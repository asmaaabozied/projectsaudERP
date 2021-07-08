<?php


namespace App\Http\Controllers;

use App\Account;
use App\MainAccount;
use App\Store;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class StoreController extends Controller
{

    public function destroy($id)
    {

        $slider = Store::find($id);
        $slider->delete();
        flash('deleted_successfully')->success();

        return redirect()
            ->route("store.index")
            ->with("success", "store  deleted successfully");
    }
    public function create()
    {

        return view('admin.store.create');
    }
    public function index()
    {

        $user=User::find(Auth::id());

        $drivers = Store::where('company_id',$user->company_id)->get();
        return view('admin.store.index', compact('drivers'));
    }
    public function store(Request $request)
    {

        $user=User::find(Auth::id());

        $admin = new Store();
        $admin->name = $request->name;
        $admin->company_id=$user->company_id;
        $admin->save();
        flash('added_successfully')->success();

        return redirect()
            ->route("store.index")
            ->with("success", "store created successfully");

    }

    public function edit($id)
    {
        $driver = Store::find($id);

        return view('admin.store.edit', compact('driver'));

    }

    public function update(Request $request, $id)

    {

        $admin = Store::find($id);
        $admin->name = $request->name;

        $admin->save();
        flash('updated_successfully')->success();

        return redirect()
            ->route("store.index")
            ->with("success", "store updated successfully");


    }

}
