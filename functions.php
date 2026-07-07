<?php
function my_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ));
}
add_action("after_setup_theme", "my_setup");


function my_script_init() {
    wp_enqueue_style("font-awesome", 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css', array(), "5.8.2", 'all');
    $css_path = get_theme_file_path('/css/style.css');
    $js_path  = get_theme_file_path('/js/script.js');
    wp_enqueue_style("my", get_template_directory_uri() . "/css/style.css", array(), file_exists($css_path) ? filemtime($css_path) : null, 'all');
    wp_enqueue_script("my", get_template_directory_uri() . "/js/script.js", array("jquery"), file_exists($js_path) ? filemtime($js_path) : null, true);
}
add_action("wp_enqueue_scripts", "my_script_init");


/**
 * メニューの登録
 */
function my_menu_init() {
  register_nav_menus(
    array(
      'global' => 'ヘッダーメニュー',
      'drawer' => 'ドロワーメニュー',
    )
  );
}
add_action('init', 'my_menu_init');


/**
 * アーカイブタイトル書き換え
 */
function my_archive_title($title) {

  if (is_category()) { // カテゴリーアーカイブの場合
    $title = single_cat_title('', false);
  } elseif (is_tag()) { // タグアーカイブの場合
    $title = single_tag_title('', false);
  } elseif (is_post_type_archive()) { // 投稿タイプのアーカイブの場合
    $title = post_type_archive_title('', false);
  } elseif (is_tax()) { // タームアーカイブの場合
    $title = single_term_title('', false);
  } elseif (is_author()) { // 作者アーカイブの場合
    $title = get_the_author();
  } elseif (is_date()) { // 日付アーカイブの場合
    $title = '';
    if (get_query_var('year')) {
      $title .= get_query_var('year') . '年';
    }
    if (get_query_var('monthnum')) {
      $title .= get_query_var('monthnum') . '月';
    }
    if (get_query_var('day')) {
      $title .= get_query_var('day') . '日';
    }
  }
  return $title;
}
add_filter('get_the_archive_title', 'my_archive_title');
?>
