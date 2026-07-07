<?php
/**
 * サイドバーテンプレート
 *
 * @package hospital-theme
 */
?>
<aside class="sidebar" role="complementary" aria-label="<?php esc_attr_e( 'サイドバー', 'hospital-theme' ); ?>">

    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php else : ?>

        <!-- 検索ウィジェット -->
        <div class="widget">
            <h3 class="widget-title">🔍 <?php esc_html_e( '記事を検索', 'hospital-theme' ); ?></h3>
            <form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
                <label class="sr-only" for="sidebar-search"><?php esc_html_e( 'キーワードで検索', 'hospital-theme' ); ?></label>
                <input type="search" id="sidebar-search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'キーワードを入力…', 'hospital-theme' ); ?>">
                <button type="submit"><?php esc_html_e( '検索', 'hospital-theme' ); ?></button>
            </form>
        </div>

        <!-- 病院基本情報 -->
        <div class="widget">
            <h3 class="widget-title">🏥 <?php esc_html_e( '病院基本情報', 'hospital-theme' ); ?></h3>
            <table>
                <tr>
                    <td><?php esc_html_e( '電話', 'hospital-theme' ); ?></td>
                    <td>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', get_theme_mod( 'hospital_phone', '000-000-0000' ) ) ); ?>">
                            <?php echo hospital_get_info( 'hospital_phone', '000-000-0000' ); ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><?php esc_html_e( '診療', 'hospital-theme' ); ?></td>
                    <td><?php echo hospital_get_info( 'hospital_hours', '平日 9:00〜17:00' ); ?></td>
                </tr>
                <tr>
                    <td><?php esc_html_e( '住所', 'hospital-theme' ); ?></td>
                    <td><?php echo hospital_get_info( 'hospital_address', '〒000-0000 ○○県○○市' ); ?></td>
                </tr>
            </table>
        </div>

        <!-- カテゴリ一覧 -->
        <div class="widget">
            <h3 class="widget-title">📂 <?php esc_html_e( 'カテゴリ', 'hospital-theme' ); ?></h3>
            <ul>
                <?php
                wp_list_categories(
                    [
                        'title_li'     => '',
                        'show_count'   => true,
                        'hide_empty'   => false,
                        'hierarchical' => true,
                    ]
                );
                ?>
            </ul>
        </div>

        <!-- 最近の投稿 -->
        <div class="widget">
            <h3 class="widget-title">📰 <?php esc_html_e( '最近の投稿', 'hospital-theme' ); ?></h3>
            <?php
            $recent = new WP_Query(
                [
                    'post_type'      => 'post',
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                ]
            );
            if ( $recent->have_posts() ) :
            ?>
            <ul>
                <?php
                while ( $recent->have_posts() ) :
                    $recent->the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <br>
                    <small style="color:var(--color-text-light);">
                        <?php echo esc_html( get_the_date() ); ?>
                    </small>
                </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
            <?php else : ?>
                <p style="font-size:0.85rem;color:var(--color-text-light);"><?php esc_html_e( '投稿はまだありません。', 'hospital-theme' ); ?></p>
            <?php endif; ?>
        </div>

        <!-- 月別アーカイブ -->
        <div class="widget">
            <h3 class="widget-title">🗓 <?php esc_html_e( '月別アーカイブ', 'hospital-theme' ); ?></h3>
            <ul>
                <?php
                wp_get_archives(
                    [
                        'type'            => 'monthly',
                        'limit'           => 12,
                        'show_post_count' => true,
                        'format'          => 'html',
                    ]
                );
                ?>
            </ul>
        </div>

        <!-- 診療科リンク -->
        <div class="widget">
            <h3 class="widget-title">🏥 <?php esc_html_e( '診療科', 'hospital-theme' ); ?></h3>
            <?php
            $depts = new WP_Query(
                [
                    'post_type'      => 'department',
                    'posts_per_page' => 10,
                    'post_status'    => 'publish',
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ]
            );
            if ( $depts->have_posts() ) :
            ?>
            <ul>
                <?php
                while ( $depts->have_posts() ) :
                    $depts->the_post();
                ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
            <?php else : ?>
                <ul>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'department' ) ); ?>"><?php esc_html_e( '診療科一覧', 'hospital-theme' ); ?></a></li>
                </ul>
            <?php endif; ?>
        </div>

    <?php endif; ?>

</aside><!-- .sidebar -->
