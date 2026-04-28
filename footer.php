
<footer class="carbon-footer">
    <?php if (is_active_sidebar('footer-1')) : ?>
        <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; border-bottom: 1px solid #393939;">
            <div class="carbon-grid-3">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
        </div>
    <?php endif; ?>
    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; display: flex; justify-content: space-between;">
        <div>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></div>
        <div><?php printf(esc_html__('Built with %s', 'carbon-pro'), 'Carbon Design System'); ?></div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
