<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController{
    use AuthorizesRequests, ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    /**
     * Send error response
     * 
     * @param \Exception $e
     * @param string|null $redirect
     */

     public function error(\Exception $e, string $redirect = null){
        return request()->ajax() ? response()->json([
            'success' => false,
            'message' => __('Opps, something went wrong.'),
            'redirect' => $redirect ? : null,
        ]) : ($redirect ? redirect()->url($redirect)->withError(__('Opps, something went wrong.')) : redirect()->back()->withError(__('Opps, something went wrong.')));
    }
}
