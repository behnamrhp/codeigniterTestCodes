
<?php  $validation = \Config\Services::validation(); ?>

 <h2>forgot Password</h2>
<?php $session=session();

if($session->has('msg')){ ?>
<h4 style="color: red">
    <?=
$session->getFlashdata('msg');
    ?>

</h4>
<?php
}
?>
<form action="<?= base_url('/loginController/forgotPassword') ?>" method="post">
    <input type="text" name="email" placeholder="enter your email address"><br>
    <?php if($validation->getError('email'))
    {?>
        <div style="color: red">
            <?php echo $validation->getError('email');
            ?>
        </div>
    <?php }?>
<input type="submit">