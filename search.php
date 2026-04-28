<?php
/**
 * The template for displaying search results pages
 */

get_header(); ?>

<main id="primary" class="site-main carbon-container">

<div class="carbon-search-results-header">
    <h1><?php printf( esc_html__( 'Search Results for: %s', 'carbon-pro' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    <p><?php
        global $wp_query;
        printf( _n( '%d result found', '%d results found', $wp_query->found_posts, 'carbon-pro' ), number_format_i18n( $wp_query->found_posts ) );
    ?></p>
</div>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('carbon-post'); ?>>
            <div class="carbon-meta">
                <?php echo esc_html(get_the_date()); ?> &bull; <?php echo esc_html(get_the_author()); ?>
            </div>
            <div class="carbon-categories" style="margin-bottom: 1rem;">
                <?php echo get_the_category_list(' '); ?>
            </div>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="carbon-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="carbon-btn">
                <?php esc_html_e('Read More', 'carbon-pro'); ?>
                <svg focusable="false" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" style="margin-left: 8px;"><path d="M9.3 3.7L14.1 8.5 9.3 13.3 8.6 12.6 12.4 8.8 2 8.8 2 7.8 12.4 7.8 8.6 4 9.3 3.7z"></path></svg>
            </a>
        </article>
    <?php endwhile; ?>

    <div class="carbon-pagination">
        <?php the_posts_pagination(); ?>
    </div>

<?php else : ?>
    <div class="carbon-no-results">
        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'carbon-pro' ); ?></p>
        <div style="margin-top: 2rem; max-width: 400px;">
            <?php get_search_form(); ?>
        </div>
    </div>
<?php endif; ?>

</main>

<?php get_footer(); ?>
