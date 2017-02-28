        <header>
            <div id="logo"><?php tpl_link(wl(),'<img src="'.ml('logo.png').'" alt="'.$conf['title'].'" />','') ?></div>
            <h1><?php tpl_link(wl(), $conf['title'], 'accesskey="h" title="[H]"') ?></h1>
            <?php if ($conf['tagline']): ?><p class="claim"><?php echo $conf['tagline'] ?></p><?php endif; ?>

        </header>
        <?php if ($showMenubar): ?><nav class="menubar"><div class="content"><?php tpl_flush() ?>

        <!-- menubar start --><?php tpl_include_page(tpl_getConf('menubar'), 1, 1) ?>
        <!-- menubar end -->
        </div></nav>
        <?php endif; ?>
