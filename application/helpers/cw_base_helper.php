<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Base helper
 *
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Helper
 * @author      W3plan Technologies
 */

 
/**
 * string tags, backslash, and convert special characters to HTML entities
 *
 * @param	string	$input_var
 * @return	string
 */
function sanitize($input_var)
{
	$input_var = strip_tags($input_var);
	
	$input_var = str_replace('\\', '', $input_var);
	
	$input_var = htmlspecialchars($input_var, ENT_QUOTES);
	
	return trim($input_var);
}

/**
 * Generate random string from specified letters and numbers in specified length
 *
 * @param	string	length of string
 * @param	string	select character from specified letters and numbers
 * @param	string	select character from addition string 
 * @return	string  random string
 */
function rand_str($len = 8, $type = '101', $add = null)
{
	$rand = ($type[0] == '1'  ? 'abcdefghijkmnpqrstuvwxyz'  : '') .
	($type[1] == '1'  ? 'ABCDEFGHIJKLMNPQRSTUVWXYZ' : '') .
	($type[2] == '1'  ? '0123456789' : '') .
	(strlen($add) > 0 ? $add : '');
	
	if (empty($rand))
	{
		$rand = sha1(uniqid(mt_rand(), true) . uniqid(uniqid(mt_rand(), true), true));
	}

	$str = str_shuffle(str_repeat($rand, 2));

	return substr($str, 0, 4) . '-' . substr($str, 4, $len - 4);
}

/**
 * get request IP address or '-' connected multiple IP addresses
 *
 * @return	string  IP address or '-' connected multiple IP addresses
 */
function get_request_ips()
{	
	if ((! isset($_SERVER['REMOTE_ADDR'])) || empty($_SERVER['REMOTE_ADDR']) || (trim($_SERVER['REMOTE_ADDR']) == ''))
	{
		$remoteip = "0";
	} else
	{
		if (filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) == false)
		{
			$remoteip = "0";
		} else
		{
			$remoteip = trim($_SERVER['REMOTE_ADDR']);
		}
	}
	
	if (isset($_SERVER['HTTP_CLIENT_IP']) && (! empty($_SERVER['HTTP_CLIENT_IP'])) && trim($_SERVER['HTTP_CLIENT_IP']))
	{
		if ($remoteip == "0")
		{	
			$ips = trim($_SERVER['HTTP_CLIENT_IP']);
		} else
		{	
			$ips = trim($_SERVER['HTTP_CLIENT_IP'])  . ' - ' . $remoteip;	//check for IP from share internet
		}		
	} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) && trim($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		if ($remoteip == "0")
		{
			$ips = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
		} elseif (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], $_SERVER['REMOTE_ADDR']) !== FALSE)
		{	
			$ips = trim($_SERVER['HTTP_X_FORWARDED_FOR']);				//check for IP from proxy servers
		} else
		{
			$ips = trim($_SERVER['HTTP_X_FORWARDED_FOR']) . ' - ' . $remoteip;
		}
	} elseif (isset($_SERVER['HTTP_FORWARDED_FOR']) && (! empty($_SERVER['HTTP_FORWARDED_FOR'])) && trim($_SERVER['HTTP_FORWARDED_FOR']))
	{
		if ($remoteip == "0")
		{
			$ips = trim($_SERVER['HTTP_FORWARDED_FOR']);
		} else 
		{
			$ips = trim($_SERVER['HTTP_FORWARDED_FOR']) . ' - ' . $remoteip;
		}
	} else
	{	
		$ips = $remoteip;
	}
	
	return $ips;
}

/**
 * get request host name
 *
 * @param	string	the value of get_request_ips
 * @return	string  host name
 */
function get_request_host($ips = false)
{
	if (! $ips)
	{
		$ips = get_request_ips();
	}
	
	if (strpos($ips, '-') !== FALSE)
	{
		list($ip) = explode(",", strstr($ips, '-', true));
	} else
	{
		list($ip) = explode(",", $ips);
	}
	
	$hostname = gethostbyaddr($ip);
	
	if ($hostname)
		return $hostname;
	else
		return '';
}

