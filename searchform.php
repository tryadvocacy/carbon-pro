<?php
/**
 * The template for displaying search forms in Carbon Pro
 */
?>

<form role="search" method="get" class="carbon-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'carbon-pro' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'carbon-pro' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
    </label>
    <button type="button" class="search-clear" aria-label="<?php echo esc_attr__( 'Clear search', 'carbon-pro' ); ?>" style="display: <?php echo get_search_query() ? 'flex' : 'none'; ?>;">
        <svg focusable="false" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="16" height="16" viewBox="0 0 32 32" aria-hidden="true"><path d="M24 9.4L22.6 8 16 14.6 9.4 8 8 9.4 14.6 16 8 22.6 9.4 24 16 17.4 22.6 24 24 22.6 17.4 16 24 9.4z"></path></svg>
    </button>
    <button type="submit" class="search-submit">
        <svg focusable="false" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true"><path d="M15,14.3L10.7,10c1.9-2.3,1.7-5.8-0.5-7.9C8,0.1,4.7,0.1,2.6,2.1c-2.1,2.1-2.1,5.4,0,7.5c2,2,5.2,2.2,7.4,0.6l4.3,4.3 L15,14.3z M3.3,8.9c-1.7-1.7-1.7-4.5,0-6.2s4.5-1.7,6.2,0s1.7,4.5,0,6.2S5,10.6,3.3,8.9z"></path></svg>
        <span class="search-btn-text"><?php echo esc_html_x( 'Search', 'submit button', 'carbon-pro' ); ?></span>
    </button>
</form>
