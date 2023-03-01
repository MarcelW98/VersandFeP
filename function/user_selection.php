<?php ?>

<script>
  
document.addEventListener('DOMContentLoaded', function () {
  var testvar;
  testvar = window.location.href;
   document.getElementById('Testform').setAttribute("action", testvar);


  var test = " "; 
  // switch(test){
  //   case "Admin":
  //     document.getElementById("testbutton").setAttribute("disabled", "");
  //   case "Schicht":
  //   case "Büro":
  //     document.getElementById("testbutton").setAttribute("disabled", "");
  //   case "Werkstatt":
  //   case "Monitor":
  // }
   

	document.Testform.RoleType.addEventListener('change', CheckAuswahl);
 
	function CheckAuswahl () {
	 	var menu = document.Testform.RoleType;
		
     test = menu.options[menu.selectedIndex].value;	
     //window.location.href = "startPage.php?test=" + test;
    console.log(test);
    document.getElementById("Testform").submit();
   
    
	}

  

});

/*
	function CheckAuswahl () {
	 	var menu = document.Testform.RoleType;
    var content = document.getElementById("role");
     role = menu.options[menu.selectedIndex].value;
     //window.location.href = "startPage.php?test=" + test;
    //document.getElementById("Testform").submit();
    $(menu).dropdown('toggle');
    sessionStorage.setItem ("secondRole", role);
    document.querySelector('#role').textContent = role;
    document.getElementById("Testform").submit();
  
    console.log("dasdsa");

*/


$(document).ready(function(){
    $(".RoleType").on('change', function postinput(){
        var matchvalue = $(this).val(); // this.value
        console.log(matchvalue);
        //$.ajax({ 
        //    url: 'matchedit-data.php',
        //    data: { matchvalue: matchvalue },
        //    type: 'post'
        //}).done(function(responseData) {
        //    console.log('Done: ', responseData);
        //}).fail(function() {
        //    console.log('Failed');
        //});
    });
}); 




</script>



