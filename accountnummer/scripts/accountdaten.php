<script>

  $(document).ready(function() {
    $.get('accountnummer/tables/accoundaten_table.php', function(data) {
      $('#Accountdatentabelle').html(data);
    });
  });

  
</script>