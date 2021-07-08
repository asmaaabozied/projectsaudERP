<?php


namespace App\Http\Controllers;

use App\Account;
use App\Company;
use App\MainAccount;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class CompanyController extends Controller
{

    public function destroy($id)
    {


        $slider = Company::find($id);
        $slider->delete();
        flash('deleted_successfully')->success();


        return redirect()
            ->route("company.index")
            ->with("success", "account  deleted successfully");
    }



    public function create()
    {
        return view('admin.company.create');
    }

    public function index()
    {

        $user=User::find(Auth::id());

        $drivers = Company::get();
        return view('admin.company.index', compact('drivers'));

    }


    public function store(Request $request)
    {

        $user=User::find(Auth::id());

        $admin = new Company();
        $admin->name = $request->name;

        $admin->save();
        flash('added_successfully')->success();

        return redirect()
            ->route("company.index")
            ->with("success", "company created successfully");

    }

    public function edit($id)
    {

        $driver = Company::find($id);

        return view('admin.company.edit', compact('driver'));

    }

    public function update(Request $request, $id)

    {

        $admin = Company::find($id);
        $admin->name = $request->name;

        $admin->save();

        flash('updated_successfully')->success();

        return redirect()
            ->route("company.index")
            ->with("success", "company updated successfully");


    }

}
