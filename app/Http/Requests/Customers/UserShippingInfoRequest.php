<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class UserShippingInfoRequest extends FormRequest
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
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'postcode' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            // 'state_id' => 'required',

        ];



        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required'              => 'Name required',
            'surname.required'           => 'surname required',
            'phone.required'              => 'Phone is required',
            'email.required'              => 'Email is required',
            'postcode.required'           => 'Postcode is required',

            'division_id.required'         => 'Division should be selected',
            'district_id.required'       => 'District should be selected',
            'state_id.required'            => 'State should be selected',
        ];



        return $messages;
    }
}
