<!-- statistiques -->
<?php include"record_stat.php" ?>
<?php
//http://localhost/datafirm/recherche_entreprise.php?lat=48.858205&lng=2.294359&proximite=10&ape=0130

// Définition du header
header("Content-Type: application/json");

$ini_array = parse_ini_file("config.ini");
$host=($ini_array['host']);
$login=($ini_array['login']);
$mdp=($ini_array['mdp']);
$db=($ini_array['db']);

$db = mysqli_connect($host, $login, $mdp,$db) or die('Erreur de connexion : ' . mysqli_connect_error());
// on crée la requête SQL
$sql = "SELECT entreprise,lat,lon,numero,adresse,cp,ville, get_distance_metres('".$_GET['lat']."', '".$_GET['lng']."', lat, lon)
      AS proximite
      FROM Entreprise where ape like '".$_GET['ape']."%'
      HAVING proximite < ".$_GET['proximite']." ORDER BY proximite ASC";

// on envoie la requête
$req = mysqli_query($db, $sql) or die('Erreur sur la requete : ' . mysqli_connect_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
$fp = fopen("./data.json","w+"); //creation du fichier
while($data = mysqli_fetch_assoc($req))
    {
      $lignes[] = $data;
    }
// Encodage en format JSON du tableau $lignes
$donneesJSON = json_encode($lignes);
// Envoi du résultat au client
echo $donneesJSON;

mysqli_close($db);
?>
