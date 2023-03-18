<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request as httpRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest{
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

    public function __construct(ValidationFactory $validationFactory){     
        $validationFactory->extend(
            'vpassword',
            function($attribute, $value, $parameters){
                $user = User::where('email', $this->email)->first();
                return (!isset($user->id) || Hash::check($this->password, $user->password)) ? true : false;
            },
            'Entered password is invalid.'
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'email' => 'bail|required|email|exists:users,email',
            'password' => 'bail|required|string|vpassword',
        ];
    }
}
