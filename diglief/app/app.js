'use strict';

// Declare app level module which depends on views, and components
angular.module('DigLief', [
  'ngRoute',
  'DigLief.login',
  'DigLief.views',
  'DigLief.version',
    'DBService',
    'authorizationService',
    'loginService',
    'ngAnimate',
    'ui.bootstrap'
])
    .config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
  $locationProvider.hashPrefix('!');

  $routeProvider.otherwise({redirectTo: '/login'});

}]);
