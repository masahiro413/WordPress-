<?php
/**
 * 診療科詳細ページテンプレート
 *
 * @package hospital-theme
 */

get_header();
hospital_breadcrumbs();
?>

<!-- ページヘッダー -->
<div class="page-header-section">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <?php if ( has_excerpt() ) : ?>
            <p><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php endif; ?>
    </div>
</div>

<div class="site-content" id="main-content">
    <main class="main-content" role="main">

        <?php
        while ( have_posts() ) :
            the_post();
            $icon = get_post_meta( get_the_ID(), '_department_icon', true );
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'department-single' ); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'full', [ 'class' => 'entry-thumbnail', 'loading' => 'lazy' ] ); ?>
            <?php elseif ( $icon ) : ?>
                <div style="text-align:center;font-size:5rem;padding:20px 0;" aria-hidden="true"><?php echo esc_html( $icon ); ?></div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <!-- この診療科の医師 -->
            <?php
            $dept_name  = get_the_title();
            $dept_slug  = get_post_field( 'post_name' );
            $dept_doctors = new WP_Query(
                [
                    'post_type'      => 'doctor',
                    'posts_per_page' => 8,
                    'post_status'    => 'publish',
                    'tax_query'      => [
                        [
                            'taxonomy' => 'doctor_department',
                            'field'    => 'slug',
                            'terms'    => $dept_slug,
                        ],
                    ],
                ]
            );
            if ( $dept_doctors->have_posts() ) :
            ?>
            <div style="margin-top:40px;padding-top:24px;border-top:2px solid var(--color-border);">
                <h2 style="font-family:var(--font-heading);font-size:1.3rem;color:var(--color-primary);margin-bottom:20px;">
                    <?php esc_html_e( '担当医師', 'hospital-theme' ); ?>
                </h2>
                <div class="doctors-grid">
                    <?php
                    while ( $dept_doctors->have_posts() ) :
                        $dept_doctors->the_post();
                        $specialty = get_post_meta( get_the_ID(), '_doctor_specialty', true );
                    ?>
                    <article class="doctor-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'hospital-doctor', [ 'loading' => 'lazy' ] ); ?>
                            </a>
                        <?php else : ?>
                            <div style="height:160px;background:var(--color-accent);display:flex;align-items:center;justify-content:center;font-size:3.5rem;" aria-hidden="true">👨‍⚕️</div>
                        <?php endif; ?>
                        <div class="doctor-info">
                            <h3><a href="<?php the_permalink(); ?>" style="color:var(--color-text);"><?php the_title(); ?></a></h3>
                            <?php if ( $specialty ) : ?>
                                <p><?php echo esc_html( $specialty ); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endif; ?>

        </article>
        <?php endwhile; ?>

    </main>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
