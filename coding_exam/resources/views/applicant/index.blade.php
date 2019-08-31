<!-- for more effective code, this should be extends  -->
@include('layouts.header')
    <body>

    <div ng-app="myApp" ng-controller="applicantCtrl">

        <div class="container">
            <h4>VAL VINCENT S. MONTESCLAROS</h4>
            <span class="">09453519058</span>
            <span class="">valvinzm@gmail.com</span>
            <div class="row" style="margin:40px;">
                <div class="col-md-6">
                    <canvas id="hired">Hired</canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="rejected">Rejected</canvas>
                </div>
              </div>


            <div class="row row-no-gutters">
                <div class="col-sm-3">
                    <button type="button" ng-click="goApplyPage()" class="btn btn-primary btn-block">
                        Apply as Applicant
                    </button>
                </div>
                <div class="col-sm-6">
                </div>
                <div class="col-sm-3">
                    <button type="button" ng-click="generateDummyDate()" class="btn btn-primary btn-block">
                        Generate Dummy Applicants
                    </button>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Hired</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="(key, applicant) in applicants">
                        <td>{! applicant.name !}</td>
                        <td>{! applicant.email !}</td>
                        <td>{! applicant.isHired == 1 ? "Yes" : "No" !}</td>
                        <td>{! applicant.created_at !}</td>
                        <td>
                            <button type="button" ng-click="goEditPage(applicant.id)" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span>
                                Edit
                            </button>
                            <button type="button" class="btn btn-default btn-sm" ng-click="deleteApplicant(applicant.id, key)">
                                <span class="glyphicon glyphicon-remove"></span> Remove
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    @include('applicant.PieChartJs')

    <script>
        var app = angular.module('myApp', [],function($interpolateProvider) {
            $interpolateProvider.startSymbol('{!');
            $interpolateProvider.endSymbol('!}');
        });
        app.controller('applicantCtrl', function($scope, $http) {

            $scope.deleteApplicant = function(id, key) {
                  $http.delete("/api/v1/applicant/" + id)
                  .then(function(response) {
                        $scope.applicants.splice(key, 1);
                        initializePie();
                        populateChart('hired', fillChartData(hired), 'Applicant Hired');
                        populateChart('rejected', fillChartData(rejected), 'Applicant Rejected');
                  });
            };

            $scope.goEditPage = function(id){
                window.location.href = "/api/v1/applicant/" + id + "/edit";
            }

            $scope.goApplyPage = function(){
                window.location.href = "/api/v1/applicant/create";
            }

            $scope.generateDummyDate = function(){
                $http.get("/api/v1/dummy-applicants")
                  .then(function(response) {
                        console.log(response.data);
                        $scope.applicants = response.data;
                        initializePie();
                        populateChart('hired', fillChartData(hired), 'Applicant Hired');
                        populateChart('rejected', fillChartData(rejected), 'Applicant Rejected');
                  });
            }

            $scope.applicants = JSON.parse("{{ $applicants }}".replace(/&quot;/g,'"'));

            var hired = [];
            var rejected = [];

            initializePie()

            function initializePie(){
                hired = [];
                rejected = [];
                $scope.applicants.forEach(function(applicant){
                    if (applicant.isHired) {
                        hired.push(applicant);
                    } else {
                        rejected.push(applicant);
                   }
                });
            }



            function fillChartData(applicants){

                if (applicants.length == 0) {
                    return [0, 0, 0];
                }

                var thisMonthData = getThisMonth(applicants);
                // 2nd param is subtracted from first day of the current week
                var thisWeekData = daysOfWEekFinder(thisMonthData);
                var lastWeekData = daysOfWEekFinder(thisMonthData, 7);
                return [thisMonthData.length, thisWeekData.length, lastWeekData.length];
            }

            function getThisMonth(applicants){
                var validData = [];

                applicants.forEach(function(applicant){
                    const dateTime = applicant.created_at;
                    const parts = dateTime.split(/[- :]/);

                    var month = parts[1];
                    var year = parts[0];

                    var currentdate = new Date();
                    var cur_month = currentdate.getMonth() + 1;
                    var cur_year = currentdate.getFullYear();

                    if (cur_month == month && year == cur_year) {
                        validData.push(applicant);
                    }
                });
                return validData;
            }

            function daysOfWEekFinder(applicants, daysOfWeekSubtractor = 0){
                let curr = new Date;
                let days = [];
                let validData = [];
                let first = curr.getDate() - curr.getDay();

                    for (let i = 0; i < 7; i++) {
                        let day = (first + i - daysOfWeekSubtractor);
                        days.push(day)
                    }
                    applicants.forEach(function(applicant){
                        var applicantDate =  new Date(applicant.created_at).getDate();
                        if (days.indexOf(applicantDate) > 0) {
                            validData.push(applicant);
                        }
                    });
                return validData;
           }

            populateChart('hired', fillChartData(hired), 'Applicant Hired');
            populateChart('rejected', fillChartData(rejected), 'Applicant Rejected');

        });
    </script>
    </body>
</html>
