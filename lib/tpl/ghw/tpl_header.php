<?php
/**
 * DokuWiki GHW Template 2017
 *
 * @link     http://dokuwiki.org/template
 * @author   Jonathan Cox <cbjcaesar@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
header('X-UA-Compatible: IE=edge,chrome=1');

$hasSidebar = page_findnearest($conf['sidebar']);
$showSidebar = $hasSidebar && ($ACT == 'show');
?><!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="utf-8"/>
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function (H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)</script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <?php echo tpl_favicon(array('favicon', '')) ?>
    <?php tpl_includeFile('meta.html') ?>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
<div id="dokuwiki__site">
    <div id="dokuwiki__top" class="container site <?php echo tpl_classes(); ?> <?php
    echo ($showSidebar) ? 'showSidebar' : ''; ?> <?php echo ($hasSidebar) ? 'hasSidebar' : ''; ?>">

        <div id="docs">
            <div id="sidebar">
                <div class="logo">
                    <?php
                    // get logo either out of the template images folder or data/media folder
                    $logoSize = array(200,30);
                    $logo = tpl_getMediaFile(array('images/logo.png', 'images/logo.png', 'images/logo.png'), false, $logoSize);

                    // display logo and wiki title in a link to the home page
                    tpl_link(
                        wl(),
                        '<img src="'.$logo.'" alt="" width="150" height="30" /> docs<span></span>',
                        'accesskey="h" title="[H]"'
                    );
                    ?>
                </div>

                <div class="nav-border"></div>
                <nav>
                    <div class="filterBlock">
                        <input type="text" id="filterInput" placeholder="Type to filter">
                        <a href="#" id="clearFilterButton">x</a>
                    </div>
                    <?php tpl_include_page($conf['sidebar'], true, true) ?>
                </nav>
            </div>
            <div id="content-wrapper" tabindex="0">
                <div class="overlay"></div>
                <div class="search-results">
                    <ul class="results"></ul>
                </div>
                <form class="search">
                    <?php tpl_searchform(); ?>
                    <div class="search-after">
                        <span class="search-text"></span>
                        <span class="search-after-text--no-results">— No Results</span>
                    </div>
                </form>
                <header id="main-header">
                    <nav>
                        <ul class="external">
                            <?php

                            tpl_toolsevent('usertools', array(
                                tpl_action('admin', true, 'li', true),
                                tpl_action('profile', true, 'li', true),
                                tpl_action('register', true, 'li', true),
                                tpl_action('login', true, 'li', true)
                            ));
                            ?>
                        </ul>
                    </nav>
                </header>
                <article id="content">

                    <!-- BREADCRUMBS -->
                    <ul class="external">
                        <?php
                        if (!empty($_SERVER['REMOTE_USER'])) {
                            echo '<li class="user">';
                            tpl_userinfo(); /* 'Logged in as ...' */
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    <?php if($conf['breadcrumbs'] || $conf['youarehere']): ?>
                        <div class="breadcrumbs">
                            <?php if($conf['youarehere']): ?>
                                <div class="youarehere"><?php tpl_youarehere() ?></div>
                            <?php endif ?>
                            <?php if($conf['breadcrumbs']): ?>
                                <ul id="trace" class="stripped-ul"><?php tpl_breadcrumbs() ?></ul>
                            <?php endif ?>
                        </div>
                    <?php endif ?>


