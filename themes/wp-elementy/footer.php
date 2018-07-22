<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
    </div>
    <footer id="colophon" class="elementy-footer-wrap site-footer">
        <?php do_action('wp_elementy_newsletter_in_bottom'); ?>
        <?php wp_elementy_footer(); ?>
    </footer>
    <?php do_action('wp_elementy_after_show_menu'); ?>
</div>
<?php wp_elementy_backtotop(); ?>
<?php wp_footer(); ?>
</body>
</html>