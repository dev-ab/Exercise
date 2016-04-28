angular.module('homeCtrl', []).controller('HomeController', ['$scope', '$window', function ($scope, $window) {

        var vm = this;
        //data arrays
        vm.user = $window.user;
        
        vm.users = function(){
            alert(vm.user);
        }

    }]);