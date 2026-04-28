<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $author = get_theme_mod('carbon_meta_author');
    if ($author) : ?>
        <meta name="author" content="<?php echo esc_attr($author); ?>">
    <?php endif; ?>
    <?php
    $description = get_theme_mod('carbon_meta_description');
    if ($description) : ?>
        <meta name="description" content="<?php echo esc_attr($description); ?>">
    <?php endif; ?>
    <?php
    $keywords = get_theme_mod('carbon_meta_keywords');
    if ($keywords) : ?>
        <meta name="keywords" content="<?php echo esc_attr($keywords); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="carbon-header">
    <div class="carbon-logo">
        <?php
        if (function_exists('the_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        } else {
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <span style="background: #0f62fe; padding: 2px 6px; margin-right: 8px;">C</span>
                <?php bloginfo('name'); ?>
            </a>
            <?php
        }
        ?>
    </div>
    <button class="carbon-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <svg focusable="false" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 32 32" aria-hidden="true"><path d="M4 6H28V8H4zM4 15H28V17H4zM4 24H28V26H4z"></path></svg>
    </button>
    <nav class="carbon-nav" id="carbon-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'container'      => false,
            'fallback_cb'    => 'wp_page_menu',
        ));
        ?>
    </nav>
    <div class="carbon-header-search">
        <?php get_search_form(); ?>
    </div>
</header>
