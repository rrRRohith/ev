<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request as httpRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    public function failedValidation(Validator $validator){
        if($this->ajax()){
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Opps, there are some problems.',
                'data'      => $validator->errors()
            ], 422));
        }
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name' => 'bail|required|string',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'bail|required|string|',
        ];
    }
}
