<?php

if($bdd = mysqli_connect('192.168.0.10', 'lp_acsid', 'lp_acsid2017', 'lp_acsid'))
{
  if($resultat = mysqli_query($bdd, 'SELECT * from SectionAPE'))
  {
    while($data = mysqli_fetch_assoc($resultat))
    {
      ?> <option value="<?php echo utf8_encode($data['SecAPE']) ?>"><?php echo utf8_encode($data['LibSectionAPE']) ?></option> <?php
    }
  }
  else{
    echo "Erreur requete";
  }
}
else
{
  echo "Erreur connexion BDD";
}


?>
