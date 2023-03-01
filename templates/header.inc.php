
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/versandfep" . "/database/user_service.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/versandfep" . "/auth/authguard.php");
AuthGuard::getInstance()->protect();
$loggedInUser = UserService::getInstance()->getLoggedInUser();
$isLoggedIn = !is_null($loggedInUser);
?>


<header class="bg-light fixed-top " >
<img src="bilder/colorbar.png" alt="colorbar" class="img-fluid" style="width:100%; height:9px; position: absolute; top:0; " />
<nav class="navbar navbar-expand-lg navbar-light " >
  <div class="container-fluid ">
  <a class="navbar-brand" href="startPage.php" style="margin-top: 8px;">
  <img src="bilder/BoschLogoNavColored.png" width="180" class="d-inline-block rounded" alt="Bosch Icon" />
  Versand@FeP
    </a>
 
    
    <div >
      <h3 id="pageName" style="font-family: var(--bs-font-sans-serif); margin: 0px; margin-top: 8px;" ></h3>
    
      </div>
    
    
      <div style="display: flex; justify-content: center; margin-top: 8px;" >
      <button type="button" aria-label="accessibility label" class="btn btn-primary" style="border: 1px; border-radius: 3px;margin-right: 20px; padding: 5px; background-color: #007bc0; float: left;" onclick="window.location.href = 'startPage.php';">
                <img src="assets/icons/home.svg" height="40" width="40">
            </button>
            <?php if ($isLoggedIn) { ?>
            <div style="margin-right: 120px;">
      <p style=" margin: 0px;"> <?php $username = $_SESSION['ldap_user'];
                                            echo ($username->getdisplayname()); ?></p>
        <p style=" margin: 0px;">Rolle: <?php echo ($_SESSION['user_role']); ?></p>
        </div>
        <?php } ?>
    
      </div>
      </div>
</nav> 
           
          
            
       
    
</header>
<br />
<br />
<br />
<br />

<script>
    $(document).ready(function() {
        $(".RoleType").on('change', function postinput() {
            var matchvalue = $(this).val(); // this.value
            console.log(matchvalue);
            $.ajax({
                url: 'function/ansicht.php',
                data: {
                    matchvalue: matchvalue
                },
                type: 'post'
            }).done(function(responseData) {
                console.log('Done: ', responseData);
                location.reload();
            }).fail(function() {
                console.log('Failed');
            });
        });
    });
</script>