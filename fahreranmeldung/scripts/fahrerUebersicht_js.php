<script>
    var form = "";
    var actionUrl = "";

    window.onload = function() {
      let date = new Date();
      
      document.getElementById("pageName").innerHTML = "Fahreranmeldung " + date.toLocaleDateString();
      
    };

    function abgeschlossenSend(myId) {

      var tester34 = document.getElementById("flexCheckDefault" + myId).checked;

      if (tester34) {

        form = $("#abgeschlossenForm" + myId);
        actionUrl = form.attr('action');

        $.ajax({
          type: "POST",
          url: actionUrl,
          data: form.serialize(),
          success: function(data) {

          }
        });
      } else {

        form = $("#abgeschlossenForm" + myId);
        actionUrl = 'fahreranmeldung/abgeschlossenreset.php';

        $.ajax({
          type: "POST",
          url: actionUrl,
          data: form.serialize(),
          success: function(data) {

          }
        });


      }
    }

    function modalDelete() {

      $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data) {
          $('#exampleModal1').modal('hide');
          window.location.reload();
        }
      });

    }

    function buttonloeschen(id) {
      document.getElementById("modalBody").innerHTML = "Möchten Sie den Eintrag mit der ID: " + id + " wirklich löschen?"
      $('#exampleModal1').modal('show');
      form = $("#deleteForm" + id);
      actionUrl = form.attr('action');


    }
  </script>