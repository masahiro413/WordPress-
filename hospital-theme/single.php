<?php
/**
 * 投稿詳細テンプレート
 *
 * @package hospital-theme
 */

get_header();
hospital_breadcrumbs();
?>

<div class="site-content" id="main-content">
    <main class="main-content" role="main">

        <?php
        while ( have_posts() ) :
            the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) :
                ?>
                <a class="entry-category" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                    <?php echo esc_html( $categories[0]->name ); ?>
                </a>
                <?php endif; ?>

                <h1 class="entry-title"><?php the_title(); ?></h1>

                <div class="entry-meta">
                    <span>
                        📅
                        <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
                            <?php echo esc_html( get_the_date() ); ?>
                        </time>
                    </span>
                    <span>✍️ <?php the_author(); ?></span>
                    <?php if ( get_the_modified_date() !== get_the_date() ) : ?>
                    <span>
                        🔄 <?php esc_html_e( '更新:', 'hospital-theme' ); ?>
                        <time datetime="<?php echo esc_attr( get_the_modified_date( 'Y-m-d' ) ); ?>">
                            <?php echo esc_html( get_the_modified_date() ); ?>
                        </time>
                    </span>
                    <?php endif; ?>
                </div>
            </header><!-- .entry-header -->

            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'full', [ 'class' => 'entry-thumbnail', 'loading' => 'lazy' ] ); ?>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Post title. */
                            __( 'Continue reading<span class="sr-only"> "%s"</span>', 'hospital-theme' ),
                            [ 'span' => [ 'class' => [] ] ]
                        ),
                        wp_kses_post( get_the_title() )
                    )
                );
                wp_link_pages(
                    [
                        'before' => '<div class="page-links">' . esc_html__( 'ページ:', 'hospital-theme' ),
                        'after'  => '</div>',
                    ]
                );
                ?>
            </div><!-- .entry-content -->

            <?php
            $tags = get_the_tags();
            if ( $tags ) :
            ?>
            <div class="entry-tags">
                <span class="label">🏷 <?php esc_html_e( 'タグ:', 'hospital-theme' ); ?></span>
                <?php foreach ( $tags as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag-link">
                        <?php echo esc_html( $tag->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </article><!-- #post-{ID} -->

        <!-- 前後の記事リンク -->
        <nav class="post-navigation" aria-label="<?php esc_attr_e( '投稿ナビゲーション', 'hospital-theme' ); ?>">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            if ( $prev_post ) :
            ?>
            <div class="post-nav-prev">
                <span class="nav-label">← <?php esc_html_e( '前の記事', 'hospital-theme' ); ?></span>
                <a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
                    <?php echo esc_html( get_the_title( $prev_post ) ); ?>
                </a>
            </div>
            <?php endif; ?>
            <?php if ( $next_post ) : ?>
            <div class="post-nav-next">
                <span class="nav-label"><?php esc_html_e( '次の記事', 'hospital-theme' ); ?> →</span>
                <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
                    <?php echo esc_html( get_the_title( $next_post ) ); ?>
                </a>
            </div>
            <?php endif; ?>
        </nav>

        <!-- コメント -->
        <?php if ( comments_open() || get_comments_number() ) : ?>
        <div class="comments-section">
            <?php comments_template(); ?>
        </div>
        <?php endif; ?>

        <?php endwhile; ?>

    </main><!-- .main-content -->

    <?php get_sidebar(); ?>
</div><!-- .site-content -->

<?php get_footer(); ?>
