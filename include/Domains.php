<?php

$cfgfile="/boot/config/plugins/acme.sh-plugin/plugin.conf";
$cfg=file_exists($cfgfile)?parse_ini_file($cfgfile):array("CERT_HOME"=>"/boot/config/plugins/acme.sh-plugin/certs");
$plugin="acme.sh-plugin";
$execPath="/usr/local/emhttp/plugins/$plugin";
$cmd="acme.sh";

$domains=array_map("basename", glob($cfg['CERT_HOME']."/*"));
$domains_cfg=array();
foreach ($domains as $key)
    $domain_cfgfile=$cfg['CERT_HOME']."/".$key."/".$key.".conf";
	$domains_cfg[$key]=file_exists($domain_cfgfile)?parse_ini_file($domain_cfgfile):array();

$domains=$domains_cfg;
?>
<link type="text/css" rel="stylesheet" href="/webGui/styles/jquery.ui.css">
<link type="text/css" rel="stylesheet" href="/webGui/styles/jquery.switchbutton.css">

<!-- <?php print_r($cfg); ?> -->
<!-- <?php print_r($domains); ?> -->

<script src="/webGui/javascript/jquery.switchbutton.js"></script>
<script>
function showDetails() {
	
}
</script>
<table class='domains-table'>
  <thead>
    <tr>
      <td>Domain</td>
      <td>Key Length</td>
      <td>Created</td>
      <td>Expires</td>
	  <td colspan="">Operations</td>
    </tr>
  </thead>
  <tbody id="domains-table-body">
<?php
foreach (array_keys($domains) as $key)
	$domain=$domains[$key]["Le_Domain"];
	$san=($domains[$key]["Le_Alt"])=="no"?$domain:$domains[$key]["Le_Alt"];
	$keylen=($domains[$key]["Le_Keylength"])=="no"?2048:$domains[$key]["Le_Keylength"];
	echo "<tr>";
	echo "<td>".$domain."</td>";
	echo "<td>".$keylen."</td>";
	echo "<td>".date("M d, Y H:i:s", $domains[$key]["Le_CertCreateTime"])."</td>";
	echo "<td>".date("M d, Y H:i:s", $domains[$key]["Le_NextRenewTime"])."</td>";
	echo "<td><input type='button' onclick='renew()' value='Renew'></td>";
	echo "<td><input type='button' onclick='reload()' value='Reload'></td>";
	echo "<td><input type='button' onclick='showDetails()' value='Details'></td>";
	echo "</tr>";
?>
	</tbody>
</table>
