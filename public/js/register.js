(function () {
    var register = angular.module('register',[], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    register.controller('maincontroller', maincontroller);
    maincontroller.$inject = ['$scope'];
    function maincontroller ($scope) {
        $scope.title = "Registered as";
        $scope.decide =false;
        $scope.formDisplay =false;
        $scope.decideCategory =function (category) {
            if(category == "2"){
                $scope.title = "you have started registering as supplier";
                $scope.decide =true;
                $scope.formDisplay =true;
            }else if (category == "1"){
                $scope.title = "you have started registering as commercial farm service center";
                $scope.decide =false;
                $scope.formDisplay =true;
            }
            else if (category == "4"){
                $scope.title = "you have started registering as Transporter";
                $scope.decide =false;
                $scope.formDisplay =true;
            }
            else if (category == "3"){
                $scope.title = "you have started registering as Agro-dealer";
                $scope.decide =false;
                $scope.formDisplay =true;
            }
        };
    }
})();