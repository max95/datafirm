$(function() {

      Morris.Line({
          parseTime: false,
          element: 'morris-line-chart',
          data: [
          <?php
          $ini_array = parse_ini_file("../../../config.ini");
          $host=($ini_array['host']);
          $login=($ini_array['login']);
          $mdp=($ini_array['mdp']);
          $db=($ini_array['db']);
            		$db = mysqli_connect($host, $login, $mdp,$db);

          // on crée la requête SQL
      		$sql = "SELECT DATE_FORMAT(date, '%Y-%m-%d') as date,count(distinct ip) as nbconnection, SUM(REQUETE) as nbrequete
          FROM statistiques F,
              (SELECT id,
              (select count(id)
                FROM statistiques R WHERE page like '%proximite%' AND R.id=C.id) REQUETE
                FROM statistiques C) N
          WHERE F.id=N.id
          GROUP BY DATE_FORMAT(date, '%Y-%m-%d') ORDER BY date";

          // on envoie la requête
      		$req = mysqli_query($db, $sql);

      		// on fait une boucle qui va faire un tour pour chaque enregistrement
      		while($data = mysqli_fetch_assoc($req))
      		    {
            echo "{";
            echo "y: '".$data['date']."', ";
            echo "a: ".$data['nbconnection'].", ";
            echo "b: ".$data['nbrequete'];
            echo "},";
          }
          ?>
],
        xkey: 'y',
        ykeys: ['a','b'],
        labels: ['visiteur','requete'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
    Morris.Donut({
        element: 'morris-donut-chart-ape',
        data: [{
            label: "Culture du riz",
            value: 12
        }, {
            label: "Elevage de volailles",
            value: 30
        }, {
            label: "Fabrication d'instrumentation scientifique et technique",
            value: 20
        }],
        resize: true
    });
    Morris.Donut({
        element: 'morris-donut-chart-ville',
        data: [{
            label: "Paris",
            value: 100
        }, {
            label: "La Celle Saint Cloud",
            value: 20
        }, {
            label: "Poitier",
            value: 20
        }],
        resize: true
    });
});
