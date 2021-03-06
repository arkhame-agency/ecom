<?php

return [
    'settings' => 'Settings',
    'tabs' => [
        'group' => [
            'general_settings' => 'General Settings',
            'social_logins' => 'Social Logins',
            'shipping_methods' => 'Shipping Methods',
            'payment_methods' => 'Payment Methods',
        ],
        'general' => 'General',
        'maintenance' => 'Maintenance',
        'store' => 'Store',
        'currency' => 'Currency',
        'sms' => 'SMS',
        'mail' => 'Mail',
        'newsletter' => 'Newsletter',
        'custom_css_js' => 'Custom CSS/JS',
        'facebook' => 'Facebook',
        'google' => 'Google',
        'free_shipping' => 'Free Shipping',
        'commercial_shipping' => 'Commercial Shipping',
        'shippo_shipping' => 'Shippo Multi-carrier Shipping ',
        'canada_post_regular_parcel' => 'Canada Post Regular Parcel',
        'local_pickup' => 'Local Pickup',
        'flat_rate' => 'Flat Rate',
        'paypal' => 'PayPal',
        'stripe' => 'Stripe',
        'paytm' => 'Paytm',
        'razorpay' => 'Razorpay',
        'instamojo' => 'Instamojo',
        'cod' => 'Cash On Delivery',
        'bank_transfer' => 'Bank Transfer',
        'check_payment' => 'Check / Money Order',
    ],
    'form' => [
        'allow_reviews' => 'Allow customers to give reviews & ratings',
        'approve_reviews_automatically' => 'Customer reviews will be approved automatically',
        'show_cookie_bar' => 'Show cookie bar in your website',
        'privacy_settings' => 'Privacy Settings',
        'hide_store_phone' => 'Hide store phone and fax from the storefront',
        'hide_store_email' => 'Hide store email from the storefront',
        'put_the_application_into_maintenance_mode' => 'Put the application into maintenance mode',
        'ip_addreses_seperated_in_new_line' => 'IP addreses seperated in new line',
        'select_service' => 'Select Service',
        'enable_auto_refreshing_currency_rates' => 'Enable auto-refreshing currency rates',
        'auto_refresh_currency_rate_frequencies' => [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
        ],
        'customer_notification_settings' => 'Customer Notification Settings',
        'contact_form_settings' => 'Contact Form Settings',
        'send_welcome_sms_after_registration' => 'Send welcome SMS after registration',
        'order_notification_settings' => 'Order Notification Settings',
        'send_new_order_notification_to_customer' => 'Send new order notification to the customer',
        'send_new_order_notification_to_admin' => 'Send new order notification to recipient',
        'mail_encryption_protocols' => [
            'ssl' => 'SSL',
            'tls' => 'Tls',
        ],
        'send_welcome_email_after_registration' => 'Send welcome email after registration',
        'send_invoice_email' => 'Send invoice email to the customer after checkout',
        'allow_customers_to_subscribe' => 'Allow customers to subscribe to your newsletter.',
        'allow_newsletter_popup' => 'Show newsletter popup.',
        'allow_customers_last_name' => 'Allow customers to add last name and name',
        'enable_facebook_login' => 'Enable Facebook Login',
        'enable_google_login' => 'Enable Google Login',
        'enable_free_shipping' => 'Enable Free Shipping',
        'enable_free_shipping_radius' => 'Enable Free Shipping on a Radius',
        'enable_commercial_shipping' => 'Enable Commercial Shipping',
        'enable_shippo_shipping' => 'Enable Shippo Multi-carrier Shipping',
        'enable_local_pickup' => 'Enable Local Pickup',
        'enable_flat_rate' => 'Enable Flat Rate',
        'enable_paypal' => 'Enable PayPal',
        'use_sandbox_for_test_payments' => 'Use sandbox for test payments',
        'enable_stripe' => 'Enable Stripe',
        'enable_paytm' => 'Enable Paytm',
        'enable_razorpay' => 'Enable Razorpay',
        'enable_instamojo' => 'Enable Instamojo',
        'enable_cod' => 'Enable Cash On Delivery',
        'enable_bank_transfer' => 'Enable Bank Transfer',
        'enable_check_payment' => 'Enable Check / Money Order',
    ],
    'validation' => [
        'sqlite_is_not_installed' => 'SQLite is not installed.',
    ],
];
