<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use LaravelLocalization;

class BlogRequest extends FormRequest
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
          'blog_image'         => 'file|required|mimes:jpeg,png|max:2048',
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["blog_title.$key"] = 'required|max:100';
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["short_blog.$key"] = 'required|max:100';
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["full_blog.$key"] = 'required|max:255';
        }

        return $rules;
    }
    public function messages()
    {
        $messages = [

            'blog_image.required'         => 'Image is required',

        ];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["blog_title.{$key}.required"] = "The {$locale['native']} title field is required.";
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["short_blog.{$key}.required"] = "The {$locale['native']} short blog required.";
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["full_blog.{$key}.required"] = "The {$locale['native']} full blog is required.";
        }


        return $messages;
    }
}
