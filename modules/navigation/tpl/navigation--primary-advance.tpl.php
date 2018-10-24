<div class="nav-wrap clearfix">
            <?php wp_nav_menu(
                array('menu' => 'primary',
                    'container' => 'nav',
                    'container_class' => 'main-nav primary-menu',
                    'container_id' => 'navigation-menu',
                    'menu_class' => 'group',
                    'menu_id' => '',
                    'echo' => true,
                    'fallback_cb' => 'wp_page_menu',
                    'before' => '', 'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 0, 'walker' => '',
                    'theme_location' => 'primary_menu'
                ));
            ?>
        </div>