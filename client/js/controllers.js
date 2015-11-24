'use strict';

/* Controllers */

function setFirstCapital(str)
{
	var place = str.toLowerCase();
	place = place.charAt(0).toUpperCase() + place.slice(1);
	return place;
}

var permitcatControllers = angular.module('permitcatControllers',[]);

permitcatControllers.controller('PlaceListCtrl', ['$scope', '$http',
	function($scope, $http) {
 		$http.get('data/places.json').success(function(data) {
			$scope.places = data;
		});
}]);

permitcatControllers.controller('PlaceDetailsCtrl', ['$scope', '$routeParams', '$http',
	function($scope, $routeParams, $http) {
		if( $scope.searchPlace != null && $scope.searchPlace.ime != null )
			$scope.searchPlace.ime = '';

		var place = setFirstCapital($routeParams.placeId);
		var obshtina = setFirstCapital($routeParams.obshtina);
		console.log(place);
		console.log(obshtina);
		$http.get('http://localhost:8000/logging-permits-registry/api/permits_api.php?filters={"Землище":"' + place +'"}').success(function(data) {
			$scope.permits = data;
			console.log(data);
		});
}]);