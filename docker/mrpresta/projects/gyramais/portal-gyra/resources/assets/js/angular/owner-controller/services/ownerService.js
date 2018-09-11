/**
 *
 */
angular.module('ownerModule')
    .service('ownerService', ['$http','$q', function($http,$q){

        var getOwners = function(actionUrl){
         var defer = $q.defer();
         var promise = defer.promise;
         $http({
             method: "GET",
             url: actionUrl,
         }).then(function (response) {
             defer.resolve(response.data);
         }, function(errorData){
             defer.reject(errorData);
         });
         return promise;
        };

        var statusOwner = function(actionUrl){
            var defer = $q.defer();
            var promise = defer.promise;
            //console.log(query);
            $http({
                method: "DELETE",
                url: actionUrl,
            }).then(function (response) {
                defer.resolve(response.data);
            }, function(errorData){
                defer.reject(errorData);
            });
            return promise;
        };

        var getCustom = function(actionUrl){
            var defer = $q.defer();
            var promise = defer.promise;
            $http({
                method: "GET",
                url: actionUrl,
            }).then(function (response) {
                defer.resolve(response.data);
            }, function(errorData){
                defer.reject(errorData);
            });
            return promise;
        };

        var postCustom = function(actionUrl, data){
            var defer = $q.defer();
            var promise = defer.promise;
            $http({
                method: "POST",
                url: actionUrl,
                data: data,
            }).then(function (response) {
                defer.resolve(response.data);
            }, function(errorData){
                defer.reject(errorData);
            });
            return promise;
        };
        var putCustom = function(actionUrl, data){
            var defer = $q.defer();
            var promise = defer.promise;
            var query = data;
            $http({
                method: "PUT",
                url: actionUrl,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: query,
            }).then(function (response) {
                defer.resolve(response.data);
            }, function(errorData){
                defer.reject(errorData);
            });
            return promise;
        };


        var service = {
            'getCustom': function (actionUrl) {
                return getCustom(actionUrl);
            },
            'getOwners': function (actionUrl) {
                return getOwners(actionUrl);
            },
            'statusOwner': function (actionUrl) {
                return statusOwner(actionUrl);
            },
            'postCustom': function (actionUrl) {
                return postCustom(actionUrl);
            },
            'putCustom': function (actionUrl) {
                return putCustom(actionUrl);
            }
        };

        return service;

}]);
