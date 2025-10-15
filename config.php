<?php
// Configuration file for sensitive keys.
// IMPORTANT: Do NOT commit this file to a public repository.

// PayPal sandbox credentials
define('PAYPAL_CLIENT_ID', 'TU_PAYPAL_SANDBOX_CLIENT_ID');
define('PAYPAL_SECRET', 'TU_PAYPAL_SANDBOX_SECRET');

// OpenAI key for chatbot advanced responses (GPT-4o)
define('OPENAI_API_KEY', 'sk-REPLACE_WITH_YOUR_OPENAI_KEY');

// PayPal environment: sandbox or live
define('PAYPAL_ENV', 'sandbox'); // change to 'live' in production

function get_paypal_base() {
    return (PAYPAL_ENV === 'live') ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';
}
?>
