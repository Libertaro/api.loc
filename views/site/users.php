<?php

?>
<div class="site-about">
    <?
//    var_dump($users); exit;
    foreach ($users as $user){
        echo ($user['name'])."<br>";
    }
    ?>
</div>
