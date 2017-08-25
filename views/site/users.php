<?php
$this->title = 'Main';
?>
<div class="site-about">
    <?
    foreach ($users as $user){
        echo ($user['name'])."<br>";
    }
    ?>
</div>
