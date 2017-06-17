<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DATAGOUV</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>


</head>

<body id="page-top">

<?php include"menu.php" ?>

<div class="header-content">
  <div class="col-md-8">
  <!-- Emplacement de ma Map -->
  <?php
  //LdtBGJeU7nHQCP7Q3eP

   ?>
  <table class="table table-bordered" id="dataTables-example">
    <thead>
      <tr>
        <th>Code</th>
        <th>Libelle</th>
        <th>Sous-Famille</th>
        <th>Famille</th>
        <th>Section</th>
      </tr>
    </thead>

    <?php

    $ini_array = parse_ini_file("config.ini");
    $host=($ini_array['host']);
    $login=($ini_array['login']);
    $mdp=($ini_array['mdp']);
    $db=($ini_array['db']);
      		$db = mysqli_connect($host, $login, $mdp,$db);

    // on crée la requête SQL
    $sql = 'SELECT LibSectionAPE,
	        LibFamAPE,
	        LibSsFamAPE,
	        LibCodeAPE,
	        CodeAPE
          FROM
	        CodeAPE,
          SousFamilleAPE,
          FamilleAPE,
          SectionAPE
          WHERE
          '.'CodeAPE.SsFamAPE = SousFamilleAPE.SsFamAPE
          AND SousFamilleAPE.FamAPE = FamilleAPE.FamAPE
          AND FamilleAPE.SecAPE = SectionAPE.SecAPE';

    // on envoie la requête
    $req = mysqli_query($db, $sql);

    // on fait une boucle qui va faire un tour pour chaque enregistrement
    while($data = mysqli_fetch_assoc($req))
        {
        // on affiche les informations de l'enregistrement en cours
        //echo $data['nom_commune'].' '.$data['lat'].' '.$data['lon'].'</i><br>';

?>
<tr>
  <th><?php echo utf8_encode($data['CodeAPE']);?></th>
  <th><?php echo utf8_encode($data['LibCodeAPE']);?></th>
  <th><?php echo utf8_encode($data['LibSsFamAPE']);?></th>
  <th><?php echo utf8_encode($data['LibFamAPE']);?></th>
  <th><?php echo utf8_encode($data['LibSectionAPE']);?></th>
</tr>


<?php
}
    ?>





<tbody>
</tbody>

</table>

</div>
</div>

<?php include"footer.php" ?>


<!-- jQuery Version 1.11.0 -->
<script src="js/jquery-1.11.0.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>
