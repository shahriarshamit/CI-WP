<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * File helper
 *
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Helper
 * @author      W3plan Technologies
 */

 
/**
 * Quick read file content
 *
 * @param	string	the file path to read
 * @return	string  the file content
 */
function get_file_content($file_name)
{
	$content = '';
	
	if(file_exists($file_name))
	{
		$fsize = filesize($file_name);
		
		if($fsize > 1)
		{
			$fp = fopen($file_name, 'r');
			$content = fread($fp, $fsize);
			fclose($fp);
		}
	}
	
	return $content;
}

/**
 * Quick write file content
 *
 * @param	string	the file path
 * @param	string	the file content to write
 * @return	void
 */
function write_file($file_name, $file_content)
{
	$fp = fopen($file_name, 'w');

	if($fp)
	{
		fwrite($fp, $file_content);		
		fclose($fp);
	}
}

/**
 * download file to the browser
 *
 * @param	string	the file path to download
 * @return	void
 */
function download_file($file_name)
{
	header('Pragma: public');   // required
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime ($file_name)) . ' GMT');
	header('Cache-Control: private', false);

	header('Content-Description: File Transfer');
	header('Content-Type: text/plain');
	header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($file_name));
	
	header('Connection: close');
	
	readfile($file_name);
}

/**
 * get remote file content by get method
 *
 * @param	string	the file URL
 * @param	string	True to include the header in the output
 * @return	string  the file content
 */
function curl_file_get_contents_byget($url, $with_header = FALSE)
{	
	$curl = curl_init();
	
	$userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:15.0) Gecko/20100101 Firefox/15.0';
	
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
	
	if ($with_header) curl_setopt($curl, CURLOPT_HEADER, $with_header);
	
	curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	
	$output = curl_exec($curl);
	
	curl_close($curl);
	
	return $output;
}

/**
 * get remote file content by post method
 *
 * @param	string	the file URL
 * @param	string	post fields
 * @param	string	True to include the header in the output
 * @return	string  the file content
 */
function curl_get_contents_bypost($url, $data, $with_header = FALSE)
{
	$curl = curl_init();
	
	$userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:15.0) Gecko/20100101 Firefox/15.0';
	
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);	
	curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
	
	if ($with_header) curl_setopt($curl, CURLOPT_HEADER, $with_header);
	
	curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	
	curl_setopt($curl, CURLOPT_POST, TRUE);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	
	$output = curl_exec($curl);
	
	curl_close($curl);

	return $output;
}

/**
 * check whether remote file existed or not
 * 
 * @param	string	 the file URL
 * @return	boolean  True if file existed
 */
function is_url_exist($url)
{	
	$ch = curl_init();	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	$result = curl_exec($ch);
	$scode = curl_getinfo($ch, CURLINFO_HTTP_CODE);	
	
	curl_close($ch);
	
	if (($result !== false) && ($scode >= 200 && $scode < 400))
		return true;
	else
		return false;
}
