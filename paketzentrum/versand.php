<?php
session_start();

if (isset($_SESSION['benutzer'])) {
    $Schicht = 0;
    $buero = 0;
    $Admin = 0;
} else 

if (isset($_SESSION['buero'])) {
    $Schicht = 0;
    $Admin = 0;
    $buero = 1;
} else

if (isset($_SESSION['schichtfuehrer'])) {
    $Schicht = 1;
    $buero = 0;
    $Admin = 0;
    $inactive = 600;
    $session_life = time() - $_SESSION['last_time'];
    // if ($session_life > $inactive) {
    //     header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
    // }
} else

    if (isset($_SESSION['admin'])) {
    $Schicht = 0;
    $buero = 0;
    $Admin = 1;
    $inactive = 600;
    $session_life = time() - $_SESSION['last_time'];
    // if ($session_life > $inactive) {
    //     header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
    // }
} else {
    header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
}
$_SESSION['last_time'] = time();
?>

<head lang="en">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="view/media/favicon.ico">
    <link type="text/css" rel="stylesheet" href="css\bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sticky-footer-navbar.css">
    <link rel="stylesheet" href="css/rb_design.css">
    <script src="js/angular.js"></script>
    <script src="js/jquery.min.js"></script>
    <title>Auftrag versenden</title>
</head>

