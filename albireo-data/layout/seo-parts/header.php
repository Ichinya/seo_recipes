<?php if (!defined('BASE_DIR')) exit('No direct script access allowed'); ?>

<?php
$gitInfo = getVal('gitInfo');
$tag = $gitInfo['tag'];
$url = $gitInfo['url'];
?>
<span class="t-gray150 t150">壱</span> <a class="t-gray100 t-bold hover-t-gray100" href="/">SEO Book</a>
<sup class="t90"><?= a($url, $tag); ?></sup>
