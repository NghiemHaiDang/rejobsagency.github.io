<header id="apus-header" class="apus-header header-default visible-lg" role="banner">
    <div class="container p-relative">
        <div class="header-layout">
            <div class="header-left header-item">
                <div class="logo-in-theme">
                    <?php get_template_part( 'template-parts/logo/logo' ); ?>
                </div>
            </div>
            <div class="header-right p-static header-item">
                <?php if ( has_nav_menu( 'primary' ) ) : ?>                            
                    <div class="main-menu">
                        <nav data-duration="400" class="apus-megamenu slide animate navbar p-static" role="navigation">
                        <?php
                            $args = array(
                                'theme_location' => 'primary',
                                'container_class' => 'collapse navbar-collapse no-padding',
                                'menu_class' => 'nav navbar-nav megamenu effect1',
                                'fallback_cb' => '',
                                'menu_id' => 'primary-menu',
                                'walker' => new Workio_Nav_Menu()
                            );
                            wp_nav_menu($args);
                        ?>
                        </nav>
                    </div>                            
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>