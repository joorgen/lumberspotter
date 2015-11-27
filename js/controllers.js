'use strict';

/* Controllers */

var permitcatControllers = angular.module('permitcatControllers',[]);

permitcatControllers.controller('PlaceDetailsCtrl', ['$scope', '$routeParams', '$http',
	function($scope, $routeParams, $http) {
		$scope.loading = true;
		$scope.dataAvail = false;

		$http.get(config.opendata_api_url + '?filters={"Землище":"' + $routeParams.placeId +'","Община":"' +$routeParams.obshtina + '"}')
			.success(function(data) {
				$scope.permits = data;
			})
			.catch(function (err) {
				// Log error somehow.
			})
			.finally(function () {
				// Hide loading spinner whether our call succeeded or failed.
				$scope.loading = false;
				$scope.placeName = $routeParams.placeId;
				$scope.placeObshtina = $routeParams.obshtina;
				$scope.dataAvail = !$scope.loading && $scope.permits.length > 0;
			});
	}
]);

permitcatControllers.controller('PermitDetailsCtrl', ['$scope', '$routeParams', '$http',
	function($scope, $routeParams, $http) {
		$scope.loading = true;
		$scope.dataAvail = false;

		$http.get(config.opendata_api_url + '?filters={"Номер":"' + $routeParams.permitId +'"}')
		.success(function(data) {
			$scope.permit = data;
		})
		.catch(function (err) {
			// Log error somehow.
		})
		.finally(function () {
			// Hide loading spinner whether our call succeeded or failed.
			$scope.loading = false;
			$scope.permitId = $routeParams.permitId;
			$scope.dataAvail = !$scope.loading && $scope.permit.length > 0;
		});
	}
]);