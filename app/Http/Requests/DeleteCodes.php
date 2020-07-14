<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCodes extends FormRequest
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
            'codes' => 'required|string|min:10',
        ];
    }

    /**
     * Get codes from the input
     * 
     * @return array
     */
    public function validated () {
        $validated = $this->validator->validated();
        $codes = preg_split("/[\s,]+/",  $validated['codes']);
        if (!count($codes) > 0) {
            return redirect()->back()->withErrors(['codes'=>'Wpisz poprawny kod'])->withInput();
        }
        
        return $codes;
    }
}
