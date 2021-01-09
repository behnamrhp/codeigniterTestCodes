<?php
$session=session();
?>

<h4 style="color:red;">

    <?=

    $session->getFlashdata('msg');

    ?>
</h4>
<div>

        <?php
//        print_r($article);
//        die();
        foreach ($article as $art){ ?>

        <div style="display: block; height: 40vh; width: 50vh; overflow: auto">
<?=
         $art['descreption'].'<br>';
?>
    </div>

<?php
}
        ?>


</div>