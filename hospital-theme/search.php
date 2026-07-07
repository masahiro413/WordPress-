<?php
/**
 * 検索結果ページテンプレート
 *
 * @package hospital-theme
 */

get_header();
hospital_breadcrumbs();
?>

<div class="page-header-section">
    <div class="container">
        <h1>
            🔍 &ldquo;<?php echo esc_html( get_search_query() ); ?>&rdquo; <?php esc_html_e( 'の検索結果', 'hospital-theme' ); ?>
        </h1>
        <?php if ( have_posts() ) : ?>
        <p>
            <?php
            global $wp_query;
            printf(
                /* translators: %d: Number of results found. */
                esc_html( _n( '%d 件見つかりました', '%d 件見つかりました', (int) $wp_query->found_posts, 'hospital-theme' ) ),
                (int) $wp_query->found_posts
            );
            ?>
        </p>
        <?php endif; ?>
    </div>
</div>

<div class="site-content" id="main-content">
    <main class="main-content" role="main">

        <?php if ( have_posts() ) : ?>
            <div class="news-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    hospital_post_card();
                endwhile;
                ?>
            </div>
            <?php hospital_pagination(); ?>
        <?php else : ?>
            <div style="text-align:center; padding:40px 0;">
                <p><?php esc_html_e( '検索キーワードに一致する投稿が見つかりませんでした。別のキーワードをお試しください。', 'hospital-theme' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>

    </main><!-- .main-content -->

    <?php get_sidebar(); ?>
</div><!-- .site-content -->

<?php get_footer(); ?>
