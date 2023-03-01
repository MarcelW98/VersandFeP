var authorizationService = angular.module('loginService', [])

    /** NOT USED at the moment
     * original idea was for the login.js controller to send a
     * login request to the loginService so that
     * this service can handle the request however it seems fit*/
    .service('LoginService', function ($http) {
        this.userLogin = function (user, pw) {
            $http.post("db/userMngmnt.php", {
                'user' :  user,
                'pw' :  pw
            })
                .success(function (data) {

                    return data;
                });
        };
    });