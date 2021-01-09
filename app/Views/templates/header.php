<!doctype html>
<html>
<head>
    <title>CodeIgniter Tutorial</title>
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
<a href="<?php echo base_url('registerController/create') ; ?>">create</a>
<?php
if (!$session->has('username')){ ?>

    <a href="<?php echo base_url('loginController/index') ; ?>">login</a>


<?php } ?>

<?php

if($session->has('username')){ ?>
    <a href="<?php echo base_url('loginController/logout') ; ?>">logout</a>
    <a href="<?php echo base_url('dashboardController/index') ; ?>">dashboard</a>

<?php } ?>

<table style="border: solid">
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
