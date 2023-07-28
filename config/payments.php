<?php
return [

    'stripe' => [
        'local' => [
            'secret' => 'sk_test_51MdxE0LYuNRuHnSIhONSDVwEZcL8ufLCYoyx2sX69ZbwNv1q4nPb5K6P0ocnpxlzalUQsx0p9dc0jZrMPa9msHFQ0035WAp0Fv',
            'public' => 'pk_test_51MdxE0LYuNRuHnSIJ9qzt6TM4Xngs9oADGUmIbqU3BDBJea0XBrp3TTG0dHfIXMPfrRiludv7AIfuTjK4LJGHSas00Rrda38km'

        ],

        'production' => '',
    ],
    'paypal' =>[
        'local' => [
          'client_id' => 'ASKEGuiUcFgs8ODQpqCktNomPzDE6H73cZMv2wabA-vV5XnohDVmnZLp4r7TBekwv6iuSy9e0hznB0PC',
          'secret'=> 'EG_kbB3RHuWRSsq8V5OQnFnVx8t_s-ZUZcNhXy81Ki8NMRvcOjhNjAEh43wGV2e7jTpzsur4p6tPg1FH',
           'api_endpoint' =>'https://api.sandbox.paypal.com',
           'mode' => 'sandbox',
        ],
        'production' => [
         'client_id' => '',
          'secret' => '',
        ],
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'DEBUG'
        ],

];
