
<?php $validation = \Config\Services::validation();

?>

<form action="<?php echo site_url('/loginController/updateresetpassword'); ?>" method="post" enctype="multipart/form-data">
    <input type="password" name="password" placeholder="enter new password" ><br>
    <?php if($validation->getError('password')){?>
        <div style="color:red">
            <?php
            echo $validation->getError('password');
            ?>
        </div>
    <?php } ?>
    <input type="hidden" name="id" value="<?= $users['id']; ?>">
    <input type="password" name="password_confirm" placeholder="confirm new password" ><br>
    <?php if($validation->getError('password_confirm')){?>
        <div style="color:red">
            <?php
            echo $validation->getError('password_confirm');
            ?>
        </div>
    <?php } ?>
    <input type="submit" name="save">

</form>