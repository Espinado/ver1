<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use LaravelLocalization;

class ProductRequest extends FormRequest
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
            'brand_id'            => 'required',
            'category_id'         => 'required',
            // 'subcategory_id'      => 'required',
            // 'subsubcategory_id'   => 'required',
            'selling_price'       => 'required',
            'product_code' => 'required',
            'product_qty' => 'required',
            'product_thambnail'   => 'file|required|mimes:jpeg,png|max:2048',
            // 'multi_img.*' => 'image|mimes:jpeg,jpg,png|max:2048',
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["product_name.$key"] = 'required|max:255';
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["product_tags.$key"] = 'required|max:255';
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["product_color.$key"] = 'required|max:255';
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["short_descp.$key"] = 'required';
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["long_descp.$key"] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'category_icon.required'        => 'Icon is required',
            'brand_id.required'             => 'Brand not selected',
            'category_id.required'          => 'Category not selected',
            // 'subcategory_id.required'       => 'Category 1 not selected',
            // 'subsubcategoryd_id.required'   => 'Category 2 not selected',
            'product_code.required'        => 'Product code is required',
            'product_qty.required'         => 'Product qty is required',
            'selling_price.require'       => 'selling_price required',

        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["product_name.{$key}.required"] = "The {$locale['native']} product_name field is required.";
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["product_tags.{$key}.required"] = "The {$locale['native']} tags are required.";
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["product_color.{$key}.required"] = "The {$locale['native']} colors are required.";
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["short_descp.{$key}.required"] = "{$locale['native']} short description is required.";
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["long_descp.{$key}.required"] = "{$locale['native']} full description is required.";
        }

        return $messages;
    }
}
