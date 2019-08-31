<!-- for more effective code, this should be extends  -->
@include('layouts.header')
    <body>

    <div ng-app="myApp" ng-controller="applicantCtrl">
        <div class="container">
            <h3>Applicant Page</h3>
            <form action="/api/v1/applicants">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="name" ng-model="applicant.name" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input ng-disabled="true" type="text" ng-model="applicant.email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Hired</label>
                     <select
                        ng-model="applicant.isHired"
                        ng-options="status.id as status.name for status in applicant.options">

                    </select>
                </div>
                <button ng-click="submitForm(applicant.id)" class="btn btn-default">Submit</button>
            </form>
        </div>

    </div>
    <script>

    var app = angular.module('myApp', [],function($interpolateProvider) {
        $interpolateProvider.startSymbol('{!');
        $interpolateProvider.endSymbol('!}');
    });
    app.controller('applicantCtrl', function($scope, $http) {
         $scope.applicant = JSON.parse("{{ $applicant }}".replace(/&quot;/g,'"'));

        $scope.applicant.options = [{
          id: 1,
          name: "Yes"
        }, {
          id: 0,
          name: "No"
        }];
        $scope.submitForm = function(id){

            $http.put("/api/v1/applicant/" + id, $scope.applicant)
                .then(function(response) {
                    console.log(response);
                });
        }


    });
    </script>
    </body>
</html>
