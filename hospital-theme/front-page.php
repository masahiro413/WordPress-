<?php
/**
 * トップページテンプレート（フロントページ）
 *
 * @package hospital-theme
 */

get_header();
?>

<!-- ヒーローセクション -->
<section class="hero-section" role="banner" aria-label="<?php esc_attr_e( 'ヒーロー', 'hospital-theme' ); ?>">
    <div class="container">
        <h1>
            <?php echo hospital_get_info( 'hospital_name', esc_html( get_bloginfo( 'name' ) ) ); ?>
        </h1>
        <p>
            <?php echo hospital_get_info( 'hospital_tagline', esc_html( get_bloginfo( 'description' ) ) ); ?>
        </p>
        <div class="hero-buttons">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'department' ) ); ?>" class="btn btn-primary">
                📋 <?php esc_html_e( '診療科を見る', 'hospital-theme' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/access/' ) ); ?>" class="btn btn-outline">
                📍 <?php esc_html_e( 'アクセス・受付時間', 'hospital-theme' ); ?>
            </a>
        </div>
    </div>
</section>

<!-- 基本情報 -->
<section class="home-section" aria-label="<?php esc_attr_e( '病院基本情報', 'hospital-theme' ); ?>">
    <div class="container">
        <div class="info-boxes">
            <div class="info-box">
                <h3>🕐 <?php esc_html_e( '診療時間', 'hospital-theme' ); ?></h3>
                <p><?php echo hospital_get_info( 'hospital_hours', '平日 9:00〜17:00 / 土曜 9:00〜12:00（日祝休診）' ); ?></p>
            </div>
            <div class="info-box">
                <h3>📞 <?php esc_html_e( '電話番号', 'hospital-theme' ); ?></h3>
                <p>
                    <?php esc_html_e( '代表:', 'hospital-theme' ); ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', get_theme_mod( 'hospital_phone', '000-000-0000' ) ) ); ?>">
                        <?php echo hospital_get_info( 'hospital_phone', '000-000-0000' ); ?>
                    </a>
                    <br>
                    <?php
                    $emergency = get_theme_mod( 'hospital_emergency', '' );
                    if ( $emergency ) :
                    ?>
                    <?php esc_html_e( '救急:', 'hospital-theme' ); ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $emergency ) ); ?>">
                        <?php echo esc_html( $emergency ); ?>
                    </a>
                    <?php endif; ?>
                </p>
            </div>
            <div class="info-box">
                <h3>📍 <?php esc_html_e( '所在地', 'hospital-theme' ); ?></h3>
                <p><?php echo hospital_get_info( 'hospital_address', '〒000-0000 ○○県○○市○○町1-1' ); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- 診療科 -->
<?php
$departments = new WP_Query(
    [
        'post_type'      => 'department',
        'posts_per_page' => 8,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]
);
?>
<section class="home-section" aria-label="<?php esc_attr_e( '診療科', 'hospital-theme' ); ?>">
    <div class="container">
        <div class="section-heading">
            <h2><?php esc_html_e( '診療科', 'hospital-theme' ); ?></h2>
            <p><?php esc_html_e( '各診療科の専門医が丁寧に診察いたします', 'hospital-theme' ); ?></p>
        </div>

        <div class="departments-grid">
            <?php if ( $departments->have_posts() ) : ?>
                <?php while ( $departments->have_posts() ) : $departments->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="department-card" style="text-decoration:none;">
                        <div class="dept-icon">
                            <?php
                            $icon = get_post_meta( get_the_ID(), '_department_icon', true );
                            echo $icon ? esc_html( $icon ) : '🏥';
                            ?>
                        </div>
                        <h3><?php the_title(); ?></h3>
                        <?php if ( has_excerpt() ) : ?>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '…' ) ); ?></p>
                        <?php endif; ?>
                    </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- サンプル診療科（投稿が登録されていない場合） -->
                <?php
                $sample_depts = [
                    [ 'icon' => '🫀', 'name' => '内科',         'desc' => '一般内科・生活習慣病' ],
                    [ 'icon' => '🦷', 'name' => '外科',         'desc' => '消化器・腹部外科' ],
                    [ 'icon' => '🧠', 'name' => '脳神経内科',   'desc' => '脳・神経疾患' ],
                    [ 'icon' => '🦴', 'name' => '整形外科',     'desc' => '骨・関節・リハビリ' ],
                    [ 'icon' => '👁', 'name' => '眼科',         'desc' => '眼疾患・白内障' ],
                    [ 'icon' => '👂', 'name' => '耳鼻咽喉科',   'desc' => '耳・鼻・喉の疾患' ],
                    [ 'icon' => '🤱', 'name' => '産婦人科',     'desc' => '妊娠・出産・婦人科' ],
                    [ 'icon' => '🧒', 'name' => '小児科',       'desc' => '子ども・乳幼児医療' ],
                ];
                foreach ( $sample_depts as $dept ) :
                ?>
                <div class="department-card">
                    <div class="dept-icon"><?php echo esc_html( $dept['icon'] ); ?></div>
                    <h3><?php echo esc_html( $dept['name'] ); ?></h3>
                    <p><?php echo esc_html( $dept['desc'] ); ?></p>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'department' ) ); ?>" class="btn btn-primary">
                <?php esc_html_e( '診療科一覧を見る', 'hospital-theme' ); ?>
            </a>
        </div>
    </div>
