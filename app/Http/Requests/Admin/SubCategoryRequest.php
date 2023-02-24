<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use LaravelLocalization;

class SubCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'subcategory_icon' => 'required',

        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["subcategory_name.$key"] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'subcategory_icon.required' => 'Icon is required',
           
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["subcategory_name.{$key}.required"] = "The {$locale['native']} category name field is required.";
        }

        return $messages;
    }

}
