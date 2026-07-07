<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns#">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">

	<meta property="og:title" content="みなと歯科クリニック">
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://example.com/">
	<meta property="og:image" content="https://example.com/img/ogp.png">
	<meta property="og:site_name" content="みなと歯科クリニック">
	<meta property="og:description" content="">
	<meta name="twitter:card" content="summary_large_image">

	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/icon-home.png">

	<?php wp_head(); ?>
</head>

<body>

	<!-- header -->
	<header id="header">
		<div class="inner">

			<?php if (is_front_page()) : // トップページではロゴをh1に、それ以外のページではdivに。 ?>
			<h1 class="header-logo"><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1><!-- /header-logo -->
			<?php else : ?>
			<div class="header-logo"><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></div><!-- /header-logo -->
			<?php endif; ?>
			<div class="header-sub"><?php bloginfo('description'); // ブログのdescriptionを表示 ?></div><!-- /header-sub -->

			<!-- drawer -->
			<div class="drawer">
				<div class="drawer-icon">
					<span class="drawer-open"><i class="fas fa-bars"></i></span><!-- /drawer-open -->
					<span class="drawer-close"><i class="fas fa-times"></i></span><!-- drawer-close -->
				</div><!-- /drawer-icon -->

				<!-- drawer-content -->
				<div class="drawer-content">
					<nav class="drawer-nav">
						<?php
							wp_nav_menu(
								array(
									'depth'          => 1,
									'theme_location' => 'drawer', // ドロワーメニューをここに表示すると指定
									'container'      => '',
									'menu_class'     => 'drawer-list'
								)
							);
						?>
					</nav>
				</div><!-- /drawer-content -->
			</div><!-- /drawer -->

		</div><!-- /inner -->
	</header><!-- /header -->

	<!-- entry -->
	<article class="entry">

	・
	・
	・
	</article> <!-- /entry -->

	<?php wp_footer(); ?>
</body>

</html>
