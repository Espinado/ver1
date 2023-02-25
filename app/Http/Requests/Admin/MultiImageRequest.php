<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MultiImageRequest extends FormRequest
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

            'multi_img.*' => 'image|mimes:jpeg,jpg,png|max:2048',
        ];

        return [
           $rules
        ];
    }
    public function messages()
    {
        $messages = [
            'multi_img.*.image' => 'The :attribute must be an image file.',
            'multi_img.*.max' => 'The :attribute may not be greater than :max kilobytes.',

        ];



        return $messages;
    }
}
