<?php

namespace App\Helpers;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransHelper
{
    public static function configure()
    {
        $isProduction = config('midtrans.is_production');

        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = $isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public static function createTransaction($orderId, $grossAmount, $customerDetails)
    {
        self::configure();

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $grossAmount,
        ];

        $itemDetails = [
            [
                'id' => 'item01',
                'price' => $grossAmount,
                'quantity' => 1,
                'name' => 'Swimming Pool Booking',
            ],
        ];

        $billingAddress = [
            'first_name' => $customerDetails['first_name'],
            'last_name' => $customerDetails['last_name'],
            'address' => $customerDetails['address'],
            'city' => $customerDetails['city'],
            'postal_code' => $customerDetails['postal_code'],
            'phone' => $customerDetails['phone'],
            'country_code' => 'IDN',
        ];

        $customerDetails = [
            'first_name' => $customerDetails['first_name'],
            'last_name' => $customerDetails['last_name'],
            'email' => $customerDetails['email'],
            'phone' => $customerDetails['phone'],
            'billing_address' => $billingAddress,
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // return Snap::createTransaction($transaction);
        
    }
}
