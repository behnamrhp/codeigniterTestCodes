<head>

    <script src="<?php echo base_url()?>/ckeditor/ckeditor.js"></script>
</head>
<body>


<form action="<?= base_url('/ArticleController/store') ?>" method="post">
    <textarea id="editor" name="descreption"></textarea>
    <input type="submit" >

</form>
<!--<script src="http://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>-->
<script>

    CKEDITOR.replace('editor',{
        language: 'fa',
        uiColor: '#011640'

    });
</script>
<script src="<?php echo base_url()?>/ckfinder/ckfinder.js"></script>
<script>
    var editor = CKEDITOR.replace( 'ckfinder' );
    CKFinder.setupCKEditor( editor );

</script>
</body>

