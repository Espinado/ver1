<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use LaravelLocalization;

class SubSubCategoryRequest extends FormRequest
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
            'subsubcategory_icon' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["subsubcategory_name.{$key}"] = "required";
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'subsubcategory_icon.required' => 'Icon is required',
            'category_id.required' => 'Category not selected',
            'subcategory_id.required' => 'SubCategory not selected'

        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["subsubcategory_name.{$key}.required"] = "The {$locale['native']} subsubcategory name field is required.";
        }

        return $messages;
    }

}
