<?php
/**
 * 病院ブログテーマ – functions.php
 *
 * テーマのセットアップ、カスタム投稿タイプ（医師・診療科）、
 * ウィジェットエリア、メニュー登録を行います。
 *
 * @package hospital-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ===== Include Files =====
require_once get_template_directory() . '/inc/meta-departments.php';
require_once get_template_directory() . '/inc/admin-settings.php';

// ===== Theme Setup =====

/**
 * テーマの基本設定を行う。
 */
function hospital_theme_setup(): void {
    // 翻訳ファイルの読み込みを有効化
    load_theme_textdomain( 'hospital-theme', get_template_directory() . '/languages' );

    // HTML5 マークアップ
    add_theme_support(
        'html5',
        [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ]
    );

    // アイキャッチ画像
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 800, 500, true );
    add_image_size( 'hospital-card', 400, 260, true );
    add_image_size( 'hospital-doctor', 400, 400, true );

    // タイトルタグの自動出力
    add_theme_support( 'title-tag' );

    // カスタムロゴ
    add_theme_support(
        'custom-logo',
        [
            'height'      => 70,
            'width'       => 200,
            'flex-height' => true,
            'flex-width'  => true,
        ]
    );

    // フィードリンク
    add_theme_support( 'automatic-feed-links' );

    // ブロックエディタスタイル
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );

    // ナビゲーションメニュー登録
    register_nav_menus(
        [
            'primary'  => __( 'メインメニュー', 'hospital-theme' ),
            'footer'   => __( 'フッターメニュー', 'hospital-theme' ),
            'topbar'   => __( 'トップバーメニュー', 'hospital-theme' ),
        ]
    );
}
add_action( 'after_setup_theme', 'hospital_theme_setup' );

// ===== Enqueue Scripts & Styles =====

/**
 * スクリプトとスタイルシートを読み込む。
 */
function hospital_enqueue_assets(): void {
    $version = wp_get_theme()->get( 'Version' );

    // Google Fonts（日本語）
    wp_enqueue_style(
        'hospital-google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@400;700&display=swap',
        [],
        null
    );

    // テーマスタイルシート
    wp_enqueue_style(
        'hospital-theme-style',
        get_stylesheet_uri(),
        [ 'hospital-google-fonts' ],
        $version
    );

    // テーマ JavaScript
    wp_enqueue_script(
        'hospital-theme-script',
        get_template_directory_uri() . '/js/main.js',
        [],
        $version,
        true
    );

    // コメントスレッド
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'hospital_enqueue_assets' );

// ===== Widget Areas =====

/**
 * ウィジェットエリアを登録する。
 */
function hospital_widgets_init(): void {
    $defaults = [
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ];

    register_sidebar(
        array_merge(
            $defaults,
            [
                'name'        => __( 'サイドバー', 'hospital-theme' ),
                'id'          => 'sidebar-1',
                'description' => __( 'メインサイドバーのウィジェットエリアです。', 'hospital-theme' ),
            ]
        )
    );

    register_sidebar(
        array_merge(
            $defaults,
            [
                'name'        => __( 'フッターウィジェット 1', 'hospital-theme' ),
                'id'          => 'footer-1',
                'description' => __( 'フッター左側のウィジェットエリアです。', 'hospital-theme' ),
            ]
        )
    );

    register_sidebar(
        array_merge(
            $defaults,
            [
                'name'        => __( 'フッターウィジェット 2', 'hospital-theme' ),
                'id'          => 'footer-2',
                'description' => __( 'フッター中央のウィジェットエリアです。', 'hospital-theme' ),
            ]
        )
    );
}
add_action( 'widgets_init', 'hospital_widgets_init' );

// ===== Custom Post Types =====

/**
 * カスタム投稿タイプ（医師・診療科）を登録する。
 */
