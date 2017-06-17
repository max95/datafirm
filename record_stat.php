<?php
// récupération de l'heure courante
$date_courante = date("Y-m-d H:i:s");

// récupération de l'adresse IP du client (on cherche d'abord à savoir si il est derrière un proxy)
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
  $ip  = $_SERVER['HTTP_CLIENT_IP'];
}
else {
  $ip = $_SERVER['REMOTE_ADDR'];
}
// récupération du domaine du client
$host = gethostbyaddr($ip);

// récupération du navigateur et de l'OS du client
$navigateur = $_SERVER['HTTP_USER_AGENT'];

// récupération du REFERER
if (isset($_SERVER['HTTP_REFERER'])) {
  if (eregi($_SERVER['HTTP_HOST'], $_SERVER['HTTP_REFERER'])) {
  $referer ='';
  }
  else {
  $referer = $_SERVER['HTTP_REFERER'];
  }
}
else {
  $referer ='';
}

// récupération du nom de la page courante ainsi que ses arguments
if ($_SERVER['QUERY_STRING'] == "") {
  $page_courante = $_SERVER['PHP_SELF'];
}
else {
  $page_courante = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}

// connexion à la base de données
$ini_array = parse_ini_file("config.ini");
$host=($ini_array['host']);
$login=($ini_array['login']);
$mdp=($ini_array['mdp']);
$db=($ini_array['db']);
$db = mysqli_connect($host, $login, $mdp,$db);

// insertion des éléments dans la base de données
$sql = 'INSERT INTO statistiques VALUES("",?,?,?,?,?,?)';
$req_pre = mysqli_prepare($db, $sql);

mysqli_stmt_bind_param($req_pre,"ssssss",$date_courante,$page_courante,$ip,$host,$navigateur,$referer);

mysqli_stmt_execute($req_pre);
// fermeture de la connexion à la base de données
mysqli_close($db);
?>
