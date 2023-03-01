<script>
     window.onload = function() {
      let date = new Date();
      
      document.getElementById("pageName").innerHTML = "Accountnummernübersicht";
      
    };
    function kundennuCheck() {
      let check = 0;
      data.forEach(function(myvalue) {
        let kundenvalue = document.getElementById('Kundenummer').value
        if (myvalue.kundennummer == kundenvalue && kundenvalue != "" && kundenvalue != 1) {
          document.getElementById('fehlermeldungKundennummer').innerHTML = "Kundennummer bereits vorhanden"
          check = 1;
          return;
        }
      });
      if (check == 0) {
        neuerEintrag();
      };
    };

    function neuerEintrag() {

      let inputData = document.getElementById('Kundenummer').value;

      if (inputData === "") {

        document.getElementById("Kundenummer").value = " ";
        $('#exampleModal').modal('hide');
        $('#exampleModal2').modal('show');

      } else {

        var form = $("#accountForm");
        var actionUrl = form.attr('action');

        $.ajax({
          type: "POST",
          url: actionUrl,
          data: form.serialize(),
          success: function(data) {
            $('#exampleModal').modal('hide');
            $('#exampleModal1').modal('show');
            window.setTimeout("modalEintragAngelegt()", 1500);

          }
        });
      }
    };

    function modalEintragAngelegt() {
      $('#exampleModal1').modal('hide');
      window.location.reload();
    };

    function modalEintragbearbeiten(valueid2) {

      data.forEach(function(myvalue) {
        if (myvalue.id == valueid2) {
          document.getElementById("idbearbeiten").value = myvalue.id;
          document.getElementById("Kundenummerbearbeiten").value = myvalue.kundennummer;
          document.getElementById("Dienstleisterbearbeiten").value = myvalue.dienstleister;
          document.getElementById("AccNummerbearbeiten").value = myvalue.acc_nummer;
          document.getElementById("Firmabearbeiten").value = myvalue.firma;
          document.getElementById("Straßebearbeiten").value = myvalue.straße;
          document.getElementById("Stadtbearbeiten").value = myvalue.stadt;
          document.getElementById("Landbearbeiten").value = myvalue.land;
          $('#exampleModal5').modal('show');

        }
      });

    };

    function eintragBearbeitenBesteatigen() {

      var form = $("#accountbearbeiten");
      var actionUrl = form.attr('action');

      $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data) {
          $('#exampleModal5').modal('hide');
          $('#exampleModal6').modal('show');
          window.setTimeout("modalEintraggeaendert()", 1500);
        }
      });
    };

    function modalEintraggeaendert() {
      $('#exampleModal6').modal('hide');
      window.location.reload();
    };

    function eintragLoeschen(valueid) {
      $('#exampleModal3').modal('show');
      idvalue = valueid;

    };

    function eintragLoeschenbestaetigen() {

      var form = $("#loeschenForm" + idvalue);
      var actionUrl = form.attr('action');

      $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data) {
          console.log("test989");
          $('#exampleModal4').modal('show');
          window.setTimeout("modalEintraggeloescht()", 1500);
        }
      });
    };

    function modalEintraggeloescht() {
      $('#exampleModal4').modal('hide');
      window.location.reload();
    };
  </script>