<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FecharAulaRequest extends FormRequest
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
            'data' => 'required|string'
        ];
    }

    public function messages()
    {
        return[
            'data.required' => 'Insira a data de fim'
        ];
    }
}
