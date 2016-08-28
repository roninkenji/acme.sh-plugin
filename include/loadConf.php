<?php
$cfgfile = "/boot/config/plugins/acme.sh-plugin/account.conf";
$cfg = file_exists($cfgfile)?parse_ini_file($cfgfile):array("CERT_HOME"=>"/boot/config/plugins/acme.sh-plugin/certs");
$plugin = "acme.sh-plugin";
$execPath = "/usr/local/emhttp/plugins/".$plugin;
$cmd = "acme.sh";
$domains=array_map("basename", glob($cfg['CERT_HOME']."/*"));
$domains_cfg=array();
foreach ($domains as $key) {
	$domain_cfgfile=$cfg['CERT_HOME']."/".$key."/".$key.".conf";
	$domains_cfg[$key]=file_exists($domain_cfgfile)?parse_ini_file($domain_cfgfile):array();
}
?>
