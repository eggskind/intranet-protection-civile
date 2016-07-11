<?php
$hostname_dbprotect = "localhost";
$username_dbprotect = "root";
$password_dbprotect = "root";
$database_dbprotect = "ADPC"; 

$relationships = getenv("PLATFORM_RELATIONSHIPS");
if (!$relationships) {
  return;
}

$relationships = json_decode(base64_decode($relationships), TRUE);

foreach ($relationships['database'] as $endpoint) {
  if (empty($endpoint['query']['is_master'])) {
    continue;
  }
  $hostname_dbprotect = $endpoint['host'];
  $username_dbprotect = $endpoint['username'];
  $password_dbprotect = $endpoint['password'];
  $database_dbprotect = $endpoint['path'];
}

$tablename_dbprotect= "membres";    // nom de la table utilisée
$tablename_commune = "commune";		//liste des communes
$tablename_ratcommune = "rat_com";		//liste des rattachements aux communes
$tablename_ratmembre = "rat_membre";		//membres vis à vis des communes
$tablename_ratdepartement = "rat_dpt";		//membres vis à vis du département
$tablename_permission = "rbac_permissions";		//gestion des permissions
$tablename_roles = "rbac_permissions";		//gestion des roles
$link = mysqli_connect($hostname_dbprotect,$username_dbprotect,$password_dbprotect,$database_dbprotect) or die("Error " . mysqli_error($link));
if (!mysqli_set_charset($link, "utf8")) {}
?>
