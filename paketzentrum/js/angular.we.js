var application = angular.module("myapp", []);
application.controller("formcontroller", function($scope, $http){
 $scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"function/insert.php",
   data:$scope.insert,   
  }).success(function(data){
	  
	if(data.error1)
   {
    $scope.errorbarcodescan = data.error1.barcode_scan;
    $scope.successInsert = null;
   }
   else
	   
	if(data.error2)
   {
    $scope.errorbarcodescan = data.error2.barcode_scan;
    $scope.successInsert = null;
   }
   else
	   
   if(data.error)
   {
    $scope.errorbarcodescan = data.error.barcode_scan;
    $scope.errorAuftragsart = data.error.input_Auftragsart;
    $scope.errorGB = data.error.input_GB;
    $scope.errorWareneingbearbeiter = data.error.input_Wareneingbearbeiter;
    $scope.errorKommentar = data.error.input_Kommentar;
    $scope.successInsert = null;
   }
   else
   {
    $scope.insert = null;
    $scope.errorbarcodescan = null;
    $scope.errorAuftragsart = null;
    $scope.errorGB = null;
    $scope.errorWareneingbearbeiter = null;
    $scope.errorKommentar = null;
    $scope.successInsert = data.message;
   }

  });
 }
});