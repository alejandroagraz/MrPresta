/**
 *
 */
angular.module('customModule')
    .controller('customCtrl', ['$scope','$timeout', '$window', 'customService',
        function($scope, $timeout, $window, customService){
            var vm = this;
            vm.customVar = 'this is a test';

            //example
            customService.postCustom(url, data).then(function(response){
                if(response.type=='success') {

                }else{
                }
            });

        }
    ]);
