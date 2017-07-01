function famille(){
    var req = new XMLHttpRequest();
    var a = document.getElementById('secteur').value;
    console.log(a);
    req.open("GET","recherche_famille.php?famille="+a,false);
    req.send(null);
    document.getElementById('famille').innerHTML=req.responseText;
    document.getElementById('resultatfamille').disabled=false;
    document.getElementById('resultatssfamille').innerHTML="";
    document.getElementById('resultatssfamille').disabled=true;
    document.getElementById('resultatcodeape').innerHTML="";
    document.getElementById('resultatcodeape').disabled=true;
}
function sousfamille(){
    var req = new XMLHttpRequest();
    var a = document.getElementById('resultatfamille').value;
    console.log(a);
    //alert(a);
    req.open("GET","recherche_ssfamille.php?sousfamille="+a,false);
    req.send(null);
    document.getElementById('sousfamille').innerHTML=req.responseText;
    document.getElementById('resultatssfamille').disabled=false;
    document.getElementById('resultatcodeape').innerHTML="";
    document.getElementById('resultatcodeape').disabled=true;
}
function codeape(){
    var req = new XMLHttpRequest();
    var a = document.getElementById('resultatssfamille').value;
    console.log(a);
    //alert(a);
    req.open("GET","recherche_codeape.php?codeape="+a,false);
    req.send(null);
    document.getElementById('codeape').innerHTML=req.responseText;
    document.getElementById('resultatcodeape').disabled=false;
}
