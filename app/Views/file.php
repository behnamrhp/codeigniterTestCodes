<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>file upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        * {
            margin: 0px;
            padding: 0px;

        }

        body {
            padding-top: 10px;
        }
    </style>
</head>
<body>
<?php
$validation = \Config\Services::validation();
$session = session();
?>
<div>

    <?php
    if ($session->getFlashdata('msg')) { ?>
        <h4 style="color: green">
            <?= $session->getFlashdata('msg'); ?>
        </h4>  <?php } ?>
</div>
<div class="alert " id="success" ></div>
<div class="alert " id="danger"></div>

<fieldset style="margin-left:30px">
    <legend class="h3">single file upload</legend>
    <form action="<?= base_url('/fileUpload/store') ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="image">

        <input type="submit" class="btn btn-primary">

    </form>

</fieldset>
<fieldset style="margin-left:30px">
    <legend class="h3">multiple file upload</legend>
    <form action="<?= base_url('/fileUpload/multipleStore') ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple>
        <input type="submit" class="btn btn-primary">

    </form>

</fieldset>

<fieldset style="margin-left:30px">
    <legend class="h3">ajax file upload</legend>
    <form>

        <input id="img" style="margin-left:30px" type="file" name="image" class="mt-3">

        <button id="aimg" type="submit" class="btn btn-primary mt-3"> ajax upload</button>
        <small id="error" class="text-danger" style="display: block; margin-left:30px"></small>
    </form>

</fieldset>

<fieldset style="margin-left:30px">
    <legend class="h3">ajax multiple file upload</legend>
    <form>
        <input id="multiImg" style="margin-left:30px" type="file" name="images[]" class="mt-3" multiple>
        <button id="amultiimg"  class="btn btn-primary mt-3"> ajax multiple upload</button>
        <small id="error" class="text-danger" style="display: block; margin-left:30px"></small>
    </form>

</fieldset>
<!--<div class="row">-->
<!--    <div class="mt-5 col-md-12">-->
<!--        --><?php
//
//        foreach ($image as $img) {
//            ?>
<!--            <img src="--><?//= $img['image'] ?><!--" alt="asdads" style="display: block; height: 500px; float: right">-->
<!--            --><?php
//        }
//        ?>
<!---->
<!--    </div>-->




<h3>ajaxshow</h3>

<div class="row">
    <div id="img_show" class="col-md-12">

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
        crossorigin="anonymous"></script>
<script>
    function show(){
        var id=1
        $.ajax({
            url: '<?= base_url('/fileUpload/showAjax'); ?>',
            data:{id:id},
            method:'get',
            dataType:'json',
            success:function (response) {
                var img='<img style="display: block; height: 100px;width: 100px;float: right" class="m-3" src="'+response.images[0].image+'">';
                for (var i=1; i < response.images.length; i++){
                    img +='<img style="display: block; height: 100px;width: 100px;float: right" class="m-3" src="'+response.images[i].image+'">'
                }
                $('#img_show').html(img);
            }
        })
    }
    $(document).ready(function () {
        show();
    })
    $(document).on('click', '#aimg', function (e) {
        e.preventDefault();
        // var image=$('#img').val();
        var fd = new FormData();
        var image = $('#img')[0].files;
        // Check file selected or not
        if (image.length > 0) {
            fd.append('image', image[0]);
            $.ajax({
                url: '<?= base_url('/fileUpload/afupload'); ?>',
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.msgs) {
                        $('#error').html(response.msgs.image);
                    } else {
                        $('#success').addClass('alert-success');
                        $('#success').html(response.message);

                        // show images
                       show();
                    }
                }
            })
        } else {
            alert("please select a file")
        }
    })

    $(document).on('click','#amultiimg',function (e) {
        e.preventDefault();
        var fd1 = new FormData();
        var totalFilesLen = $('#multiImg')[0].files.length;
        var file=$('#multiImg')[0].files;
        console.log(totalFilesLen);
        if (totalFilesLen > 0){
            for (var i = 0; i < totalFilesLen; i++) {
                fd1.append("images[]", file[i]);
            }
            console.log(fd1);
            $.ajax({
                url: '<?= base_url('/fileUpload/multipleUpload'); ?>',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: fd1,
                method: 'post',
                success: function (response){
                    if(response.msge){
                        $('#danger').addClass('alert-danger');
                        $('#danger').html(response.msge);
                    }else {
                        $('#success').addClass('alert-success');
                        $('#success').html(response.msg);
                    }
                    show();
                }
            })
        }else{
            alert('please put at least one file');

        }

    })
</script>

</body>
</html>





