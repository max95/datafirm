<?php
        $ini_array = parse_ini_file("config.ini");
        $host=($ini_array['host']);
        $login=($ini_array['login']);
        $mdp=($ini_array['mdp']);
        $db=($ini_array['db']);

$db = mysqli_connect($host, $login, $mdp,$db);
$resultat = mysqli_query($db, 'SELECT * from SectionAPE');

    while($data = mysqli_fetch_assoc($resultat))
    {
      ?> <option value="<?php echo utf8_encode($data['SecAPE']) ?>"><?php echo utf8_encode($data['LibSectionAPE']) ?></option> <?php
    }
?>
