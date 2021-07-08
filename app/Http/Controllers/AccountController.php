<?php


namespace App\Http\Controllers;
use Validator;
use App\Account;
use App\Branches;
use App\MainAccount;
use App\Purchase;
use App\Suppliers;
use App\Transaction;
use App\User;
use App\Years;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class AccountController extends Controller
{
    public function import(Request $request)
    {
        $this->validate($request, [
//            'select_file' => 'required|mimes:xlsx,csv'
        ]);

        $path = $request->file('select_file')->getRealPath();
//        $selectedAccount=Account::find($request->name);
//        if (!$selectedAccount)
//        {
//            return back()->with('error', $request->name. 'لايوجد  حساب باسم ');
//
//        }
        //dd($path);
        $collections = (new FastExcel)->import($path);
        $total = 0;
//        $accounts = Account::all();
//        foreach ($accounts as $account) {
//            $account->balance = 0;
//            $account->save();
//        }
        //  dd($collections);
        foreach ($collections as $collection) {
            try {

                //    dd($collection);
                $account = Account::where('number', $collection['رقم الحساب'])->first();
                if (!$account)
                    return back()->with('error', $collection['رقم الحساب'] . '  لايوجد رقم حساب ب ');
                //    dd($request->date_from);


                $transaction = Transaction::find($collection['مسلسل']);
                if (!$transaction) {
                    $transaction = new Transaction();
                    $transaction->id = $collection['مسلسل'];


                }
                $transaction->account_id = $account->id;
                $transaction->details = $collection['تفاصيل'];
                $transaction->branch = $collection['رقم الفرع'];
                $transaction->registration_number = $collection['رقم القيد'];

                $transaction->center = $collection['مركز التكلفة'];
                $transaction->date = date('Y-m-d', strtotime($collection['التاريخ']));
                $year = Years::where('name', $collection['رقم السنة المالية'])->where('company_id', $user->company_id)->first();
                $transaction->year_id = $year->id;


                if ($collection['دائن'] != null && $collection['دائن'] != '') {
                    $account->balance += $collection['دائن'];
                    $transaction->amount = $collection['دائن'];

                }
                if ($collection['مدين'] != null && $collection['مدين'] != '') {
                    $account->balance -= $collection['مدين'];
                    $transaction->amount = -$collection['مدين'];

                }

                $account->save();

                $transaction->save();

            } catch (\Exception $E) {
                return $E;

            }
        }
        //dd($collection);
        return back()->with('success', 'تم ادخال ملف اكسيل بنجاح');
    }

    public function get()
    {
        $user = User::find(Auth::id());

        $accounts = Account::where('name', '!=', 'الصندوق')->get();
        $transaction = Transaction::orderby('id', 'desc')->first();

        return view('account.catch', compact('accounts', 'transaction'));
    }

    public function entry()
    {
        $user = User::find(Auth::id());
        $branches = Branches::get();
        $accounts = Account::get();
        $transaction = Transaction::orderby('id', 'desc')->first();

        return view('account.entry', compact('accounts', 'transaction', 'branches'));
    }

    public function storeGet(Request $request)
    {

        $user = User::find(Auth::id());

        $transaction = new Transaction();

        $transaction->account_id = $request->account_id;
        $account = Account::find($request->account_id);
        $transaction->details = 'سند قبض';
        // $transaction->center=$collection['مركز التكلفة'];
        $transaction->date = date('Y-m-d', strtotime($request->date));
        $transaction->registration_number = $request->statement;

        $account->balance -= $request->money;
        $transaction->amount = -$request->money;
        $transaction->notes = $request->notes;

        $account->save();
        $transaction->save();
        $user = User::find(Auth::id());

        $transaction = new Transaction();
        $transaction->company_id = $user->company_id;
        $secondAccount = Account::where('name', '=', 'الصندوق')->first();

        $secondAccount->balance += $request->money;
        $transaction->amount = $request->money;

        $transaction->notes = $request->notes;


        $transaction->account_id = $secondAccount->id;
        $transaction->details = 'سند قبض';
        // $transaction->center=$collection['مركز التكلفة'];
        $transaction->date = date('Y-m-d', strtotime($request->date));
        $transaction->registration_number = $request->statement;


        $secondAccount->save();
        $transaction->save();
        return back()->with('success', 'تم اضافة سند قبض بنجاح');


    }

    public function postentry(Request $request)
    {

        $request->validate([
            'debtor' => 'required|same:creditor',

        ]);
        $user = User::find(Auth::id());
        for ($i = 0; $i < count($request->names); $i++) {
            $transaction = new Transaction();
            $transaction->company_id = $user->company_id;
            $transaction->registration_number = $request->registration_number;
            $transaction->account_id = $request->names[$i];
            $account = Account::find($request->names[$i]);
            $transaction->notes = $request->type;
            $transaction->branch = $request->branch;
            // $transaction->center=$collection['مركز التكلفة'];
            $transaction->date = date('Y-m-d', strtotime($request->date));
            $year = Years::where('year', date('Y'))->first();
            if ($year) {
                $transaction->year_id = $year->id;
            }
//            if ($request->debtor[$i]) {
//                $account->balance -= $request->debtor[$i];
//                $transaction->amount = -$request->debtor[$i];
//                $transaction->details = $request->statement[$i];
//
//                $account->save();
//                $transaction->save();
//            }
//            if ($request->creditor[$i]) {
//                $account->balance += $request->creditor[$i];
//                $transaction->amount = $request->creditor[$i];
//                $transaction->details = $request->statement[$i];
//
//                $account->save();
//                $transaction->save();
//            }
        }
        $transaction->save();

//        flash('added_successfully')->success();

        return back()->with('success', 'تم اضافة قيد يومي بنجاح');


    }


    public function cashing()
    {
        $user = User::find(Auth::id());

        $accounts = Account::where('name', '!=', 'الصندوق')->get();
        $transaction = Transaction::orderby('id', 'desc')->first();

        return view('account.cache', compact('accounts', 'transaction'));
    }

    public function storeCashing(Request $request)
    {

        $user = User::find(Auth::id());

        $transaction = new Transaction();
        $transaction->company_id = $user->company_id;

        $transaction->account_id = $request->account_id;
        $account = Account::find($request->account_id);
        $transaction->details = 'سند صرف';
        // $transaction->center=$collection['مركز التكلفة'];
        $transaction->date = date('Y-m-d', strtotime($request->date));

        $transaction->registration_number = $request->statement;

        $account->balance += $request->money;
        $transaction->amount = $request->money;
        $transaction->notes = $request->notes;

        $account->save();
        $transaction->save();
        $transaction = new Transaction();
        $transaction->account_id = $request->account_id;

        $secondAccount = Account::where('name', '=', 'الصندوق')->first();

        $secondAccount->balance -= $request->money;
        $transaction->amount = -$request->money;

        $transaction->notes = $request->notes;


        $transaction->account_id = $secondAccount->id;
        $transaction->details = 'سند صرف';
        // $transaction->center=$collection['مركز التكلفة'];
        $transaction->date = date('Y-m-d', strtotime($request->date));

        $transaction->registration_number = $request->statement;

        $secondAccount->save();
        $transaction->save();
        flash('added_successfully')->success();

        return back()->with('success', 'تم اضافة سند صرف بنجاح');


    }

    public function destroy($id)
    {
//
//        if (!isset(Auth)) {
//            return redirect('/admin/login');
//        }
        $slider = Account::find($id);
        $slider->delete();
        flash('deleted_successfully')->success();

        return redirect()
            ->route("account.index")
            ->with("success", "account  deleted successfully");
    }

    public function deleteStatement($id)
    {

//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $slider = Transaction::find($id);
        $account = Account::find($slider->account_id);
        if ($slider->amount > 0) {
            $account->balance -= $slider->amount;


        } else {
            $account->balance += -$slider->amount;

        }
        $account->save();
        $sliders = Transaction::where('registration_number', $slider->registration_number)->get();
        foreach ($sliders as $s) {
            $s->delete();
        }
        $slider->delete();

        return back()
            ->with("success", "تم حذف القيد بنجاح");
    }

    public function upload()
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $accounts = Account::all();
        return view('account.upload', compact('accounts'));

    }

    public function create()
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $user = User::find(Auth::id());

        $mains = MainAccount::get();
        return view('admin.account.create', compact('mains'));
    }

    public function index()
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
//        return Auth::id();

        $user = User::find(Auth::id());
        $drivers = Account::where('company_id', $user->company_id)->get();
        return view('admin.account.index', compact('drivers'));

    }

    public function review(Request $request)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $user = User::find(Auth::id());
        $branches = Branches::get();
        $years = Years::get();
        $drivers = Account::get();
        foreach ($drivers as $driver) {
            $driver->credit = 0;
            $driver->depit = 0;

            if ($request->get('branch') && $request->get('from') && $request->get('to') && $request->get('year_id')) {
                $credits = Transaction::where('branch', $request->get('branch'))->where('year_id', $request->get('year_id'))->where('date', '>=', $request->get('from'))
                    ->where('date', '<=', $request->get('to'))->where('amount', '<', 0)->get();
                $depits = Transaction::where('branch', $request->get('branch'))->where('year_id', $request->get('year_id'))->where('date', '>=', $request->get('from'))
                    ->where('date', '<=', $request->get('to'))->where('amount', '>', 0)->get();
            } elseif ($request->get('from') && $request->get('to') && $request->get('year_id')) {
                $credits = Transaction::where('date', '>=', $request->get('from'))->where('year_id', $request->get('year_id'))
                    ->where('date', '<=', $request->get('to'))->where('amount', '<', 0)->get();
                $depits = Transaction::where('date', '>=', $request->get('from'))->where('year_id', $request->get('year_id'))
                    ->where('date', '<=', $request->get('to'))->where('amount', '>', 0)->get();
            } elseif ($request->get('from') && $request->get('year_id')) {
                $credits = Transaction::where('date', '>=', $request->get('from'))->where('year_id', $request->get('year_id'))
                    ->where('amount', '<', 0)->where('company_id', $user->company_id)->get();
                $depits = Transaction::where('date', '>=', $request->get('from'))->where('year_id', $request->get('year_id'))
                    ->where('amount', '>', 0)->where('company_id', $user->company_id)->get();
            } elseif ($request->get('to') && $request->get('year_id')) {
                $credits = Transaction::where('date', '<=', $request->get('to'))->where('year_id', $request->get('year_id'))
                    ->where('amount', '<', 0)->where('company_id', $user->company_id)->get();
                $depits = Transaction::where('date', '<=', $request->get('to'))->where('year_id', $request->get('year_id'))
                    ->where('amount', '>', 0)->where('company_id', $user->company_id)->get();
            } elseif ($request->get('branch') && $request->get('year_id')) {
                $credits = Transaction::where('branch', $request->get('branch'))->where('year_id', $request->get('year_id'))->where('amount', '<', 0)->get();
                $depits = Transaction::where('branch', $request->get('branch'))->where('year_id', $request->get('year_id'))->where('amount', '>', 0)->get();
            } elseif ($request->get('from') && $request->get('to')) {
                $credits = Transaction::where('date', '>=', $request->get('from'))
                    ->where('date', '<=', $request->get('to'))->where('amount', '<', 0)->get();
                $depits = Transaction::where('date', '>=', $request->get('from'))
                    ->where('date', '<=', $request->get('to'))->where('amount', '>', 0)->get();
            } elseif ($request->get('from')) {
                $credits = Transaction::where('date', '>=', $request->get('from'))
                    ->where('amount', '<', 0)->get();
                $depits = Transaction::where('date', '>=', $request->get('from'))
                    ->where('amount', '>', 0)->get();
            } elseif ($request->get('to')) {
                $credits = Transaction::where('date', '<=', $request->get('to'))
                    ->where('amount', '<', 0)->get();
                $depits = Transaction::where('date', '<=', $request->get('to'))
                    ->where('amount', '>', 0)->get();
            } elseif ($request->get('branch')) {
                $credits = Transaction::where('branch', $request->get('branch'))->where('amount', '<', 0)->get();
                $depits = Transaction::where('branch', $request->get('branch'))->where('amount', '>', 0)->get();
            } elseif ($request->get('year_id')) {
                $credits = Transaction::where('year_id', $request->get('year_id'))->where('amount', '<', 0)->get();
                $depits = Transaction::where('year_id', $request->get('year_id'))->where('amount', '>', 0)->get();
            } else {
                $credits = Transaction::where('account_id', $driver->id)->where('amount', '<', 0)->get();
                $depits = Transaction::where('account_id', $driver->id)->where('amount', '>', 0)->get();
            }
            foreach ($credits as $credit) {
                $driver->credit += $credit->amount;
            }
            foreach ($depits as $credit) {
                $driver->depit += $credit->amount;
            }

        }
        return view('account.review', compact('drivers', 'years', 'branches'));

    }

    public function store(Request $request)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $user = User::find(Auth::id());

        $admin = new Account();
        $admin->number = $request->number;
        $admin->name = $request->name;
        $admin->date = $request->date;

        $admin->debit_salary = $request->debit;
        $admin->credit_salary = $request->credit;
        $admin->main_id = $request->main_id;
        $admin->company_id = $user->company_id;
        $admin->save();
        flash('created_successfully')->success();
        return redirect()
            ->route("account.index")
            ->with("success", "account created successfully");

    }

    public function edit($id)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $user = User::find(Auth::id());

        $driver = Account::find($id);
        $mains = MainAccount::get();

        return view('admin.account.edit', compact('driver', 'mains'));

    }

    public function update(Request $request, $id)

    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $admin = Account::find($id);
        $admin->number = $request->number;
        $admin->name = $request->name;
        $admin->debit_salary = $request->debit;
        $admin->credit_salary = $request->credit;
        $admin->main_id = $request->main_id;
        $admin->date = $request->date;

        $admin->save();
        flash('updated_successfully')->success();

        return redirect()
            ->route("account.index")
            ->with("success", "account updated successfully");


    }

    public function show($id)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $trip = Account::find($id);
        return view('admin.account.show', compact('trip'));

    }

    public function search(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->account_id && $request->from && $request->to && $request->year_id) {
            $drivers = Transaction::where('year_id', $request->year_id)->where('account_id', $request->account_id)->where('date', '>=', $request->from)->where('date', '<', $request->to)->get();
        } elseif ($request->year_id && $request->from && $request->to) {
            $drivers = Transaction::where('year_id', $request->year_id)->where('date', '>=', $request->from)->where('date', '<', $request->to)->get();
        } elseif ($request->account_id && $request->from && $request->to) {
            $drivers = Transaction::where('account_id', $request->account_id)->where('date', '>=', $request->from)->where('date', '<', $request->to)->get();
        } elseif ($request->year_id && $request->account_id) {
            $drivers = Transaction::where('year_id', $request->year_id)->where('account_id', $request->account_id)->get();
        } elseif ($request->account_id) {
            $drivers = Transaction::where('account_id', $request->account_id)->get();
        } elseif ($request->from && $request->to) {
            $drivers = Transaction::where('date', '>=', $request->from)->where('date', '<', $request->to)->get();
        } elseif ($request->year_id) {
            $drivers = Transaction::where('year_id', $request->year_id)->get();

        } else {
            $drivers = Transaction::get();
        }
        $accounts = Account::get();
        $years = Years::get();

        return view('account.statement', compact('accounts', 'drivers', 'years'));
    }

    public function daily()
    {
        $user = User::find(Auth::id());

        $drivers = Transaction::get();

        return view('account.daily', compact('drivers'));
    }

    public function userTransaction($id)
    {
        $drivers = Transaction::where('account_id', $id)->get();

        return view('account.userTransaction', compact('drivers'));
    }

    public function transaction($id)
    {
        $drivers = Transaction::where('registration_number', $id)->get();

        return view('account.transactions', compact('drivers'));

    }

    public function statement()
    {
        $user = User::find(Auth::id());
        $years = Years::get();
        $accounts = Account::get();
        return view('account.statement', compact('accounts', 'years'));
    }

    public function report(Request $request)
    {
        if ($request->from && $request->to && $request->supplier) {
            $accounts = Purchase::where('date', '<=', $request->from)->where('date', '>=', $request->to)
                ->where('supplier_id', $request->supplier)->get();
        } elseif ($request->from && $request->to) {
            $accounts = Purchase::where('date', '<=', $request->from)->where('date', '>=', $request->to)->get();
        } elseif ($request->supplier) {
            $accounts = Purchase::where('supplier_id', $request->supplier)->get();
        } else {
            $accounts = array();
        }
        $user = User::find(Auth::id());
//    return $user;
        $suppliers = Suppliers::get();

        return view('account.report', compact('accounts', 'suppliers'));
    }

    public function catch_view()
    {
        $user = User::find(Auth::id());

        $drivers = Transaction::where('details', 'سند قبض')->get();

        return view('account.catchView', compact('drivers'));
    }

    public function cashing_view()
    {
        $user = User::find(Auth::id());

        $drivers = Transaction::where('details', 'سند صرف')->where('company_id', $user->company_id)->get();

        return view('account.cashingView', compact('drivers'));
    }
}
