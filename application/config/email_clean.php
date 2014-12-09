<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/

$config['wordwrap'] = FALSE;
$config['mailtype'] = 'html';
$config['smtp_host'] = 'smtp.sendgrid.net';
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
$config['protocol'] = 'smtp';
$config['smtp_port'] = '587'; //2525 is usual
$config['validate'] = 'FALSE';

$config['charset'] = 'utf-8';
$config['newline'] = '\r\n';


/* End of file email.php */
/* Location: ./application/config/email.php */




