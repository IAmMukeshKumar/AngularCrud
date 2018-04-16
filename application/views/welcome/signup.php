<div ng-app="signupApp" ng-controller="signupController" ng-init="messageStatus=false" >
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 align-center">
                <div ng-if="messageStatus" class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{message}}
                </div>
                <h3>Sign Up</h3>
                <form ng-submit="signUpSubmit()">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" ng-model="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" ng-model="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" ng-model="password" id="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var app = angular.module('signupApp', []);
    app.controller('signupController', function ($scope, $element, $http) {
        var url = "<?= base_url('signupController/storeNewUser')?>";

        $scope.signUpSubmit = function () {
            var name = $scope.name;
            var email = $scope.email;
            var password = $scope.password;
            $http({
                method: 'POST',
                url: url,
                data: 'name=' + name + '&email=' + email + '&password=' + password,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}

            }).then(function (response) {
                var data = response.data;
                if (data.status == 1) {
                    var redirectUrl="<?= base_url('user')?>";
                    $scope.messageStatus = true;
                    $scope.message = data.message;
                    window.location=redirectUrl;
                }
            });
        }
    })
</script>