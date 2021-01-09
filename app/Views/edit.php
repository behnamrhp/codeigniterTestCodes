
<?php $validation = \Config\Services::validation(); ?>

<form action="<?php echo site_url('registerController/update/'); ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="firstname" value="<?php if($_POST){
        echo set_value('firstname');
    }else{
        echo $users["firstname"];
    }   ?>"><br>
    <?php if($validation->getError('firstname')){?>
        <div style="color:red">
            <?php
            echo $validation->getError('firstname');
            ?>
        </div>
    <?php } ?>
    <input type="hidden" name="id" value="<?php echo $users["id"];  ?>">
    <input type="text" name="lastname" placeholder="type lname" value="<?php if($_POST){
        echo set_value('lastname');
    }else{
        echo $users["lastname"];
    }
    ?>"><br>
    <?php if($validation->getError('lastname')){?>
        <div style="color:red">
            <?php
            echo $validation->getError('lastname');
            ?>
        </div>
    <?php } ?>
    <input type="text" name="username" placeholder="type username" value="<?php if($_POST){
        echo set_value('username');
    }else{
        echo $users["username"];
    }  ?>"><br>
    <?php if($validation->getError('username')){?>
        <div style="color:red">
            <?php
            echo $validation->getError('username');
            ?>
        </div>
    <?php } ?>
    <input type="email" name="email" placeholder="email" value="<?php if($_POST){
        echo set_value('email');
    }else{
        echo $users["email"];
    }   ?>"><br>
    <?php if($validation->getError('email')){?>
        <div style="color:red">
            <?php
            echo $validation->getError('email');
            ?>
        </div>
    <?php } ?>
    <input type="text" name="phone" placeholder="phone" value="<?php if($_POST){
        echo set_value('phone');
    }else{
        echo $users["phone"];
    }  ?>"><br>
    <?php if($validation->getError('phone')){?>
        <div style="color:red">
            <?php
            echo $validation->getError('phone');
            ?>
        </div>
    <?php } ?>
    <input type="password" name="password" placeholder="enter new password" ><br>
    <?php if($validation->getError('password')){?>
        <div style="color:red">
            <?php
            echo $validation->getError('password');
            ?>
        </div>
    <?php } ?>
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