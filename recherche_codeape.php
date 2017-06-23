<?php
$ini_array = parse_ini_file("config.ini");
$host=($ini_array['host']);
$login=($ini_array['login']);
$mdp=($ini_array['mdp']);
$db=($ini_array['db']);
  		$db = mysqli_connect($host, $login, $mdp,$db);

// on crée la requête SQL
$sql = "select * from CodeAPE WHERE SsFamAPE like '".$_GET["codeape"]."'";

// on envoie la requête
$req = mysqli_query($db,$sql);

// on fait une boucle qui va faire un tour pour chaque enregistrement
?><h4 style="color: black">Code APE</h4><select id="resultatcodeape" class="form-control" style="color: black" ><?php
while($data = mysqli_fetch_assoc($req))
    {
      //echo "&lt;option value=\"".utf8_encode($data['LibSectionAPE'])."\"&gt;".utf8_encode($data['LibSectionAPE'])."&lt;/option&gt;";
      ?> <option value="<?php echo utf8_encode($data['CodeAPE']) ?>"><?php echo utf8_encode($data['LibCodeAPE']) ?></option> <?php
    }
?>
</select>
