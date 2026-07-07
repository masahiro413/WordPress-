<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content"><?php esc_html_e( 'コンテンツへスキップ', 'hospital-theme' ); ?></a>

<?php
// お知らせバー
$notice = get_theme_mod( 'hospital_notice', '' );
if ( $notice ) :
?>
<div class="notice-bar" role="region" aria-label="<?php esc_attr_e( '重要なお知らせ', 'hospital-theme' ); ?>">
    <?php echo wp_kses_post( $notice ); ?>
</div>
<?php endif; ?>

<header class="site-header" role="banner">
    <div class="header-inner">
        <div class="site-branding">
            <?php if ( has_custom_logo() ) : ?>
                <div class="custom-logo-wrap"><?php the_custom_logo(); ?></div>
            <?php else : ?>
                <span class="hospital-icon" aria-hidden="true">🏥</span>
                <div>
                    <p class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php
                            $hospital_name = get_theme_mod( 'hospital_name', '' );
                            echo $hospital_name ? esc_html( $hospital_name ) : esc_html( get_bloginfo( 'name' ) );
                            ?>
                        </a>
                    </p>
                    <?php
                    $tagline = get_theme_mod( 'hospital_tagline', '' );
                    if ( ! $tagline ) {
                        $tagline = get_bloginfo( 'description' );
                    }
                    if ( $tagline ) :
                    ?>
                    <p class="site-tagline"><?php echo esc_html( $tagline ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <nav class="main-navigation" id="site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'メインメニュー', 'hospital-theme' ); ?>">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'メニューを開く', 'hospital-theme' ); ?>">
                &#9776;
            </button>
            <?php
            wp_nav_menu(
                [
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'hospital_fallback_menu',
                ]
            );
            ?>
        </nav><!-- #site-navigation -->
    </div><!-- .header-inner -->
</header><!-- .site-header -->

<?php
/**
 * メニューが登録されていない場合のデフォルトメニューを出力する。
 */
function hospital_fallback_menu(): void {
    ?>
    <ul id="primary-menu">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'ホーム', 'hospital-theme' ); ?></a></li>
        <li><a href="<?php echo esc_url( get_post_type_archive_link( 'department' ) ); ?>"><?php esc_html_e( '診療科', 'hospital-theme' ); ?></a></li>
        <li><a href="<?php echo esc_url( get_post_type_archive_link( 'doctor' ) ); ?>"><?php esc_html_e( '医師紹介', 'hospital-theme' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'ブログ・お知らせ', 'hospital-theme' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/access/' ) ); ?>"><?php esc_html_e( 'アクセス', 'hospital-theme' ); ?></a></li>
    </ul>
    <?php
}
