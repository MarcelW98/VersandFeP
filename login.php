<?php
include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/function/sessionLogin.php");
include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/templates/head.inc.php");
include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/function/loginuser.php");
?>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<body class="bg" onload="loginTime()">

    <?php
    include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/templates/header.inc.php");
    ?>
    <br />
    <div class="container-fluid col-md-6 bg-white rounded text-center">
        <a><img src="bilder/Logo_groß.png" style="width:620px" class=" img-fluid" alt="LOGO" /><img src="bilder/Versand.png" style="width:500px" class=" img-fluid" alt="LOGO" /></a>
        <br />
        <br />
    </div>
    <br />
    <main role="main" class="container text-center">
        <div class="container-fluid">
            <div class="row">
                <div class="container col-md-4 bg-light rounded">
                    <div class="login-panel panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sie werden eingeloggt</h3>
                        </div>
                        <br>
                        <div class="panel-body">
                            <form id="login" role="form" method="post" action="login.php">
                                <fieldset>
                                    <div id="waitforlogin">
                                        <div class="spinner-border" role="status"></div>
                                    </div>
                                    <div class="text-danger"><b><?php echo $LoginError; ?></b></div>
                                </fieldset><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/templates/footer.inc.php");
    ?>

    <script>
        function loginTime() {
            var loginStatus = (<?php echo json_encode($LoginError); ?>);
            if (loginStatus == " ") {
                setTimeout(function() {
                    document.getElementById("login").submit();
                }, 1000)
            } else {
                document.getElementById("waitforlogin").setAttribute("hidden", "true");
            }
        };
    </script>