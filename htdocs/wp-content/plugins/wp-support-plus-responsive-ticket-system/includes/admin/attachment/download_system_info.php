<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$upload_dir = wp_upload_dir();
$filepath=$upload_dir['basedir'].'/wpsp_backup_settings.txt';
$filename='wpsp_system_info.txt';
if ($fd = fopen ($filepath, "r")) {
    $fsize = filesize($filepath);
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Content-length: $fsize");
    header("Cache-control: private");
    while(!feof($fd)) {
        $buffer = fread($fd, $fsize);
        echo $buffer;
    }
    exit;
}
fclose ($fd);