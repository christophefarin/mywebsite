// fichier cts.js
$(document).ready(function () {
  $.ajax({
    ////// Données envoyées au serveur //////
    type: "POST", // Le type de la requête HTTP
    url: "get_type_cdc.php", // La ressource ciblée
    ///// Fonctions exécutées aprés le retour des données du serveur /////
    success: function (data) {
      // ajax réussi
      $("#types").html(data);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    },
  });
});
function getHauteur(val) {
  $.ajax({
    ////// Données envoyées au serveur //////
    type: "POST", // Le type de la requête HTTP
    url: "get_hauteur.php", // La ressource ciblée
    data: "type_cdc=" + val, //Les données envoyées au serveur
    ///// Fonctions exécutées aprés le retour des données du serveur /////
    success: function (data) {
      // ajax réussi
      $("#hauteurs").html(data);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    },
  });
}

function getLargeurmin(val) {
  var type_cdc = $("#types option:selected").val(); //récupération de la valeur de la sélection précédente
  $.ajax({
    ////// Données envoyées au serveur //////
    type: "POST", // Le type de la requête HTTP
    url: "get_largeur_min.php", // La ressource ciblée
    data: "hauteur=" + val + "&type_cdc=" + type_cdc, //Les données envoyées au serveur
    ///// Fonctions exécutées aprés le retour des données du serveur /////
    success: function (lmin) {
      // ajax réussi
      $("#largeursmin").html(lmin);
      getLargeurmax();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    },
  });
}

function getLargeurmax() {
  var type_cdc = $("#types option:selected").val(); //récupération de la valeur de la sélection précédente
  var hauteur = $("#hauteurs option:selected").val(); //récupération de la valeur de la sélection précédente
  $.ajax({
    ////// Données envoyées au serveur //////
    type: "POST", // Le type de la requête HTTP
    url: "get_largeur_max.php", // La ressource ciblée
    data: "hauteur=" + hauteur + "&type_cdc=" + type_cdc, //Les données envoyées au serveur
    ///// Fonctions exécutées aprés le retour des données du serveur /////
    success: function (lmax) {
      // ajax réussi
      $("#largeursmax").html(lmax);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    },
  });
}

//Contrôle de la hauteur du cdc et calculs
function calculs() {
  //var type_cdc = String($("#types option:selected").val()); //récupération de la valeur de la sélection du type de cdc et conversion en chaine de caractères
  var hauteur_cdc = parseInt($("#hauteurs option:selected").val()); //récupération de la valeur de la sélection de la hauteur et conversion en nombre entier
  var reserve = document.getElementById("reserve").value; //récupération de la valeur de la réserve
  var nbcouches = document.getElementById("nbcouches").value; //récupération de la valeur du nombre de couches de câbles dans le cdc
  var largeursmin = parseInt($("#largeursmin option:selected").val()); //récupération de la valeur de la sélection de la largeur min du cdc et conversion en nombre entier
  //var largeursmax = parseInt($("#largeursmax option:selected").val()); //récupération de la valeur de la sélection de la largeur max du cdc et conversion en nombre entier
  //console.log(type_cdc);
  console.log(hauteur_cdc);
  console.log(reserve);
  console.log(nbcouches);
  console.log(largeursmin);
  //console.log(largeursmax);
  $.ajax({
    ////// Données envoyées au serveur //////
    type: "POST", // Le type de la requête HTTP
    url: "get_calculs.php", // La ressource ciblée
    ///// Fonctions exécutées aprés le retour des données du serveur /////
    success: function (data) {
      // ajax réussi
      console.log(data);
      let tableau = JSON.parse(data); //conversion au format tableau
      console.log(tableau);
      console.log(tableau[0]); //somme des diamètres des câbles sélectionnés
      console.log(tableau[1]); //somme des poids des câbles sélectionnés
      console.log(tableau[2]); //somme des sections des câbles sélectionnés
      console.log(tableau[3]); //le diamètre maxi parmis les câbles sélectionnés
      //vérification si la hauteur du cdc est suffisante
      var max_diam = tableau[3];
      if ((hauteur_cdc < max_diam) & (control2.style.display === "none")) {
        control2.style.display = "block"; //affiche un message dans la taskbar
      } else {
        control2.style.display = "none";
      }
      //ajout de la réserve dans les sommes
      var coef_reserve = 1 + reserve / 100;
      var result_poids = (tableau[1] * coef_reserve).toFixed(2); //arrondir à 2 chiffres aprés la virgule
      var result_section = (tableau[2] * coef_reserve).toFixed(2); //arrondir à 2 chiffres aprés la virgule
      if ((nbcouches > 0) & (nbcouches != "")) {
        result_diam = Math.max(
          (tableau[0] * coef_reserve) / nbcouches,
          largeursmin
        );
      } else {
        result_diam = largeursmin;
      }
      console.log(coef_reserve);
      console.log(result_diam);
      console.log(result_poids);
      console.log(result_section);
      //on affiche les valeurs
      document.getElementById("largeurcible").value = result_diam;
      document.getElementById("chargecible").value = result_poids;
      document.getElementById("volumecible").value = result_section;
      //on lance la fonction de mise à jour du tableau de résultats avec les paramètres calculés
      $("#tableresult").DataTable().ajax.reload();
    },
    // Oups une erreur
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    },
  });
}

//taskbar
//https://www.w3schools.com/howto/howto_js_alert.asp
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function () {
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function () {
      div.style.display = "none";
    }, 600);
  };
}

//Contrôle des valeurs min et max
function controlValue() {
  var largeur_min = parseInt($("#largeursmin option:selected").val()); //récupération de la valeur de la sélection précédente et conversion en nombre entier
  var largeur_max = parseInt($("#largeursmax option:selected").val()); //récupération de la valeur de la sélection précédente et conversion en nombre entier
  // Number.isInteger($("#largeursmax option:selected").val()); //vérifie si c'est un nombre
  if ((largeur_max < largeur_min) & (control.style.display === "none")) {
    control.style.display = "block"; //affiche un message dans la taskbar
  } else {
    control.style.display = "none";
  }
}

//Vérification si pas de câble de sélectionné
function selvide() {
  oTable = $("#tabright").dataTable();
  var oSettings = oTable.fnSettings();
  if ((oSettings.fnRecordsTotal() <= 0) & (vide.style.display === "none")) {
    vide.style.display = "block"; //affiche un message dans la taskbar
  } else {
    vide.style.display = "none";
  }
}
