<?php
/**
 * アーカイブページテンプレート（カテゴリ・タグ・投稿タイプアーカイブなど）
 *
 * @package hospital-theme
 */

get_header();
hospital_breadcrumbs();
?>

<!-- アーカイブヘッダー -->
<div class="page-header-section">
    <div class="container">
        <h1><?php the_archive_title(); ?></h1>
        <?php
        $description = get_the_archive_description();
        if ( $description ) :
        ?>
        <p><?php echo wp_kses_post( $description ); ?></p>
        <?php endif; ?>
    </div>
</div>

<div class="site-content" id="main-content">
    <main class="main-content" role="main">

        <?php if ( have_posts() ) : ?>

            <?php if ( is_post_type_archive( 'doctor' ) || is_tax( 'doctor_department' ) ) : ?>
                <!-- 医師一覧 -->
                <div class="doctors-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        $dept_terms = get_the_terms( get_the_ID(), 'doctor_department' );
                        $specialty  = get_post_meta( get_the_ID(), '_doctor_specialty', true );
                    ?>
                    <article class="doctor-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'hospital-doctor', [ 'loading' => 'lazy' ] ); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" style="text-decoration:none;">
                                <div style="height:200px;background:var(--color-accent);display:flex;align-items:center;justify-content:center;font-size:4rem;" aria-hidden="true">👨‍⚕️</div>
                            </a>
                        <?php endif; ?>
                        <div class="doctor-info">
                            <?php if ( $dept_terms && ! is_wp_error( $dept_terms ) ) : ?>
                                <p class="doctor-dept"><?php echo esc_html( $dept_terms[0]->name ); ?></p>
                            <?php endif; ?>
                            <h2 style="font-size:1.05rem;"><a href="<?php the_permalink(); ?>" style="color:var(--color-text);"><?php the_title(); ?></a></h2>
                            <?php if ( $specialty ) : ?>
                                <p><?php echo esc_html( $specialty ); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

            <?php elseif ( is_post_type_archive( 'department' ) ) : ?>
                <!-- 診療科一覧 -->
                <div class="departments-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        $icon = get_post_meta( get_the_ID(), '_department_icon', true );
                    ?>
                    <a href="<?php the_permalink(); ?>" class="department-card" style="text-decoration:none;">
                        <div class="dept-icon"><?php echo $icon ? esc_html( $icon ) : '🏥'; ?></div>
                        <h2 style="font-size:1rem;"><?php the_title(); ?></h2>
                        <?php if ( has_excerpt() ) : ?>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '…' ) ); ?></p>
                        <?php endif; ?>
                    </a>
                    <?php endwhile; ?>
                </div>

            <?php else : ?>
                <!-- 通常の投稿アーカイブ（ブログ・お知らせ） -->
                <div class="news-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        hospital_post_card();
                    endwhile;
                    ?>
                </div>
            <?php endif; ?>

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
