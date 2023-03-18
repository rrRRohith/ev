<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request as httpRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CarRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return auth()->check();
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
            'name' => 'required|string',
            'trim' => 'required|string',
            'make' => 'required|string',
            'drive_range' => 'required|numeric|min:0',
            'charger_type' => 'required|string',
            'charging_time' => 'required|numeric|min:0',
            'description' => 'sometimes|nullable|string'
        ];
    }
}

