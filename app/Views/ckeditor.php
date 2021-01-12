<head>

    <script src="<?php echo base_url()?>/ckeditor/ckeditor.js"></script>
</head>
<body>

<?php
$session=session();?>
<h4 style="color:red;">

    <?=

    $session->getFlashdata('msg');

    ?>
</h4>
<div>
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

    CKEDITOR.editorConfig = function( config ) {
        config.toolbarGroups = [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
            { name: 'forms', groups: [ 'forms' ] },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
            { name: 'links', groups: [ 'links' ] },
            { name: 'insert', groups: [ 'insert' ] },
            '/',
            { name: 'styles', groups: [ 'styles' ] },
            { name: 'colors', groups: [ 'colors' ] },
            { name: 'tools', groups: [ 'tools' ] },
            { name: 'others', groups: [ 'others' ] },
            { name: 'about', groups: [ 'about' ] }
        ];

        config.removeButtons = 'Form,SelectAll,Scayt,Find,Undo,Bold,CopyFormatting,NumberedList,Outdent,Indent,BulletedList,RemoveFormat,Italic,Underline,Strike,Subscript,Superscript,Blockquote,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Anchor,Unlink,Link,Image,Flash';
    };
</script>
<script src="<?php echo base_url()?>/ckfinder/ckfinder.js"></script>
<script>
    var editor = CKEDITOR.replace( 'ckfinder' );
    CKFinder.setupCKEditor( editor );

</script>
</body>

