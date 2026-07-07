<?php
/**
 * 医師詳細ページテンプレート
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
            $title      = get_post_meta( get_the_ID(), '_doctor_title', true );
            $specialty  = get_post_meta( get_the_ID(), '_doctor_specialty', true );
            $experience = get_post_meta( get_the_ID(), '_doctor_experience', true );
            $schedule   = get_post_meta( get_the_ID(), '_doctor_schedule', true );
            $dept_terms = get_the_terms( get_the_ID(), 'doctor_department' );
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'doctor-single' ); ?>>
            <div style="display:flex; gap:32px; flex-wrap:wrap; margin-bottom:32px;">
                <div style="flex:0 0 240px;">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'hospital-doctor', [ 'style' => 'width:100%;border-radius:var(--border-radius);', 'loading' => 'lazy' ] ); ?>
                    <?php else : ?>
                        <div style="width:100%;height:280px;background:var(--color-accent);display:flex;align-items:center;justify-content:center;font-size:6rem;border-radius:var(--border-radius);" aria-hidden="true">👨‍⚕️</div>
                    <?php endif; ?>
                </div>
                <div style="flex:1 1 260px;">
                    <?php if ( $dept_terms && ! is_wp_error( $dept_terms ) ) : ?>
                        <p style="color:var(--color-secondary);font-weight:700;font-size:0.88rem;margin-bottom:6px;"><?php echo esc_html( $dept_terms[0]->name ); ?></p>
                    <?php endif; ?>
                    <h1 class="entry-title" style="margin-bottom:4px;"><?php the_title(); ?></h1>
                    <?php if ( $title ) : ?>
                        <p style="color:var(--color-text-light);margin-bottom:16px;"><?php echo esc_html( $title ); ?></p>
                    <?php endif; ?>

                    <table style="width:100%;font-size:0.9rem;border-collapse:collapse;">
                        <?php if ( $specialty ) : ?>
                        <tr>
                            <th style="text-align:left;padding:8px 12px 8px 0;color:var(--color-text-light);white-space:nowrap;font-weight:600;width:100px;"><?php esc_html_e( '専門分野', 'hospital-theme' ); ?></th>
                            <td style="padding:8px 0;"><?php echo esc_html( $specialty ); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ( $schedule ) : ?>
                        <tr>
                            <th style="text-align:left;padding:8px 12px 8px 0;color:var(--color-text-light);white-space:nowrap;font-weight:600;"><?php esc_html_e( '担当曜日', 'hospital-theme' ); ?></th>
                            <td style="padding:8px 0;"><?php echo esc_html( $schedule ); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <?php if ( $experience ) : ?>
            <div style="background:var(--color-accent);padding:20px 24px;border-radius:var(--border-radius);margin-bottom:24px;">
                <h2 style="font-size:1rem;color:var(--color-primary);margin-bottom:10px;"><?php esc_html_e( '経歴・資格', 'hospital-theme' ); ?></h2>
                <p style="font-size:0.9rem;white-space:pre-line;"><?php echo esc_html( $experience ); ?></p>
            </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        </article>
        <?php endwhile; ?>

    </main>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
