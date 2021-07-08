<?php


namespace App\Http\Controllers;

use App\Account;
use App\MainAccount;
use App\Permission;
use App\Store;
use App\Suppliers;
use App\Transaction;
use App\User;
use App\Years;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Hash;
class YearsController extends Controller
{

    public function destroy($id)
    {

        $slider = Years::find($id);
        $slider->delete();
        flash('deleted_successfully')->success();

        return redirect()
            ->route("years.index")
            ->with("success", "years  deleted successfully");
    }
    public function create()
    {

        return view('admin.years.create');
    }
    public function index()
    {

        $user=User::find(Auth::id());
        $drivers = Years::where('company_id',$user->company_id)->get();

        return view('admin.years.index', compact('drivers'));
    }
    public function store(Request $request)
    {

        $user=User::find(Auth::id());

        $admin = new Years();
        $admin->year= $request->year;
        $admin->company_id=$user->company_id;
        $admin->save();

        flash('added_successfully')->success();

        return redirect()
            ->route("years.index")
            ->with("success", "years created successfully");

    }

    public function edit($id)
    {

        $driver = Years::find($id);
        return view('admin.years.edit', compact('driver'));

    }

    public function update(Request $request, $id)

    {

        $admin = Years::find($id);
        $admin->year= $request->year;
        $admin->save();
        flash('updated_successfully')->success();

        return redirect()
            ->route("years.index")
            ->with("success", "years updated successfully");
    }

}
