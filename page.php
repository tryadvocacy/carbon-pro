<?php get_header(); ?>

<main id="primary" class="site-main carbon-container">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('carbon-page'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title" style="font-weight: 300; font-size: 3rem; margin-bottom: 2rem;">
                        <?php the_title(); ?>
                    </h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail" style="margin-bottom: 2rem;">
                        <?php the_post_thumbnail('large', ['style' => 'width: 100%; height: auto;']); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content" style="font-weight: 300; line-height: 1.8; font-size: 1.125rem;">
                    <?php
                    the_content();
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'carbon-pro'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (comments_open() || get_comments_number()) : ?>
                    <div style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid #e0e0e0;">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
