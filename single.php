<?php get_header(); ?>

<main id="primary" class="site-main carbon-container">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('carbon-post'); ?>>
                <header class="entry-header">
                    <div class="carbon-meta">
                        <?php echo esc_html(get_the_date()); ?> &bull; <?php echo esc_html(get_the_author()); ?>
                    </div>
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

                <footer class="entry-footer" style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid #e0e0e0;">
                    <div class="carbon-categories">
                        <span class="carbon-meta"><?php esc_html_e('Categories:', 'carbon-pro'); ?></span>
                        <?php echo get_the_category_list(' '); ?>
                    </div>
                    <?php if (has_tag()) : ?>
                        <div class="carbon-tags" style="margin-top: 1rem;">
                            <span class="carbon-meta"><?php esc_html_e('Tags:', 'carbon-pro'); ?></span>
                            <?php echo get_the_tag_list('', ' '); ?>
                        </div>
                    <?php endif; ?>
                </footer>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </article>
        <?php endwhile; ?>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
