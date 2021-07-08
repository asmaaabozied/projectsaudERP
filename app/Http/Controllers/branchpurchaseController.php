<?php


namespace App\Http\Controllers;

use App\Account;
use App\Baku;
use App\Box;
use App\Branchexpence;
use App\BranchexpercesAttr;
use App\Branchpurchase;
use App\BranchpurchaseAttr;
use App\Carton;
use App\Classification;
use App\MainAccount;
use App\Products;
use App\Purchase;
use App\PurchaseProduct;
use App\Store;
use App\Suppliers;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class branchpurchaseController extends Controller
{

    public function destroy($id)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $slider = Products::find($id);
        $slider->delete();
        $baku = Baku::where('product_id', $id)->first();
        if ($baku) {
            $baku->delete();
        }
        $box = Box::where('product_id', $id)->first();
        if ($box) {
            $box->delete();
        }
        $carton = Carton::where('product_id', $id)->first();
        if ($carton) {
            $carton->delete();
        }
        return redirect()
            ->route("products.index")
            ->with("success", "products  deleted successfully");
    }

    public function create()
    {

        $user = User::find(Auth::id());

        $classifications = Classification::get();

        $stores = Store::get();
        $suppliers = Suppliers::get();
        $products = Products::get();
        return view('admin.purchase.create', compact('stores', 'classifications', 'suppliers', 'products'));
    }


    public function index()
    {

        $user = User::find(Auth::id());

        $stores = Store::get();
        $suppliers = Suppliers::get();
        $drivers = Branchpurchase::where('company_id', $user->company_id)->get();
        return view('admin.branchpurchases.index', compact('drivers', 'suppliers', 'stores'));
    }


    public function show($id)
    {
//        $user=User::find($_SESSION['admin_id']);

        $driver = Purchase::find($id);
        $classifications = Classification::get();
        $stores = Store::get();
        $suppliers = Suppliers::get();
//        $products=Products::all();

        $products = PurchaseProduct::where('purchase_id', $id)->get();
        return view('admin.purchase.show', compact('driver', 'suppliers', 'stores', 'classifications', 'products'));
    }


    public function store(Request $request)
    {
        $user = User::find(Auth::id());

        $admin = new Branchpurchase();
        $admin->date1 = date('Y-m-d', strtotime($request->date1));
        $admin->supplier_id = $request->supplier_id;
        $admin->store_id = $request->store_id;
        $admin->branch_id = $request->branch_id;
        $admin->type = $request->type;
        $admin->registration_number = $request->registration_number;
        $admin->company_id = $user->company_id;
        $admin->save();

        foreach ($request->date as $key => $value)


            BranchpurchaseAttr::create([

                'date' => $request['date'][$key],
                'number' => $request['number'][$key],

                'aftertax' => $request['aftertax'][$key],

                'valuetax' => $request['valuetax'][$key],

                'tax' => $request['tax'][$key],

                'amount' => $request['amount'][$key],

                'company' => $request['company'][$key],

                'branchpurchase_id' => $admin->id


            ]);

        flash('created_successfully')->success();

        return redirect()
            ->back()
            ->with("success", "purchase invoice created successfully");

    }

    public function branchexperences(Request $request)
    {
        $user = User::find(Auth::id());

        $admin = new Branchexpence();
        $admin->date1 = date('Y-m-d', strtotime($request->date1));
        $admin->supplier_id = $request->supplier_id;
        $admin->store_id = $request->store_id;
        $admin->branch_id = $request->branch_id;
        $admin->registration_number = $request->registration_number;
        $admin->company_id = $user->company_id;
        $admin->save();

        foreach ($request->date as $key => $value)


            BranchexpercesAttr::create([

                'date' => $request['date'][$key],
                'number' => $request['number'][$key],

                'aftertax' => $request['aftertax'][$key],

                'valuetax' => $request['valuetax'][$key],

                'tax' => $request['tax'][$key],

                'amount' => $request['amount'][$key],

                'company' => $request['company'][$key],

                'branchpurchase_id' => $admin->id


            ]);

        flash('created_successfully')->success();

        return redirect()
            ->back()
            ->with("success", "purchase invoice created successfully");

    }


    public function storeSell(Request $request)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $user = User::find(Auth::id());

        $admin = new Purchase();
        $admin->date = date('Y-m-d', strtotime($request->date));
        $admin->client = $request->client;
        $admin->store_id = $request->store;
        $admin->discount = $request->discount;
        $admin->order = $request->order;
        $admin->type = $request->type;
        $admin->tax = $request->tax;
        $admin->total = $request->final;
        $admin->return = 3;
        $admin->registration_number = $request->registration_number;
        $admin->company_id = $user->company_id;
        $admin->save();
        $total = 0;
        for ($i = 0; $i < count($request->name); $i++) {
            $purchaseProduct = new PurchaseProduct();
            $purchaseProduct->purchase_id = $admin->id;

            $purchaseProduct->product_id = $request->name[$i];
            $purchaseProduct->quantity = $request->quantity[$i];
            $purchaseProduct->unit = $request->unit[$i];
            $purchaseProduct->total = $request->totals[$i];
            $total += $request->totals[$i];
//            if ($request->unit[$i] == 'وحدة') {
//                $product = Baku::where('product_id', $request->id)->first();
//                if ($product) {
//                    $product->current_price -= $request->quantity[$i];
//                    $product->save();
//                }
//            } else if ($request->unit[$i] == 'علبة') {
//                $product = Box::where('product_id', $request->id)->first();
//                if ($product) {
//                    $product->current_price_2 -= $request->quantity[$i];;
//                    $product->save();
//
//
//                }
//
//            } else if ($request->unit[$i] == 'كارتونة') {
//                $product = Carton::where('product_id', $request->id)->first();
//                if ($product) {
//
//                    $product->current_price_3 -= $request->quantity[$i];;
//                    $product->save();
//
//                }
//
//            }
            $purchaseAccount = Account::where('name', 'المبيعات')->first();
            $transaction = new Transaction();
            $transaction->date = date('Y-m-d', strtotime($request->date));
            $transaction->account_id = $purchaseAccount->id;
//            $transaction->amount = $total;
            $transaction->details = 'فاتورة مبيعات';
            $transaction->registration_number = $request->registration_number;

            $transaction->save();


            $purchaseAccount = Account::where('name', 'الضريبة')->first();
            $transaction = new Transaction();
            $transaction->date = date('Y-m-d', strtotime($request->date));
            $transaction->account_id = $purchaseAccount->id;
//            $transaction->amount = -$request->tax;
            $transaction->details = 'فاتورة مبيعات';
            $transaction->registration_number = $request->registration_number;

            $transaction->save();

            if ($admin->discount >= 0) {
                $purchaseAccount = Account::where('name', 'الخصم')->first();
                $transaction = new Transaction();
                $transaction->date = date('Y-m-d', strtotime($request->date));
                $transaction->account_id = $purchaseAccount->id;
//                $transaction->amount = -$request->discount;
                $transaction->details = 'فاتورة مبيعات';
                $transaction->registration_number = $request->registration_number;

                $transaction->save();
            }

            if ($request->type == 'نقدي') {
                $purchaseAccount = Account::where('name', 'الصندوق')->first();
                $transaction = new Transaction();
                $transaction->date = date('Y-m-d', strtotime($request->date));
                $transaction->account_id = $purchaseAccount->id;
//                $transaction->amount = -($total - $request->discount + $request->tax);
                $transaction->details = 'فاتورة مبيعات';
                $transaction->registration_number = $request->registration_number;

                $transaction->save();
            }
            if ($request->type == 'فيزا') {
                $purchaseAccount = Account::where('name', 'البنك')->first();
                $transaction = new Transaction();
                $transaction->date = date('Y-m-d', strtotime($request->date));
                $transaction->account_id = $purchaseAccount->id;
//                $transaction->amount = -($total - $request->discount + $request->tax);
                $transaction->details = 'فاتورة مبيعات';
                $transaction->registration_number = $request->registration_number;

                $transaction->save();
            }
            if ($request->type == 'اجل') {

                $purchaseAccount = Account::where('name', $request->client)->first();
                if (!$purchaseAccount) {
                    $purchaseAccount = new Account();
                    $purchaseAccount->name = $request->client;
                    $purchaseAccount->save();
                }
                $transaction = new Transaction();
                $transaction->date = date('Y-m-d', strtotime($request->date));
                $transaction->account_id = $purchaseAccount->id;
//                $transaction->amount = -($total - $admin->discount + $request->tax);
                $transaction->details = 'فاتورة مبيعات';
                $transaction->registration_number = $request->registration_number;

                $transaction->save();
            }


        }

        return redirect()
            ->back()
            ->with("success", "sell invoice created successfully");

    }

    public function storeSellReturn(Request $request)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $user = User::find(Auth::id());

        $admin = new Purchase();
        $admin->date = date('Y-m-d', strtotime($request->date));
        $admin->client = $request->client;
        $admin->store_id = $request->store;
        $admin->discount = $request->discount;
        $admin->order = $request->order;
        $admin->type = $request->type;
        $admin->tax = $request->tax;
        $admin->total = $request->final;
        $admin->return = 4;
        $admin->registration_number = $request->registration_number;
        $admin->company_id = $user->company_id;
        $admin->save();
        $total = 0;
        for ($i = 0; $i < count($request->name); $i++) {
            $purchaseProduct = new PurchaseProduct();
            $purchaseProduct->purchase_id = $admin->id;

            $purchaseProduct->product_id = $request->name[$i];
            $purchaseProduct->quantity = $request->quantity[$i];
            $purchaseProduct->unit = $request->unit[$i];
            $purchaseProduct->total = $request->totals[$i];
            $total += $request->totals[$i];
//            if ($request->unit[$i] == 'وحدة') {
//                $product = Baku::where('product_id', $request->id)->first();
//                if ($product) {
//                    $product->current_price += $request->quantity[$i];
//                    $product->save();
//                }
//            } else if ($request->unit[$i] == 'علبة') {
//                $product = Box::where('product_id', $request->id)->first();
//                if ($product) {
//                    $product->current_price_2 += $request->quantity[$i];
//                    $product->save();
//
//
//                }
//
//            } else if ($request->unit[$i] == 'كارتونة') {
//                $product = Carton::where('product_id', $request->id)->first();
//                if ($product) {
//
//                    $product->current_price_3 += $request->quantity[$i];;
//                    $product->save();
//
//                }
//
//            }
            $purchaseAccount = Account::where('name', 'المبيعات')->first();
            $transaction = new Transaction();
            $transaction->date = date('Y-m-d', strtotime($request->date));
            $transaction->account_id = $purchaseAccount->id;
            $transaction->amount = -$total;
            $transaction->details = 'فاتورة مردود مبيعات';
            $transaction->registration_number = $request->registration_number;

            $transaction->save();


            $purchaseAccount = Account::where('name', 'الضريبة')->first();
            $transaction = new Transaction();
            $transaction->date = date('Y-m-d', strtotime($request->date));
            $transaction->account_id = $purchaseAccount->id;
            $transaction->amount = $request->tax;
            $transaction->details = 'فاتورة مردود مبيعات';
            $transaction->registration_number = $request->registration_number;

            $transaction->save();

            if ($admin->discount >= 0) {
                $purchaseAccount = Account::where('name', 'الخصم')->first();
                $transaction = new Transaction();
                $transaction->date = date('Y-m-d', strtotime($request->date));
                $transaction->account_id = $purchaseAccount->id;
                $transaction->amount = $request->discount;
                $transaction->details = 'فاتورة مردود مبيعات';
                $transaction->registration_number = $request->registration_number;

                $transaction->save();
            }

            if ($request->type == 'نقدي') {
                $purchaseAccount = Account::where('name', 'الصندوق')->first();
                $transaction = new Transaction();
                $transaction->date = date('Y-m-d', strtotime($request->date));
                $transaction->account_id = $purchaseAccount->id;
//                $transaction->amount = ($total - $request->discount + $request->tax);
                $transaction->details = 'فاتورة مردود مبيعات';
                $transaction->registration_number = $request->registration_number;

                $transaction->save();
            }
            if ($request->type == 'فيزا') {
                $purchaseAccount = Account::where('name', 'البنك')->first();
                $transaction = new Transaction();
                $transaction->date = date('Y-m-d', strtotime($request->date));
                $transaction->account_id = $purchaseAccount->id;
                $transaction->amount = ($total - $request->discount + $request->tax);
                $transaction->details = 'فاتورة مردود مبيعات';
                $transaction->registration_number = $request->registration_number;

                $transaction->save();
            }
            if ($request->type == 'اجل') {

                $purchaseAccount = Account::where('name', $request->client)->first();
                if (!$purchaseAccount) {
                    $purchaseAccount = new Account();
                    $purchaseAccount->name = $request->client;
                    $purchaseAccount->save();
                }
                $transaction = new Transaction();
                $transaction->date = date('Y-m-d', strtotime($request->date));
                $transaction->account_id = $purchaseAccount->id;
                $transaction->amount = ($total - $admin->discount + $request->tax);
                $transaction->details = 'فاتورة مردود مبيعات';
                $transaction->registration_number = $request->registration_number;

                $transaction->save();
            }


        }

        return redirect()
            ->back()
            ->with("success", "sell return invoice created successfully");

    }

    public function edit($id)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $driver = Products::find($id);
        $baku = Baku::where('product_id', $id)->first();
        $box = Box::where('product_id', $id)->first();
        $carton = Carton::where('product_id', $id)->first();
        $user = User::find($_SESSION['admin_id']);

        $classifications = Classification::where('company_id', $user->company_id)->get();
        $stores = Store::where('company_id', $user->company_id)->get();
        $suppliers = Suppliers::where('company_id', $user->company_id)->get();
        return view('admin.products.edit', compact('driver', 'baku', 'box', 'carton', 'stores', 'suppliers', 'classifications'));

    }

    public function update(Request $request, $id)

    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $admin = Products::find($id);
        $admin->name = $request->name;
        $admin->supplier_id = $request->supplier_id;
        $admin->store_id = $request->store_id;
        $admin->classificaiton_id = $request->classificaiton_id;
        $admin->min_price = $request->min_price;
        $admin->max_price = $request->max_price;
        $admin->price_system = $request->price_system;
        $admin->save();
        $baku = Baku::where('product_id', $id)->first();
        $baku->type = $request->type;
        $baku->price = $request->price;
        $baku->order = $request->order;
        $baku->bacode1 = $request->bacode1;
        $baku->bacode2 = $request->bacode2;
        $baku->current_price = $request->current_price;
        $baku->dicount = $request->dicount;
        $baku->unit = $request->unit;
        $box = Box::where('product_id', $id)->first();
        $box->type_2 = $request->type_2;
        $box->price_2 = $request->price_2;
        $box->order_2 = $request->order_2;
        $box->bacode1_2 = $request->bacode1_2;
        $box->bacode2_2 = $request->bacode2_2;
        $box->current_price_2 = $request->current_price_2;
        $box->dicount_2 = $request->dicount_2;
        $box->unit_2 = $request->unit_2;
        $box->save();
        $carton = Carton::where('product_id', $id)->first();
        $carton->type_3 = $request->type_3;
        $carton->price_3 = $request->price_3;
        $carton->order_3 = $request->order_3;
        $carton->bacode1_3 = $request->bacode1_3;
        $carton->bacode2_3 = $request->bacode2_3;
        $carton->current_price_3 = $request->current_price_3;
        $carton->dicount_3 = $request->dicount_3;
        $carton->unit_3 = $request->unit_3;
        $carton->save();
        return redirect()
            ->route("products.index")
            ->with("success", "products updated successfully");


    }

    public function deletepurchase($id)
    {
        $purchase = Purchase::find($id);
        $trans = Transaction::where('registration_number', $purchase->registration_number)->get();
        if (count($trans) > 0) {
            foreach ($trans as $tran) {
                $tran->delete();
            }
        }
        $purchase->delete();

        return back()
            ->with("success", "تم حذف القيد بنجاح");
    }

}
