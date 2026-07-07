<?php
/**
 * テーマ設定ページ（管理画面）
 *
 * WordPress管理画面に「病院設定」ページを追加します。
 * （テーマカスタマイザーの補助として使用）
 *
 * @package hospital-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 管理メニューに病院設定ページを追加する。
 */
function hospital_add_admin_menu(): void {
    add_theme_page(
        __( '病院テーマ設定', 'hospital-theme' ),
        __( '病院設定', 'hospital-theme' ),
        'manage_options',
        'hospital-theme-settings',
        'hospital_admin_settings_page'
    );
}
add_action( 'admin_menu', 'hospital_add_admin_menu' );

/**
 * 病院設定ページのコンテンツを出力する。
 */
function hospital_admin_settings_page(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'このページにアクセスする権限がありません。', 'hospital-theme' ) );
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( '病院テーマ設定', 'hospital-theme' ); ?></h1>
        <p>
            <?php
            printf(
                /* translators: %s: Customizer URL */
                wp_kses(
                    __( '病院情報の設定は <a href="%s">テーマカスタマイザー</a> の「病院情報」セクションで行えます。', 'hospital-theme' ),
                    [ 'a' => [ 'href' => [] ] ]
                ),
                esc_url( admin_url( 'customize.php' ) )
            );
            ?>
        </p>
        <hr>
        <h2><?php esc_html_e( 'テーマについて', 'hospital-theme' ); ?></h2>
        <table class="form-table">
            <tr>
                <th><?php esc_html_e( 'テーマ名', 'hospital-theme' ); ?></th>
                <td><?php echo esc_html( wp_get_theme()->get( 'Name' ) ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'バージョン', 'hospital-theme' ); ?></th>
                <td><?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( '説明', 'hospital-theme' ); ?></th>
                <td><?php echo esc_html( wp_get_theme()->get( 'Description' ) ); ?></td>
            </tr>
        </table>
        <hr>
        <h2><?php esc_html_e( '使い方ガイド', 'hospital-theme' ); ?></h2>
        <ol style="max-width:700px;line-height:2.2;">
            <li><?php esc_html_e( '「外観 → カスタマイズ → 病院情報」で病院名・電話番号・住所・診療時間などを設定してください。', 'hospital-theme' ); ?></li>
            <li><?php esc_html_e( '「診療科」の投稿タイプから各診療科を登録してください。アイコン絵文字も設定できます。', 'hospital-theme' ); ?></li>
            <li><?php esc_html_e( '「医師」の投稿タイプから担当医師を登録してください。所属診療科タクソノミーも設定できます。', 'hospital-theme' ); ?></li>
            <li><?php esc_html_e( '「投稿」を使ってブログ・お知らせを配信してください。', 'hospital-theme' ); ?></li>
            <li><?php esc_html_e( '「固定ページ」でアクセスページ・病院概要ページを作成してください。', 'hospital-theme' ); ?></li>
            <li><?php esc_html_e( '「外観 → メニュー」でナビゲーションメニュー（メインメニュー・フッター）を設定してください。', 'hospital-theme' ); ?></li>
        </ol>
    </div>
    <?php
}
