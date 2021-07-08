<?php


namespace App\Http\Controllers;

use App\Account;
use App\MainAccount;
use App\Store;
use App\Suppliers;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class SuppliersController extends Controller
{

    public function destroy($id)
    {

        $slider = Suppliers::find($id);
        $slider->delete();
        flash('deleted_successfully')->success();

        return redirect()
            ->route("supplier.index")
            ->with("success", "supplier  deleted successfully");
    }

    public function create()
    {

        return view('admin.supplier.create');
    }

    public function index()
    {

        $drivers = Suppliers::get();
        return view('admin.supplier.index', compact('drivers'));
    }

    public function store(Request $request)
    {

        $user = User::find(Auth::id());

        $admin = new Suppliers();
        $admin->name = $request->name;
        $admin->company_id = $user->comapny_id;
        $admin->save();
        flash('added_successfully')->success();

        return redirect()
            ->route("supplier.index")
            ->with("success", "supplier created successfully");

    }

    public function edit($id)
    {

        $driver = Suppliers::find($id);

        return view('admin.supplier.edit', compact('driver'));

    }

    public function update(Request $request, $id)

    {
        $admin = Suppliers::find($id);
        $admin->name = $request->name;

        $admin->save();

        flash('updated_successfully')->success();

        return redirect()
            ->route("supplier.index")
            ->with("success", "supplier updated successfully");


    }

}
