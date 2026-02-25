<?php
/**
 * Page Template
 *
 * @package WEBServices
 * @since 1.2.2
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main class="container">
    <section class="primary-cta" aria-label="Page content">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <div class="product-desc">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <h1>Page not found</h1>
            <p class="product-desc">No content is available for this page.</p>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
