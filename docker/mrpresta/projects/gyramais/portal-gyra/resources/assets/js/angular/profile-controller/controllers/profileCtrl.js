/**
 *
 */
angular.module('profileModule')
    .controller('profileCtrl', ['$scope', '$timeout', '$window', 'profileService',
        function ($scope, $timeout, $window, profileService) {
            var vm = this;

            vm.count = 2;
            vm.name = null;
            vm.profile = [];
            vm.picture = null;
            vm.confirm = null;
            vm.message = null;
            vm.loading = false;
            vm.allSend = true;
            vm.notAllSend = true;
            vm.typeMessage = null;

            $("#file").hide();
            $("#message").hide();
            $("#confirmSpan").hide();
            $("#nameSpan").hide();
            $("#nicknameSpan").hide();
            $("#passwordSpan").hide();

            vm.getProfile = function () {
                var url = '/get-profile';
                vm.loading = true;
                profileService.getCustom(url).then(function (response) {
                    if (!response.error) {
                        vm.profile = response.data;
                        vm.name = vm.profile['name'];
                        vm.loading = false;
                    } else {
                        vm.message = response.error_description;
                        vm.viewMessage('danger');
                        vm.loading = false;
                    }
                });
            };

            vm.validateInput = function (input) {
                if (vm.profile[input] == null || vm.profile[input].length === 0) {
                    $("#" + input + "Span").show();
                } else {
                    $("#" + input + "Span").hide();
                }

                vm.confirmPassword();
                vm.unlockSend();
            };

            vm.updateSpanNickname = function (nickname) {
                $("#spanNickname").text(nickname);
            };

            vm.emptyInput = function (input) {
                vm.profile[input] = null;
                vm.validateInput(input);
            };

            vm.unlockSend = function () {
                if ($("#password").length) {
                    if ($("#nameSpan").is(":visible") || $("#nicknameSpan").is(":visible") || $("#passwordSpan").is(":visible") || $("#confirmSpan").is(":visible")) {
                        vm.allSend = true;
                    } else {
                        vm.allSend = false;
                    }
                }
                else {
                    if ($("#nameSpan").is(":visible") || $("#nicknameSpan").is(":visible")) {
                        vm.notAllSend = true;
                    } else {
                        vm.notAllSend = false;
                    }
                }
            };

            vm.confirmPassword = function () {
                if ($("#confirmPassword").val() !== $("#password").val()) {
                    $("#confirmSpan").show();
                } else {
                    $("#confirmSpan").hide();
                }

                vm.unlockSend();
            };

            vm.viewMessage = function (type) {
                vm.typeMessage = type;
                $("#message").show();
            };

            vm.closeMessage = function () {
                $("#message").hide();
            };

            vm.uploadFile = function () {
                $("#file").change(function () {
                    $("#formPicture").submit();
                });
            };

            vm.processForm = function () {
                vm.sendForm();
            };

            vm.sendForm = function () {
                var url = '/update-profile';
                vm.loading = true;
                profileService.postCustom(url, vm.profile).then(function (response) {
                    if (!response.error) {
                        vm.profile = [];
                        vm.profile = response.data;
                        vm.name = vm.profile['name'];
                        vm.loading = false;
                        vm.name = vm.profile['name'];
                        vm.message = "Profile updated successfully";
                        vm.viewMessage('success');
                        vm.updateSpanNickname(vm.profile['nickname']);
                        vm.blockSend = true;
                    } else {
                        vm.message = response.error_description;
                        vm.viewMessage('danger');
                        vm.loading = false;
                    }
                });
            };

            vm.getProfile();
        }
    ]);

