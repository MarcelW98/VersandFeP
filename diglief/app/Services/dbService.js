var DBService = angular.module('DBService', [])

    /* service should be used to manage all db request functions
    * but currently all this functions are executed in the view.js controller
    * with that this service is at the moment not used at all and only
    * referenced in the view.js controller*/
    .service('GetOrders', function ($http) {


        // currently not used. Code for individually view executed in views.js controller.
        this.getOrders = function () {
            $http.post("db/dbOrders.php", {
                'target' : 'getOrders'
            })
                .success(function(data) {
                    return data;
                });
        };

        /* currently executed in views.js controller. */
        this.addOrder = function(newOrder, datum) {

            $http.post("db/dbOrders.php", {
                    'target': 'addOrder',
                    'Spediteur': newOrder.Spediteur,
                    'Bearbeiter': newOrder.Bearbeiter,
                    'Auslager_Zeitfenster': newOrder.Auslager_Zeitfenster,
                    'Datum': datum,
                    'Plan_Ankunft': newOrder.Plan_Ankunft,
                    'Plan_Abfahrt': newOrder.Plan_Abfahrt,
                    'Pack_Soll': newOrder.Pack_Soll,
                    'Fehler_Buero': newOrder.Fehler_Buero,
                    'Bemerkung': newOrder.Bemerkung,
                    'Bereitstellungszeit': newOrder.Bereitstellungszeit,
                    'Spaeteste_Abfahrt': newOrder.Spaeteste_Abfahrt,
                    'Priorisierung': newOrder.Priorisierung

                }
            ).success(function (data) {
               return true;
            });

        };

        //ToDo: Abfrage nach einem Datensatz
        this.getOrder = function (ID) {

        };

        /* currently executed in views.js controller. */
        this.updateOrder = function (saveOrder) {
            if($http.post("db/dbOrders.php", {
                'ID' : saveOrder.ID,
                'Auslagerung_Ist' : saveOrder.Auslagerung_Ist,
                'Bearbeiter' :  saveOrder.Bearbeiter,
                'Bemerkung' :  saveOrder.Bemerkung,
                'Datum' :  saveOrder.Datum,
                'Durchsprache' : saveOrder.Durchsprache,
                'Ausgelagert' : saveOrder.Ausgelagert,
                'Fehler_Buero' : saveOrder.Fehler_Buero,
                'Fehler_IPunkt1' :saveOrder.Fehler_IPunkt1,
                'Fehler_IPunkt2' :saveOrder.Fehler_IPunkt2,
                'Fehler_IPunkt3' :saveOrder.Fehler_IPunkt3,
                'Fehler_Verladung1' : saveOrder.Fehler_Verladung1,
                'Fehler_Verladung2' : saveOrder.Fehler_Verladung2,
                'Fehler_Verladung3' : saveOrder.Fehler_Verladung3,
                'Ist_Abfahrt' :  saveOrder.Ist_Abfahrt,
                'Ist_Ankunft' :  saveOrder.Ist_Ankunft,
                'Pack_Soll' : saveOrder.Pack_Soll,
                'Paletten_Soll' : saveOrder.Paletten_Soll,
                'Plan_Ankunft' :  saveOrder.Plan_Ankunft,
                'Plan_Abfahrt' :  saveOrder.Plan_Abfahrt,
                    'Priorisierung' : saveOrder.Priorisierung,
                'Spediteur' :  saveOrder.Spediteur,

                'Versand' : saveOrder.Versand,

                    'target' : 'updateOrder'
            })) {
                return true;
            }
            else {
                return false;
            }


        };

        /* currently executed in views.js controller. */
        this.deleteOrder = function () {

        };

        /* currently executed in views.js controller. */
        this.getSpediteure = function () {

        };


    })

;
