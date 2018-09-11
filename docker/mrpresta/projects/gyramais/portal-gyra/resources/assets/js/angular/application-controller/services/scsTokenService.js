/**
 *
 */
angular.module('applicationModule')
    .service('scsTokenService', ['$http','$q', '$window', function($http,$q,$window){

        var getScsToken = function(){
            var defer = $q.defer();
            var promise = defer.promise;

            $http({
                method: "POST",
                url: "https://scs.beta.mrpresta.com/oauth/access_token",
                dataType: "json",
                data: {
                    "grant_type" : "password",
                    "client_id" : "f3d259ddd3ed8ff3843839b",
                    "client_secret" : "4c7f6f8fa93d59c45502c0ae8c4a95b",
                    "username" : "developers@mrpresta.com",
                    "password" : "MrpLambda"
                },
                headers: {
                    "Access-Control-Allow-Origin": "*"
                },
            }).then(function (response) {
                defer.resolve(response.data);
            }, function(errorData){
                defer.reject(errorData);
            });
            return promise;
        };


        var validateScsToken = function(){
            var token = localStorage.getItem("token");
            var date = new Date();
            var timeNow = date.getTime() / 1000;

            if(token == null){
                getScsToken().then(function (response) {
                    if(response.access_token){
                        date.setSeconds(response.expires_in)
                        var expiresIn = date.getTime() / 1000

                        localStorage.setItem("token", response.access_token);
                        localStorage.setItem("expiresIn", expiresIn);
                    }
                });
            }else{
                var expiresIn = localStorage.getItem("expiresIn");
                if(timeNow >= expiresIn){
                    getScsToken().then(function (response) {
                        if(response.access_token){
                            date.setSeconds(response.expires_in)
                            var expiresIn = date.getTime() / 1000

                            localStorage.setItem("token", response.access_token);
                            localStorage.setItem("expiresIn", expiresIn);
                        }
                    });
                }
            }


            return localStorage.getItem("token");
        };


        var service = {
            'getScsToken': function () {
                return getScsToken();
            },
            'validateScsToken': function () {
                return validateScsToken();
            },
        };

        return service;

}]);