<body class="bg">
    <script src="js/bootstrap.min.js"></script>
    <header class="bg-light fixed-top">
        <!-- Header -->
        <img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width: 100%" />
        <nav class="navbar navbar-light bg-faded">
            <a class="navbar-brand align-top">
                <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block" alt="Bosch Icon" />
                Versand Werk Feuerbach &nbsp &nbsp &nbsp &nbsp <button class="align-self-end btn rb-button rb-button--primary" onclick="location.href = 'paketzentrum.php'">zurück zur Übersicht</button></a>
            <?php
            if ($Schicht == 1) {
                echo "<a><center><strong>Sie sind als Schichtführer eingeloggt</strong></center></a>";
            }

            if ($Admin == 1) {
                echo "<a><center><strong>Sie sind als Administrator eingeloggt</strong></center></a>";
                echo "<a href='verwaltung.php'><button class='btn btn-success rb-button-sm'>Verwaltung</button></a>";
            }
            ?>
            <?php if (!isset($_SESSION['user_role'])){  ?>
            <button type="button" class="btn btn-danger rb-button-sm" onclick="location.href = 'Logout.php'">Abmelden</button>
            <?php } ?>
        </nav>
    </header>
    <br />
    <br />
    <br />
    <br />
    <div class="bg-white container-fluid col-md-6 bg-light rounded text-center">
        <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO" />
            <h1>Auftrag versenden</h1>
        </a>
        <br />
    </div>
    <br />
    <main>
        <div class="container-fluid col-md-12 border rounded" style="width:700px; background-color: #efeff0;">

            <div ng-app="myappver" ng-controller="formcontrollerver">
                <form name="userForm" ng-submit="insertData()">

                    <!-- Barcode Scan -->
                    <div class="form-group col-md-12 center-block text-center">
                        <label>
                            <h2><strong>Barcode scannen <span class="text-danger">*</span></strong></h2>
                        </label>
                        <input type="text" style="text-align:center" id="barcode_scanversand" ng-click="reset()" name="barcode_scanversand" ng-model="insert.barcode_scanversand" class="form-control inputs" autofocus />
                        <span class="bg-danger text-white" ng-show="errorbarcodescan">{{errorbarcodescan}}</span>
                    </div>
                    <div class="form-group col-md-12 center-block text-center">
                        <h4><label class="fatred bg-white text-danger rounded center-block text-center" ng-show="prio"></p>&nbsp{{prio}}&nbsp</p></label></h4>
                        <h4><label class="bg-success text-white rounded center-block text-center" ng-show="successInsert"></p>{{successInsert}}</p></label></h4>
                    </div>

                    <div class="row">

                        <!-- Bearbeiter -->
                        <div class="form-group center-block text-center col-md-6">
                            <label><strong>Bearbeiter (VKS Nr.:)</strong><span class="text-danger">*</span></label>
                            <select id="input_Versandbearbeiter" name="input_Versandbearbeiter" ng-model="insert.input_Versandbearbeiter" class="form-control">
                                <option value="" selected disabled>Bitte Auswählen</option>
                                <?php
                                include("database/db_conection.php");
                                $sql = 'SELECT * FROM vks ORDER by VKS_Nummer ASC';
                                $result = mysqli_query($dbcon, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option>' . $row['VKS_Nummer'] . '</option>';
                                }
                                mysqli_close($dbcon);
                                ?>
                            </select>
                            <span class="bg-danger text-white" ng-hide="insert.input_Versandbearbeiter" ng-show="errorversandbearbeiter">{{errorversandbearbeiter}}</span>
                        </div>

                    </div>

                    <div class="form-group col-md-12 text-center">
                        <br />
                        <input type="submit" id="insert" name="insert" class="btn rb-button rb-button--primary btn-block" value="Auftrag speichern" />

                    </div>
                    <div class="col-md-12 text-left">
                        <button class="btn btn-danger rb-button-sm" onclick="javascript:document.getElementById('barcode_scanversand').focus()" ng-click="reset()" type="button">Eingabe zurücksetzen</button>
                    </div>
                </form>
            </div>
        </div>

        <br />

        <!-- Arbeitsvorat Anfang-->
        <div class="row">
            <div class="container-fluid col-md-11 text-center border rounded" style="width:700px; background-color: #efeff0;">
                <div class="table-scrol">
                    <h2>Arbeitsvorrat zum versenden</h2>
                    <div class="table-responsive bg-light">
                        <!--this is used for responsive display in mobile and other devices-->
                        <table id="Arbeitsvorrat" class="table table-bordered table-hover table-striped" style="table-layout: fluid">
                            <thead>
                                <tr>
                                    <th>Auftragsnummer</th>
                                    <th>Datum Transportpapiere</th>
                                    <th>Zeit Transportpapiere</th>
                                    <th>Lieferschein</th>
                                    <th>Dienstleister</th>
                                    <!-- <th>Bearbeiter VKS Transportpapiere</th> -->
                                    <th>Priorität</th>

                                </tr>
                            </thead>

                            <?php
                            include("database/db_conection.php");

                            $view_arbeitsvorrat_query = "select * FROM versendungen WHERE Status_Bereitstellung='1' && Status_Transportpapiere='1' && Status_Versendung='' && Status_Storno='' && Status_Klaerung='' ORDER by Prioritaet_Wareneingang='eilig' DESC, STR_TO_DATE(Datum_Bereitstellung, '%d.%m.%Y') ASC, Zeit_Bereitstellung ASC";

                            $run = mysqli_query($dbcon, $view_arbeitsvorrat_query); //here run the sql query.  

                            while ($row = mysqli_fetch_array($run)) //while look to fetch the result and store in a array $row.  
                            {
                                $id = $row[0];
                                $referenz = $row[1];
                                $prioW = $row[7];
                                $datumT = $row[23];
                                $zeitT = $row[24];
                                $lieferscheinT = $row[18];
                                $dienstleister = $row[25];
                                $bearbT = $row[27];

                            ?>
                                <tr>
                                    <!--here showing results in the table -->
                                    <td <?php if ($prioW == "eilig") {
                                            echo ' style="font-weight:bold;" id="spezial"';
                                        }   ?>><a class="Auftragsnummer" href="detail.php?id=<?php echo $referenz; ?>" style="color: black"> <?php echo $referenz; ?> </a></td>
                                    <td <?php if ($prioW == "eilig") {
                                            echo ' style="font-weight:bold;" id="spezial"';
                                        }   ?>><?php echo $datumT;  ?></td>
                                    <td <?php if ($prioW == "eilig") {
                                            echo ' style="font-weight:bold;" id="spezial"';
                                        }   ?>><?php echo $zeitT;  ?></td>
                                    <td <?php if ($prioW == "eilig") {
                                            echo ' style="font-weight:bold;" id="spezial"';
                                        }   ?>><?php echo $lieferscheinT;  ?></td>
                                    <td <?php if ($prioW == "eilig") {
                                            echo ' style="font-weight:bold;" id="spezial"';
                                        }   ?>><?php echo $dienstleister;  ?></td>
                                    <!-- <td <?php if ($prioW == "eilig") {
                                            echo ' style="font-weight:bold;" id="spezial"';
                                        }   ?>><?php echo $bearbT;  ?></td> -->
                                    <td <?php if ($prioW == "eilig") {
                                            echo ' style="font-weight:bold;" id="spezial"';
                                        }   ?>><?php echo $prioW;  ?></td>

                                </tr>
                            <?php }
                            mysqli_close($dbcon);
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <br />
        <br />
    </main>

    <div id="ModalContainer">
    </div>



    <?php
    include("function/footer.php")
    ?>

