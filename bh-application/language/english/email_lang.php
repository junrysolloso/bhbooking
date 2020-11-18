<?php
/**
 * System messages translation for CodeIgniter(tm)
 *
 * @author	CodeIgniter community
 * @author	Iban Eguia
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 */
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

$lang['email_must_be_array'] = 'You must pass an array to the email validation method.';
$lang['email_invalid_address'] = 'Invalid email: %s';
$lang['email_attachment_missing'] = 'Could not find this attachment: %s';
$lang['email_attachment_unreadable'] = 'Could not open this attachment: %s';
$lang['email_no_from'] = 'You cannot send an email without the "From" header.';
$lang['email_no_recipients'] = 'You must include recipients: To, Cc, or Bcc';
$lang['email_send_failure_phpmail'] = 'It was not possible to send the mail using PHP mail (). Your server may not be configured to send emails with this method.';
$lang['email_send_failure_sendmail'] = 'It was not possible to send the mail using PHP Sendmail. Your server may not be configured to send emails with this method.';
$lang['email_send_failure_smtp'] = 'It was not possible to send the mail using PHP SMTP. Your server may not be configured to send emails with this method.';
$lang['email_sent'] = 'Your message has been sent successfully using this protocol: %s';
$lang['email_no_socket'] = 'Unable to open a socket to Sendmail. Please check the settings.';
$lang['email_no_hostname'] = 'You have not specified an SMTP server.';
$lang['email_smtp_error'] = 'This SMTP error has been encountered: %s';
$lang['email_no_smtp_unpw'] = 'Error: Debes asignar un usuario y una contraseña SMTP.';
$lang['email_failed_smtp_login'] = 'Failed to send AUTH LOGIN command. Error: %s';
$lang['email_smtp_auth_un'] = 'Failed to authenticate user. Error: %s';
$lang['email_smtp_auth_pw'] = 'Failed to authenticate password. Error: %s';
$lang['email_smtp_data_failure'] = 'It was not possible to send the data: %s';
$lang['email_exit_status'] = 'Status code on exit: %s';
