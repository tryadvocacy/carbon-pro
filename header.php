<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'carbon-pro' ); ?></a>

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
    <button class="carbon-menu-toggle" aria-controls="carbon-pro-primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'carbon-pro'); ?>">
        <svg focusable="false" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 32 32" aria-hidden="true"><path d="M4 6H28V8H4zM4 15H28V17H4zM4 24H28V26H4z"></path></svg>
        <span class="screen-reader-text"><?php esc_html_e('Toggle navigation', 'carbon-pro'); ?></span>
    </button>
    <nav class="carbon-nav" id="carbon-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'carbon-pro-primary',
            'menu_id'        => 'carbon-pro-primary-menu',
            'container'      => false,
            'fallback_cb'    => 'wp_page_menu',
        ));
        ?>
    </nav>
    <div class="carbon-header-search">
        <?php get_search_form(); ?>
    </div>
</header>

<?php if (get_header_image()) : ?>
    <div class="header-image">
        <img src="<?php header_image(); ?>" width="<?php echo absint(get_custom_header()->width); ?>" height="<?php echo absint(get_custom_header()->height); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
    </div>
<?php endif; ?>
