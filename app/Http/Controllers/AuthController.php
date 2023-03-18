<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller{

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request){
        parent::__construct();
        $this->redirectTo = $request->requestPath ? url($request->requestPath) : $this->redirectTo;
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login user
     * @param  LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request){
        auth()->attempt(['email' => $request->email, 'password' => $request->password]);
        return !$request->ajax() ? redirect($this->redirectTo) : response()->json([
            'success' => true,
            'message' => __('Login success.'),
            'redirect' => $this->redirectTo,
        ]);
    }

    /**
     * Logout user
     * @param  Request $request
     * @return Response
     */
    public function logout(Request $request){
        auth()->logout();
        return !$request->ajax() ? redirect($this->redirectTo) : response()->json([
            'success' => true,
            'message' => __('Logout success.'),
            'redirect' => $this->redirectTo,
        ]);
    }

}
