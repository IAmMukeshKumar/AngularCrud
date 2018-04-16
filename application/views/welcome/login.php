<div ng-app="loginApp" ng-controller="loginController" ng-init=init()>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 align-center">
            <div ng-if="messageStatus" class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{message}}
            </div>
            <h3>Login</h3>
            <form ng-submit="loginSubmit()" name="loginForm" >
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" ng-model="email">
                    <span ng-show="(loginForm.email.$touched && loginForm.email.$invalid) || emailBlank" class="text-danger wy-alert-danger" > Enter a valid email  </span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" ng-model="password">
                   <span ng-show="(loginForm.password.$touched && loginForm.password.$invalid)|| blankPassword" class="text-danger wy-alert-danger"> Password is required </span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    var app = angular.module("loginApp", []);
    app.controller("loginController", function($scope, $http) {
        $scope.myTxt = "Yoot yet clicked submit";
        var url="<?=base_url('login/grantLogin')?>";
        $scope.loginSubmit = function () {
            $scope.submitted=1;
           var email=$scope.email;
           var password=$scope.password;
           if(email && password){
               $http({
                   method:'POST',
                   url:url,
                   data: 'email=' + email + '&password=' + password,
                   headers: {'Content-Type': 'application/x-www-form-urlencoded'}
               }).then(function (response) {
                   var redirectUrl="<?= base_url('user')?>";
                  $scope.messageStatus=true;
                  $scope.message=response.data.message;
                  if(response.data.status==1){
                      window.location=redirectUrl;
                  }
               })
           }else{
               $scope.emailBlank = email?false:true;
               $scope.blankPassword=password?false:true;
               $scope.messageStatus= true;
               $scope.message="Can not be submitted. Please check if you have filled all fields";
           }

        }

        $scope.init=function () {
            $scope.messageStatus=false;
            $scope.emailBlank=false;
            $scope.passwordBlank=false;
        }
    });

</script>
