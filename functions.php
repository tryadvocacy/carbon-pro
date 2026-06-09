<?php
/**
 * Carbon Pro functions and definitions
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function carbon_pro_content_width() {
    $GLOBALS['content_width'] = apply_filters('carbon_pro_content_width', 800);
}
add_action('after_setup_theme', 'carbon_pro_content_width', 0);

/**
 * Load theme textdomain early to prevent early translation notices (WordPress 6.7)
 */
function carbon_pro_load_textdomain() {
    load_theme_textdomain('carbon-pro', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'carbon_pro_load_textdomain', 5);

function carbon_pro_setup() {
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('wp-block-styles');
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('custom-background');
    add_theme_support('custom-header', array(
        'default-image'      => '',
        'width'              => 1200,
        'height'             => 250,
        'flex-height'        => true,
        'flex-width'         => true,
    ));
    add_editor_style('style.css');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'carbon_pro_setup');

/**
 * Register navigation menus
 */
function carbon_pro_menus() {
    register_nav_menus(array(
        'carbon-pro-primary' => __('Primary Menu', 'carbon-pro'),
    ));
}
add_action('init', 'carbon_pro_menus');

function carbon_pro_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'carbon-pro'),
        'id'            => 'carbon-pro-footer',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'carbon-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'carbon_pro_widgets_init');

function carbon_pro_scripts() {
    // Enqueue main stylesheet with theme version to prevent caching
    $theme = wp_get_theme();
    wp_enqueue_style('carbon-pro-style', get_stylesheet_uri(), array(), $theme->get('Version'));

    // Enqueue navigation script
    wp_enqueue_script('carbon-pro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $theme->get('Version'), true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'carbon_pro_scripts');

/**
 * Highlight search terms in search results
 */
function carbon_pro_highlight_search_results($text) {
    if (is_search() && !is_admin()) {
        $query = get_search_query();
        if ($query) {
            $keys = explode(" ", $query);
            $keys = array_filter($keys);
            foreach ($keys as $key) {
                $text = preg_replace('/(?![^<]*>)(' . preg_quote($key, '/') . ')/iu', '<mark class="carbon-highlight">$1</mark>', $text);
            }
        }
    }
    return $text;
}
add_filter('the_title', 'carbon_pro_highlight_search_results');
add_filter('the_excerpt', 'carbon_pro_highlight_search_results');
add_filter('the_content', 'carbon_pro_highlight_search_results');

// Customizer settings have been removed to comply with WordPress.org SEO guidelines.

/**
 * Register Block Patterns
 */
function carbon_pro_register_block_patterns() {
    register_block_pattern_category(
        'carbon-pro',
        array('label' => __('Carbon Pro', 'carbon-pro'))
    );

    register_block_pattern(
        'carbon-pro/hero',
        array(
            'title'       => __('Hero Section', 'carbon-pro'),
            'description' => _x('A large hero section with a call to action.', 'Block pattern description', 'carbon-pro'),
            'categories'  => array('carbon-pro'),
            'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"backgroundColor":"carbon-g100","textColor":"white","layout":{"type":"constrained"}} -->
                            <div class="wp-block-group has-white-color has-carbon-g100-background-color has-text-color has-background" style="padding-top:80px;padding-bottom:80px">
                            <!-- wp:heading {"textAlign":"center","level":1} -->
                            <h1 class="has-text-align-center">' . esc_html__('Welcome to Carbon Pro', 'carbon-pro') . '</h1>
                            <!-- /wp:heading -->
                            <!-- wp:paragraph {"align":"center"} -->
                            <p class="has-text-align-center">' . esc_html__('High-performance, resource-efficient WordPress theme inspired by IBM Carbon.', 'carbon-pro') . '</p>
                            <!-- /wp:paragraph -->
                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                            <div class="wp-block-buttons">
                            <!-- wp:button {"backgroundColor":"carbon-blue-60"} -->
                            <div class="wp-block-button"><a class="wp-block-button__link has-carbon-blue-60-background-color has-background">' . esc_html__('Learn More', 'carbon-pro') . '</a></div>
                            <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                            </div>
                            <!-- /wp:group -->',
        )
    );
}
add_action('init', 'carbon_pro_register_block_patterns');

/**
 * Register Block Styles
 */
function carbon_pro_register_block_styles() {
    register_block_style(
        'core/button',
        array(
            'name'  => 'carbon-pro-flush',
            'label' => __('Carbon Flush', 'carbon-pro'),
        )
    );
}
add_action('init', 'carbon_pro_register_block_styles');
