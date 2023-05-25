<?php

namespace App\Http\Controllers\Customers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


class PayPalController extends Controller
{
    private $apiContext;
    private $clientId;
    private $clientSecret;

    public function __construct()
    {
        // Initialize PayPal API credentials
        $this->clientId = config('paypal.sandbox.client_id');
        $this->clientSecret = config('paypal.sandbox.client_secret');

        // Set up the API context
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential($this->clientId, $this->clientSecret)
        );
        $this->apiContext->setConfig(config('paypal.sandbox.settings'));
    }
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
    public function processTransaction(Request $request)

    {
        $data = json_decode($request->input('data'), true);
        $amount = new Amount();
        $amount->setTotal('10.00'); // Set the total amount of the payment
        $amount->setCurrency('USD'); // Set the currency (e.g., USD, EUR)

        $payer = new Payer();
        $payer->setPaymentMethod('paypal'); // Set the payment method to PayPal

        $payment = new Payment();
        $payment->setIntent('sale'); // Set the payment intent (e.g., sale, authorize)
        $payment->setPayer($payer);
        $payment->setTransactions([$amount]);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.executePayment'));
        $redirectUrls->setCancelUrl(route('paypal.cancelPayment'));
dd($this->apiContext);
        $payment->setRedirectUrls($redirectUrls);
        try {
            $payment->create($this->apiContext);
            $approvalUrl = $payment->getApprovalLink();

            return redirect($approvalUrl);
        } catch (\Exception $e) {
            // Handle any errors that occurred during payment creation
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
