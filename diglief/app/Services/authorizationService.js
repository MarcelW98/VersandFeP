var authorizationService = angular.module('authorizationService', [])
    .service('AuthorizationService', function () {

        /**
         * String for different userGroups
         * Authorizable:
         * Modules:
         * 'admin'                      Admin                       admin
         * 'buero'                      Büro                        office
         * 'iPunkt'                     I-Punkt                     I-Point
         * 'monitor'                    Monitor                     monitor
         * 'verladung'                  Verladung                   loading
         */

        /* return array,
        * is empty at initialisation */
        var groupAuthorization = [''];

        /** @const {array} USER_GROUP_ADMIN
         * @const {array} USER_GROUP_OFFICE
         * @const {array} USER_GROUP_IPOINT
         * @const {array} USER_GROUP_LOADING
         * @const {array} USER_GROUP_MONITOR*/
        const USER_GROUP_ADMIN = ['admin', 'verladung', 'buero','monitor','kPunkt' ];
        const USER_GROUP_OFFICE = ['buero'];
        const USER_GROUP_KPOINT = ['kPunkt'];
        const USER_GROUP_LOADING = ['verladung'];
        const USER_GROUP_MONITOR = ['monitor'];
        const USER_GROUP_SHIFT = ['buero','verladung','kPunkt','monitor'];



        /** public function
         * sets the authorization array depending on the
         * @param {string} userGroup
         * to a predefined user_group const */
        this.setAuthorization = function (userGroup) {
            if (userGroup === null) {
                groupAuthorization = [];
            }
            else if (userGroup === 'office') {
                groupAuthorization = USER_GROUP_OFFICE;
            }
            else if (userGroup === 'kPoint') {
                groupAuthorization = USER_GROUP_KPOINT;
            }
            else if (userGroup === 'loading') {
                groupAuthorization = USER_GROUP_LOADING;
            }   else if (userGroup === 'monitor') {
                groupAuthorization = USER_GROUP_MONITOR;
            }
            else if (userGroup === 'admin') {
                groupAuthorization = USER_GROUP_ADMIN;
            }else if (userGroup === 'shift'){
                groupAuthorization = USER_GROUP_SHIFT;
            }

        };

        /** public function
         * that returns the authorisation array */
        this.getAuthorizationWrite = function () {
            return groupAuthorization;
        };

    });