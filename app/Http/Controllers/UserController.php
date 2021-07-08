<?php


namespace App\Http\Controllers;

use App\Account;
use App\MainAccount;
use App\Permission;
use App\Store;
use App\Suppliers;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function destroy($id)
    {

        $slider = User::find($id);
        $slider->delete();

        flash('users deleted successfully')->success();

        return redirect()
            ->route("users.index")
            ->with("success", "users  deleted successfully");
    }
    public function create()
    {

        return view('admin.users.create');
    }
    public function index()
    {
        $user=User::find(Auth::id());

        $drivers = User::get();
        return view('admin.users.index', compact('drivers'));
    }
    public function store(Request $request)
    {

        $check=User::where('email',$request->email)->first();
        if ($check){
            return redirect()->back()->with('error','email exist');
        }
        $user=User::find(Auth::id());

        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->type=0;
        $admin->password = Hash::make($request->input('password'));
        $admin->company_id=Auth::id();

        $admin->save();
        if ($request->per_name) {
            for ($x = 0; $x < count($request->per_name); $x++) {
                $permission = new Permission();
                $permission->name = $request->per_name[$x];
                $permission->user_id = $admin->id;
                $permission->save();
            }
        }
        flash('users created successfully')->success();

        return redirect()
            ->route("users.index")
            ->with("success", "users created successfully");

    }

    public function edit($id)
    {

        $driver = User::find($id);
        $permissions=Permission::where('user_id',$id)->get();
        return view('admin.users.edit', compact('driver','permissions'));

    }

    public function update(Request $request, $id)

    {

        $admin = User::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->input('password'));
        }
        $admin->save();
        if ($request->per_name) {
            $checks=Permission::where('user_id',$id)->get();
            foreach ($checks as $check){
                $check->delete();
            }
            for ($x = 0; $x < count($request->per_name); $x++) {
                $permission = new Permission();
                $permission->name = $request->per_name[$x];
                $permission->user_id = $admin->id;
                $permission->save();
            }
        }

        flash('users updated successfully')->success();

        return redirect()
            ->route("users.index")
            ->with("success", "users updated successfully");
    }

}
