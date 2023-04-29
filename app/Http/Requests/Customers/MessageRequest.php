<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',

        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required'                => 'Name is required',
            'email.required'              => 'Email is required',
            'message.required'            => 'Message is required',

        ];



        return $messages;
    }
}
