<?php
/**
 * 404 エラーページテンプレート
 *
 * @package hospital-theme
 */

get_header();
?>

<div id="main-content">
    <div class="error-404-section">
        <div class="container">
            <h1>404</h1>
            <h2><?php esc_html_e( 'ページが見つかりません', 'hospital-theme' ); ?></h2>
            <p>
                <?php esc_html_e( 'お探しのページは移動、削除、またはURLが間違っている可能性があります。', 'hospital-theme' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                🏠 <?php esc_html_e( 'トップページへ戻る', 'hospital-theme' ); ?>
            </a>
            <div style="margin-top:40px; max-width:400px; margin-left:auto; margin-right:auto;">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
