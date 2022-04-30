<?php

namespace RA_ELITE_USA\Controller\Classes;

use \RA_ELITE_USA\Controller\Template;

class Mail
{

	public static function send_mail($to = [], $subject = '', $message = '', $headers = [], $attachments = [] )
	{
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		$email_response = wp_mail( $to, $subject, $message, $headers, $attachments);
		return $email_response;
	}

	public static function send_user_credentials_mail($user, $user_created = false)
	{
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		$template_select = $user_created ? 'emails/account-credentials-created' : 'emails/account-credentials-updated';
		ob_start();
     		Template::show_template($template_select,['email' => $user['user_email'], 'password' => $user['user_pass']]);
    	$template = ob_get_clean();
		$email_response = wp_mail( $user['user_email'], 'Account Credentials', $template, $headers, []);
		return $email_response;
	}

	public static function send_notification_to_admins($subject = '', $message = '', $just_admins = false)
	{
		$domain = str_replace('http://', '', get_option('siteurl'));
    $domain = str_replace('www.', '', $domain);		
    $args = [
			'role__in' => $just_admins ? [ 'elite_usa_superuser', 'administrator'] : [ 'elite_usa_quote_manager', 'administrator']
		];
		$users = get_users( $args );
		$recipients = [];
		foreach ($users as $user) {
			$recipients[] = $user->user_email;
		}
		$email_response = wp_mail( $recipients, $subject, $message, array('Content-Type: text/html; charset=UTF-8'));
		return $email_response;
	}


}
