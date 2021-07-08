<?php


namespace App\Http\Controllers;

use App\Tips;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->post()) {


//            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
//                // if successful, then redirect to their intended location
//                return redirect('/admin/dashboard');
//            }else{
//
//                return redirect()->back()->with('error', 'Credentials Doesn\'t Match !');
//
//            }

            $user = User::where('email', $request->input('email'))->first();
            if ($user == null) {
                return redirect()->back()->with('error', 'email not exist');
            } else {
                if (!Hash::check($request->input('password'), $user->password)) {
                    return redirect()->back()->with('error', 'password not matching');

                } else {
//                    $_SESSION['admin_id'] = $user->id;
                    Auth::login($user);

                    return redirect('/admin/dashboard');
                }
            }
        }
        return view('admin.login');
    }

    public function page()
    {
        return view('admin.pages.index');

    }

    public function index()
    {
        return view('admin.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