</section>

<!-- 医師紹介 -->
<?php
$doctors = new WP_Query(
    [
        'post_type'      => 'doctor',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]
);
?>
<section class="home-section" aria-label="<?php esc_attr_e( '医師紹介', 'hospital-theme' ); ?>">
    <div class="container">
        <div class="section-heading">
            <h2><?php esc_html_e( '医師紹介', 'hospital-theme' ); ?></h2>
            <p><?php esc_html_e( '経験豊富な医師が皆様の健康をサポートします', 'hospital-theme' ); ?></p>
        </div>

        <div class="doctors-grid">
            <?php if ( $doctors->have_posts() ) : ?>
                <?php while ( $doctors->have_posts() ) : $doctors->the_post(); ?>
                    <article class="doctor-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'hospital-doctor', [ 'loading' => 'lazy' ] ); ?>
                        <?php else : ?>
                            <div class="doctor-avatar" aria-hidden="true" style="display:flex;align-items:center;justify-content:center;height:200px;background:var(--color-accent);font-size:4rem;">👨‍⚕️</div>
                        <?php endif; ?>
                        <div class="doctor-info">
                            <?php
                            $dept_terms = get_the_terms( get_the_ID(), 'doctor_department' );
                            if ( $dept_terms && ! is_wp_error( $dept_terms ) ) :
                            ?>
                            <p class="doctor-dept"><?php echo esc_html( $dept_terms[0]->name ); ?></p>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <?php
                            $specialty = get_post_meta( get_the_ID(), '_doctor_specialty', true );
                            if ( $specialty ) :
                            ?>
                            <p><?php echo esc_html( $specialty ); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- サンプル医師カード -->
                <?php
                $sample_doctors = [
                    [ 'emoji' => '👨‍⚕️', 'dept' => '内科', 'name' => '山田 太郎 先生', 'spec' => '一般内科・糖尿病専門' ],
                    [ 'emoji' => '👩‍⚕️', 'dept' => '小児科', 'name' => '鈴木 花子 先生', 'spec' => '小児科・アレルギー専門' ],
                    [ 'emoji' => '👨‍⚕️', 'dept' => '整形外科', 'name' => '田中 一郎 先生', 'spec' => '整形外科・スポーツ医学' ],
                    [ 'emoji' => '👩‍⚕️', 'dept' => '眼科', 'name' => '佐藤 美咲 先生', 'spec' => '眼科・白内障手術' ],
                ];
                foreach ( $sample_doctors as $doc ) :
                ?>
                <article class="doctor-card">
                    <div style="height:200px;background:var(--color-accent);display:flex;align-items:center;justify-content:center;font-size:4rem;" aria-hidden="true"><?php echo esc_html( $doc['emoji'] ); ?></div>
                    <div class="doctor-info">
                        <p class="doctor-dept"><?php echo esc_html( $doc['dept'] ); ?></p>
                        <h3><?php echo esc_html( $doc['name'] ); ?></h3>
                        <p><?php echo esc_html( $doc['spec'] ); ?></p>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'doctor' ) ); ?>" class="btn btn-primary">
                <?php esc_html_e( '医師一覧を見る', 'hospital-theme' ); ?>
            </a>
        </div>
    </div>
</section>

<!-- 最新のお知らせ・ブログ -->
<?php
$latest_posts = new WP_Query(
    [
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
    ]
);
?>
<section class="home-section" aria-label="<?php esc_attr_e( 'お知らせ・ブログ', 'hospital-theme' ); ?>">
    <div class="container">
        <div class="section-heading">
            <h2><?php esc_html_e( 'お知らせ・ブログ', 'hospital-theme' ); ?></h2>
            <p><?php esc_html_e( '病院からの最新情報をお届けします', 'hospital-theme' ); ?></p>
        </div>

        <div class="news-grid">
            <?php if ( $latest_posts->have_posts() ) : ?>
                <?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
                    <?php hospital_post_card(); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p style="grid-column:1/-1; text-align:center; color:var(--color-text-light);">
                    <?php esc_html_e( 'まだ投稿がありません。', 'hospital-theme' ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn-primary">
                <?php esc_html_e( 'すべての記事を見る', 'hospital-theme' ); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
