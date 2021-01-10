<!doctype html>
<html>
<head>
    <title>CodeIgniter Tutorial</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

<?php
$session=session();
if ($session->has('msg')){ ?>
<h4 style="color:green">
    <?= $session->getFlashdata('msg'); ?>
</h4>
<?php } ?>
<h1><?= esc($title);
?></h1>

<div class="container">
    <a id="add" href="<?php echo base_url('registerController/create') ; ?>">create</a>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        create
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">create user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="email" class="form-control" id="name" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="add" type="button" class="btn btn-primary">add</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <?php
    if (!$session->has('username')){ ?>

        <a href="<?php echo base_url('loginController/index') ; ?>">login</a>


    <?php } ?>

    <?php

    if($session->has('username')){ ?>
        <a href="<?php echo base_url('loginController/logout') ; ?>">logout</a>
        <a href="<?php echo base_url('dashboardController/index') ; ?>">dashboard</a>

    <?php } ?>
    <table class="table">
        <tr>
            <td>name</td>
            <td>lastname</td>
            <td>email</td>
            <td>edit</td>
            <td>delete</td>
        </tr>
        <?php
        foreach ($users as $user){
            echo '

    <tr>
        <td>' .$user["firstname"]. '</td>
        <td>'.$user["lastname"].'</td>
        <td>'.$user["email"].'</td>
        <td>'.'<a href="/registerController/edit/'.$user['id'].'">edit</a>'.'</td>
        <td>'.'<a href="destroy/'.$user['id'].'" onclick="return confirm(\'are you sure to delete?\')">delete</a>'.'</td>
    </tr>';
        } ?>

    </table>
    <?php
    if($pager){

        echo  $pager->links();

    }
    ?>


</div>


