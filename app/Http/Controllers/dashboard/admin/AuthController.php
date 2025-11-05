<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Validator;
class AuthController extends Controller
{
    public function loginPage() {
        if (Auth::check()) {
            return redirect('/app-dashboard');
        }
        return view('Auth.login');
    }
    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->has('remember');
        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->status != 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Your account is inactive. Please contact support.',
                ], 403);
            }
            if (in_array($user->roles, ['Super Admin', 'Admin', 'Staff'])) {
                if (Hash::check($password, $user->password)) {
                    Auth::login($user, $remember);
                    if ($remember) {
                        cookie()->queue('remember_email', $email, 43200); // 30 days
                        cookie()->queue('remember_password', $password, 43200); // Not safe in real-world app
                    } else {
                        cookie()->queue(cookie()->forget('remember_email'));
                        cookie()->queue(cookie()->forget('remember_password'));
                    }
                    return response()->json([
                        'status' => 'success',
                        'redirect' => url('/app-dashboard'),
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Password is incorrect',
                    ], 401);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Permission Denied',
                ], 403);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials. Please check your email and password.',
            ], 404);
        }
    }
    public function dashboard()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/admin');
        }
        if (in_array($user->roles, ['Super Admin', 'Admin','Staff'])) {
            return redirect('/admin/home');
        }
        return redirect('/');
    }

    public function Signup() {
        return view('auth.signup');
    }

    public function logout(){
        $logout = Auth::logout();
        return redirect()->intended('/admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}