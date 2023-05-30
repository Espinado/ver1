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
use PayPal\Api\PayerInfo;
use App\Helpers\newOrder;
use Illuminate\Support\Facades\Session;

use Countable;


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
// dd($this->apiContext);
        $data = json_decode($request->input('data'), true);
        // dd($data);
        if (!is_array($data) && !($data instanceof Countable)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $payerInfo = new PayerInfo();
        $payerInfo->setFirstName($data['shipping_name']);
        $payerInfo->setLastName($data['shipping_surname']);
        // $payerInfo->setEmail($data['shipping_email']);
        // $payerInfo->setPhone($data['shipping_phone']);

        $payer->setPayerInfo($payerInfo);
        // dd($payer);

        $amount = new Amount();
        $amount->setTotal($data['GrandTotal']); // Set the total amount of the payment
        $amount->setCurrency('EUR'); // Set the currency (e.g., USD, EUR)

        $transaction = new Transaction();
        $transaction->setAmount($amount);


        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.executePayment'));
        $redirectUrls->setCancelUrl(route('paypal.cancelPayment'));

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);

        $payment->setTransactions([$transaction]);
        $payment->setRedirectUrls($redirectUrls);
        // dd($payment);

        try {
            $payment->create($this->apiContext);
            $approvalUrl = $payment->getApprovalLink();

            return redirect($approvalUrl);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Other methods for execution and cancellation

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */

    public function executePayment(Request $request)
{
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');

        // Initialize PayPal API credentials
        $clientId = env('APP_ENV') == 'local' ? config('paypal.sandbox.client_id'): config('paypal.live.client_id') ;
        $clientSecret = env('APP_ENV') == 'local' ? config('paypal.sandbox.client_secret') : config('paypal.live.client_secret');

        // Set up the API context
        $apiContext = new ApiContext(new OAuthTokenCredential($clientId, $clientSecret));

        try {
            // Retrieve the payment object
            $payment = Payment::get($paymentId, $apiContext);

            // Execute the payment
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);
            $result = $payment->execute($execution, $apiContext);
            $transactions = $result->getTransactions();

            // Check the payment status
            if ($result->getState() === 'approved') {
                // Payment is successful
                // Perform additional actions or redirect as needed
                Session::put('order.payment_type', 'paypal');
                Session::put('order.payment_method', 'paypal');
                Session::put('order.transaction_id', $transactions[0]->related_resources[0]->sale->id);

                newOrder::createOrderRecord();
                return view('customers.payments.completed_payment');
            } else {
                // Payment was not approved
                return redirect()->route('payment.cancel')->with('error', 'Payment was not approved.');
            }
        } catch (\Exception $e) {
            // Handle any errors that occurred during payment execution
            dd($e);
            // return redirect()->route('payment.error')->with('error', $e->getMessage());
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
