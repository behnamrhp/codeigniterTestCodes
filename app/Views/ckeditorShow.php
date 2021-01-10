<?php
$session = session();
?>

<h4 style="color:red;">

    <?=

    $session->getFlashdata('msg');

    ?>
</h4>
<div>

    <?php

    foreach ($article as $art) {

            ?>

            <div style="display: block; height: 40vh; width: 50vh; overflow: auto; float: right; margin: 10px">
                <?=
                $art['descreption'] . '<br>';


                   echo   $username;


                ?>
            </div>

            <?php

    }
    ?>


</div>