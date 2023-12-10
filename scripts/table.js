// fichier table.js
$(document).ready(function () {
  var table1 = $("#tableft").DataTable({
    stateSave: true, //enregistre l'état actuel du tableau (page, filtre...)
    language: {
      url: "datatables/media/french.json",
      select: {
        rows: { _: " %d lignes sélectionnées", 1: " 1 ligne sélectionnée" },
      },
    },
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "fetch.php",
      type: "POST",
      error: function (jqXHR, ajaxOptions, thrownError) {
        alert(
          thrownError +
            "\r\n" +
            jqXHR.statusText +
            "\r\n" +
            jqXHR.responseText +
            "\r\n" +
            ajaxOptions.responseText
        );
      },
    },
    //sélection d'une seule ligne à la fois avec un click
    select: {
      style: "single",
    },
    columnDefs: [
      { targets: [0, 2, 3, 4], className: "dt-body-right" },
      { targets: [1], className: "dt-body-left" },
      { targets: "_all", className: "dt-head-center" },
      {
        targets: [2, 3, 4],
        visible: false,
        searchable: false,
      },
    ],
    dom: "Blfrtip",
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ],
    fixedColumns: {
      heightMatch: "none",
    },
  });
  var table2 = $("#tabright").DataTable({
    stateSave: true, //enregistre l'état actuel du tableau (page, filtre...)
    language: {
      url: "datatables/media/french.json",
    },
    processing: true,
    serverSide: true,
    ordering: false,
    ajax: {
      url: "fetch_cart.php",
      type: "POST",
      error: function (jqXHR, ajaxOptions, thrownError) {
        alert(
          thrownError +
            "\r\n" +
            jqXHR.statusText +
            "\r\n" +
            jqXHR.responseText +
            "\r\n" +
            ajaxOptions.responseText
        );
      },
    },
    columnDefs: [
      { targets: [0, 2, 3, 4, 5], className: "dt-body-right" },
      { targets: [1], className: "dt-body-left" },
      { targets: "_all", className: "dt-head-center" },
      {
        targets: [2, 3, 4],
        visible: false,
        searchable: false,
      },
      {
        targets: 0,
        width: "10%",
        searchable: false,
      },
      {
        targets: 1,
        width: "80%",
      },
      {
        targets: 5,
        width: "10%",
      },
    ],
    dom: "<t>i",
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ],
    fixedColumns: {
      heightMatch: "none",
    },
  });
  //configuration du plugin Tabledit
  //l'évènement draw de DataTables lance la fonction
  $("#tabright").on("draw.dt", function () {
    $("#tabright").Tabledit({
      url: "action_cart.php",
      dataType: "json",
      columns: {
        identifier: [0, "id"],
        editable: [[2, "nombre"]],
      },
      hideIdentifier: false,
      restoreButton: false,

      onFail: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      },
      onSuccess: function (data, textStatus, jqXHR) {
        //exécuté lorsque la requête ajax est terminée
        console.log(data);
        $("#tabright").DataTable().draw(false); //on reste sur la même page après un delete ou un edit
        //showtotals();
      },
    });
  });
  var table3 = $("#tableresult").DataTable({
    stateSave: true, //enregistre l'état actuel du tableau (page, filtre...)
    language: {
      url: "datatables/media/french.json",
    },
    processing: true,
    serverSide: true,
    ordering: false,
    searching: false,
    ajax: {
      url: "fetch_result.php",
      type: "POST",
      data: function (d) {
        (d.type_cdc = $("#types option:selected").val()),
          (d.hauteur = $("#hauteurs option:selected").val()),
          (d.largeurmax = $("#largeursmax option:selected").val()),
          (d.result_diam = $("#largeurcible").val()),
          (d.result_poids = $("#chargecible").val()),
          (d.result_section = $("#volumecible").val());
      },
      error: function (jqXHR, ajaxOptions, thrownError) {
        alert(
          thrownError +
            "\r\n" +
            jqXHR.statusText +
            "\r\n" +
            jqXHR.responseText +
            "\r\n" +
            ajaxOptions.responseText
        );
      },
    },
    columnDefs: [
      { targets: [0, 2, 3, 4, 5], className: "dt-body-right" },
      { targets: [1], className: "dt-body-left" },
      { targets: "_all", className: "dt-head-center" },
      // {
      //   targets: [0],
      //   visible: false,
      // },
    ],
    dom: "Blrtip",
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ],
    fixedColumns: {
      heightMatch: "none",
    },
  });
});
