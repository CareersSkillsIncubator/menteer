<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Stripe Configuration
 */


$config['stripe']['test-mode']  = true; // Enable test mode (not require HTTPS)
$config['stripe']['secret-key'] = ''; // Secret Key from Stripe.com Dashboard
$config['stripe']['publishable-key']  = ''; // Publishable Key from Stripe.com Dashboard
$config['stripe']['thank-you'] = 'http://domain.com/thank-you.html'; // Where to send upon successful donation (must include http://)
$config['stripe']['email-from'] = 'no-reply@domain.com'; // Who the email will be from.
$config['stripe']['email-bcc'] = 'admin@domain.com'; // Who should be BCC'd on this email. Probably an administrative email.
$config['stripe']['email-subject'] = 'Thank you for your donation!'; // Subject of email receipt
$config['stripe']['email-message'] = "Dear %name%,\n\nThank you for your donation of %amount%. We rely on the financial support from people like you to keep our cause alive. Below is your donation receipt to keep for your records."; // Email message. %name% is the donor's name. %amount% is the donation amount


/* End of file stripe.php */
/* Location: ./application/config/stripe.php */