function hospital_register_post_types(): void {

    // 医師 (Doctor)
    register_post_type(
        'doctor',
        [
            'labels'      => [
                'name'               => __( '医師', 'hospital-theme' ),
                'singular_name'      => __( '医師', 'hospital-theme' ),
                'add_new'            => __( '医師を追加', 'hospital-theme' ),
                'add_new_item'       => __( '新しい医師を追加', 'hospital-theme' ),
                'edit_item'          => __( '医師を編集', 'hospital-theme' ),
                'view_item'          => __( '医師を表示', 'hospital-theme' ),
                'all_items'          => __( '全医師', 'hospital-theme' ),
                'search_items'       => __( '医師を検索', 'hospital-theme' ),
                'not_found'          => __( '医師が見つかりません', 'hospital-theme' ),
                'not_found_in_trash' => __( 'ゴミ箱に医師はありません', 'hospital-theme' ),
            ],
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => [ 'slug' => 'doctors' ],
            'menu_icon'   => 'dashicons-businessperson',
            'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
            'show_in_rest' => true,
        ]
    );

    // 診療科 (Department)
    register_post_type(
        'department',
        [
            'labels'      => [
                'name'               => __( '診療科', 'hospital-theme' ),
                'singular_name'      => __( '診療科', 'hospital-theme' ),
                'add_new'            => __( '診療科を追加', 'hospital-theme' ),
                'add_new_item'       => __( '新しい診療科を追加', 'hospital-theme' ),
                'edit_item'          => __( '診療科を編集', 'hospital-theme' ),
                'view_item'          => __( '診療科を表示', 'hospital-theme' ),
                'all_items'          => __( '全診療科', 'hospital-theme' ),
                'search_items'       => __( '診療科を検索', 'hospital-theme' ),
                'not_found'          => __( '診療科が見つかりません', 'hospital-theme' ),
                'not_found_in_trash' => __( 'ゴミ箱に診療科はありません', 'hospital-theme' ),
            ],
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => [ 'slug' => 'departments' ],
            'menu_icon'   => 'dashicons-heart',
            'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
            'show_in_rest' => true,
        ]
    );
}
add_action( 'init', 'hospital_register_post_types' );

// ===== Custom Taxonomies =====

/**
 * カスタムタクソノミー（お知らせカテゴリ）を登録する。
 */
function hospital_register_taxonomies(): void {

    register_taxonomy(
        'news_category',
        'post',
        [
            'labels'       => [
                'name'              => __( 'お知らせカテゴリ', 'hospital-theme' ),
                'singular_name'     => __( 'お知らせカテゴリ', 'hospital-theme' ),
                'search_items'      => __( 'カテゴリを検索', 'hospital-theme' ),
                'all_items'         => __( '全カテゴリ', 'hospital-theme' ),
                'parent_item'       => __( '親カテゴリ', 'hospital-theme' ),
                'parent_item_colon' => __( '親カテゴリ:', 'hospital-theme' ),
                'edit_item'         => __( 'カテゴリを編集', 'hospital-theme' ),
                'update_item'       => __( 'カテゴリを更新', 'hospital-theme' ),
                'add_new_item'      => __( '新しいカテゴリを追加', 'hospital-theme' ),
                'new_item_name'     => __( '新しいカテゴリ名', 'hospital-theme' ),
                'menu_name'         => __( 'お知らせカテゴリ', 'hospital-theme' ),
            ],
            'hierarchical'  => true,
            'show_ui'       => true,
            'show_in_rest'  => true,
            'rewrite'       => [ 'slug' => 'news-category' ],
        ]
    );

    // 診療科タクソノミー（医師の所属診療科）
    register_taxonomy(
        'doctor_department',
        'doctor',
        [
            'labels'       => [
                'name'          => __( '所属診療科', 'hospital-theme' ),
                'singular_name' => __( '所属診療科', 'hospital-theme' ),
                'all_items'     => __( '全診療科', 'hospital-theme' ),
                'edit_item'     => __( '診療科を編集', 'hospital-theme' ),
                'add_new_item'  => __( '新しい診療科を追加', 'hospital-theme' ),
                'menu_name'     => __( '所属診療科', 'hospital-theme' ),
            ],
            'hierarchical'  => true,
            'show_ui'       => true,
            'show_in_rest'  => true,
            'rewrite'       => [ 'slug' => 'doctor-department' ],
        ]
    );
}
add_action( 'init', 'hospital_register_taxonomies' );

// ===== Custom Meta Boxes =====

/**
 * 医師の詳細情報メタボックスを追加する。
 */
