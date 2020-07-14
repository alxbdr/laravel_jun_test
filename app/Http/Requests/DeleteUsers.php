<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteUsers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'email' => 'required|email',
            'password' => 'required|password'
        ];
    }

    /**
     * Determine if credentials are correct and user owns the profile 
     *
     * @return bool
     */
    public function confirmed () {
        $credentials = $this->validator->validated();
        if (Auth::user()->email != $credentials['email'] || !Auth::attempt($credentials)) {
            return redirect()->back()->withErrors(['password'=>'Confirmation failed'])->withInput();
        }
        return true;
    }
}
