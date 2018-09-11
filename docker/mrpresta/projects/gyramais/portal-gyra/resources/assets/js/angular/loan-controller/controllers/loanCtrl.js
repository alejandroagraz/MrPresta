/**
 *
 */
angular.module('loanModule')
    .controller('loanCtrl', ['$scope', '$timeout', '$window', 'loanService', '$uibModal', 'scsTokenService',
        function ($scope, $timeout, $window, loanService, $uibModal, scsTokenService) {
            var vm = this;
            vm.loading = false;
            vm.customVar = 'this is a test';
            vm.loans = [];
            vm.techUrlImages = $window.techUrlImages;
            vm.globalData = [];
            vm.clientId = null;

            loanService.getCustom('/get/global/data').then(function(response){

                if(response.type=='success') {
                    vm.globalData = response.data;
                    vm.clientId = vm.globalData.MLID
                    vm.getLoans();
                }else{
                    console.log(response);
                }
            });


            vm.generateDetailContractPDF = function (idContract) {

                vm.token = scsTokenService.validateScsToken();
                vm.contractDetail = '';

                loanService.postCustom('https://scs.beta.mrpresta.com/api/br/get/contrato/detail', {
                    'idContract': idContract,
                    'access_token': vm.token
                }).then(function (response) {
                    vm.contractDetail = response.contrato;
                    loanService.postCustom('https://scs.beta.mrpresta.com/api/br/getBalaceContract', {
                        'idContract': idContract,
                        'access_token': vm.token
                    }).then(function (response) {
                        vm.contractConsolidated = response.consolidado;

                        loanService.postCustom('https://scs.beta.mrpresta.com/api/br/getProyeccionPagos', {
                            'idContract': idContract,
                            'access_token': vm.token
                        }).then(function (response) {
                            vm.contractProyection = response.proyeccion_pagos;
                            $timeout(function () {
                                $('#pdf').submit();
                            }, 2000);
                        })
                    })
                });
            }

            vm.showModalPrePayment = function (loan) {

                var parentElem = undefined;
                var modalInstance = $uibModal.open({
                    animation: true,
                    ariaLabelledBy: 'modal-title',
                    ariaDescribedBy: 'modal-body',
                    templateUrl: 'prePaymentModalContent.html',
                    controller: 'ModalInstanceCtrl',
                    controllerAs: 'ctrl',
                    size: 'md',
                    appendTo: parentElem,
                    resolve: {
                        contract_id: function () {
                            return loan.contract_id;
                        },
                        loan: function () {
                            return loan;
                        },
                        vmRoot: function () {
                            return vm;
                        }
                    }
                });
            };

            vm.reloadData = function () {
                if (!vm.loading) {
                    vm.getLoans();
                }
            };
            vm.rowClass = function (realizo_pago, pago_parcial, periodo_vencido) {

                var clase = '';

                if (realizo_pago == 0)
                    clase = 'periodo-pendiente';
                else
                    clase = 'periodo-pago';

                if (pago_parcial == 1)
                    clase = 'pago-parcial';

                if (periodo_vencido == 1)
                    clase = 'periodo-vencido';

                return clase;
            };

            vm.cellClass = function (realizo_pago, pago_parcial, periodo_vencido) {

                var clase = '';

                if (realizo_pago == 0)
                    clase = 'hide-columns-periodo-pendiente';
                else
                    clase = 'hide-columns-periodo-pago';

                if (pago_parcial == 1)
                    clase = 'hide-columns-pago-parcial';

                if (periodo_vencido == 1)
                    clase = 'hide-columns-periodo-vencido';

                return clase;
            };

            vm.getLoans = function () {
                var url = 'https://scs.beta.mrpresta.com/loans/getLoans';
                vm.token = scsTokenService.validateScsToken();
                var data = {
                    access_token: vm.token,
                    //client_id: vm.clientId
                    client_id: 914
                };
                vm.loading = true;
                vm.loans = [];

                loanService.postCustom(url, data).then(function (response) {
                    if (!response.error) {
                        vm.loans = response.data;
                        vm.loading = false;
                    } else {
                        console.log(response.error_description);
                        vm.loading = false;
                    }
                });
            };

        }
    ]);
angular.module('loanModule')
    .controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, scsTokenService, loanService, contract_id, loan, vmRoot) {
        var vm = this;
        vm.contract_id = contract_id;
        var maxDatePrePaymentObj = formatToDate(loan.max_prepayment_date);
        var lastUpdateDateObj = formatToDate(loan.balance.fecha_actualizacion);

        vm.errorPrePayment = false;
        vm.loanCustom = {
            max_prepayment_date: new Date(maxDatePrePaymentObj.year, maxDatePrePaymentObj.month - 1, maxDatePrePaymentObj.day),
            last_update_date: new Date(lastUpdateDateObj.year, lastUpdateDateObj.month - 1, lastUpdateDateObj.day),
            invoice_supplemental: loan.invoice_supplemental,
            invoice_without_paying: loan.invoice_without_paying,
            installment: loan.installment,
            period_id: loan.period
        };
        vm.form = {
            amount: loan.installment,
            payment_date: null,
            period_id: loan.period,
            contract_id: contract_id
        };

        vm.today = function () {
            vm.form.payment_date = vm.loanCustom.last_update_date;
        };
        vm.today();

        vm.clear = function () {
            vm.form.payment_date = null;
        };

        vm.inlineOptions = {
            customClass: getDayClass,
            min: vm.loanCustom.last_update_date,
            showWeeks: true
        };


        vm.dateOptions = {
            formatYear: 'yy',
            maxDate: vm.loanCustom.max_prepayment_date,
            minDate: vm.loanCustom.last_update_date,
            startingDay: 1
        };

        vm.openDatePicker = function () {
            vm.popup1.opened = true;
        };

        vm.setDate = function (year, month, day) {
            vm.form.payment_date = new Date(year, month, day);
        };

        vm.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
        vm.format = vm.formats[0];
        vm.altInputFormats = ['M!/d!/yyyy'];

        vm.popup1 = {
            opened: false
        };

        vm.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
        vm.processForm = function () {
            vm.sendForm();
        };
        vm.sendForm = function () {
            var url = 'https://scs.beta.mrpresta.com/loans/registerPrePayment';
            vm.form.access_token = vm.token = scsTokenService.validateScsToken();
            loanService.postCustom(url, vm.form).then(function (response) {
                if (!response.error) {
                    vm.cancel();
                    vmRoot.reloadData();
                } else {
                    vm.errorPrePayment = true;
                    console.log(response.error_description);
                }
            });
        };
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        var afterTomorrow = new Date();
        afterTomorrow.setDate(tomorrow.getDate() + 1);
        vm.events = [
            {
                date: tomorrow,
                status: 'full'
            },
            {
                date: afterTomorrow,
                status: 'partially'
            }
        ];

        function getDayClass(data) {
            var date = data.date,
                mode = data.mode;
            if (mode === 'day') {
                var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

                for (var i = 0; i < vm.events.length; i++) {
                    var currentDay = new Date(vm.events[i].date).setHours(0, 0, 0, 0);

                    if (dayToCheck === currentDay) {
                        return vm.events[i].status;
                    }
                }
            }
            return '';
        }
        // To convert in a Date() format to display in <md-datepicker>
        function formatToDate(value) {

            var yearO = value.substring(6, 10);
            var monthO = value.substring(3, 5);
            var dayO = value.substring(0, 2);

            // Because months begin from 0
            //monthO = parseInt(monthO) - 1;

            return {day: dayO, month: monthO, year: yearO};
        }
    });
