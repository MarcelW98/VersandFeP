'use strict';

angular.module('DigLief.login', ['ngRoute'])

    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/login', {
            templateUrl: 'Login/login.html',
            controller: 'LoginCtrl as vm'
        });
    }])

    .controller('LoginCtrl', function (AuthorizationService, LoginService, $location, $http) {
        const vm = this;

        /** sets the current user 'authorization' to null
        * so if someone is logged-in as a user and somehow lands on this view
        * he has to log-in again*/
        AuthorizationService.setAuthorization(null);
        vm.login = function () {
            var group = null;

            /** sends a async request to userMngmnt.php
             * @param {string} User
             * @param {string] Password*/
            $http.post("db/userMngmnt.php", {
                'target' : 'login',
                /** gets @property {string} User and @property {string} Password
                 * from the login.html input elements*/
                'User': document.getElementsByName("user")[0].value,
                'Password': document.getElementsByName('pw')[0].value
            })
                /** if php request is successful, return @type {array} data
                 * that should only be zero or one string, which identifies the user-group */
                .success(function (data) {

                    /** if data is not empty, compares the string in the data array with the existing user-groups
                     * and assigns the authorisation by calling the AuthorizationService setAuthorization function  */
                    if(data != "" && data != null){
                        group = data[0].Group;
                         if (group === 'buero') {
                            AuthorizationService.setAuthorization('office');
                            $location.path('/buero');
                        } else if (group === 'kpunkt') {
                            AuthorizationService.setAuthorization('kPoint');
                            $location.path('/k-punkt');
                        } else if (group === 'admin') {
                            AuthorizationService.setAuthorization('admin');
                            $location.path('/buero');
                        }
                        else if (group === 'verladung') {
                            AuthorizationService.setAuthorization('loading');
                            $location.path('/verladung');
                        }
                        else if (group === 'monitor') {
                            AuthorizationService.setAuthorization('monitor');
                            $location.path('/monitor');
                        }else if (group === 'Schicht'){
                            AuthorizationService.setAuthorization('shift');
                            $location.path('/buero');
                        }
                    } /** else sets the input elements background to red and set the validation message*/
                    else {
                        document.getElementsByName('pw')[0].setCustomValidity("Username oder Password falsch!");
                        document.getElementsByName('user')[0].style.background = "#f9a7a7";
                        document.getElementsByName('pw')[0].style.background = "#f9a7a7";
                    }

                });
            document.getElementsByName('user')[0].setCustomValidity('');

        };


    });