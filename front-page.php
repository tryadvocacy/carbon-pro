<?php get_header(); ?>

<main id="primary" class="site-main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <div class="carbon-hero">
                <div style="max-width: 1200px; margin: 0 auto;">
                    <h1><?php the_title(); ?></h1>
                    <div class="hero-content" style="font-weight: 300; line-height: 1.4; margin-bottom: 2rem;">
                        <?php the_content(); ?>
                    </div>
                    <div class="hero-actions">
                        <?php 
                        $blog_page_id = get_option('page_for_posts');
                        if ($blog_page_id) : ?>
                            <a href="<?php echo esc_url(get_permalink($blog_page_id)); ?>" class="carbon-btn">
                                <?php esc_html_e('View Blog', 'carbon-pro'); ?>
                            </a>
                        <?php endif; ?>
                        <a href="#features" class="carbon-btn-secondary">
                            <?php esc_html_e('Learn More', 'carbon-pro'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div id="features" class="carbon-grid-3">
                <div class="carbon-card">
                    <div class="carbon-meta"><?php esc_html_e('01. Architecture', 'carbon-pro'); ?></div>
                    <h3><?php esc_html_e('Modular Design', 'carbon-pro'); ?></h3>
                    <p style="font-weight: 300; font-size: 0.875rem; color: #525252; line-height: 1.5;">
                        <?php esc_html_e('Components are designed to be used in isolation or in combination to build complex interfaces.', 'carbon-pro'); ?>
                    </p>
                </div>
                <div class="carbon-card">
                    <div class="carbon-meta"><?php esc_html_e('02. Performance', 'carbon-pro'); ?></div>
                    <h3><?php esc_html_e('Technical Precision', 'carbon-pro'); ?></h3>
                    <p style="font-weight: 300; font-size: 0.875rem; color: #525252; line-height: 1.5;">
                        <?php esc_html_e('Optimized for speed and low resource consumption, ensuring a fast experience for all users.', 'carbon-pro'); ?>
                    </p>
                </div>
                <div class="carbon-card">
                    <div class="carbon-meta"><?php esc_html_e('03. Community', 'carbon-pro'); ?></div>
                    <h3><?php esc_html_e('Open Source', 'carbon-pro'); ?></h3>
                    <p style="font-weight: 300; font-size: 0.875rem; color: #525252; line-height: 1.5;">
                        <?php esc_html_e('Built with a modular approach that allows for easy customization and community contributions.', 'carbon-pro'); ?>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
