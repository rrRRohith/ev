<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController{
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->middleware(function ($request, $next) {
			$this->user = \Auth::user();
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        return view('admin.home');
    }
}
