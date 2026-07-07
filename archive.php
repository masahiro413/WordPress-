<?php get_header(); ?>

<!-- content -->
<div id="content">
  <div class="inner">

  <!-- primary -->
    <main id="primary">

<?php if (function_exists('bcn_display')) : ?>
<!-- breadcrumb -->
<div class="breadcrumb">
  <?php bcn_display(); // BreadcrumbNavXTのパンくずを表示するための記述 ?>
</div><!-- /breadcrumb -->
<?php endif; ?>

<div class="archive-head m_description">
  <div class="archive-lead">ARCHIVE</div>
  <h1 class="archive-title m_category"><?php the_archive_title(); // 一覧ページ名を表示 ?></h1><!-- /archive-title -->
  <div class="archive-description">
    <p>
     <?php the_archive_description();  ?>
    </p>
  </div><!-- /archive-description -->
</div><!-- /archive-head -->

<!-- entries -->
<div class="entries m_horizontal">

  <?php if (have_posts()) : // 記事があれば表示 ?>
    <?php while(have_posts()) : // 記事数分ループ ?>
      <?php the_post(); ?>
      <!-- entry-item -->
      <a href="<?php the_permalink();  // 記事のリンクを表示 ?>" class="entry-item">
        <!-- entry-item-img -->
        <div class="entry-item-img">
          <?php if(has_post_thumbnail()): // アイキャッチ画像が設定されてれば表示 ?>
          <?php the_post_thumbnail(); ?>
          <?php else : // なければimage画像をデフォルトで表示 ?>
          <img src="<?php echo get_template_directory_uri(); ?>/img/img.png" alt="">
          <?php endif; ?>
        </div><!-- /entry-item-img -->

        <!-- entry-item-body -->
        <div class="entry-item-body">
          <div class="entry-item-meta">
              <?php // カテゴリー１つ目の名前を表示 ?>
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

</div><!-- /entries -->

<?php if(paginate_links()) : //ページが1ページ以上あれば以下を表示 ?>
<!-- pagination -->
<div class="pagination">
  <?php
  echo paginate_links(
    array(
      'end_size' => 1,
      'mid_size' => 1,
      'prev_next' => true,
      'prev_text' => '<i class="fas fa-angle-left"></i>',
      'next_text' => '<i class="fas fa-angle-right"></i>',
    )
  );
  ?>
</div><!-- /pagination -->
<?php endif; ?>

    </main><!-- /primary -->
  </div><!-- /inner -->
</div><!-- /content -->

<?php get_footer(); ?>
