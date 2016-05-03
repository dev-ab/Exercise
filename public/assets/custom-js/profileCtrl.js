angular.module('profileCtrl', []).controller('ProfileController', ['$scope', '$window', function ($scope, $window) {

        var vm = this;
        //data arrays
        vm.user = $window.user;
        
        vm.users = function(){
            alert(vm.user);
        }

    }]);