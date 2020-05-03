TODO
- Set up email job system
- Format default emails
- DONE Format Gift Subscription Email
- DONE Format Entry email
- Write tests and algorithm for sending entries
- configure jobs on server


- DONE compose email for gift recipients
- DONE create email templates for journal entries
- DONE write code for entry delivery scheduled task
array_filter(App\Subscription::where('status', 'active')->get()->toArray(), function($item) { return (bool)$item['delivery_is_past_due']; })
- test, test, test

1) Set up subscription process and gateway. 
2) Set up email sending engine (this is an automated task that gets all the active subscriptions and sends an entry if required and runs every 15 minutes). 
3) Configure and format the email so it uses a custom font and has some amount of design to it.
4) Migrate the whole project to the server!

I also need to resolve the issue with the credit card. I don't know what to do. The bank is virtually non-responsive and Mailgun doesn't show much interest in allowing me to pay with PayPal. We can still use the service to configure the system but can only send to 5 verified emails (you didn't verify your email address, BTW).

To make this site
- layout and design: learn and apply Tailwind (about the same as doing it from scratch)
- Authentication: scaffolding plus role-based PHP package and a little configuration
- CMS: Backpack plus a _lot_ of configuration, some trial and error, and a lot of review of the documentation
- Payment gateway: PayPal, mostly new JS API, seems to work well, only about a day to implement start to finish
- Fiddling with Laravel to get relationships, accessors, and such right
- Emails: configuring mailgun was easy once I got the credit card to work
- Emails: have yet to lay out fancy emails, might try Tailwind there too
- Emails: have to set up the cron jobs
- The diamond: scheduled sending of emails has been about 10% of the whole project

[2020-04-29 20:03:34] local.INFO: array (
  'mc_gross' => '4.90',
  'protection_eligibility' => 'Eligible',
  'address_status' => 'confirmed',
  'payer_id' => 'ZZ3K6CY2K7RXJ',
  'address_street' => 'calle Vilamar 76993- 17469',
  'payment_date' => '13:03:23 Apr 29, 2020 PDT',
  'payment_status' => 'Completed',
  'charset' => 'windows-1252',
  'address_zip' => '02001',
  'first_name' => 'John',
  'mc_fee' => '0.52',
  'address_country_code' => 'ES',
  'address_name' => 'John Doe',
  'notify_version' => '3.9',
  'custom' => NULL,
  'payer_status' => 'verified',
  'business' => 'sb-nngyh1561559@business.example.com',
  'address_country' => 'Spain',
  'address_city' => 'Albacete',
  'quantity' => '1',
  'verify_sign' => 'Ad8MOJ36cV85kWpl7rf4WydlpO61AJ.vVh9l2rFKGwQ6RHt3-XCQxzPt',
  'payer_email' => 'sb-tbxrl1433822@personal.example.com',
  'txn_id' => '56951821WS544752N',
  'payment_type' => 'instant',
  'last_name' => 'Doe',
  'address_state' => 'Albacete',
  'receiver_email' => 'sb-nngyh1561559@business.example.com',
  'payment_fee' => NULL,
  'shipping_discount' => '0.00',
  'insurance_amount' => '0.00',
  'receiver_id' => 'Z9JLPLDE8QD92',
  'txn_type' => 'express_checkout',
  'item_name' => 'Subscription to Sample Novel by email',
  'discount' => '0.00',
  'mc_currency' => 'EUR',
  'item_number' => NULL,
  'residence_country' => 'ES',
  'test_ipn' => '1',
  'shipping_method' => 'Default',
  'transaction_subject' => 'Subscription to Sample Novel by email',
  'payment_gross' => NULL,
  'ipn_track_id' => '3f52f2b87542',
) 

[2020-04-29 21:45:37] local.INFO: array (
  'id' => 'WH-4DG09965JD0408042-0V1177691B962842P',
  'event_version' => '1.0',
  'create_time' => '2020-04-29T21:45:16.366Z',
  'resource_type' => 'capture',
  'resource_version' => '2.0',
  'event_type' => 'PAYMENT.CAPTURE.COMPLETED',
  'summary' => 'Payment completed for EUR 4.9 EUR',
  'resource' => 
  array (
    'id' => '6C036711J4109473M',
    'amount' => 
    array (
      'currency_code' => 'EUR',
      'value' => '4.90',
    ),
    'final_capture' => true,
    'seller_protection' => 
    array (
      'status' => 'ELIGIBLE',
      'dispute_categories' => 
      array (
        0 => 'ITEM_NOT_RECEIVED',
        1 => 'UNAUTHORIZED_TRANSACTION',
      ),
    ),
    'seller_receivable_breakdown' => 
    array (
      'gross_amount' => 
      array (
        'currency_code' => 'EUR',
        'value' => '4.90',
      ),
      'paypal_fee' => 
      array (
        'currency_code' => 'EUR',
        'value' => '0.54',
      ),
      'net_amount' => 
      array (
        'currency_code' => 'EUR',
        'value' => '4.36',
      ),
    ),
    'status' => 'COMPLETED',
    'create_time' => '2020-04-29T21:45:12Z',
    'update_time' => '2020-04-29T21:45:12Z',
    'links' => 
    array (
      0 => 
      array (
        'href' => 'https://api.sandbox.paypal.com/v2/payments/captures/6C036711J4109473M',
        'rel' => 'self',
        'method' => 'GET',
      ),
      1 => 
      array (
        'href' => 'https://api.sandbox.paypal.com/v2/payments/captures/6C036711J4109473M/refund',
        'rel' => 'refund',
        'method' => 'POST',
      ),
      2 => 
      array (
        'href' => 'https://api.sandbox.paypal.com/v2/checkout/orders/06U02052F8061944V',
        'rel' => 'up',
        'method' => 'GET',
      ),
    ),
  ),
  'links' => 
  array (
    0 => 
    array (
      'href' => 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-4DG09965JD0408042-0V1177691B962842P',
      'rel' => 'self',
      'method' => 'GET',
    ),
    1 => 
    array (
      'href' => 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-4DG09965JD0408042-0V1177691B962842P/resend',
      'rel' => 'resend',
      'method' => 'POST',
    ),
  ),
)  


[2020-04-30 00:44:16] local.INFO: array (
  'id' => 'WH-7GD53810E43219307-42H8169879011635A',
  'event_version' => '1.0',
  'create_time' => '2020-04-30T00:43:52.089Z',
  'resource_type' => 'capture',
  'resource_version' => '2.0',
  'event_type' => 'PAYMENT.CAPTURE.COMPLETED',
  'summary' => 'Payment completed for EUR 4.9 EUR',
  'resource' => 
  array (
    'id' => '4PJ11203B9100783E',
    'amount' => 
    array (
      'currency_code' => 'EUR',
      'value' => '4.90',
    ),
    'final_capture' => true,
    'seller_protection' => 
    array (
      'status' => 'ELIGIBLE',
      'dispute_categories' => 
      array (
        0 => 'ITEM_NOT_RECEIVED',
        1 => 'UNAUTHORIZED_TRANSACTION',
      ),
    ),
    'seller_receivable_breakdown' => 
    array (
      'gross_amount' => 
      array (
        'currency_code' => 'EUR',
        'value' => '4.90',
      ),
      'paypal_fee' => 
      array (
        'currency_code' => 'EUR',
        'value' => '0.54',
      ),
      'net_amount' => 
      array (
        'currency_code' => 'EUR',
        'value' => '4.36',
      ),
    ),
    'status' => 'COMPLETED',
    'create_time' => '2020-04-30T00:43:47Z',
    'update_time' => '2020-04-30T00:43:47Z',
    'links' => 
    array (
      0 => 
      array (
        'href' => 'https://api.sandbox.paypal.com/v2/payments/captures/4PJ11203B9100783E',
        'rel' => 'self',
        'method' => 'GET',
      ),
      1 => 
      array (
        'href' => 'https://api.sandbox.paypal.com/v2/payments/captures/4PJ11203B9100783E/refund',
        'rel' => 'refund',
        'method' => 'POST',
      ),
      2 => 
      array (
        'href' => 'https://api.sandbox.paypal.com/v2/checkout/orders/25075818CW306423K',
        'rel' => 'up',
        'method' => 'GET',
      ),
    ),
  ),
  'links' => 
  array (
    0 => 
    array (
      'href' => 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7GD53810E43219307-42H8169879011635A',
      'rel' => 'self',
      'method' => 'GET',
    ),
    1 => 
    array (
      'href' => 'https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7GD53810E43219307-42H8169879011635A/resend',
      'rel' => 'resend',
      'method' => 'POST',
    ),
  ),
)  
