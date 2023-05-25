<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => 'ASKEGuiUcFgs8ODQpqCktNomPzDE6H73cZMv2wabA-vV5XnohDVmnZLp4r7TBekwv6iuSy9e0hznB0PC',
        'client_secret'     => 'EG_kbB3RHuWRSsq8V5OQnFnVx8t_s-ZUZcNhXy81Ki8NMRvcOjhNjAEh43wGV2e7jTpzsur4p6tPg1FH',
        'app_id'            => 'APP-80W284485P519543T',
        'settings' => [
            'mode' => 'sandbox',
            // Other PayPal settings
        ],
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'EUR'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'lv_LV'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', false), // Validate SSL when creating api client.
];
