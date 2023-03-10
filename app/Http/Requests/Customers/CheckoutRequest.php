<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'payment_method' => 'required',
            'shipping_method' => 'required',
            'shipping_postcode' => 'required',
            'shipping_name' => 'required',
            'shipping_email' => 'required',
            'shipping_phone' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'state_id' => 'required',

        ];



        return $rules;
    }

    public function messages()
    {
        $messages = [
            'payment_method.required'     => 'Payment method should be selected',
            'shipping_method.required'    => 'Shipping method should be selected',
            'shipping_postcode.required'  => 'Shipping postcode is required',
            'shipping_name.required'      => 'Shipping name is required',
            'shipping_email.required'      => 'Shipping email is required',
            'shipping_phone.required'      => 'Shipping phone is required',
            'division_id.required'         => 'Division should be selected',
            'district_id.required'       => 'District should be selected',
            'state_id.required'            => 'State should be selected',
        ];



        return $messages;
    }
}
