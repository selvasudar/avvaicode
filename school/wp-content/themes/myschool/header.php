<!DOCTYPE html>

<head>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <nav class="navbar primary-navbar navbar-light navbar-expand-md">
            <a class="navbar-brand" href="/">
                <img src="<?php echo IMAGES_URI; ?>/logo.svg" width="140" height="26" alt="<?php echo $squad_full_name[$header_squad]; ?>">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".kissflow-navbar" aria-controls="kissflow-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <span class="kfright hamburger">
                    <span class="top"></span>
                    <span class="middle"></span>
                    <span class="bottom"></span>
                </span>
            </button>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container_class' => 'collapse navbar-collapse kissflow-navbar',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav mr-auto primary-menu',
                'fallback_cb'     => 'KF_Bootstrap_Navwalker::fallback',
                'walker'          => new KF_Bootstrap_Navwalker(),
                'depth'           => 2,
            ));
            ?>
        </nav>
    </header>
    <main>