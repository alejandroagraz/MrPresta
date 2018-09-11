/**
 *
 */
angular.module('globalModule')
    .controller('globalCtrl', ['$scope','$timeout', '$window', 'globalService',
        function($scope, $timeout, $window, globalService){
            var vm = this;
            vm.mlAccountsRegistered  = [];

            //example
            globalService.getCustom('/ml/accounts/registered').then(function(response){
                if(response.type=='success') {
                    vm.mlAccountsRegistered = response.data;
                    console.log(vm.mlAccountsRegistered)

                }else{
                    console.log(response);
                }
            });

        }
    ]);
