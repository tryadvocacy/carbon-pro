<?php
/**
 * Carbon Pro functions and definitions
 */

if (!isset($content_width)) {
    $content_width = 800;
}

function carbon_pro_setup() {
    // Make theme available for translation
    load_theme_textdomain('carbon-pro', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('wp-block-styles');
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('custom-background');
    add_editor_style('style.css');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'carbon-pro'),
    ));
}
add_action('after_setup_theme', 'carbon_pro_setup');

function carbon_pro_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'carbon-pro'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'carbon-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'carbon_pro_widgets_init');

function carbon_pro_scripts() {
    // Enqueue IBM Plex Sans from Google Fonts
    wp_enqueue_style('carbon-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;600&display=swap', array(), null);
    
    // Enqueue main stylesheet with theme version to prevent caching
    $theme = wp_get_theme();
    wp_enqueue_style('carbon-pro-style', get_stylesheet_uri(), array(), $theme->get('Version'));

    // Enqueue navigation script
    wp_enqueue_script('carbon-pro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $theme->get('Version'), true);
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

/**
 * Customizer settings for Metadata
 */
function carbon_pro_customize_register($wp_customize) {
    $wp_customize->add_section('carbon_metadata_section', array(
        'title'    => __('Site Metadata', 'carbon-pro'),
        'priority' => 30,
    ));

    // Author
    $wp_customize->add_setting('carbon_meta_author', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('carbon_meta_author', array(
        'label'    => __('Author', 'carbon-pro'),
        'section'  => 'carbon_metadata_section',
        'type'     => 'text',
    ));

    // Description
    $wp_customize->add_setting('carbon_meta_description', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('carbon_meta_description', array(
        'label'    => __('Description', 'carbon-pro'),
        'section'  => 'carbon_metadata_section',
        'type'     => 'textarea',
    ));

    // Keywords
    $wp_customize->add_setting('carbon_meta_keywords', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('carbon_meta_keywords', array(
        'label'    => __('Keywords (comma separated)', 'carbon-pro'),
        'section'  => 'carbon_metadata_section',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'carbon_pro_customize_register');
