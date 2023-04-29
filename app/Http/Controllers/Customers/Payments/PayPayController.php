<?php

namespace App\Http\Controllers\Customers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPayController extends Controller
{
    public function init($data){

        $apiContext = new ApiContext(new OAuthTokenCredential(
            'AZkR8d1osWPpPjv92TuGEHb6rhI8jkBVT8_wlziOx2-SEDvTY5wM-7_agjwgTuQuozothhirD7Bxt6ws',
            'EKQKygv6L8oVSgfXgkZPwXRqmUKLoeG6Z9wAz_H-xiodmJaykXEFnXDRv8083Je2ozwrTVCLCl5bkACY'
        ));

        // Create a payer object and set the payment method to PayPal
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Create an amount object and set the total amount and currency code
        $amount = new Amount();
        $amount->setTotal(10)
            ->setCurrency('EUR');

        // Create a transaction object and set the amount, description, and invoice number
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription('test')
            ->setInvoiceNumber('inv 5');

        // Create a redirect URL object with the success and cancel URLs
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('index'))
            ->setCancelUrl(route('index'));

        // Create a payment object and set the intent, payer, transaction, and redirect URLs
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($apiContext);
            $approvalUrl = $payment->getApprovalLink();
        } catch (\Exception $ex) {
            return redirect()->route('paypal.failure');
        }
    }
}
