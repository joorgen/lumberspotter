'use strict';

/* App Module */

var permitcatApp = angular.module('permitcatApp', [
  'ngRoute',
  'permitcatControllers'
]);

permitcatApp.config(['$routeProvider',
	function($routeProvider) {
    $routeProvider.
		when('/', {
			//templateUrl: 'index.html',
			//controller: 'PlaceListCtrl'
		}).
		when('/places/:placeId-:obshtina', {
			templateUrl: 'assets/partials/permit-list.html',
			controller: 'PlaceDetailsCtrl'
		}).
		when('/permits/:permitId',{
			templateUrl: 'assets/partials/permit-details.html',
			controller: 'PermitDetailsCtrl'
		}).
		otherwise({
			redirectTo: '/'
		});
}]);
