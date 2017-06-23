<?php
$ini_array = parse_ini_file("config.ini");
$host=($ini_array['host']);
$login=($ini_array['login']);
$mdp=($ini_array['mdp']);
$db=($ini_array['db']);
  		$db = mysqli_connect($host, $login, $mdp,$db);


// on crée la requête SQL
$sql = "select * from SousFamilleAPE WHERE FamAPE like '".$_GET["sousfamille"]."'";

// on envoie la requête
$req = mysqli_query($db,$sql);

// on fait une boucle qui va faire un tour pour chaque enregistrement
?><h4 style="color: black">Sous-Famille</h4><select id="resultatssfamille" onclick="codeape()" class="form-control" style="color: black" ><?php
while($data = mysqli_fetch_assoc($req))
    {
      //echo "&lt;option value=\"".utf8_encode($data['LibSectionAPE'])."\"&gt;".utf8_encode($data['LibSectionAPE'])."&lt;/option&gt;";
      ?> <option value="<?php echo utf8_encode($data['SsFamAPE']) ?>"><?php echo utf8_encode($data['LibSsFamAPE']) ?></option> <?php
    }
?>
</select>
