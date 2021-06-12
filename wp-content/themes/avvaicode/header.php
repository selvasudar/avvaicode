<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mukta+Malar:wght@400;500;600;700;800&display=swap');
    </style>
    <title><?php wp_title(''); ?></title>
    <?php require_once TD_PATH . '/inc/meta_tags_header.php'; ?>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <?php
    global $squad;
    //fetches header and squad value from category
    if (is_category()) {
        $squad = get_option("cat_edit_squad_val_$category->term_id");
    }
    ?>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Navbar -->
                    <nav class="navbar navbar-light">
                        <a class="navbar-brand" href="/"><img src="/logo.png" alt="avvaicode-logo"></a>
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <?php
                            wp_nav_menu(array(
                                // 'theme_location' => 'products-' . $squad . '-menu',
                                'theme_location' => 'primary-right-menu',
                                'container_id' => 'collapsibleNavbar',
                                'container_class' => 'collapse navbar-collapse justify-content-end',
                                'menu_id'         => false,
                                'menu_class'      => 'navbar-nav topmenubar',
                                'fallback_cb'     => 'KF_Bootstrap_Navwalker::fallback',
                                'walker'          => new KF_Bootstrap_Navwalker(),
                                'depth'           => 2,
                            ));
                            ?>
                        </nav>
                    </nav>
                    <!-- Navbar -->
                </div>
            </div>
        </div>

    </header>
    <main class="body-main">