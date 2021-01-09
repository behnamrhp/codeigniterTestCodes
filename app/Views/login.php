
<?php

$session=session();
?>

<h2>forgot Password</h2>
<div>

        <?php
        if($session->getFlashdata('msg')){ ?>
    <h4 style="color: red">
        <?=  $session->getFlashdata('msg');   ?>
    </h4>  <?php } ?>
</div>

<form action="<?= base_url('/loginController/login') ?>" method="post">
    <input type="text" name="username" placeholder="enter your email address" value="<?php if ($_POST['username']){ echo set_value('username'); }  ?>"><br>
<input type="password" name="password" placeholder="enter your password"><br>
<input type="submit"> <a href="<?= base_url('loginController/forgotPassword'); ?>" style="color: blue">forgot password?</a>



</form>
