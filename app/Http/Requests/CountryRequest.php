<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name:*' => 'required',
            'mob' => 'required',
            'code' => 'required|min:3',
            'currency'=>'required',
            'logo' => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg,orwebp',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('validation-attributes.attributes');
    }
}
