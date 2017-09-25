<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HTML email template
 *
 * replace all [...] in string with your contents
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Helper
 * @author      W3plan Technologies
 */


/**
 * get HTML email header content
 *
 * @return	string  HTML code
 */
function email_header_content()
{	
	return <<<DOC
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>[...] Email</title>
<style>
* {
	margin: 0;
	padding: 0;
	font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
	font-size: 100%%;
	line-height: 1.6;
}
img {
	max-width: 100%%;
}
body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: none;
	width: 100%%!important;
	height: 100%%;
}
a {
	color: #348eda;
}
table.body-wrap {
	width: 100%%;
	padding: 20px;
}
table.body-wrap .container {
	border: 1px solid #f0f0f0;
}

table.footer-wrap {
	width: 100%%;	
	clear: both!important;
}
.footer-wrap .container p {
	font-size: 12px;
	color: #666;	
}
table.footer-wrap a {
	color: #999;
}
h3, h4 {
	font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	line-height: 1.1;
	margin-bottom: 15px;
	color: #000;
	margin: 40px 0 10px;
	line-height: 1.2;
	font-weight: 200;
}
h3 {
	font-size: 22px;
}
h4 {
	font-size: 18px;
}
p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	font-size: 14px;
}
ul li, ol li {
	margin-left: 5px;
	list-style-position: inside;
}
.container {
	display: block!important;
	max-width: 600px!important;
	margin: 0 auto!important; /* makes it centered */
	clear: both!important;
}
.body-wrap .container {
	padding: 25px;
}
.content {
	max-width: 600px;
	margin: 0 auto;
	display: block;
}
.content table {
	width: 100%%;
}
</style>
</head>

<body bgcolor="#f6f6f6">
<table class="body-wrap">
	<tr>
		<td class="container" bgcolor="#FFFFFF">
			<a href="http://[...]" target="_blank">
			<img src="http://[...]" width="750" height="90" title="Go to http://[...]" alt="[...] Logo"></a>
		</td></tr><tr>
		<td class="container" bgcolor="#FFFFFF">
			<div class="content">
			<table>
            <tr><td>
DOC;
}

/**
 * get HTML email footer content
 *
 * @return	string  HTML code
 */
function email_footer_content()
{
	return <<<DOC
	<p>&nbsp;</p>
	<hr style="margin:35px auto;">
	<p>[...] is an innovative web solutions provider.</p>
	</td>
			</tr></table>
			</div>
		</td>
		<td></td>
	</tr>
</table>

<table class="footer-wrap">
	<tr>
		<td></td>
		<td class="container">			
			<div class="content">
			<table><tr>
				<td align="center">
					<p><a href="http://[...]" target="_blank"> Contact [...]</a></p>
				</td>
			</tr></table>
			</div>
		</td>
		<td></td>
	</tr>
</table>
</body>
</html>

DOC;
}

/**
 * get HTML email with confirmation message as content body
 * 
 * @return	string  HTML code
 */
function confirm_message() 
{
$message = <<<DOC
	<p>Hi %s,</p>
	<p>You recently registered for [...]. To complete your [...] registration, follow this link:</p>
	<p><a href="%s" target="_blank" style="word-break:break-all;">%s</a></p>				
	<p>If the registration don't be completed in 3 days, your initial registration would be invalid, you have to start over again.</p>
	<p>[...] helps people build well-structured websites and web applications. Once you join [...] you are able to download free Community Edition or to buy a Enterprise Edition.</p>
	<p>&nbsp;</p>
	<p>Thanks,</p>
	<p>The <a href="http://[...]" target="_blank">[...]</a> service</p>
DOC;
	
	return email_header_content() . $message . email_footer_content();
}

