<?php if (!defined('BASE_DIR')) exit('No direct script access allowed'); 

require getConfig('templateLayoutDir') . 'parts/head.php';

?>
<body>
    <section id="myNav" class="w250px h100vh overflow-auto pos-fixed overscroll-behavior-contain bg-gray900 z-index99 hide-tablet w100-tablet">
        <div class="b-hide show-tablet mar20-t mar20-b t90 t-center animation-fade">
            <button class="button button2" onclick="document.getElementById('myNav').classList.toggle('hide-tablet');">✕ Close menu</button>
        </div>

        <header class="t-gray200 bg-gray950 t140 t-center pad5-tb">
			<?php require getConfig('templateLayoutDir') . 'parts/header.php'; ?>
        </header>

        <nav class="pad20-rl">
            <?php require getConfig('templateLayoutDir') . 'parts/nav.php'; ?>
            <?php require getConfig('templateLayoutDir') . 'parts/menu.php'; ?>
        </nav>

        <?php require getConfig('templateLayoutDir') . 'parts/footer.php'; ?>
    </section>

    <section id="myContent" class="w100-phone mar0-tablet" style="margin-left: 250px;">
        <div id="top"></div>
        <div class="b-hide show-tablet mar20-b t90 t-center animation-fade">
            <button class="button button2" onclick="document.getElementById('myNav').classList.toggle('hide-tablet');">☰ Open menu</button>
        </div>

        <article<?= getPageData('articleClass', '', ' class="', '"') ?>>
            <?php
            if ($t = getVal('pageFileContent', ''))
                echo $t;
            else
                require getVal('pageFile');
            ?>
        </article>
    </section>
    
	<?= implode(getKeysPageData('lazy', '[val]')) ?>
</body>
</html>