        </article>
        <div id="edit-dash">
            <ul class="stripped-ul" id="fixed-collapse">
                <?php
                $data = array(
                    'view' => 'main',
                    'items' => array(
                        'edit' => tpl_action('edit', true, 'li', true, '<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i><p>', '</p></li>'),
                        'revert' => tpl_action('revert', true, 'li', true, '<i class="fa fa-link fa-2x" aria-hidden="true"></i><p>', '</p></li>'),#
                        'revisions' => tpl_action('revisions', true, 'li', true, '<i class="fa fa-clock-o fa-2x" aria-hidden="true"></i><p>', '</p></li>'),
                        'backlink' => tpl_action('backlink', true, 'li', true, '<i class="fa fa-link fa-2x" aria-hidden="true"></i><p>', '</p></li>'),
                        'subscribe' => tpl_action('subscribe', true, 'li', true, '<i class="fa fa-link fa-2x" aria-hidden="true"></i><p>', '</p></li>')#,
                        #'top' => tpl_action('top', true, 'li', true, '<i class="fa fa-arrow-circle-o-up fa-2x" aria-hidden="true"></i><p>', '</p></li>')
                    )
                );
                // the page tools can be amended through a custom plugin hook
                $evt = new Doku_Event('TEMPLATE_PAGETOOLS_DISPLAY', $data);
                if ($evt->advise_before()) {
                    foreach ($evt->data['items'] as $k => $html) echo $html;
                }
                $evt->advise_after();
                unset($data);
                unset($evt);
                ?>
            </ul>
        </div>
    </div>
</div>
</div>
</div>
        <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
        <div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
</body>
</html>