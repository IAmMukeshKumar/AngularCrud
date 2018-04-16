<div ng-app="dashboardApp" ng-controller="dashboardCtr" ng-init="refresh()">
<div class="container">
   <table class="table">
       <caption>Users</caption>
       <thead>
       <tr>
           <th>Name</th>
           <th>Email</th>
           <th>Action</th>
       </tr>
       </thead>
       <tbody>
       <tr ng-repeat="user in users">
           <td>{{user.name}}</td>
           <td>{{user.email}}</td>
           <td>
               <button ng-click="edit(user)" type="button" class="btn btn-primary glyphicon glyphicon-edit" data-toggle="modal" data-target="#editUser"></button>
               <button ng-click="view(user.id)" type="button" class="btn btn-success glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#viewUser"></button>
               <button ng-click="delete(user.id)" type="button" class=" btn btn-danger glyphicon glyphicon-trash"></button>
           </td>
       </tr>
       </tbody>
   </table>
</div>

    <!--    Modal Edit user-->
    <div class="modal fade" id="editUser" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <div ng-if="showMessage">
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           {{message}}
                        </div>
                    </div>
                    <form ng-submit="update(editId)">
                        <div class="form-group">
                            <label for="editedName"> Name </label>
                            <input class="form-control" type="text" name="editedName" ng-model="editedName" id="editedName" >
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


<!--    Modal view user-->
    <div class="modal fade" id="viewUser" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">User Details</h4>
                </div>
                <div class="modal-body">
                    <table class="table " ng-show="!noUser">
                        <thead>
                        <tr>
                           <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="viewUser in viewUsers">
                            <td>{{viewUser.name}}</td>
                            <td>{{viewUser.email}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <p class="text-center text-warning">{{noUser}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
<script>
    var app=angular.module('dashboardApp', []);
    app.controller('dashboardCtr', function ($scope,$http) {

         $scope.delete=function($id){
             var deleteUrl="<?= base_url('user/delete/')?>"+$id;
             $http({
              method:'POST',
              'url' :deleteUrl
           }).then(function (response) {
               $scope.refresh();
             });
         }

         $scope.view=function($id){
             var viewUrl="<?= base_url('user/viewUser/')?>"+$id;
             $http({
                 method:'GET',
                 url:viewUrl,
             }).then(function (response) {
                 if(response.data.userCount){
                   $scope.viewUsers=response.data.user;
                 }else{
                   $scope.noUser=response.data.message;
                 }
             });
         }

         $scope.edit=function(user){
             $scope.editedName=user.name;
             $scope.editId=user.id;
         }

         $scope.update=function(id){

             var updateUrl="<?= base_url('user/updateUser/')?>"+id;
             var name=$scope.editedName;
             $http({
                 method:'POST',
                 url:updateUrl,
                 data: 'name=' + name,
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
             }).then(function (response) {
                 if(response.data.affectedRows){
                     $scope.refresh();
                 }

                 $scope.showMessage=true;
                 $scope.message=response.data.message;

             });
         }
        $scope.refresh=function() {
            var url = "<?= base_url('user/retrieveAllUsers')?>";
            $http({
                method: 'POST',
                url: url
            }).then(function (response) {
                $scope.users = response.data.users;
            });
        }
    });
</script>