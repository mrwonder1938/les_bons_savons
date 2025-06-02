<?php

use Stripe\Checkout\Session;



$session = Session::create([
    'line_items'                  => [
        array_map(fn(array $product) => [
            'quantity'   => 1,
            'price_data' => [
                'currency'     => 'EUR',
                'product_data' => [
                    'name' => $product['name']
                ],
                'unit_amount'  => $product['price']
            ]
        ], $cart->getProducts())
    ],
    'mode'                        => 'payment',
    'success_url'                 => 'http://127.0.0.1:8000/success.php',
    'cancel_url'                  => 'http://127.0.0.1:8000/',
    'billing_address_collection'  => 'required',
    'shipping_address_collection' => [
        'allowed_countries' => ['FR']
    ],
    'metadata'                    => [
        'cart_id' => $cart->getId()
    ]
]);