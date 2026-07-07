<footer class="site-footer" role="contentinfo">
    <div class="footer-inner">
        <div class="footer-brand">
            <p class="site-name">
                🏥 <?php echo hospital_get_info( 'hospital_name', esc_html( get_bloginfo( 'name' ) ) ); ?>
            </p>
            <p>
                <?php echo hospital_get_info( 'hospital_address', '〒000-0000 ○○県○○市' ); ?><br>
                <?php esc_html_e( 'TEL:', 'hospital-theme' ); ?>
                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', get_theme_mod( 'hospital_phone', '000-000-0000' ) ) ); ?>" style="color: rgba(255,255,255,0.8);">
                    <?php echo hospital_get_info( 'hospital_phone', '000-000-0000' ); ?>
                </a>
            </p>
            <p style="margin-top:8px; font-size:0.82rem;">
                <?php esc_html_e( '診療時間:', 'hospital-theme' ); ?>
                <?php echo hospital_get_info( 'hospital_hours', '平日 9:00〜17:00' ); ?>
            </p>
        </div>

        <div class="footer-col">
            <h4><?php esc_html_e( '診療について', 'hospital-theme' ); ?></h4>
            <ul>
                <li><a href="<?php echo esc_url( get_post_type_archive_link( 'department' ) ); ?>"><?php esc_html_e( '診療科一覧', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( get_post_type_archive_link( 'doctor' ) ); ?>"><?php esc_html_e( '医師紹介', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/outpatient/' ) ); ?>"><?php esc_html_e( '外来診療', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/inpatient/' ) ); ?>"><?php esc_html_e( '入院のご案内', 'hospital-theme' ); ?></a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4><?php esc_html_e( '患者の方へ', 'hospital-theme' ); ?></h4>
            <ul>
                <li><a href="<?php echo esc_url( home_url( '/first-visit/' ) ); ?>"><?php esc_html_e( '初めての方へ', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'よくある質問', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/access/' ) ); ?>"><?php esc_html_e( 'アクセス・地図', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'ブログ・お知らせ', 'hospital-theme' ); ?></a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4><?php esc_html_e( '病院について', 'hospital-theme' ); ?></h4>
            <ul>
                <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( '病院概要', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/philosophy/' ) ); ?>"><?php esc_html_e( '診療理念', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'プライバシーポリシー', 'hospital-theme' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'お問い合わせ', 'hospital-theme' ); ?></a></li>
            </ul>
        </div>
    </div><!-- .footer-inner -->

    <div class="footer-bottom">
        <p>
            &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
            <?php echo hospital_get_info( 'hospital_name', esc_html( get_bloginfo( 'name' ) ) ); ?>.
            <?php esc_html_e( 'All Rights Reserved.', 'hospital-theme' ); ?>
        </p>
    </div>
</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
