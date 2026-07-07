<?php
/**
 * 固定ページテンプレート
 *
 * @package hospital-theme
 */

get_header();
hospital_breadcrumbs();
?>

<!-- ページヘッダー -->
<?php if ( ! is_front_page() ) : ?>
<div class="page-header-section">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <?php if ( has_excerpt() ) : ?>
            <p><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<div class="site-content" id="main-content">
    <main class="main-content" role="main">

        <?php
        while ( have_posts() ) :
            the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'full', [ 'class' => 'entry-thumbnail', 'loading' => 'lazy' ] ); ?>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content();
                wp_link_pages(
                    [
                        'before' => '<div class="page-links">' . esc_html__( 'ページ:', 'hospital-theme' ),
                        'after'  => '</div>',
                    ]
                );
                ?>
            </div><!-- .entry-content -->

        </article><!-- #post-{ID} -->

        <?php endwhile; ?>

    </main><!-- .main-content -->

    <?php get_sidebar(); ?>
</div><!-- .site-content -->

<?php get_footer(); ?>
