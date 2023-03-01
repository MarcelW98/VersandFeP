'use strict';

/**
 * 08.Feb 2018: I-Point was renamed to kPoint, but code still partly uses i(-)Point/I(-)Punkt as attribute references, file-names and others.
 */

angular.module('DigLief.views', ['ngRoute'])


    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/monitor', {
            templateUrl: 'views/monitor.html',
            controller: 'ViewsCtrl as vm'
        })
            .when('/k-punkt', {
                templateUrl: 'views/k-punkt.html',
                controller: 'ViewsCtrl as vm'
            })
            .when('/verladung', {
                templateUrl: 'views/verladung.html',
                controller: 'ViewsCtrl as vm'
            })
            .when('/buero', {
                templateUrl: 'views/buero.html',
                controller: 'ViewsCtrl as vm'
            });
    }])

    .controller('ViewsCtrl', function ($scope, $uibModal, GetOrders, AuthorizationService, $location, $http, $interval,$filter) {
        const vm = this;
        //#region variable declaration
        /** declaration of popup-windows variables*/
        var detailPopup;
        var addOrderPopup;
        var spedManagmentPopup;
        var statusBueroPopup;
        var statusIPunktPopup;
        var statusVerladungPopup;
        var userMngmntPopup;
        var legendPopup;
                
        /** declares a variable in that the current view-url is saved as string*/
        vm.location = '';
        /** declares the array in that the orders will be saved*/
        vm.orders = [];
        /** declares the array in that the office-statuses will be loaded*/
        vm.statuses_buero = [];
        /** declares the array in that the i-point-statuses (now k-point statuses) will be loaded*/
        vm.statuses_iPoint = [];
        /** declares the array in that the loading-statuses will be loaded*/
        vm.statuses_verladung = [];
        /** declares the array in that the carriers will be loaded*/
        vm.spediteure = [];
        
        /** variable that is responsible for showing the filter options in the office view
         * per default, when the view is loaded, the options are closed = false*/
        vm.showFilterOptions = false;
        /** variable that contains information, when the database doesn't return an array
         * 1. the db-array is empty
         * 2. there was an error trying to get information from the database, this information will be stored in here*/
        vm.dataStatus = '';
        
        /** declare and initialise filter settings and preview-settings for office view */
        /* start of date-range for filter */
        vm.myOrder = ['-Datum','Spediteur','-ID'];
        $scope.spediteure = "test";
        var filterDateStart = new Date();
        filterDateStart.setDate(filterDateStart.getDate() - 1);
        vm.filterPreDateStart = filterDateStart;
        /* end of date-range for filter */
        var filterDateEnd = new Date();
        filterDateEnd.setDate(filterDateEnd.getDate() + 3);
        vm.filterPreDateEnd = filterDateEnd;
        /* filter option if order was (not) send/ flagged as send from loading */
        var filterSend = false;
        vm.filterPreSend = filterSend;
        vm.filterName = "";        
        /** declare and initialise filter settings and preview-settings for monitor view      */
        vm.monitorViewFilter = true;

        /* Used for input validation: time-format: HH:mm*/
        vm.timeRegExp = /^((0[0-9]|1[0-9]|2[0-3]):[0-5][0-9])$/;
        //#endregion variable declaration

        /* array that gets authorization-array from AuthorizationService
         * for the currently logged-in user
         * returns empty array if not logged in */
        // AuthorizationService.setAuthorization('admin');       
        var AuthorizationWrite = AuthorizationService.getAuthorizationWrite();            
        /* function that checks if certain string is in the authorization-array
         * return true/false */
        vm.AuthorizedWrite = function (id) {
            return (AuthorizationWrite.indexOf(id) > -1);
        };

        /* change monitor view if you are logged-in */
        if(vm.AuthorizedWrite('monitor') || vm.AuthorizedWrite('admin')){
            vm.monitorViewFilter = false;
        }
        
        vm.orderByMe = function(x){                        
            if(x  == vm.myOrder){                
                x ="-"+ x;
            }              
            vm.myOrder = x;                        
        }

        /* function requesting list of status ids and messages for 3 views;
        * office, i-point, loading
        * */
        var getStatuses = function () {
            $http.post("db/dbStatuses.php", {
                'target': 'getStatusIPoint'
            })
                .success(function (data) {

                    vm.statuses_iPoint = data;
                    if (angular.isArray(vm.statuses_iPoint) && vm.statuses_iPoint.length > 0) {
                        vm.statuses_iPoint.forEach(function (error) {
                            error.ID = parseInt(error.ID);
                        })
                    }
                });

            $http.post("db/dbStatuses.php", {
                'target': 'getStatusLoading'
            })
                .success(function (data) {
                    vm.statuses_verladung = data;
                    if (angular.isArray(vm.statuses_verladung) && vm.statuses_verladung.length > 0) {
                        vm.statuses_verladung.forEach(function (error) {
                            error.ID = parseInt(error.ID);
                        })
                    }
                });

            $http.post("db/dbStatuses.php", {
                'target': 'getStatusOffice'
            })
                .success(function (data) {
                    vm.statuses_buero = data;
                    if (angular.isArray(vm.statuses_buero) && vm.statuses_buero.length > 0) {
                        vm.statuses_buero.forEach(function (error) {
                            error.ID = parseInt(error.ID);
                        })
                    }
                })
        };
        /* function requesting complete list of carriers (Spediteure) from database
        * and saving it in the vm.spediteure array*/
        var getCarriers = function () {


            $http.post("db/dbSpediteurs.php", {
                'target': 'getSpediteurs'
            })
                .success(function (data) {
                    vm.spediteure = data;                    
                    if (vm.spediteure.length > 0) {                        
                        vm.spediteure.forEach(function (sped) {
                            sped.ID = parseInt(sped.ID);
                            if (sped.prioritisation === '0') {
                                sped.prioritisation = false;
                            } else if (sped.prioritisation === '1') {
                                sped.prioritisation = true;
                            }

                            if (sped.kPointRelevant === '0') {
                                sped.kPointRelevant = false;
                            } else if (sped.kPointRelevant === '1') {
                                sped.kPointRelevant = true;
                            }

                        })
                    }
                });
        };
        /* function depending on $location.path()(view URL) requests orders based on the view */
        var getOrders = function () {
            if ($location.path() === '/monitor') {
                vm.location = 'monitor';
                var dateStart = filterDateStart.getFullYear() + "-" + (filterDateStart.getMonth() + 1) + "-" + filterDateStart.getDate();
                var dateEnd = filterDateEnd.getFullYear() + "-" + (filterDateEnd.getMonth() + 1) + "-" + filterDateEnd.getDate();
                $http.post("db/dbOrders.php", {
                    'Versand': vm.monitorViewFilter,
                    'target': 'getMonitor',
                    "Bearbeiter" : vm.filterName,
                    "filterDateStart": dateStart,
                    "filterDateEnd": dateEnd,
                    "filterSend": filterSend,                 
                })
                    .success(function (data) {


                        if (angular.isArray(data)) {
                            vm.orders = data;
                            if (vm.orders.length > 0) {
                                vm.dataStatus = '';
                                parse();
                            }
                        } else {

                            if (data === "") {
                                vm.orders = null;
                                vm.dataStatus = 'Keine Daten verfügbar';
                            } else {
                                vm.orders = null;
                                vm.dataStatus = data;
                            }


                        }

                    });
            } else if ($location.path() === '/buero') {
                vm.location = 'buero';
                var dateStart = filterDateStart.getFullYear() + "-" + (filterDateStart.getMonth() + 1) + "-" + filterDateStart.getDate();
                var dateEnd = filterDateEnd.getFullYear() + "-" + (filterDateEnd.getMonth() + 1) + "-" + filterDateEnd.getDate();
                $http.post("db/dbOrders.php", {
                    "filterDateStart": dateStart,
                    "filterDateEnd": dateEnd,
                    "filterSend": filterSend,
                    "Bearbeiter": vm.filterName,
                    'target': 'getBuero'
                })
                    .success(function (data) {


                        if (angular.isArray(data)) {
                            vm.orders = data;
                            if (vm.orders.length > 0) {
                                vm.dataStatus = '';
                                parse();
                            }
                        } else {

                            if (data === "") {
                                vm.orders = null;
                                vm.dataStatus = 'Keine Daten verfügbar';
                            } else {
                                // vm.orders = null;
                                vm.dataStatus = data;
                            }


                        }

                    });

            } else if ($location.path() === '/verladung') {
                vm.location = 'verladung';
                $http.post("db/dbOrders.php", {
                    'target': 'getVerladung'
                })
                    .success(function (data) {


                        if (angular.isArray(data)) {
                            vm.orders = data;
                            if (vm.orders.length > 0) {
                                vm.dataStatus = '';
                                parse();
                            }
                        } else {

                            if (data === "") {
                                vm.orders = null;
                                vm.dataStatus = 'Keine Daten verfügbar';
                            } else {
                                //vm.orders = null;
                                vm.dataStatus = data;
                            }


                        }

                    });
            } else if ($location.path() === '/k-punkt') {
                vm.location = 'iPunkt';
                $http.post("db/dbOrders.php", {
                    'target': 'getIPunkt'
                })
                    .success(function (data) {


                        if (angular.isArray(data)) {
                            vm.orders = data;
                            if (vm.orders.length > 0) {
                                vm.dataStatus = '';
                                parse();
                            }
                        } else {

                            if (data === "") {
                                vm.orders = null;
                                vm.dataStatus = 'Keine Daten verfügbar';
                            } else {
                                //vm.orders = null;
                                vm.dataStatus = data;
                            }


                        }

                    });
            }
        };

        getOrders();
        getStatuses();
        getCarriers();

        //#region modal functions
        vm.openLegend = function () {
            vm.locationError;
            if ($location.path() === '/k-punkt') {
                vm.locationError = vm.statuses_iPoint;
            } else if ($location.path() === '/verladung') {
                vm.locationError = vm.statuses_verladung;
            } else if ($location.path() === '/buero') {
                vm.locationError = vm.statuses_buero;
            }


            legendPopup = $uibModal.open({
                animation: false,
                backdrop: true,
                templateUrl: 'Modals/legend.html',
                scope: $scope,
                size: 'lg'
            })
        };
        vm.openAddPopup = function () {
            vm.newOrder = new Object();
            vm.newOrder.Datum = new Date();
            vm.newOrder.Datum.setDate(vm.newOrder.Datum.getDate() + 1);
			if(vm.newOrder.Datum.getDay() === 0)
			{
				vm.newOrder.Datum.setDate(vm.newOrder.Datum.getDate() + 1);
			}
			if(vm.newOrder.Datum.getDay() === 6)
			{
				vm.newOrder.Datum.setDate(vm.newOrder.Datum.getDate() + 2);
			}
            vm.newOrder.Fehler_Buero = 0;
            vm.newOrder.Priorisierung = false;
            vm.newOrder.kPointRelevant = true;
            addOrderPopup = $uibModal.open({
                animation: false,
                backdrop: false,
                templateUrl: 'Modals/order-add.html',
                scope: $scope,
                size: 'lg'
            })

        };
        vm.openDetailPopup = function (selected) {
            vm.selectedOrder = angular.copy(selected);

            var detailURL = 'Modals/order-details.html';
            if ($location.path() === '/k-punkt') {
                vm.selectedOrder.Differenz = vm.selectedOrder.Pack_Soll - vm.selectedOrder.Auslagerung_Ist;
                detailURL = 'Modals/details-iPunkt.html';
            } else if ($location.path() === '/buero') {
                detailURL = 'Modals/details-buero.html';
            }
            else if ($location.path() === '/verladung') {
                vm.selectedOrder.Versanddatum = new Date();
                detailURL = 'Modals/details-verladung.html';
            }
            else if ($location.path() === '/monitor') {
                detailURL = 'Modals/details-monitor.html'
            }


            detailPopup = $uibModal.open({
                animation: false,
                backdrop: false,
                templateUrl: detailURL,
                scope: $scope,
                size: 'lg'
            });
        };

        vm.openSpedManagment = function () {
            vm.newCarrier = new Object();
            vm.newCarrier.prioritisation = false;
            vm.newCarrier.kPointRelevant = true;

            spedManagmentPopup = $uibModal.open({
                animation: false,
                backdrop: false,
                templateUrl: 'Modals/spediteurManagment.html',
                scope: $scope,
                windowClass: 'app-modal-window'
                // size: 'lg'
            });
        };
        vm.openStatusBueroManagment = function () {
            vm.newStatus = null;
            statusBueroPopup = $uibModal.open({
                animation: false,
                backdrop: false,
                templateUrl: 'Modals/statusBueroMngmnt.html',
                scope: $scope,
                windowClass: 'app-modal-window'

            });
        };
        vm.openStatusIPunktManagment = function () {
            vm.newStatus = null;
            statusIPunktPopup = $uibModal.open({
                animation: false,
                backdrop: false,
                templateUrl: 'Modals/statusIPunktMngmnt.html',
                scope: $scope,
                windowClass: 'app-modal-window'

            });
        };
        vm.openStatusVerladungManagment = function () {
            vm.newStatus = null;
            statusVerladungPopup = $uibModal.open({
                animation: false,
                backdrop: false,
                templateUrl: 'Modals/statusVerladungMngmnt.html',
                scope: $scope,
                windowClass: 'app-modal-window'

            });
        };
        vm.openUserMngmnt = function () {
            vm.getUser();
            vm.newUser = null;
            userMngmntPopup = $uibModal.open({
                animation: false,
                backdrop: false,
                templateUrl: 'Modals/userMngmnt.html',
                scope: $scope,
                windowClass: 'app-modal-window'

            });

        };

        /* function closes PopupWindows if open */
        vm.closePopup = function () {
            if (detailPopup) {
                detailPopup.close();
                detailPopup = null;
            }

            if (addOrderPopup) {
                addOrderPopup.close();
                addOrderPopup = null;
            }

            if (spedManagmentPopup) {
                spedManagmentPopup.close();
                spedManagmentPopup = null;
            }
            if (statusBueroPopup) {
                statusBueroPopup.close();
                statusBueroPopup = null;
            }
            if (statusIPunktPopup) {
                statusIPunktPopup.close();
                statusIPunktPopup = null;
            }
            if (statusVerladungPopup) {
                statusVerladungPopup.close();
                statusVerladungPopup = null;
            }
            if (userMngmntPopup) {
                vm.user = null;
                userMngmntPopup.close();
            }
        };
        /** function closing the legend popup*/
        vm.closeLegendPopup = function () {
            if (legendPopup) {
                legendPopup.close();
            }
        };
        //#endregion modal functions

        //#region order functions
        vm.sendLoading = function (){
            vm.selectedOrder.Versand = true;
            vm.save();
        }
        /** function updating an order with an http.post command to dbOrders.php*/
        vm.save = function () {
            if ($location.path() === '/k-punkt') {
                vm.closePopup();
                    vm.selectedOrder.Auslagerung_Ist = vm.selectedOrder.Auslagerung_Ist + vm.selectedOrder.Differenz;
                if (vm.selectedOrder.Auslagerung_Ist === vm.selectedOrder.Pack_Soll) {
                    vm.selectedOrder.Ausgelagert = true;
                }
            }
            $http.post("db/dbOrders.php", {
                'ID': vm.selectedOrder.ID,
                'Auslagerung_Ist': vm.selectedOrder.Auslagerung_Ist,
                'Bearbeiter': vm.selectedOrder.Bearbeiter,
                'Bemerkung': vm.selectedOrder.Bemerkung,
                'Datum': vm.selectedOrder.Datum,
                'Durchsprache': vm.selectedOrder.Durchsprache,
                'Ausgelagert': vm.selectedOrder.Ausgelagert,
                'Fehler_Buero': vm.selectedOrder.Fehler_Buero,
                'Fehler_IPunkt1': vm.selectedOrder.Fehler_IPunkt1,
                'Fehler_IPunkt2': vm.selectedOrder.Fehler_IPunkt2,
                'Fehler_IPunkt3': vm.selectedOrder.Fehler_IPunkt3,
                'Fehler_Verladung1': vm.selectedOrder.Fehler_Verladung1,
                'Fehler_Verladung2': vm.selectedOrder.Fehler_Verladung2,
                'Fehler_Verladung3': vm.selectedOrder.Fehler_Verladung3,
                'Ist_Abfahrt': vm.selectedOrder.Ist_Abfahrt,
                'Ist_Ankunft': vm.selectedOrder.Ist_Ankunft,
                'Pack_Soll': vm.selectedOrder.Pack_Soll,
                'Paletten_Soll': vm.selectedOrder.Paletten_Soll,
                'Plan_Ankunft': vm.selectedOrder.Plan_Ankunft,
                'Plan_Abfahrt': vm.selectedOrder.Plan_Abfahrt,
                'Priorisierung': vm.selectedOrder.Priorisierung,
                'Spediteur': vm.selectedOrder.Spediteur,

                'Versand': vm.selectedOrder.Versand,

                'target': 'updateOrder'
            })
                .success(function (data) {

                    if ($location.path() === '/k-punkt') {
                        if (vm.selectedOrder.Ausgelagert) {
                            $http.post("db/dbOrders.php", {
                                'target': 'setAuslagerTime',
                                'ID': vm.selectedOrder.ID
                            })
                        }
                    }

                    if ($location.path() === '/monitor') {
                        if (vm.selectedOrder.Durchsprache) {
                            $http.post("db/dbOrders.php", {
                                'target': 'setDurchspracheDatum',
                                'ID': vm.selectedOrder.ID
                            })
                        }
                    }
                    if ($location.path() === '/verladung') {
                        if (vm.selectedOrder.Versand) {
                            $http.post("db/dbOrders.php", {
                                'target': 'setVersandDatum',
                                'ID': vm.selectedOrder.ID
                            })
                        }
                    }

                    vm.closePopup();
                    getOrders();
                });


        };
        /** special function for monitor
         * updates an order when the checkbox is clicked in the orderlist
         * but else does the same as vm.save()*/
        vm.saveD = function (order) {
            $http.post("db/dbOrders.php", {
                'ID': order.ID,
                'Auslagerung_Ist': order.Auslagerung_Ist,
                'Bearbeiter': order.Bearbeiter,
                'Bemerkung': order.Bemerkung,
                'Datum': order.Datum,
                'Durchsprache': order.Durchsprache,
                'Ausgelagert': order.Ausgelagert,
                'Fehler_Buero': order.Fehler_Buero,
                'Fehler_IPunkt1': order.Fehler_IPunkt1,
                'Fehler_IPunkt2': order.Fehler_IPunkt2,
                'Fehler_IPunkt3': order.Fehler_IPunkt3,
                'Fehler_Verladung1': order.Fehler_Verladung1,
                'Fehler_Verladung2': order.Fehler_Verladung2,
                'Fehler_Verladung3': order.Fehler_Verladung3,
                'Ist_Abfahrt': order.Ist_Abfahrt,
                'Ist_Ankunft': order.Ist_Ankunft,
                'Pack_Soll': order.Pack_Soll,
                'Paletten_Soll': order.Paletten_Soll,
                'Plan_Ankunft': order.Plan_Ankunft,
                'Plan_Abfahrt': order.Plan_Abfahrt,
                'Priorisierung': order.Priorisierung,
                'Spediteur': order.Spediteur,

                'Versand': order.Versand,

                'target': 'updateOrder'
            })
                .success(function (data) {
                    if (order.Durchsprache) {
                        $http.post("db/dbOrders.php", {
                            'target': 'setDurchspracheDatum',
                            'ID': order.ID
                        })
						.success(function () {getOrders();});

                    }
                    //getOrders();
                    //ToDO Success-Msg
                });
        };

        /** when a new order is created
         * when the user selects a carrier from the dropdown list
         * it sets the carrier specific details for the new order */
        vm.selectSped = function (sped) {
            var obj = $filter('filter')(vm.spediteure, {Name:sped}, true)[0];
            sped = obj; 
            vm.newOrder.Plan_Ankunft = sped.Ankunft_Spediteur;
            vm.newOrder.Plan_Abfahrt = sped.Abfahrt_Spediteur;
            vm.newOrder.StorageTimeStart = sped.Auslagerung_Start;
            vm.newOrder.StorageTimeEnd = sped.Auslagerung_Ende;
            vm.newOrder.Auslager_Zeitfenster = sped.Auslager_Zeitfenster;
            vm.newOrder.Bearbeiter = sped.Bearbeiter;
            vm.newOrder.Bereitstellungszeit = sped.Bereitstellungszeit;
            vm.newOrder.Spaeteste_Abfahrt = sped.Spaeteste_Abfahrt;
            vm.newOrder.AllocationWindStart = sped.AllocationWindStart;
            vm.newOrder.AllocationWindEnd = sped.AllocationWindEnd;
            vm.newOrder.Priorisierung = sped.prioritisation;
            vm.newOrder.kPointRelevant = sped.kPointRelevant;


        };

        /** function creating a new order with http.post command over the dbOrders.php
         * in the db*/
        vm.addOrder = function () {
            var datum = vm.newOrder.Datum.getFullYear() + "-" + (vm.newOrder.Datum.getMonth() + 1) + "-" + vm.newOrder.Datum.getDate();
            if(vm.newOrder.kPointRelevant === false){
                vm.newOrder.Auslagerung_Ist = vm.newOrder.Pack_Soll;
            }else{
                vm.newOrder.Auslagerung_Ist = 0;
            }
            //GetOrders.addOrder(vm.newOrder);
            $http.post("db/dbOrders.php", {
                    'target': 'addOrder',
                    'Spediteur': vm.newOrder.Spediteur,
                    'Bearbeiter': vm.newOrder.Bearbeiter,
                    'Auslagerung_Ist': vm.newOrder.Auslagerung_Ist,
                'StorageTimeStart': vm.newOrder.StorageTimeStart,
                'StorageTimeEnd': vm.newOrder.StorageTimeEnd,
                    'Datum': datum,
                    'Plan_Ankunft': vm.newOrder.Plan_Ankunft,
                    'Plan_Abfahrt': vm.newOrder.Plan_Abfahrt,
                    'Pack_Soll': vm.newOrder.Pack_Soll,
                    'Fehler_Buero': vm.newOrder.Fehler_Buero,
                    'Bemerkung': vm.newOrder.Bemerkung,
                    'Bereitstellungszeit': vm.newOrder.Bereitstellungszeit,
                    'Spaeteste_Abfahrt': vm.newOrder.Spaeteste_Abfahrt,
                    'Priorisierung': vm.newOrder.Priorisierung,
                    'kPointRelevant': vm.newOrder.kPointRelevant

                }
            ).success(function (data) {
                vm.closePopup();
                getOrders();
            });


        };
        /** deletes Order from the db*/
        vm.deleteOrder = function () {
            $http.post("db/dbOrders.php", {
                'target': 'deleteOrder',
                'ID': vm.selectedOrder.ID
            })
                .success(function () {
                    vm.closePopup();
                    getOrders();
                })


        };
        //#endregion order functions

        //#region filter functions
        /* at the moment only for office */
        /* Applies the filter options for db request */
        vm.applyFilter = function () {
            filterDateStart = vm.filterPreDateStart;
            filterDateEnd = vm.filterPreDateEnd;
            filterSend = vm.filterPreSend;
            vm.showFilterOptions = false;
            getOrders();
        };
        vm.resetFilter = function () {
            vm.filterPreDateStart = filterDateStart;
            vm.filterPreDateEnd = filterDateEnd;
            vm.filterPreSend = filterSend;
        };
        /** change boolean for monitor view filter*/
        vm.monitorFilter = function () {
            vm.monitorViewFilter = !vm.monitorViewFilter;
            getOrders();
        };
        /** changes boolean that is responsible for displaying the filter option in the office  */
        vm.showFilter = function () {
            vm.resetFilter();
            vm.showFilterOptions = !vm.showFilterOptions;
        }     
        
	vm.Vortag = function() {
		let d = new Date(); 
		
		if (d.getDay() == 1 ) {
			d.setDate(d.getDate()-2);
			filterDateEnd = d;
			d = new Date();
			d.setDate(d.getDate()-3);
			filterDateStart = d;
		}else
		{
			d.setDate(d.getDate()-1);
			filterDateStart = d;
			filterDateEnd = d;
		} 
		filterSend = !filterSend;
		var text = document.getElementById('Vortag').firstChild;
		text.data = text.data == "Letzter Werktag anzeigen" ? "Aktuelles anzeigen" : "Letzter Werktag anzeigen";
		getOrders();

	} 

        //#endregion filter functions
        
        //#region admin management functions
        /* Add functions for Statuses */
        vm.addStatusOffice = function (text) {
            $http.post("db/dbStatuses.php", {
                    'target': 'addStatusOffice',
                    'ID': vm.newStatus.ID,
                    'Text': vm.newStatus.Text
                }
            ).success(function (data) {
                    vm.newStatus = null;
                    getStatuses();
                }
            )
        };
        vm.addStatusIPoint = function () {
            $http.post("db/dbStatuses.php", {
                    'target': 'addStatusIPoint',
                    'ID': vm.newStatus.ID,
                    'Text': vm.newStatus.Text
                }
            ).success(function (data) {
                    vm.newStatus = null;
                    getStatuses();
                }
            )
        };
        vm.addStatusLoading = function () {
            $http.post("db/dbStatuses.php", {
                    'target': 'addStatusLoading',
                    'ID': vm.newStatus.ID,
                    'Text': vm.newStatus.Text
                }
            ).success(function (data) {
                    vm.newStatus = null;
                    getStatuses();
                }
            )
        };

        /* Update functions for Statuses  */
        vm.updateStatusOffice = function (updateStatus) {
            if (!updateStatus.newID) {
                updateStatus.newID = updateStatus.ID;
            }
            $http.post("db/dbStatuses.php", {
                    'target': 'updateStatusOffice',
                    'ID': updateStatus.ID,
                    'newID': updateStatus.newID,
                    'Text': updateStatus.Text
                }
            ).success(function (data) {
                    getStatuses();
                }
            )
        };
        vm.updateStatusIPoint = function (updateStatus) {
            if (!updateStatus.newID) {
                updateStatus.newID = updateStatus.ID;
            }
            $http.post("db/dbStatuses.php", {
                    'target': 'updateStatusIPoint',
                    'ID': updateStatus.ID,
                    'newID': updateStatus.newID,
                    'Text': updateStatus.Text
                }
            ).success(function (data) {
                    getStatuses();
                }
            )
        };
        vm.updateStatusLoading = function (updateStatus) {
            if (!updateStatus.newID) {
                updateStatus.newID = updateStatus.ID;
            }
            $http.post("db/dbStatuses.php", {
                    'target': 'updateStatusLoading',
                    'ID': updateStatus.ID,
                    'newID': updateStatus.newID,
                    'Text': updateStatus.Text
                }
            ).success(function (data) {
                    getStatuses();
                }
            )
        };

        /* Delete functions for Statuses   */
        vm.deleteStatusOffice = function (deleteStatus) {
            $http.post("db/dbStatuses.php", {
                    'target': 'deleteStatusOffice',
                    'ID': deleteStatus.ID,

                }
            ).success(function (data) {
                    getStatuses();
                }
            )
        };
        vm.deleteStatusIPoint = function (deleteStatus) {
            $http.post("db/dbStatuses.php", {
                    'target': 'deleteStatusIPoint',
                    'ID': deleteStatus.ID,

                }
            ).success(function (data) {
                    getStatuses();
                }
            )
        };
        vm.deleteStatusLoading = function (deleteStatus) {
            $http.post("db/dbStatuses.php", {
                    'target': 'deleteStatusLoading',
                    'ID': deleteStatus.ID,

                }
            ).success(function (data) {
                    getStatuses();
                }
            )
        };


        /* carrier managment functions */
        vm.addSpediteur = function () {
            $http.post("db/dbSpediteurs.php", {
                    'target': 'addSpediteur',
                    'Name': vm.newCarrier.Name,
                    'Bearbeiter': vm.newCarrier.Bearbeiter,
                    'AllocationWindStart': vm.newCarrier.AllocationWindStart,
                    'AllocationWindEnd': vm.newCarrier.AllocationWindEnd,
                    'Ankunft_Spediteur': vm.newCarrier.Ankunft_Spediteur,
                    'Abfahrt_Spediteur': vm.newCarrier.Abfahrt_Spediteur,
                    'Bereitstellungszeit': vm.newCarrier.Bereitstellungszeit,
                    'Zeitfenster_Spediteur': vm.newCarrier.Ankunft_Spediteur + ' - ' + vm.newCarrier.Abfahrt_Spediteur,
                    'Spaeteste_Abfahrt': vm.newCarrier.Spaeteste_Abfahrt,
                    'Auslager_Zeitfenster': vm.newCarrier.Auslagerung_Start + ' - ' + vm.newCarrier.Auslagerung_Ende,
                    'Auslagerung_Start': vm.newCarrier.Auslagerung_Start,
                    'Auslagerung_Ende': vm.newCarrier.Auslagerung_Ende,
                    'prioritisation': vm.newCarrier.prioritisation,
                    'kPointRelevant': vm.newCarrier.kPointRelevant
                }
            ).success(function (data) {
                vm.newCarrier = new Object();
                vm.newCarrier.prioritisation = false;
                vm.newCarrier.kPointRelevant = true;
                getCarriers();
            });
        };
        vm.updateSpediteur = function (upSped) {
            $http.post("db/dbSpediteurs.php", {
                    'target': 'updateSpediteur',
                    'ID': upSped.ID,
                    'Name': upSped.Name,
                    'AllocationWindStart': upSped.AllocationWindStart,
                    'AllocationWindEnd': upSped.AllocationWindEnd,
                    'Ankunft_Spediteur': upSped.Ankunft_Spediteur,
                    'Abfahrt_Spediteur': upSped.Abfahrt_Spediteur,
                    'Bereitstellungszeit': upSped.Bereitstellungszeit,
                    'Zeitfenster_Spediteur': upSped.Ankunft_Spediteur + ' - ' + upSped.Abfahrt_Spediteur,
                    'Spaeteste_Abfahrt': upSped.Spaeteste_Abfahrt,
                    'Bearbeiter': upSped.Bearbeiter,
                    'Auslager_Zeitfenster': upSped.Auslagerung_Start + ' - ' + upSped.Auslagerung_Ende,
                    'Auslagerung_Start': upSped.Auslagerung_Start,
                    'Auslagerung_Ende': upSped.Auslagerung_Ende,
                    'prioritisation': upSped.prioritisation,
                    'kPointRelevant': upSped.kPointRelevant
                }
            ).success(function (data) {
                getCarriers();
            });
        };
        vm.updateAllSpediteur = function(){
            if(angular.isArray(vm.spediteure) && vm.spediteure.length > 0){
                vm.spediteure.forEach(function (upSped) {
                    $http.post("db/dbSpediteurs.php", {
                            'target': 'updateSpediteur',
                            'ID': upSped.ID,
                            'Name': upSped.Name,
                            'AllocationWindStart': upSped.AllocationWindStart,
                            'AllocationWindEnd': upSped.AllocationWindEnd,
                            'Ankunft_Spediteur': upSped.Ankunft_Spediteur,
                            'Abfahrt_Spediteur': upSped.Abfahrt_Spediteur,
                            'Bereitstellungszeit': upSped.Bereitstellungszeit,
                            'Zeitfenster_Spediteur': upSped.Ankunft_Spediteur + ' - ' + upSped.Abfahrt_Spediteur,
                            'Spaeteste_Abfahrt': upSped.Spaeteste_Abfahrt,
                            'Bearbeiter': upSped.Bearbeiter,
                            'Auslager_Zeitfenster': upSped.Auslagerung_Start + ' - ' + upSped.Auslagerung_Ende,
                            'Auslagerung_Start': upSped.Auslagerung_Start,
                            'Auslagerung_Ende': upSped.Auslagerung_Ende,
                            'prioritisation': upSped.prioritisation,
                            'kPointRelevant': upSped.kPointRelevant
                        }
                    ).success(function (data) {
                    });
                });
                getCarriers();
            }

        };
        vm.deleteSpediteur = function (delSped) {
            $http.post("db/dbSpediteurs.php", {
                'target': 'deleteSpediteur',
                'ID': delSped.ID
            })
                .success(function (data) {
                    getCarriers();
                });
        };

        /* user management functions */
        vm.getUser = function () {
            $http.post("db/userMngmnt.php", {
                'target': 'getUser'
            })
                .success(function (data) {
                    vm.user = data;
                   vm.user.forEach(function (user) {
                    user.Password ="";
                   }); 
                });
        };
        vm.addUser = function () {
            $http.post("db/userMngmnt.php", {
                'target': 'checkUser',
                'User': vm.newUser.User
            })
                .success(function (data) {

                    if (data === "") {
                        $http.post("db/userMngmnt.php", {
                            'target': 'addUser',
                            'User': vm.newUser.User,
                            'Password': vm.newUser.Password,
                            'Group': vm.newUser.Group
                        })
                            .success(function (data) {
                                vm.getUser();
                                vm.newUser = null;
                            });
                    } else {
                        vm.newUser.User = null;
                    }
                });


        };
        vm.deleteUser = function (user) {
            $http.post("db/userMngmnt.php", {
                'target': 'deleteUser',
                'ID': user.ID
            })
                .success(function (data) {
                    vm.getUser();
                });
        };
        vm.changePW = function (user) {
            $http.post("db/userMngmnt.php", {
                'target': 'changePW',
                'ID': user.ID,
                'Password': user.Password
            })
                .success(function (data) {
                    vm.getUser();
                })
        };
        //#endregion admin management functions

        /** function link to login page and sets authorisation to null*/
        vm.logout = function () {
            AuthorizationService.setAuthorization('');
            $location.path('/login');
        };

        /** parses most of the order attributes so it can be used by the program
         * db saves some values is different types than used by the program */
        var parse = function () {

            if (angular.isArray(vm.orders) && vm.orders.length > 0) {
                vm.orders.forEach(function (element) {

                    element.ID = parseInt(element.ID);
                    element.partialRelease = parseInt(element.partialRelease);
                    var dateParts = element.Datum.split("-");
                    element.Datum = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0, 2));
                    element.Datum.setHours(12);
                    if (element.Durchsprache === '0') {
                        element.Durchsprache = false;
                    } else if (element.Durchsprache === '1') {
                        element.Durchsprache = true;
                    }
                    if (element.Priorisierung === '0') {
                        element.Priorisierung = false;
                    } else if (element.Priorisierung === '1') {
                        element.Priorisierung = true;
                    }
                    if (element.Ausgelagert === '0') {
                        element.Ausgelagert = false;
                    } else if (element.Ausgelagert === '1') {
                        element.Ausgelagert = true;
                    }
                    if (element.kPointRelevant === '0') {
                        element.kPointRelevant = false;
                    } else if (element.kPointRelevant === '1') {
                        element.kPointRelevant = true;
                    }
                    element.Auslagerung_Ist = parseInt(element.Auslagerung_Ist);
                    element.Fehler_Buero = parseInt(element.Fehler_Buero);
                    element.Fehler_IPunkt1 = parseInt(element.Fehler_IPunkt1);
                    element.Fehler_IPunkt2 = parseInt(element.Fehler_IPunkt2);
                    element.Fehler_IPunkt3 = parseInt(element.Fehler_IPunkt3);
                    element.Fehler_Verladung1 = parseInt(element.Fehler_Verladung1);
                    element.Fehler_Verladung2 = parseInt(element.Fehler_Verladung2);
                    element.Fehler_Verladung3 = parseInt(element.Fehler_Verladung3);
                    element.Pack_Soll = parseInt(element.Pack_Soll);
                    if (element.Versanddatum === null || element.Versanddatum === "0000-00-00 00:00:00") {
                        element.Versanddatum = "";
                    } else {
                        dateParts = element.Versanddatum.split("-");
                        element.Versanddatum = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0, 2));
                    }

                    if (element.Versand === '0') {
                        element.Versand = false;
                    } else if (element.Versand === '1') {
                        element.Versand = true;
                    }

                    if (element.Verladedatum === "0000-00-00") {
                        element.Verladedatum = "";
                    } else {
                        dateParts = element.Verladedatum.split("-");
                        element.Verladedatum = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0, 2));
                    }
					let t = element.Erstellungs_Datum.split("-");
					let time = t[2].split(" ");
					element.Erstellungs_Datum = time[0]+"."+t[1]+"."+t[0] +" "+time[1];
					

                });
            }

        };

        /** periodic function that is called every 30 seconds and gets the orders from the db again */
        var periodicRefreshOrders = $interval(function () {
            if (!(detailPopup )) {
                getOrders();

                console.log(new Date() + 'Aufträge neu geladen.');
            }
        }, 30000);
        /** periodic function that is called every 10 minutes and gets the carriers and the statuses from the db again */
        var periodicRefresh = $interval(function () {
            if(!(spedManagmentPopup || statusBueroPopup || statusVerladungPopup || statusIPunktPopup)){
                getCarriers();
                getStatuses();
            }

            console.log(new Date() + 'Spediteure und Status neu geladen.');

        }, 600000);

        /** if the start/end date in the filter is changed, changes the minimum/maximum
         * allowed date to select with the other filter option*/
        vm.filterChangeMaxDate = function () {
            $scope.filterMaxDateOption.maxDate = vm.filterPreDateEnd;
        };
        vm.filterChangeMinDate = function () {
            $scope.filterMinDateOption.minDate = vm.filterPreDateStart;
        };


        // sets the minimum date that is possible to select when you create a new order
        $scope.options = {
            //showWeeks: false,
            startingDay: 1,
            minDate: new Date()
        };

        // filter options datepicker settings disallowing to select date that are
        // earlier or later then the counterpart
        $scope.filterMaxDateOption = {
            maxDate: filterDateEnd
        };
        $scope.filterMinDateOption = {
            minDate: filterDateStart
        };

        // on change of view, releases the periodicRefresh function for Trashcollector
        $scope.$on('$destroy', function () {

            if (angular.isDefined(periodicRefreshOrders)) {
                $interval.cancel(periodicRefreshOrders);
            }

            if (angular.isDefined(periodicRefresh)) {
                $interval.cancel(periodicRefresh);
            }
        });


    })


    /** reverses the orderlist
     * currently not used*/
    .filter('reverse', function () {
        return function (items) {
            if (items != null && items.length > 0) {
                return items.slice().reverse();
            }


        }
    });