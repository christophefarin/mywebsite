//fichier cart.js
//ajouter un produit dans le panier
$(document).ready(function () {
  var table = $("#tableft").DataTable();
  //l'évènement select de DataTables (click sur une ligne) permet de lire les données de la ligne
  table.on("select", function (e, dt, type, indexes) {
    // console.log(table.rows(indexes).data().toArray());
    // var rowData = table.rows(indexes).data().toArray();
    var rowData = table.row(dt).data();
    var actionCart = rowData.push("add");
    // var data_to_send = $.serialize(rowData);
    // var data_to_send = $(rowData).serialize();
    console.log(rowData);

    $.ajax({
      url: "action_cart.php",
      type: "POST",
      data: {
        id: rowData[0],
        type_cable: rowData[1],
        diam_ext: rowData[2],
        poids: rowData[3],
        section_utile: rowData[4],
        action: rowData[5],
      },
      onFail: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      },
      success: function (response) {
        console.log(response);
        $("#tabright").DataTable().ajax.reload(); //actualisation du panier
        //showtotals();
      },
    });
  });
});
