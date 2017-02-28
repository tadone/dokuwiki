<?php
/**
 * Template footer, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/* Check for logged in user name */
$loginname = "";
if (!empty($conf["useacl"])) {
    if (isset($_SERVER["REMOTE_USER"]) && //no empty() but isset(): "0" may be a valid username...
        $_SERVER["REMOTE_USER"] !== ""){
        $loginname = $_SERVER["REMOTE_USER"]; //$INFO["client"] would not work here (-> e.g. when
                                              //current IP differs from the one used to login)
    }
}


?>
        <footer>
            <nav class="footer_actions_left"><?php
                echo "[&#160;";
                if (tpl_getConf('footer_start_link')) {
                    tpl_link(wl(), 'Startseite');
                    echo "&#160;|&#160;";
                }
                tpl_actionlink("top");
                if (actionOK("index")) {
                    echo "&#160;|&#160;";
                    tpl_actionlink("index");
                }
                echo "&#160;]";
            ?></nav>

            <nav class="footer_actions_right"><?php if ($conf['useacl']) {
                echo "[&#160;";
                if (!empty($INFO["isadmin"])) {
                    if (actionOK("admin")) {
                        tpl_actionlink("admin");
                        echo "&#160;|&#160;";
                    }
                    if (actionOK("media")) {
                        tpl_actionlink("media");
                        echo "&#160;|&#160;";
                    }
                }

                tpl_actionlink("login"); //"login" handles both login/logout
                echo "&#160;]";
            } ?></nav>
            <div class="clearer"></div>
            <div class="licence"><?php if ($customLicence == '') { tpl_license(''); } else { echo $customLicence; } ?></div>
            <?php if (tpl_getConf('footer_buttons')): ?>
            <div class="buttons">
                <?php
                    if ($customLicence == '') {
                        tpl_license('button', true, false, false); // license button, no wrapper
                    }
                    $target = ($conf['target']['extern']) ? 'target="'.$conf['target']['extern'].'"' : '';
                ?>
                <a href="http://www.dokuwiki.org/donate" title="Donate" <?php echo $target?>><img
                    src="<?php echo tpl_basedir(); ?>images/button-donate.gif" width="80" height="15" alt="Donate" /></a>
                <a href="http://www.php.net" title="Powered by PHP" <?php echo $target?>><img
                    src="<?php echo tpl_basedir(); ?>images/button-php.gif" width="80" height="15" alt="Powered by PHP" /></a>
                <a href="http://validator.w3.org/check/referer" title="Valid HTML5" <?php echo $target?>><img
                    src="<?php echo tpl_basedir(); ?>images/button-html5.png" width="80" height="15" alt="Valid HTML5" /></a>
                <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" title="Valid CSS" <?php echo $target?>><img
                    src="<?php echo tpl_basedir(); ?>images/button-css.png" width="80" height="15" alt="Valid CSS" /></a>
                <a href="http://dokuwiki.org/" title="Driven by DokuWiki" <?php echo $target?>><img
                    src="<?php echo tpl_basedir(); ?>images/button-dw.png" width="80" height="15" alt="Driven by DokuWiki" /></a>
            </div><?php endif; ?>

        </footer>