function hospital_add_doctor_meta_boxes(): void {
    add_meta_box(
        'doctor_details',
        __( '医師詳細情報', 'hospital-theme' ),
        'hospital_doctor_meta_box_callback',
        'doctor',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hospital_add_doctor_meta_boxes' );

/**
 * 医師詳細情報メタボックスのコールバック。
 *
 * @param \WP_Post $post 現在の投稿オブジェクト。
 */
function hospital_doctor_meta_box_callback( \WP_Post $post ): void {
    wp_nonce_field( 'hospital_doctor_meta_nonce', 'hospital_doctor_nonce' );

    $title      = get_post_meta( $post->ID, '_doctor_title', true );
    $specialty  = get_post_meta( $post->ID, '_doctor_specialty', true );
    $experience = get_post_meta( $post->ID, '_doctor_experience', true );
    $schedule   = get_post_meta( $post->ID, '_doctor_schedule', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="doctor_title"><?php esc_html_e( '役職・称号', 'hospital-theme' ); ?></label></th>
            <td><input type="text" id="doctor_title" name="doctor_title" value="<?php echo esc_attr( $title ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="doctor_specialty"><?php esc_html_e( '専門分野', 'hospital-theme' ); ?></label></th>
            <td><input type="text" id="doctor_specialty" name="doctor_specialty" value="<?php echo esc_attr( $specialty ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="doctor_experience"><?php esc_html_e( '経歴・資格', 'hospital-theme' ); ?></label></th>
            <td><textarea id="doctor_experience" name="doctor_experience" rows="4" class="large-text"><?php echo esc_textarea( $experience ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="doctor_schedule"><?php esc_html_e( '担当曜日', 'hospital-theme' ); ?></label></th>
            <td><input type="text" id="doctor_schedule" name="doctor_schedule" value="<?php echo esc_attr( $schedule ); ?>" class="regular-text" placeholder="例: 月・水・金（午前）"></td>
        </tr>
    </table>
    <?php
}

/**
 * 医師の詳細情報を保存する。
 *
 * @param int $post_id 投稿 ID。
 */
function hospital_save_doctor_meta( int $post_id ): void {
    if ( ! isset( $_POST['hospital_doctor_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['hospital_doctor_nonce'] ) ), 'hospital_doctor_meta_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = [
        '_doctor_title'      => 'doctor_title',
        '_doctor_specialty'  => 'doctor_specialty',
        '_doctor_experience' => 'doctor_experience',
        '_doctor_schedule'   => 'doctor_schedule',
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
add_action( 'save_post_doctor', 'hospital_save_doctor_meta' );

// ===== Theme Customizer =====

/**
 * テーマカスタマイザー設定を追加する。
 *
 * @param \WP_Customize_Manager $wp_customize カスタマイザーマネージャー。
 */
function hospital_customize_register( \WP_Customize_Manager $wp_customize ): void {

    // 病院情報セクション
    $wp_customize->add_section(
        'hospital_info',
        [
            'title'    => __( '病院情報', 'hospital-theme' ),
            'priority' => 30,
        ]
    );

    $settings = [
        'hospital_name'        => [ 'label' => __( '病院名', 'hospital-theme' ),         'default' => '〇〇病院' ],
        'hospital_tagline'     => [ 'label' => __( 'キャッチコピー', 'hospital-theme' ), 'default' => '地域に根ざした医療を提供します' ],
        'hospital_address'     => [ 'label' => __( '住所', 'hospital-theme' ),            'default' => '〒000-0000 ○○県○○市○○町1-1' ],
        'hospital_phone'       => [ 'label' => __( '代表電話番号', 'hospital-theme' ),    'default' => '000-000-0000' ],
        'hospital_fax'         => [ 'label' => __( 'FAX番号', 'hospital-theme' ),         'default' => '000-000-0001' ],
        'hospital_email'       => [ 'label' => __( 'メールアドレス', 'hospital-theme' ),  'default' => 'info@hospital.example.com' ],
        'hospital_hours'       => [ 'label' => __( '診療時間', 'hospital-theme' ),        'default' => '平日 9:00〜17:00 / 土曜 9:00〜12:00' ],
        'hospital_emergency'   => [ 'label' => __( '救急連絡先', 'hospital-theme' ),      'default' => '000-000-0002' ],
        'hospital_notice'      => [ 'label' => __( 'お知らせバー（空欄で非表示）', 'hospital-theme' ), 'default' => '' ],
    ];

    foreach ( $settings as $id => $args ) {
        $wp_customize->add_setting(
            $id,
            [
                'default'           => $args['default'],
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );
        $wp_customize->add_control(
            $id,
            [
                'label'   => $args['label'],
                'section' => 'hospital_info',
                'type'    => 'text',
            ]
        );
    }
}
add_action( 'customize_register', 'hospital_customize_register' );

// ===== Helper Functions =====

/**
 * カスタマイザーから病院情報を取得する。
 *
 * @param  string $key     設定キー。
 * @param  string $default デフォルト値。
 * @return string
 */
function hospital_get_info( string $key, string $default = '' ): string {
    return esc_html( get_theme_mod( $key, $default ) );
}

/**
 * パンくずリストを出力する。
 */
function hospital_breadcrumbs(): void {
    if ( is_front_page() ) {
        return;
    }
    ?>
    <nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'パンくずリスト', 'hospital-theme' ); ?>">
        <div class="container">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'ホーム', 'hospital-theme' ); ?></a>
            <span class="sep" aria-hidden="true"> › </span>
            <?php
            if ( is_category() ) {
                single_cat_title();
            } elseif ( is_tag() ) {
                printf( '%s: ', esc_html__( 'タグ', 'hospital-theme' ) );
                single_tag_title();
            } elseif ( is_author() ) {
                printf( esc_html__( '投稿者: %s', 'hospital-theme' ), esc_html( get_the_author() ) );
            } elseif ( is_date() ) {
                echo get_the_date();
            } elseif ( is_singular( 'doctor' ) ) {
                echo '<a href="' . esc_url( get_post_type_archive_link( 'doctor' ) ) . '">';
                esc_html_e( '医師紹介', 'hospital-theme' );
                echo '</a>';
                echo '<span class="sep" aria-hidden="true"> › </span>';
                echo esc_html( get_the_title() );
            } elseif ( is_singular( 'department' ) ) {
                echo '<a href="' . esc_url( get_post_type_archive_link( 'department' ) ) . '">';
                esc_html_e( '診療科', 'hospital-theme' );
                echo '</a>';
                echo '<span class="sep" aria-hidden="true"> › </span>';
                echo esc_html( get_the_title() );
            } elseif ( is_single() ) {
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    $cat = $categories[0];
                    echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
                    echo '<span class="sep" aria-hidden="true"> › </span>';
                }
                echo esc_html( get_the_title() );
            } elseif ( is_page() ) {
                echo esc_html( get_the_title() );
            } elseif ( is_search() ) {
                printf( esc_html__( '検索結果: %s', 'hospital-theme' ), esc_html( get_search_query() ) );
            } elseif ( is_404() ) {
                esc_html_e( 'ページが見つかりません', 'hospital-theme' );
            } else {
                echo esc_html( get_the_title() );
            }
            ?>
        </div>
    </nav>
    <?php
}

/**
 * 投稿カードの HTML を出力する（ループ内で使用）。
 */
function hospital_post_card(): void {
    $categories = get_the_category();
    $cat_name   = ! empty( $categories ) ? esc_html( $categories[0]->name ) : '';
    $cat_link   = ! empty( $categories ) ? esc_url( get_category_link( $categories[0]->term_id ) ) : '';
    ?>
    <article class="post-card">
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                <?php the_post_thumbnail( 'hospital-card', [ 'class' => 'post-card-thumbnail', 'loading' => 'lazy' ] ); ?>
            </a>
        <?php else : ?>
            <div class="post-card-thumbnail-placeholder" aria-hidden="true">📰</div>
        <?php endif; ?>

        <div class="post-card-body">
            <div class="post-card-meta">
                <?php if ( $cat_name ) : ?>
                    <a class="post-card-category" href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a>
                <?php endif; ?>
                <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
                    <?php echo esc_html( get_the_date() ); ?>
                </time>
            </div>
            <h3>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <p class="post-card-excerpt">
                <?php echo esc_html( wp_trim_words( get_the_excerpt(), 40, '…' ) ); ?>
            </p>
            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">
                <?php esc_html_e( '続きを読む', 'hospital-theme' ); ?>
            </a>
        </div>
    </article>
    <?php
}

/**
 * ページネーションを出力する。
 */
function hospital_pagination(): void {
    $links = paginate_links(
        [
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type'      => 'array',
        ]
    );

    if ( ! $links ) {
        return;
    }
    ?>
    <nav class="pagination" aria-label="<?php esc_attr_e( 'ページナビゲーション', 'hospital-theme' ); ?>">
        <?php echo wp_kses_post( implode( '', $links ) ); ?>
    </nav>
    <?php
}

/**
 * 抜粋の文字数を日本語向けに調整する。
 *
 * @param  int $length 文字数。
 * @return int
 */
function hospital_excerpt_length( int $length ): int {
    return 80;
}
add_filter( 'excerpt_length', 'hospital_excerpt_length' );

/**
 * 抜粋の末尾文字を変更する。
 *
 * @param  string $more 末尾文字列。
 * @return string
 */
function hospital_excerpt_more( string $more ): string {
    return '…';
}
add_filter( 'excerpt_more', 'hospital_excerpt_more' );

// ===== Security & Cleanup =====

// WordPress バージョン情報を非表示
remove_action( 'wp_head', 'wp_generator' );

// 絵文字スクリプトを無効化（不要な場合）
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
