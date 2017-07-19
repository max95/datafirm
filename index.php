<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="description" content="DATAFIRM permet a ces utilisateurs de trouver une entreprise suivant son secteur d'activité.">
    <meta name="keyboard" content="">

    <title>DATAFIRM</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="slider/dist/css/bootstrap-slider.css" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <link href="magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="css/creative.min.css" rel="stylesheet">
    <link href="css/perso.css" rel="stylesheet">
    <style>
      img{
         width:auto;
          height: auto;

      }
      .header-bg {
        width:100%;
        height:550px;
        background-image: url("images/boussole.jpg");
        background-size:cover;
      }

      .img-rounded{
        width: 10%;
        height: 10%;
      }
      .carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
            max-width: 100%;
            height: auto;
            display: inline;
      }
      .progress-bar-vertical {
        width: 100%;
        min-height: 200px;
        display: flex;
        align-items: flex-end;
        margin-right: 20px;
        margin-top: 20px;
        float: bottom;
      }

      .progress-bar-vertical .progress-bar {
        width: 100%;
        height: 0;
        -webkit-transition: height 0.6s ease;
        -o-transition: height 0.6s ease;
        transition: height 0.6s ease;
      }
    </style>

</head>

<body id="page-top">
  <div class="header-bg">
    <nav class="navbar navbar-default" style="border-color:transparent;">
     <div class="container-fluid">
       <ul class="nav navbar-nav navbar-right">
          <?php include"menu.php" ?>
       </ul>
     </div>
    </nav>
     <div class="container">
     </div>
  </div>
  <div class="container">
    <div class="col-md-offset-1 col-md-2 col-md-offset-9" style="margin-top:-120px">
      <a onclick="recherche.php"class="btn btn-primary" style="background-color: #fFad00;">Accéder à la carte</a>
    </div>
  </div>
  <div class="jumbotron">
      <div class="container">
        <div class="col-md-2">
            <div class="progress progress-bar-vertical">
              <div class="progress-bar" role="progressbar" aria-valuenow="4086150" aria-valuemin="0" aria-valuemax="10640379" style="height: 61%;">
                <span class="sr-only">30% Complete</span>
              </div>
            </div>
        </div>
        <div class="col-md-10">
          <h2>Nombre de sociétés inscrites dans SIRENE : 10.640.379</h2>
          <h2>Nombre de sociétés référencées dans DATAFirm : 4.086.150</h2><br><br><br>
          <a onclick="#"class="btn btn-primary" style="background-color: #082268 ">En savoir plus</a>
        </div>
      </div>
    </div>
    <div class="jumbotron" style="background-color: white">
      <div class="container">
            <div class="row">
              <div class="col-md-4 m-b-lg">
                        <div class="panel panel-default panel-profile m-b-0">
                          <div class="panel-heading" style="background-image: url(images/voilier.jpeg);"></div>
                          <div class="panel-body text-center">
                            <img class="panel-profile-img" src="images/jerome.jpeg">
                            <h5 class="panel-title">Jerome Bouchet</h5>
                            <p class="m-b">Apprenti Data Analyst.</p>
                            <a href="https://www.linkedin.com/in/jerome-bouchet-375b28a2/" role="button " onclick="window.open(this.href); return false;"><i class="fa fa-linkedin-square fa-3x" style="color:#585858"></i></a>
                          </div>
                        </div>
              </div>
              <!--</div> col-md-4 m-b-lg -->
              <div class="col-md-4 m-b-lg">
                        <div class="panel panel-default panel-profile m-b-0">
                          <div class="panel-heading" style="background-image: url(images/wallpaper_hugo1.jpeg);"></div>
                          <div class="panel-body text-center">
                            <img class="panel-profile-img" src="images/hugo.jpeg">
                            <h5 class="panel-title">Hugo Fichot</h5>
                            <p class="m-b">Apprenti Décisionnel.</p>
                            <a href="https://www.linkedin.com/in/hugo-fichot-964322105/" role="button" onclick="window.open(this.href); return false;"><i class="fa fa-linkedin-square fa-3x" style="color:#585858"></i></a>
                            </a>
                          </div>
                        </div>
              </div>
              <!--</div> col-md-4 m-b-lg -->
              <div class="col-md-4 m-b-lg">
                        <div class="panel panel-default panel-profile m-b-0">
                          <div class="panel-heading" style="background-image: url(images/wallpaper_chris.jpeg);"></div>
                          <div class="panel-body text-center">
                            <img class="panel-profile-img" src="images/chris.jpeg">
                            <h5 class="panel-title">Christopher Clemoux</h5>
                            <p class="m-b">Apprenti Développeur.</p>
                            <a href="https://www.linkedin.com/in/christopher-clemoux-830814145/" role="button" onclick="window.open(this.href); return false;"><i class="fa fa-linkedin-square fa-3x" style="color:#585858"></i></a>
                          </div>
                        </div>
              </div>
              <!--</div> col-md-4 m-b-lg -->

            </div>
            <!--</div> row -->

    </div>
</div class="container marketing">
<!-- container marketing -->

<!-- Footer-->
<?php include"footer.php" ?>


    <!-- jQuery -->
    <script src="jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="slider/dist/bootstrap-slider.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>

</body>

</html>
