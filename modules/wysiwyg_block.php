<?php 
$id = get_the_id();
//  var_dump($id);
$content = get_sub_field('wysiwyg_editor', $id);
// var_dump($content);

?>

<div id="content-module" class="wysiwyg-content">
<h1 id="wysiwyg_editor"> 
    <?= $content ?>
</h1>
</div>