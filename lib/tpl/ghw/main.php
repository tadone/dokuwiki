<?php include('tpl_header.php') ?>
    <div class="content">
        <?php tpl_flush() ?>
        <?php tpl_includeFile('pageheader.html') ?>
        <!-- wikipage start -->
        <?php tpl_content() ?>
        <!-- wikipage stop -->
        <?php tpl_includeFile('pagefooter.html') ?>
    </div>
    <div class="docInfo"><?php tpl_pageinfo() ?></div>

<?php tpl_flush() ?>

<?php include('tpl_footer.php') ?>