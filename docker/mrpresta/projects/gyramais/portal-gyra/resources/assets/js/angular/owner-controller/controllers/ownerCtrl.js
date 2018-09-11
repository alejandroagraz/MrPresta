/**
 *
 */
angular.module('ownerModule')
    .controller('ownerCtrl', ['$scope','$timeout', '$window', 'ownerService',
        function($scope, $timeout, $window, ownerService){
            var vm = this;
            vm.error = [];
            vm.owners = [];
            vm.socialAccountsRegistered = [];
            vm.mlAccountsRegistered = [];

            ownerService.getOwners('/owners').then(function(response){
                if(response.type=='success') {
                    vm.owners = response.data
                }else{
                    vm.error = response;
                }
            });

            vm.statusOwner = function(id, index){

                ownerService.statusOwner('/status/owner/' + id).then(function(response){
                    if(response.type=='success') {

                        if(vm.owners[index].status==1)
                            vm.owners[index].status=0;
                        else if(vm.owners[index].status==0)
                            vm.owners[index].status=1;
                        /*vm.owners = vm.owners.filter(function(data){
                            if(data.id != index){
                                return data;
                            }
                        });*/
                    }else{
                        console.log(response);
                    }
                });
            };


            ownerService.getCustom('/social/accounts/registered').then(function(response){

                if(response.type=='success') {
                    vm.socialAccountsRegistered = response.data;
                }else{
                    console.log(response);
                }
            });
        }
    ]);
