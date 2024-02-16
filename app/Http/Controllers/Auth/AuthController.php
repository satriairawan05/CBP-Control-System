<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Display a listing for User of the resource.
     */
    public function showRegisterForm()
    {
        return view('auth.register', [
            'role' => \App\Models\Group::whereNot('group_id', 1)->get()
        ]);
    }

    /**
     * Process register for User.
     */
    public function register(Request $request)
    {
        $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name'   => ['required', 'string', 'min:4', 'max:255'],
            'email'   => ['required', 'string', 'email', 'unique:users,email', 'regex:/(.*)@gmail\.com/i'],
            'password' => ['required', 'string', 'min:4', 'max:8', 'confirmed']
        ]);

        if (!$validated->fails()) {
            \Illuminate\Support\Facades\DB::beginTransaction();
            try {
                \App\Models\User::Create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'group_id' => $request->input('group_id')
                ]);

                $user = \App\Models\User::where('email', $request->input('email'))->first();

                $user->notify(new \App\Notifications\UserRegisteredNotification($request->input('name')));

                \Illuminate\Support\Facades\DB::commit();
                \Illuminate\Support\Facades\Log::info('User ' . $request->input('name') . ' telah berhasil terdaftar di sistem!');

                return redirect()->back()->with('success', 'Data saved, please sign in!');
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\DB::rollBack();
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('loginError', $e->getMessage())->withInput();
            }
        } else {
            \Illuminate\Support\Facades\Log::error($validated->getMessageBag());
            return redirect()->back()->withErrors($validated->getMessageBag())->withInput();
        }
    }

    /**
     * Display a listing for User of the resource.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Process login for User.
     */
    public function login(Request $request)
    {
        $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email'   => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:4', 'max:8']
        ]);

        if (!$validated->fails()) {
            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
                \Illuminate\Support\Facades\Log::info('User dengan email ' . $request->input('email') . ' telah berhasil login di sistem!');
                return redirect()->to(route('home'))->with('success', 'Successfully Logged In!');
            }
            return redirect()->back()->with('loginError', 'Email atau Password salah');
        } else {
            \Illuminate\Support\Facades\Log::error($validated->getMessageBag());
            return redirect()->back()->withErrors($validated->getMessageBag())->withInput();
        }
    }

    /**
     * Process logout for User.
     */
    public function logout(Request $request)
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            \Illuminate\Support\Facades\Log::info('User dengan email' . \Illuminate\Support\Facades\Auth::user()->email . ' telah keluar dari sistem!');
            \Illuminate\Support\Facades\Auth::logout();
            return redirect()->route('login');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('login');
    }
}
