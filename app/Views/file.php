
<?php
$validation = \Config\Services::validation();
$session=session();
?>
<div>

    <?php
    if($session->getFlashdata('msg')){ ?>
        <h4 style="color: green">
            <?=  $session->getFlashdata('msg');   ?>
        </h4>  <?php } ?>
</div>

<fieldset>
    <legend>single file upload</legend>
    <form action="<?= base_url('/fileUpload/store') ?>" method="post"  enctype="multipart/form-data">
        <input type="file" name="image">

        <input type="submit">

    </form>

</fieldset>
<fieldset>
    <legend>multiple file upload</legend>
    <form action="<?= base_url('/fileUpload/multipleStore') ?>" method="post"  enctype="multipart/form-data">
        <input type="file" name="files[]" multiple>
        <input type="submit">

    </form>

</fieldset>


<div>
    <?php

    foreach ($image as $img){?>
        <img src="<?= $img['image'] ?>" alt="asdads" style="display: block; height: 500px; float: right">
 <?php
    }
    ?>

</div>
