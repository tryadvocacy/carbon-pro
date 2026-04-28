<?php get_header(); ?>

<main id="primary" class="site-main carbon-container">

    <div class="carbon-404">
        <div class="carbon-meta"><?php esc_html_e('Error 404', 'carbon-pro'); ?></div>
        <h1>404</h1>
        <h2><?php esc_html_e('Page not found', 'carbon-pro'); ?></h2>
        <p>
            <?php esc_html_e("The page you are looking for doesn't exist or has been moved. It's a quiet space here, but there's plenty more to see elsewhere.", 'carbon-pro'); ?>
        </p>
        <div style="margin-bottom: 3rem; width: 100%; max-width: 400px;">
            <?php get_search_form(); ?>
        </div>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="carbon-btn">
            <?php esc_html_e('Return to Home', 'carbon-pro'); ?>
        </a>
    </div>

</main>

<?php get_footer(); ?>
