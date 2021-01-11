<!doctype html>
<html>
<head>
    <title>Codeigniter test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<?php  $validation = \Config\Services::validation(); ?>

<?php
$session=session();
if ($session->has('msg')){ ?>
<h4 style="color:green">
    <?= $session->getFlashdata('msg'); ?>
</h4>
<?php } ?>

<div class="container mt-5" >
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
                <div  class="modal-body">

<!--                    <form action="" class="testForm" method="post">-->
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">FirstName</label>
                                <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="emailHelp">
                                <small class="text-danger nameError"></small>
                            </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">LastName</label>
                            <input type="text" name="lastname" class="form-control" id="lastname">
                        </div>
                    <small class="text-danger lastError"></small>

                    <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                    <small class="text-danger emailError"></small>

                    <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">UserName</label>
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
                    <small class="text-danger userError"></small>

                    <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control" id="phone">
                        </div>
                    <small class="text-danger phoneError"></small>

                    <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                    <small class="text-danger passwordError"></small>


                    <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">password Confirm</label>
                                <input type="password" name="password_confirm" class="form-control" id="password_confirm">
                            </div>
                    <small class="text-danger confirmError"></small>

                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                            <button id="add" type="button" class="btn btn-primary">add</button>
                        </div>
<!--                    </form>-->
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

     <tbody>

     </tbody>
    </table>
    <?php
    if($pager){
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">

            <?= $pager->links(); ?>
        </ul>
    </nav>


    <?php

    }
    ?>



</div>


