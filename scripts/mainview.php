<script>

  $(document).ready(function() {
    $.get('templates/main.inc.php', function(data) {
      $('#MainView').html(data);
    });
  });

  
</script>