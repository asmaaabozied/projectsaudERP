<?php


namespace App\Http\Controllers;

use App\Account;
use App\MainAccount;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class MainAccountController extends Controller
{

    public function destroy($id)
    {


        $slider = MainAccount::find($id);
        $slider->delete();
        flash('deleted_successfully')->success();


        return redirect()
            ->route("main.index")
            ->with("success", "account  deleted successfully");
    }



    public function create()
    {
        return view('admin.main.create');
    }

    public function index()
    {

        $user=User::find(Auth::id());

        $drivers = MainAccount::where('company_id',$user->company_id)->get();
        return view('admin.main.index', compact('drivers'));

    }


    public function store(Request $request)
    {

        $user=User::find(Auth::id());

        $admin = new MainAccount();
        $admin->name = $request->name;

        $admin->company_id=$user->company_id;
        $admin->save();
        flash('added_successfully')->success();

        return redirect()
            ->route("main.index")
            ->with("success", "main created successfully");

    }

    public function edit($id)
    {

        $driver = MainAccount::find($id);

        return view('admin.main.edit', compact('driver'));

    }

    public function update(Request $request, $id)

    {

        $admin = MainAccount::find($id);
        $admin->name = $request->name;

        $admin->save();

        flash('updated_successfully')->success();

        return redirect()
            ->route("main.index")
            ->with("success", "main updated successfully");


    }

}
