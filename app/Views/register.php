

<?php  $validation = \Config\Services::validation(); ?>

<form action="<?php echo base_url('/registerController/store') ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="firstname" placeholder="type fname"  value="<?php if($_POST){
        echo set_value('firstname'); }   ?>"><br>
    <?php if($validation->getError('firstname'))
    {?>
        <div style="color: red">
            <?php echo $validation->getError('firstname');
            ?>
        </div>
    <?php }?>

    <input type="text" name="lastname" placeholder="type lname" value="<?php if($_POST){
        echo set_value('lastname');
    }   ?>" ><br>
    <?php if($validation->getError('lastname')) {?>
        <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('lastname'); ?>
        </div>
    <?php }?>

    <input type="text" name="username" placeholder="type username" value="<?php if($_POST){
        echo set_value('username');
    }   ?>"  ><br>
    <?php if($validation->getError('username')) {?>
        <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('username'); ?>
        </div>
    <?php }?>

    <input type="email" name="email" placeholder="email" value="<?php if($_POST){
        echo set_value('email');
    }   ?>"  ><br>
    <?php if($validation->getError('email')) {?>
        <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('email'); ?>
        </div>
    <?php }?>

    <input type="number" name="phone" placeholder="phone" value="<?php if($_POST){
        echo set_value('phone');
    }   ?>"  ><br>
    <?php if($validation->getError('phone')) {?>
        <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('phone'); ?>
        </div>
    <?php }?>

    <input type="password" name="password" placeholder="pass"><br>
    <?php if($validation->getError('password')) {?>
        <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('password'); ?>
        </div>
    <?php }?>
    <input type="password" name="password_confirm" placeholder="confirmpass"><br>
    <?php if($validation->getError('password_confirm')) {?>
        <div class='alert alert-danger mt-2'>
            <?= $error = $validation->getError('password_confirm'); ?>
        </div>
    <?php }?>
    <input type="submit" name="save">

</form>
