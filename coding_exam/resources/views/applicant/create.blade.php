<!-- for more effective code, this should be extends  -->
@include('layouts.header')
    <body>

    <div ng-app="myApp" ng-controller="applicantCtrl">
        <div class="container">
            <!-- <form action="/api/v1/applicants"> -->
            <form>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="name" ng-model="applicant.name" class="form-control" id="name">
                     <span style="color:red">{! errors.name[0] !}</span>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" ng-model="applicant.email" class="form-control" id="email">
                    <span style="color:red">{! errors.email[0] !}</span>
                </div>
                <button ng-click="submitForm(applicant)" class="btn btn-default">Submit</button>
            </form>
        </div>

    </div>
    <script>

    var app = angular.module('myApp', [],function($interpolateProvider) {
        $interpolateProvider.startSymbol('{!');
        $interpolateProvider.endSymbol('!}');
    });
    app.controller('applicantCtrl', function($scope, $http) {

        $scope.submitForm = function(data){

            $http.post("/api/v1/applicant/", data)
                .then(function(response) {
                    if (response.data.errors) {
                        var errors = response.data.errors;
                        $scope.errors = errors;
                    } else {
                        window.location.href = "/api/v1/applicants";
                    }
                });
        }

    });
    </script>
    </body>
</html>
