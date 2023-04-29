<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use LaravelLocalization;

class FaqRequest extends FormRequest
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

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["question.$key"] = 'required|max:100';
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $rules["answer.$key"] = 'required|max:100';
        }


        return $rules;
    }
    public function messages()
    {

        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["question.{$key}.required"] = "The {$locale['native']} question field is required.";
        }
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {
            $messages["answer.{$key}.required"] = "The {$locale['native']} answer required.";
        }



        return $messages;
    }
}
