<?php


namespace App\Http\Controllers;

use App\Account;
use App\Classification;
use App\MainAccount;
use App\Store;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class ClassificationController extends Controller
{

    public function destroy($id)
    {

        $slider = Classification::find($id);
        $slider->delete();
        flash('deleted_successfully')->success();

        return redirect()
            ->route("classification.index")
            ->with("success", "classification  deleted successfully");
    }
    public function create()
    {

        return view('admin.classification.create');
    }
    public function index()
    {

        $user=User::find(Auth::id());

        $drivers = Classification::get();
        return view('admin.classification.index', compact('drivers'));
    }
    public function store(Request $request)
    {

        $user=User::find(Auth::id());

        $admin = new Classification();
        $admin->name = $request->name;
        $admin->company_id=$user->company_id;
        $admin->save();

        flash('added_successfully')->success();

        return redirect()
            ->route("classification.index")
            ->with("success", "classification created successfully");

    }

    public function edit($id)
    {

        $driver = Classification::find($id);

        return view('admin.classification.edit', compact('driver'));

    }

    public function update(Request $request, $id)

    {

        $admin = Classification::find($id);
        $admin->name = $request->name;

        $admin->save();

        flash('updated_successfully')->success();

        return redirect()
            ->route("classification.index")
            ->with("success", "classification updated successfully");


    }

}
