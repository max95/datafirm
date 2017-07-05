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
    <style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {width:100%;height:350px;}
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    .controls {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 300px;
    }

    #pac-input:focus {
      border-color: #4d90fe;
    }

    .pac-container {
      font-family: Roboto;
    }

    </style>
</head>
<body id="page-top">
  <?php include"menu.php" ?>
    <div class="header-content">
    <div class="col-md-8">
      <!-- Division d’affichage du résultat -->
      <div id="divisionResultat"></div>
      <input id="pac-input" class="controls" type="text"
          placeholder="Enter a location">
      <input id="idmalatitude" name="malatitude" type="hidden">
      <input id="idmalongitude" name="malongitude" type="hidden">
      <input id="proximite" name="rating" type="hidden">
      <input id="activite" name="ape" type="hidden">

      <div id="map"></div>
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
      <tbody>
      </tbody>
    </table>
    <!--div class="col-md-8"-->
    </div>
    <div class="col-md-4">
      <h4 style="color: black">Distance (km)</h4>
      <input name="rating" type="range" min="10" max="50" step="10" value="10" onchange="proximite()" id="rating" />
      <output id="rating_selectionne" for="flying" name="level" >Choisir la distance</output>
      <div class="well">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#code" data-toggle="tab">Par Code</a></li>
            <li><a href="#menu" data-toggle="--tab">Par Menu</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="code">
                    <h4 style="color: black">Code APE</h4>
                    <div class="input-group">
                        <input id="codeape" ONKEYUP="activite()" name="ape" type="text" class="form-control" placeholder="ex: 0130"/>
                    </div><br/>
                  <a onclick="recherche_activite()"class="btn btn-primary" style="background-color: Grey ">Rechercher</a>
                  <a class="btn btn-primary" style="background-color: Grey " href="liste_ape.php">Liste Code APE</a><br/>
              </div>
              <div class="tab-pane fade" id="menu">
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
    <!-- Script donné par Google à linker avec sa page -->
    <script>

      // In the following example, markers appear when the user clicks on the map.
      // Each marker is labeled with a single alphabetical character.
      var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var labelIndex = 0;
      var map;
      var donneesJSON;
      var markers = [];

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        //Selectionne la proximité à 10 au départ
        document.getElementById("proximite").value= 10;
        document.getElementById("idmalatitude").value =48.85661400000001;
        document.getElementById("idmalongitude").value =2.3522219000000177;


        //Construction de la map, centré sur Paris
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 48.85661400000001, lng: 2.3522219000000177},
          zoom: 10
        });

        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        //autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(10);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);

          //Récupération de lat et lng pour calculs ultérieurs
          var latlng = JSON.stringify(place.geometry.location);
          var lat=latlng.substring(7,latlng.indexOf(",",0));
          var lng=latlng.substring(lat.length+14,latlng.length-1);
          document.getElementById("idmalatitude").value = lat;
          document.getElementById("idmalongitude").value = lng;

          marker.setVisible(true);

          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });
      }
    </script>

    <script type="text/javascript">
    function activite(){
      var activite = document.getElementById("codeape").value;
      document.getElementById("activite").value= activite;
    }

    function proximite(){
      var rating = document.getElementById("rating").value;
      document.getElementById("proximite").value= rating;
      document.getElementById("rating_selectionne").innerHTML= rating;
    }

    function recherche_activite(){
      var lat = document.getElementById("idmalatitude").value;
      var lng = document.getElementById("idmalongitude").value;
      var proximite = document.getElementById("proximite").value;
      var activite = document.getElementById("activite").value;

      //Suppression des markers existants
      deleteMarkers();

      //Supression du tableau précédocument
      var table = $('#dataTables-example').DataTable();
      table
        .clear()
        .draw();
      /* Association de la variable resultat
      à la division d’affichage divisionResultat */
      var resultat = document.getElementById("divisionResultat");
      /* Instanciation d’un objet de type XMLHttpRequest
      /* NB : XMLHttpRequest est un objet ActiveX
      ou JavaScript qui permet d’obtenir des données
      au format XML, JSON, mais aussi HTML ou encore texte
      simple à l’aide de requêtes HTTP. */
      if (window.XMLHttpRequest) {
          // Code pour IE7+, Firefox, Chrome, Opera, Safari
          httpRequest = new XMLHttpRequest();
      } else {
          // Code pour IE6, IE5
          httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }
      /* Ouverture du fichier voitures.json
      via le script PHP serveurJSON */
      /* true : mode asynchrone -> le flux doit être
      disponible entièrement avant son traitement */
      httpRequest.open("GET", "recherche_entreprise.php?lat="+lat+"&lng="+lng+"&proximite="+proximite+"&ape="+activite, true);

      /* Définition du type de flux */
      httpRequest.setRequestHeader("Content-type", "application/json");
      /* Traitement effectué dès que le flux est disponible */
      httpRequest.onreadystatechange = function() {

          /* Test si requête terminée et test status OK */
          if (httpRequest.readyState == 4 && httpRequest.status == 200)
          {
                  /* Affichages de contrôle */
                  //alert("readystate : "+ httpRequest.readyState);
                  //alert("status : "+ httpRequest.status);
                  //alert("responseText : " + httpRequest.responseText);

                  /* Conversion du flux JSON en objets JavaScript */
                  donneesJSON = JSON.parse(httpRequest.responseText);

                  /* Initialisation de la variable resultat */
                  resultat.innerHTML = "";

                  //Définition du marqueur
                  var image = {
                    // Adresse de l'icône personnalisée - Attention il faut que le .png existe
                    url: 'images/drapeau.png',
                    // Taille de l'icône personnalisée
                    size: new google.maps.Size(40, 40),
                    // Origine de l'image, souvent (0, 0)
                    origin: new google.maps.Point(0,0),
                    // L'ancre de l'image. Correspond au point de l'image que l'on raccroche à la carte. Par exemple, si votre îcone est un drapeau, cela correspond à son mâts
                    anchor: new google.maps.Point(20, 40)
                  };

                  /* Parcours des objets JavaScript */
                  for (var obj in donneesJSON)
                  {

                         var marker = new google.maps.Marker({
                               icon: image,
                               position: new google.maps.LatLng(donneesJSON[obj].lat, donneesJSON[obj].lon),
                               title: donneesJSON[obj].entreprise,
                               map: map
                             });
                        //Nécessaire pour la suppresion des markers ultérieurs
                         markers.push(marker);

                        /* Creation du tableau de restitution*/
                        var table = $('#dataTables-example').DataTable();
                        table.rows.add( [ {
                                0: donneesJSON[obj].proximite,
                                1: donneesJSON[obj].entreprise,
                                2: donneesJSON[obj].numero+" "+donneesJSON[obj].adresse,
                                3: donneesJSON[obj].cp,
                                4: donneesJSON[obj].ville
                            } ] )
                            .draw();
                         }
                  }
          }

      /* Pas d’envoi de données au travers de la requête XMLHttpRequest */
      httpRequest.send(null);

      /* Message affiché en attente du traitement du fichier voitures.json */
      resultat.innerHTML = "Attente de traitement JSON ...";
    }
    </script>
    <script type="text/javascript">
    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
      setMapOnAll(null);
    }

    // Shows any markers currently in the array.
    function showMarkers() {
      setMapOnAll(map);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
      clearMarkers();
      markers = [];
    }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb-W-2g7z3d5oYWVnFm4gnBbRkN3NQenw&libraries=places&callback=initMap"></script>



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
