<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <h3><a class="headerlink" href="<?= base_url() ?>">Angular Crud</a></h3>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline text-right">
                        <?php if(!isset($this->session->user)) { ?>
                            <li><a href="<?= base_url('login')?>">Log in</a></li>
                            <li><a href="<?= base_url('signupController')?>">Sign Up</a></li>
                        <?php } else {?>
                            <li><h5><?= $this->session->user ?></h5></li>
                            <li><a href="<?= base_url('logout')?>">Log Out</a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $content ?>
</body>
</html>