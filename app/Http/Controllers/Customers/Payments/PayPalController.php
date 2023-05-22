<?php

namespace App\Http\Controllers\Customers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction($data)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('index'),
                "cancel_url" => route('index'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00",
                        "breakdown" => [
                            "item_total" => [
                                "currency_code" => "USD",
                                "value" => "1000.00"
                            ]
                        ]
                    ],
                    "items" => [
                        [
                            "name" => "Item 1",
                            "description" => "Description of Item 1",
                            "unit_amount" => [
                                "currency_code" => "USD",
                                "value" => "500.00"
                            ],
                            "quantity" => "2",
                            "category" => "PHYSICAL_GOODS"
                        ]
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                // dump($links['rel']);
                if ($links['rel'] == 'approve') {
                    dd($links['href']);
                    return redirect()->away('http://rus.delfi.lv');

                }
            }
        }
        //     return redirect()
        //         ->route('index')
        //         ->with('error', 'Something went wrong.');
        // } else {
        //     return redirect()
        //         ->route('index')
        //         ->with('error', $response['message'] ?? 'Something went wrong.');
        // }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
