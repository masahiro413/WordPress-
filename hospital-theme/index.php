<?php
/**
 * ブログ一覧テンプレート（フォールバック）
 *
 * @package hospital-theme
 */

get_header();
hospital_breadcrumbs();
?>

<div class="site-content" id="main-content">
    <main class="main-content" role="main">

        <?php if ( is_home() && ! is_front_page() ) : ?>
            <header class="archive-header">
                <h1 class="archive-title"><?php esc_html_e( 'ブログ・お知らせ', 'hospital-theme' ); ?></h1>
            </header>
        <?php endif; ?>

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
            <div class="text-center" style="padding:40px 0;">
                <p><?php esc_html_e( '投稿が見つかりませんでした。', 'hospital-theme' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>

    </main><!-- .main-content -->

    <?php get_sidebar(); ?>
</div><!-- .site-content -->

<?php get_footer(); ?>
