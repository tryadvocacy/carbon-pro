<?php get_header(); ?>

<main id="primary" class="site-main carbon-container">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('carbon-post'); ?>>
                <header class="entry-header">
                    <div class="carbon-meta">
                        <?php echo esc_html(get_the_date()); ?> &bull; <?php echo esc_html(get_the_author()); ?>
                    </div>
                    <div class="carbon-categories" style="margin-bottom: 1rem;">
                        <?php echo get_the_category_list(' '); ?>
                    </div>
                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                </header>

                <div class="entry-content" style="font-weight: 300; line-height: 1.6; margin: 1rem 0;">
                    <?php the_excerpt(); ?>
                </div>

                <a href="<?php echo esc_url(get_permalink()); ?>" class="carbon-btn">
                    <?php esc_html_e('Read Article →', 'carbon-pro'); ?>
                </a>
            </article>
        <?php endwhile; ?>

        <div class="navigation" style="margin-top: 2rem;">
            <?php the_posts_navigation(); ?>
        </div>

    <?php else : ?>
        <p><?php esc_html_e('No content found.', 'carbon-pro'); ?></p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
