<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**

layout: empty.php
slug: robots.txt
slug-static: robots.txt
title: robots.txt
compress: 0
parser: -
sitemap: -

**/
header("Content-Type: text/plain");
# https://you-site/robots.txt
?>
User-agent: *

Sitemap: <?= SITE_URL . 'sitemap.xml'; ?>
