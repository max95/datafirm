<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DATAFIRM permet a ces utilisateurs de trouver une entreprise suivant son secteur d'activité. Il Géolicalise les visiteurs afin de leur permettre de voir les entreprises le plus proche d'eux.">
    <meta name="keyboard" content="">
    <meta name="author" content="">

    <title>DATAFIRM-recherche d'une entreprise</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <script>
      function adresse(){
        var req = new XMLHttpRequest();
        var a = document.getElementById('monadresse').value;
        if (a!=""){
          req.open("GET","geocodage.php?adresse="+a,false);
          req.send(null);
          return req.responseText;
        }
        else{
          //adresse par défaut
          return "48.858205, 2.294359";
        }
      }
    </script>
</head>
<body id="page-top">
  <?php include"menu.php" ?>
    <div class="header-content">
    <div class="col-md-8">
        <form id="" action="#" method="GET">
          <h4>Adresse :</h4><input type="text" name="adresse" id="monadresse" value="<?php echo $_GET['adresse'];?>" placeholder="ex: Paris"><button onclick="initialize()" type="submit" class="btn btn-primary" style="background-color: Grey ">Rechercher</button><br><br>
          <input id="idmalatitude" name="malatitude" value="<?php echo $_GET["malatitude"]?>" type="hidden">
          <input id="idmalongitude" name="malongitude" value="<?php echo $_GET["malongitude"]?>" type="hidden">
        </form>
      <!-- Emplacement de ma Map -->
      <div id="map_canvas">  </div>
      <!-- Je mets du style pour donner une forme à mon emplacement de map -->
      <style>#map_canvas{width:100%;height:350px;}</style>
      <!-- Script donné par Google à linker avec sa page -->
      <script>
              <?php
              $ini_array = parse_ini_file("config.ini"); ?>
              var GOOGLE_MAP_KEY = " <?php echo ($ini_array['google']); ?>";

              function loadScript() {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'https://maps.googleapis.com/maps/api/js' +
                    '?key=' + GOOGLE_MAP_KEY +'&callback=initialize'; //& needed
                document.body.appendChild(script);
              }
              window.onload = loadScript;
      </script>
      <!-- Script pour dessinner sa map -->
      <script>
      		function initialize(){
            <?php
            $ini_array = parse_ini_file("config.ini");
            $host=($ini_array['host']);
            $login=($ini_array['login']);
            $mdp=($ini_array['mdp']);
            $db=($ini_array['db']);
            ?>
            //Géocode l'adresse
            var coordonnees = adresse();
            //Sépare la longitute et la latitude
            var lat=coordonnees.substring(0,coordonnees.indexOf(",",0));
            var lng=coordonnees.substring(lat.length+1,40);

            document.getElementById("idmalatitude").value = lat;
            document.getElementById("idmalongitude").value = lng;

      			var map_canvas = document.getElementById('map_canvas');
      			var map_options = {
      				center: new google.maps.LatLng(lat, lng),
      				zoom: 10,
      				mapTypeId: google.maps.MapTypeId.ROADMAP
      				}
      			var map = new google.maps.Map(map_canvas, map_options)
      			//--> Configuration de l'icône personnalisée
        		var image = {
          			// Adresse de l'icône personnalisée - Attention il faut que le .png existe
          			url: 'drapeau.png',
          			// Taille de l'icône personnalisée
          			size: new google.maps.Size(40, 40),
          			// Origine de l'image, souvent (0, 0)
          			origin: new google.maps.Point(0,0),
          			// L'ancre de l'image. Correspond au point de l'image que l'on raccroche à la carte. Par exemple, si votre îcone est un drapeau, cela correspond à son mâts
          			anchor: new google.maps.Point(20, 40)
        		};
            //Pointeur d'Origine
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng(lat, lng),
              map: map,
              draggable:true,
              title:"DEPART",
              // On définit l'icône de ce marker comme étant l'image définie juste au-dessus
              //icon: image
            });
          <?php
          if(ISSET($_GET['ape'])){
              $ape = $_GET['ape'];
              if(ISSET($_GET['rating'])){
                  $proximite = $_GET['rating'];
                  //Permet d'avoir des résultats si aucune adresse n'est saisie
                  if(ISSET($_GET['adresse']) AND ($_GET['adresse']!="")){
                      $lat = $_GET["malatitude"];
                      $lng = $_GET["malongitude"];
                  }
                  else{
                      $lat = "48.858205";
                      $lng = "2.294359";
                }
            }
            else{
                $proximite = 10;
            }
      		$db = mysqli_connect($host, $login, $mdp,$db) or die('Erreur de connexion : ' . mysqli_connect_error());
      		// on crée la requête SQL
      		$sql = "SELECT entreprise,lat,lon,numero,adresse,cp,ville, get_distance_metres('".$lat."', '".$lng."', lat, lon)
      		      AS proximite
      		      FROM Entreprise where ape like '".$ape."%'
      		      HAVING proximite < ".$proximite." ORDER BY proximite ASC";
      		// on envoie la requête
      		$req = mysqli_query($db, $sql) or die('Erreur de connexion : ' . mysqli_connect_error());
      		// on fait une boucle qui va faire un tour pour chaque enregistrement
      		while($data = mysqli_fetch_assoc($req))
      		    {?>
      		    // on affiche les informations de l'enregistrement en cours
      		    //echo $data['nom_commune'].' '.$data['lat'].' '.$data['lon'].'</i><br>';
      				var marker = new google.maps.Marker({
      				position: new google.maps.LatLng(<?php echo $data['lat'];?>,<?php echo $data['lon'];?>),
      				map: map,
      				title:"<?php echo $data['entreprise'];?>",
      				// On définit l'icône de ce marker comme étant l'image définie juste au-dessus
      				icon: image
      				});<?php
            }}?>
          }
      			// Astuce pour ne pas afficher la map lorsqu'il s'agit du référenceur de Google
      			if (navigator.userAgent.toLowerCase().indexOf('googlebot') === -1) {
      			// Lancement du script au chargement de la page
      			google.maps.event.addDomListener(window, 'load', initialize);
            map.enableGoogleBar();
      			}
      </script>
      <hr class="featurette-divider">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
             <tr>
                <th>Distance</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>CP</th>
                <th>Ville</th>
            </tr>
        </thead>
        <?php
        mysqli_data_seek ($req, 0);
        while($data = mysqli_fetch_assoc($req))
            {?>
              <tr>
                <th><?php echo $data['proximite'];?></th>
                <th><?php echo $data['entreprise'];?></th>
                <th><?php echo $data['numero'].' '.$data['adresse'];?></th>
                <th><?php echo $data['cp'];?></th>
                <th><?php echo $data['ville'];?></th>
              </tr><?php
            } ?>
      </table>
    <!--div class="col-md-8"-->
    </div>
    <div class="col-md-4">
      <div class="well">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#code" data-toggle="tab">Par Code</a></li>
            <li><a href="#menu" data-toggle="tab">Par Menu</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="code">
                  <form id="tab" oninput="level.value = rating.valueAsNumber" action="#" method="GET">
                    <h4 style="color: black">Distance (km)</h4>
                    <input name="rating" type="range" min="10" max="50" step="10" value="<?php echo $_GET["rating"]?>"  id="rating" />
                    <output for="flying" name="level" >Choisir la distance<?php echo $_POST['rating'] ?></output>
                    <h4 style="color: black">Code APE</h4>
                    <div class="input-group">
                        <input name="ape" type="text" value="<?php echo $ape;?>"class="form-control" placeholder="ex: 0130"/>
                        <input name="adresse" value="<?php echo $_GET["adresse"]?>" type="hidden">
                        <input name="malatitude" value="<?php echo $_GET["malatitude"]?>" type="hidden">
                        <input name="malongitude" value="<?php echo $_GET["malongitude"]?>" type="hidden">
                    </div><br/>
                  <button onclick="initialize()" type="submit" class="btn btn-primary" style="background-color: Grey ">Rechercher</button>
                  <a class="btn btn-primary" style="background-color: Grey " href="liste_ape.php">Liste Code APE</a><br/>
                </form>
              </div>
              <div class="tab-pane fade" id="menu">
                  <form id="tab2"oninput="level.value = rating.valueAsNumber" action="#" method="GET">
                      <h4 style="color: black">Distance (km)</h4>
                      <input name="rating" type="range" min="10" max="50" step="10" value="<?php echo $_GET["rating"]?>"  id="rating" />
                      <output for="flying" name="level" >Choisir la distance<?php echo $_POST['rating'] ?></output>
                      <input name="adresse" value="<?php echo $_GET["adresse"]?>" type="hidden">
                      <input name="malatitude" value="<?php echo $_GET["malatitude"]?>" type="hidden">
                      <input name="malongitude" value="<?php echo $_GET["malongitude"]?>" type="hidden">
                      <tr>
                          <td ><h4 style="color: black">Secteur</h4><select id="secteur" onclick="famille()" class="form-control" style="color: black"><?php include"recherche_secteur.php" ?></select></td>
                      </tr>
                      <tr>
                          <td><div id="famille"><h4 style="color: black">Famille</h4><select id="resultatfamille" disabled="disabled" class="form-control" style="color: black"></select></div></td>
                      </tr>
                      <tr>
                          <td><div id="sousfamille"><h4 style="color: black">Sous-Famille</h4><select id="resultatssfamille" disabled="disabled" class="form-control" style="color: black"></select></div></td>
                      </tr>
                      <tr>
                          <td><div id="codeape"><h4 style="color: black">Code APE</h4><select id="resultatcodeape" disabled="disabled" class="form-control" style="color: black" ></select></div></td>
                      </tr>
                  </form>
              <!--class="tab-pane fade"-->
              </div>
            <!--id="myTabContent" class="tab-content"-->
            </div>
        <!--class="well"-->
        </div>
    <!--class="col-md-4"-->
    </div>
    <!-- Footer -->
    <?php include"footer.php" ?>

    <!-- Menu Recherche Activité -->
    <script src="js/recherche_activite.js"></script>
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

    <!-- statistiques -->
    <?php include"record_stat.php" ?>
</body>
</html>
