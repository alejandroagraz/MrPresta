/**
 *
 */
angular.module('applicationModule')
    .controller('applicationCtrl', ['$scope', '$timeout', '$window', 'applicationService', '$uibModal','scsTokenService',
        function ($scope, $timeout, $window, applicationService, $uibModal, scsTokenService) {
            var vm = this;
            vm.loading = false;
            vm.customVar = 'this is a test';
            vm.opportunities = [];
            vm.params = [];
            vm.form = {
                amount: null,
                tenor:null,
                client_id:null
            };

            vm.clientId = [];

            applicationService.getCustom('/get/global/data').then(function(response){

                if(response.type=='success') {
                    vm.globalData = response.data;
                    vm.clientId = vm.globalData.MLID
                    vm.getApplications();
                    vm.getParams();
                }else{
                    console.log(response);
                }
            });

            vm.modalNewApp = function () {
                var parentElem = undefined;
                var modalInstance = $uibModal.open({
                    animation: true,
                    ariaLabelledBy: 'modal-title',
                    ariaDescribedBy: 'modal-body',
                    templateUrl: 'newAppModalContent.html',
                    controller: 'ModalInstanceCtrl',
                    controllerAs: 'ctrl',
                    size: 'lg',
                    appendTo: parentElem,
                    resolve: {
                        items: function () {
                            return vm.params;
                        },
                        formData : function () {
                            return vm.form;
                        },
                        vmRoot : function () {
                            return vm;
                        },
                        clientId: vm.clientId
                    }
                });

                modalInstance.result.then(function (selectedItem) {
                    vm.selected = selectedItem;
                }, function () {
                    $log.info('Modal dismissed at: ' + new Date());
                });
            };
            vm.showModal = function (opportunity) {
                var parentElem = undefined;
                var modalInstance = $uibModal.open({
                    animation: true,
                    ariaLabelledBy: 'modal-title',
                    ariaDescribedBy: 'modal-body',
                    templateUrl: 'myModalContent.html',
                    controller: 'ModalInstanceCtrl',
                    controllerAs: 'ctrl',
                    size: 'lg',
                    appendTo: parentElem,
                    resolve: {
                        items: function () {
                            return opportunity;
                        },
                        formData : function () {
                            return [];
                        },
                        vmRoot : function () {
                            return vm;
                        },
                        clientId: vm.clientId
                    }
                });
            };
            vm.reloadData = function () {
                if (!vm.loading) {
                    vm.getApplications();
                }
            };

            vm.getApplications = function () {
                var url = '/getOpportunities/' + vm.clientId;
                vm.loading = true;
                vm.opportunities = [];
                applicationService.getCustom(url).then(function (response) {
                    if (!response.error) {
                        vm.opportunities = response.data;
                        vm.loading = false;
                    } else {
                        console.log(response.error_description);
                        vm.loading = false;
                    }
                });
            };
            vm.getParams = function () {
                var url = '/getAppParams';
                applicationService.getCustom(url).then(function (response) {
                    if (!response.error) {
                        vm.params = response.data;
                    } else {
                        console.log(response.error_description);
                    }
                });
            };



        }
    ]);
angular.module('applicationModule')
    .controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, applicationService, items, formData, vmRoot, clientId) {
        alert(clientId);
        var vm = this;
        vm.items = items;
        vm.formData = formData;
        vm.formData.client_id = clientId;
        vm.errorApp = false;

        vm.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
        vm.processForm = function () {
            vm.sendForm();
        };
        vm.sendForm = function () {
            var url = '/registerApp';
            applicationService.postCustom(url, vm.formData).then(function (response) {
                console.log(response);
                if (!response.error) {
                    vm.cancel();
                    vm.formData.amount = null;
                    vm.formData.tenor = null;
                    vmRoot.reloadData();
                } else {
                    vm.errorApp = true;
                    console.log(response.error_description);
                }
            });
        }
    });
