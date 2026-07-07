<?php get_header(); ?>

	<!-- header-nav -->
	<nav class="header-nav">
		<div class="inner">
			<?php
				wp_nav_menu(
					array(
						'depth'          => 1,
						'theme_location' => 'global', // グローバルメニューをここに表示すると指定
						'container'      => '',
						'menu_class'     => 'header-list'
					)
				);
			?>
		</div><!-- /inner -->
	</nav><!-- header-nav -->


	<!-- pickup -->
	<div id="pickup">
		<div class="inner">

			<div class="pickup-items">

				<a href="#" class="pickup-item">
					<div class="pickup-item-img">
						<img src="<?php echo get_template_directory_uri(); ?>/img/pickup1.png" alt="">
						<div class="pickup-item-tag">初診の方へ</div><!-- /pickup-item-tag -->
					</div><!-- /pickup-item-img -->
					<div class="pickup-item-body">
						<h2 class="pickup-item-title">はじめての歯科受診でも安心。丁寧なカウンセリングで不安を解消します</h2><!-- /pickup-item-title -->
					</div><!-- /pickup-item-body -->
				</a><!-- /pickup-item -->

				<a href="#" class="pickup-item">
					<div class="pickup-item-img">
						<img src="<?php echo get_template_directory_uri(); ?>/img/pickup2.png" alt="">
						<div class="pickup-item-tag">虫歯・歯周病</div><!-- /pickup-item-tag -->
					</div><!-- /pickup-item-img -->
					<div class="pickup-item-body">
						<h2 class="pickup-item-title">早期発見・早期治療で、大切な歯をできるだけ残す治療を行います</h2><!-- /pickup-item-title -->
					</div><!-- /pickup-item-body -->
				</a><!-- /pickup-item -->

				<a href="#" class="pickup-item">
					<div class="pickup-item-img">
						<img src="<?php echo get_template_directory_uri(); ?>/img/pickup3.png" alt="">
						<div class="pickup-item-tag">予防歯科</div><!-- /pickup-item-tag -->
					</div><!-- /pickup-item-img -->
					<div class="pickup-item-body">
						<h2 class="pickup-item-title">定期検診とクリーニングで、むし歯・歯周病を未然に防ぎましょう</h2><!-- /pickup-item-title -->
					</div><!-- /pickup-item-body -->
				</a><!-- /pickup-item -->

			</div><!-- /pickup-items -->

		</div><!-- /inner -->
	</div><!-- /pickup -->


	<!-- content -->
	<div id="content">
		<div class="inner">

			<!-- primary -->
			<main id="primary">

				<!-- entries -->
				<div class="entries">
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>

						<!-- entry-item -->
						<a href="<?php the_permalink(); // 記事のリンクを表示 ?>" class="entry-item">
							<!-- entry-item-img -->
							<div class="entry-item-img">
								<?php if (has_post_thumbnail()) : // アイキャッチ画像が設定されてれば表示 ?>
								<?php the_post_thumbnail(); ?>
								<?php else : // なければno　image画像をデフォルトで表示 ?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/no　img.png" alt="">
								<?php endif; ?>
							</div><!-- /entry-item-img -->

							<!-- entry-item-body -->
							<div class="entry-item-body">
								<div class="entry-item-meta">
									<?php $category = get_the_category(); ?>
									<?php if ($category[0]) : ?>
									<div class="entry-item-tag"><?php echo $category[0]->cat_name; ?></div><!-- /entry-item-tag -->
									<?php endif; ?>
									<?php // 公開日時を動的に表示する ?>
									<time class="entry-item-published" datetime="<?php the_time('c'); ?>"><?php the_time('Y/n/j'); ?></time><!-- /entry-item-published -->
								</div><!-- /entry-item-meta -->
								<h2 class="entry-item-title"><?php the_title(); // タイトルを表示 ?></h2><!-- /entry-item-title -->
								<div class="entry-item-excerpt">
									<p><?php the_excerpt(); // 抜粋を表示 ?></p>
								</div><!-- /entry-item-excerpt -->
							</div><!-- /entry-item-body -->
						</a><!-- /entry-item -->

						<?php endwhile; ?>
					<?php endif; ?>

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry2.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry3.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry4.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry5.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry6.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry7.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry8.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry9.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

					<!-- entry-item -->
					<a href="#" class="entry-item">
						<div class="entry-item-img">
							<img src="<?php echo get_template_directory_uri(); ?>/img/entry10.png" alt="">
						</div><!-- /entry-item-img -->
						<div class="entry-item-body">
							<div class="entry-item-meta">
								<div class="entry-item-tag">カテゴリ名</div><!-- /entry-item-tag -->
								<time class="entry-item-published" datetime="2019-01-01">2019/1/1</time><!-- /entry-item-published -->
							</div><!-- /entry-item-meta -->
							<h2 class="entry-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</h2><!-- /entry-item-title -->
							<div class="entry-item-excerpt">
								<p>文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入ります文章の一部が入…</p>
							</div><!-- /entry-item-excerpt -->
						</div><!-- /entry-item-body -->
					</a><!-- /entry-item -->

				</div><!-- /entries -->

				<!-- pagination -->
				<?php if (paginate_links()) : // ページが1ページ以上あれば以下を表示 ?>
				<div class="pagination">
					<?php
					echo paginate_links(
						array(
							'end_size'  => 1,
							'mid_size'  => 1,
							'prev_next' => true,
							'prev_text' => '<i class="fas fa-angle-left"></i>',
							'next_text' => '<i class="fas fa-angle-right"></i>',
						)
					);
					?>
				</div><!-- /pagination -->
				<?php endif; ?>

			</main><!-- /primary -->

			<!-- secondary -->
			<aside id="secondary">

				<!-- widget -->
				<div class="widget widget_text widget_custom_html">
					<div class="widget-title">院長紹介</div>

					<div class="profile">
						<div class="profile-img"><img src="<?php echo get_template_directory_uri(); ?>/img/profile.png" alt=""></div>
						<div class="profile-content">
							<p>
								日本医科歯科大学卒業。大学病院で10年勤務。子供から高齢者まで、幅広い世代のお口の健康をサポートします。
							</p>
						</div><!-- /profile-content -->
						<nav class="profile-sns">
							<div class="profile-sns-item m_twitter"><a href="" rel="noopener noreferrer" target="_blank"><i class="fab fa-twitter"></i></a></div>
							<div class="profile-sns-item m_facebook"><a href="" rel="noopener noreferrer" target="_blank"><i class="fab fa-facebook-f"></i></a></div>
							<div class="profile-sns-item m_instagram"><a href="" rel="noopener noreferrer" target="_blank"><i class="fab fa-instagram"></i></a></div>
						</nav>
					</div><!-- /profile -->
				</div><!-- /widget -->


				<!-- widget -->
				<div class="widget widget_search">
					<div class="widget-title">症状・診療内容を検索</div>
					<form method="get" class="search-form" action="#">
						<input type="search" class="search-field" value="" placeholder="キーワード" name="s" id="s">
						<button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
					</form><!-- /search-form -->
				</div><!-- /widget -->


				<!-- widget -->
				<div class="widget widget_popular">
					<div class="widget-title">よく読まれている診療案内</div>

					<div class="post-items m_ranking">

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry2.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry1.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry3.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry4.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry5.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

					</div><!-- /post-items -->
				</div><!-- /widget -->


				<!-- widget -->
				<div class="widget widget_recent">
					<div class="widget-title">最新のお知らせ</div>

					<div class="post-items">

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry7.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry6.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry10.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry7.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

						<a class="post-item" href="#">
							<div class="post-item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/entry9.png" alt=""></div>
							<div class="post-item-body">
								<div class="post-item-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります</div>
							</div><!-- /post-item-body -->
						</a><!-- /post-item -->

					</div><!-- /post-items -->
				</div><!-- /widget -->

				<div class="widget widget_archive">
					<div class="widget-title">過去のお知らせ</div>
					<ul>
						<li><a href="#">医療</a></li>
						<li><a href="#">健康</a></li>
						<li><a href="#">イベント</a></li>
					</ul>
				</div><!-- /widget -->

			</aside><!-- secondary -->

		</div><!-- /inner -->
	</div><!-- /content -->

	<!-- footer-menu -->
	<div id="footer-menu">
		<div class="inner">
			<div class="footer-logo"><a href="/">みなと歯科クリニック</a></div><!-- /footer-logo -->
			<div class="footer-sub">痛みに配慮した、通いやすい地域のかかりつけ歯科</div><!-- /footer-sub -->

			<nav class="footer-nav">
				<ul class="footer-list">
					<li class="menu-item"><a href="#">初めての方へ</a></li>
					<li class="menu-item"><a href="#">診療案内</a></li>
					<li class="menu-item"><a href="#">医院紹介</a></li>
					<li class="menu-item"><a href="#">料金・保険</a></li>
					<li class="menu-item"><a href="#">アクセス・予約</a></li>
				</ul>
			</nav>

		</div><!-- /inner -->
	</div><!-- /footer-menu -->


	<!-- footer -->
	<footer id="footer">
		<div class="inner">
			<div class="copy">&copy; Minato Dental Clinic All rights reserved.</div><!-- /copy -->
			<div class="by">Presented by <a href="#">みなと歯科クリニック</a></div><!-- /by -->
		</div><!-- /inner -->
	</footer><!-- /footer -->

	<div class="floating">
		<a href="#"><i class="fas fa-chevron-up"></i></a>
	</div>

    <?php wp_footer(); ?>
</body>

</html>