</body>

</html>

<script>
    $(document).ready(function() {
        $(".Auftragsnummer").click(function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            $.get(url, function(data, status) {
                $("#ModalContainer").html(data);
                console.log(data);
                $("#detailModal").modal('show');
            });
        });
    });
</script>


<script>
    var app = angular.module("myappver", []);
    app.controller("formcontrollerver", function($scope, $http) {
        $scope.insert = {};
        $scope.insertData = function() {
            $http({
                method: "POST",
                url: "function/versenden.php",
                data: $scope.insert,
            }).success(function(data) {

                // Überprüfung ob Priorisiert
                if (data.prio) {
                    $scope.prio = data.prio.barcode_scanversand;
                }

                // Fehlerbehandlung - Barcodescan wenn leer	
                if (data.error1) {
                    $scope.errorbarcodescan = data.error1.barcode_scanversand;
                    document.getElementById('barcode_scanversand').focus();
                    $scope.insert.barcode_scanversand = "";
                    $scope.insert.input_Versandbearbeiter = "";
                    $scope.errorversandbearbeiter = "";
                    $scope.successInsert = "";
                    $scope.prio = "";
                } else

                    // Fehlerbehandlung - Bearbeiter leer  
                    if (data.error2) {
                        if (data.error2.input_Versandbearbeiter > "") {
                            $scope.errorbarcodescan = "";
                            $scope.errorversandbearbeiter = data.error2.input_Versandbearbeiter;
                            document.getElementById('input_Versandbearbeiter').focus();
                            $scope.successInsert = "";

                        }
                    }

                else

                // Nach erfolgreicher Eingabe
                {
                    $scope.insert = "";
                    $scope.errorbarcodescan = "";
                    $scope.errorversandbearbeiter = "";
                    $scope.prio = "";
                    $scope.successInsert = data.message;
                    document.getElementById('barcode_scanversand').focus();
                    $( "#Arbeitsvorrat" ).load("verpacken.php #Arbeitsvorrat");	
                }

            });
        };

        // Eingabeform zurücksetzen
        $scope.reset = function() {

            $scope.successInsert = "";
            $scope.insert.barcode_scanversand = "";
            $scope.insert.input_Versandbearbeiter = "";

            $scope.errorbarcodescan = "";
            $scope.errorversandbearbeiter = "";
            $scope.prio = "";
            $scope.successInsert = data.message;
            document.getElementById('barcode_scanversand').focus();
        }
    });
</script>


<script type="text/javascript">
    // Immer Barcodescan Auswählen
    $(document).ready(function() {
        $('#barcode_scanversand').focus();
    });
</script>

<script>
    // Wenn "Enter" in Bearbeiter dann button Klick
    $(document).ready(function() {
        $("#input_Versandbearbeiter").keyup(function(event) {
            if (event.keyCode == 13) {
                $("#insert").click();
            }
        });
    });
</script>

<style type="text/css">
   #spezial
{
      background-color: #FA5858;
}
</style>