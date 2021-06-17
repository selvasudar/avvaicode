<!DOCTYPE html>
<html lang="ta">
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Madurai&display=swap');
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Navbar -->
                    <nav class="navbar navbar-light">
                        <a class="navbar-brand logo-fitter" href="/"><img src="/logo.svg" alt="avvaicode-logo"></a>
                        <nav class="navbar navbar-expand-lg navbar-light main-menu">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-menu">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <?php
                            wp_nav_menu(array(
                                // 'theme_location' => 'products-' . $squad . '-menu',
                                'theme_location' => 'primary-right-menu',
                                'container_id' => 'header-menu',
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
    <main class="main-content">