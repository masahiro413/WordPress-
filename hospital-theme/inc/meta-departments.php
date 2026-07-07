<?php
/**
 * 診療科のメタボックス登録と保存
 *
 * @package hospital-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 診療科メタボックスを追加する。
 */
function hospital_add_department_meta_boxes(): void {
    add_meta_box(
        'department_details',
        __( '診療科詳細情報', 'hospital-theme' ),
        'hospital_department_meta_box_callback',
        'department',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hospital_add_department_meta_boxes' );

/**
 * 診療科メタボックスのコールバック。
 *
 * @param \WP_Post $post 現在の投稿オブジェクト。
 */
function hospital_department_meta_box_callback( \WP_Post $post ): void {
    wp_nonce_field( 'hospital_department_meta_nonce', 'hospital_department_nonce' );

    $icon    = get_post_meta( $post->ID, '_department_icon', true );
    $phone   = get_post_meta( $post->ID, '_department_phone', true );
    $hours   = get_post_meta( $post->ID, '_department_hours', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="department_icon"><?php esc_html_e( '診療科アイコン（絵文字）', 'hospital-theme' ); ?></label></th>
            <td>
                <input type="text" id="department_icon" name="department_icon" value="<?php echo esc_attr( $icon ); ?>" class="small-text" placeholder="🏥">
                <p class="description"><?php esc_html_e( '絵文字を1文字入力してください（例: 🫀 🦴 🧠）', 'hospital-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="department_phone"><?php esc_html_e( '診療科直通電話', 'hospital-theme' ); ?></label></th>
            <td><input type="text" id="department_phone" name="department_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text" placeholder="000-000-0000"></td>
        </tr>
        <tr>
            <th><label for="department_hours"><?php esc_html_e( '診療時間', 'hospital-theme' ); ?></label></th>
            <td>
                <textarea id="department_hours" name="department_hours" rows="3" class="large-text"><?php echo esc_textarea( $hours ); ?></textarea>
                <p class="description"><?php esc_html_e( '例: 月〜金 9:00〜12:00 / 14:00〜17:00', 'hospital-theme' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * 診療科の詳細情報を保存する。
 *
 * @param int $post_id 投稿 ID。
 */
function hospital_save_department_meta( int $post_id ): void {
    if ( ! isset( $_POST['hospital_department_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['hospital_department_nonce'] ) ), 'hospital_department_meta_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = [
        '_department_icon'  => 'department_icon',
        '_department_phone' => 'department_phone',
        '_department_hours' => 'department_hours',
    ];

    foreach ( $fields as $meta_key => $field_name ) {
        if ( isset( $_POST[ $field_name ] ) ) {
            update_post_meta(
                $post_id,
                $meta_key,
                sanitize_textarea_field( wp_unslash( $_POST[ $field_name ] ) )
            );
        }
    }
}
add_action( 'save_post_department', 'hospital_save_department_meta' );
