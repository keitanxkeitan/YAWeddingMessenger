var WeddingMessenger = angular.module('WeddingMessenger', ["WeddingMessengerFilters"]);

WeddingMessenger.controller('Ctrl', function($scope, $http, $sce) {
  $http.get('messages.php').success(function(data) {
    $scope.messages = data;
  });

  $scope.trustSrc = function(src) {
    return $sce.trustAsResourceUrl(src);
  };
});

var WeddingMessengerFilters = angular.module("WeddingMessengerFilters", []);

WeddingMessengerFilters.filter("status", function() {
  return function(input) {
    switch (input) {
      case "0": return "Created";
      case "1": return "Confirmed";
      case "2": return "Rejected";
    }
  };
});

WeddingMessengerFilters.filter("date", function() {
  return function(input) {
    var date = new Date(input);
    return (date.getMonth() + 1) + "/" + date.getDate() + " " + ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2);
  };
});