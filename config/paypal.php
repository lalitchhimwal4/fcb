<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => '', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => '',//env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret'     => '',//env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
        'app_id'            => '',//'APP-80W284485P519543T',
    ],
    'live' => [
        'client_id'    => '', //env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'    => '',//env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'      => '', // Used for Adaptive Payments API
    ],

    'payment_action' => '',//'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => '',//env('PAYPAL_CURRENCY', 'CAD'),
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];



//note by developer: this file is overrided by config function in AppServiceProvider.