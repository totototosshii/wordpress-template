<?php

/**
 * WordPress.org Forums
 * @link https://ja.wordpress.org/support/
 * テンプレート階層
 * @link https://wphierarchy.com/
 */

/**
 * テーマのセットアップ
 */
function my_setup()
{
  add_theme_support('title-tag'); // タイトルタグの出力
  add_theme_support('post-thumbnails'); // アイキャッチを有効化
  add_theme_support('automatic-feed-links'); // RSSリンクの出力
  add_theme_support( // HTML5形式で出力
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );
  // カスタムロゴの有効化
  $logo_width  = 300;
  $logo_height = 100;
  add_theme_support(
    'custom-logo',
    array(
      'width'                => $logo_width,
      'height'               => $logo_height,
      'flex-width'           => true,
      'flex-height'          => true,
      'unlink-homepage-logo' => false,
    )
  );
  /**
   * カスタムメニューの有効化
   * @link https://www.webdesignleaves.com/pr/wp/wp_nav_menus.html
   */
  register_nav_menus(
    array(
      'header' => 'ヘッダーナビゲーション',
      'footer' => 'フッターナビゲーション',
      'drawer' => 'ドロワーナビゲーション',
    )
  );
}
add_action('after_setup_theme', 'my_setup');

/**
 * CSSとJavaScriptの読み込み
 */
function my_script_init()
{
  // WordPress本体のjQueryを読み込まない
  wp_deregister_script('jquery');
  // jQueryをCDNから読み込む
  wp_enqueue_script(
    'jquery',
    '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js',
    array(),
    '3.6.0',
    true // wp_footer()の位置で出力
  );

  // Google Fonts(2つ以上ある場合は1つずつ書く)
  // wp_enqueue_style('NotoSans',
  //   '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap'
  // );
  // wp_enqueue_style('Lexend',
  //   '//fonts.googleapis.com/css2?family=Lexend+Deca:wght@400;500&display=swap'
  // );

  // トップページのみファイル追加
  // Splideスライダー
  if (is_front_page()) {
    wp_enqueue_style(
      'splide',
      'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css',
      array(),
      "4.1.4",
      'all'
    );
    wp_enqueue_script(
      'splide',
      'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
      array('jquery'),
      "4.1.4",
      true
    );
  }

  // 自作JavaScriptファイルの読み込み
  wp_enqueue_script(
    'bundle-js',
    get_theme_file_uri('/assets/js/bundle.js'),
    array('jquery'), // bundle.jsよりも前に読み込みたいJSファイルの名前を記述
    filemtime(get_theme_file_path('/assets/js/bundle.js')), // 更新時にキャッシュクリア
    true // wp_footer()の位置で出力
  );

  // 自作CSSファイルの読み込み
  wp_enqueue_style(
    'style-css',
    get_theme_file_uri('/assets/css/style.min.css'),
    array(),
    filemtime(get_theme_file_path('/assets/css/style.min.css')), // 更新時にキャッシュクリア
    'all'
  );
}
add_action('wp_enqueue_scripts', 'my_script_init');

/**
 * 不要なタグを削除
 */
remove_action('wp_head', 'rsd_link'); // Really Simple Discovery
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head', 'index_rel_link'); // indexへのリンク
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // 分割ページへのリンク
remove_action('wp_head', 'start_post_rel_link', 10, 0); // 分割ページへのリンク
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // 前後ページへのリンク
remove_action('wp_head', 'print_emoji_detection_script', 7); // 絵文字のJSを削除
remove_action('admin_print_scripts', 'print_emoji_detection_script'); // 管理ページ内絵文字のJSを削除
remove_action('wp_print_styles', 'print_emoji_styles'); // 絵文字のCSSを削除
remove_action('admin_print_styles', 'print_emoji_styles'); // 管理ページ内絵文字のCSSを削除
remove_action('wp_head', 'rest_output_link_wp_head'); // Embed対応
remove_action('wp_head', 'wp_shortlink_wp_head'); // ショートリンクURLを非表示
remove_action('wp_head', 'wp_generator'); // WordPressのバージョンを非表示

/**
 * CSSとJavaScriptのパラメータに付与されるWordPressのバージョンを非表示
 * @link https://qiita.com/blog_bootcamp/items/bcc8c8cb5b63a855ef89
 */
function vc_remove_wp_ver_css_js($src)
{
  if (strpos($src, 'ver=' . get_bloginfo('version')))
    $src = remove_query_arg('ver', $src);
  return $src;
}
add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);

/**
 * 画像に自動で付与されるsrcsetを無効化
 */
add_filter('wp_calculate_image_srcset_meta', '__return_null');

/**
 * SVGファイルをアップロード可能にする
 */
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype($filename, $mimes);
  return [
    'ext' => $filetype['ext'],
    'type' => $filetype['type'],
    'proper_filename' => $data['proper_filename']
  ];
}, 10, 4);
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * 標準メニューを非表示
 * @link https://haniwaman.com/wp-menu-remove/
 */
function remove_menus()
{
  // ダッシュボード
  // remove_menu_page('index.php');
  // 投稿
  // remove_menu_page('edit.php');
  // メディア
  // remove_menu_page('upload.php');
  // 固定
  // remove_menu_page('edit.php?post_type=page');
  // コメント
  remove_menu_page('edit-comments.php');
  // 外観
  // remove_menu_page('themes.php');
  // プラグイン
  // remove_menu_page('plugins.php');
  // ユーザー
  // remove_menu_page('users.php');
  // ツール
  // remove_menu_page('tools.php');
  // 設定
  // remove_menu_page('options-general.php');
}
add_action('admin_menu', 'remove_menus');

/**
 * REST API対策
 * @link https://otamunote.com/wordpress-username-measures/
 */
function my_filter_rest_endpoints($endpoints)
{
  if (isset($endpoints['/wp/v2/users'])) {
    unset($endpoints['/wp/v2/users']);
  }
  if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
  }
  return $endpoints;
}
add_filter('rest_endpoints', 'my_filter_rest_endpoints', 10, 1);

/**
 * ?author=1対策
 * @link https://webst8.com/blog/wordpress-author-setting/
 */
add_filter('author_rewrite_rules', '__return_empty_array');
function disable_author_archive()
{
  if ($_GET['author'] || preg_match('#/author/.+#', $_SERVER['REQUEST_URI'])) {
    wp_redirect(home_url('/404.php'));
    exit;
  }
}
add_action('init', 'disable_author_archive');

/**
 * 自動挿入されるpタグを削除
 */
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

/**
 * アーカイブタイトル書き換え
 */
function my_archive_title($title)
{
  if (is_home()) { /* ホームの場合 */
    $title = '最新記事一覧';
  } elseif (is_category()) { /* カテゴリーアーカイブの場合 */
    $title = '' . single_cat_title('', false) . '';
  } elseif (is_tag()) { /* タグアーカイブの場合 */
    $title = '' . single_tag_title('', false) . '';
  } elseif (is_post_type_archive()) { /* 投稿タイプのアーカイブの場合 */
    $title = '' . post_type_archive_title('', false) . '';
  } elseif (is_tax()) { /* タームアーカイブの場合 */
    $title = '' . single_term_title('', false);
  } elseif (is_search()) { /* 検索結果アーカイブの場合 */
    $title = '「' . esc_html(get_query_var('s')) . '」の検索結果';
  } elseif (is_author()) { /* 作者アーカイブの場合 */
    $title = '' . get_the_author() . '';
  } elseif (is_date()) { /* 日付アーカイブの場合 */
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
};
add_filter('get_the_archive_title', 'my_archive_title');

/**
 * ショートコード
 */
// imageパス短縮
function imgPath()
{
  return get_theme_file_uri() . '/assets/images/';
}
add_shortcode('img', 'imgPath');
// 投稿のカスタムHTMLから記述する場合↓
// <img src="[img]画像ファイル名" alt="">
// テンプレートファイルに記述する場合↓
/** <img src="<?php echo do_shortcode('[img]'); ?>画像ファイル名" alt="">
 */

// URL短縮
function urlPath()
{
  return esc_url(home_url()) . '/';
}
add_shortcode('url', 'urlPath');
// 投稿のカスタムHTMLから記述する場合↓
// <a href="[url]パス" target="_blank" rel=”noopener”>
// テンプレートファイルに記述する場合↓
/** <a href="<?php echo do_shortcode('[url]'); ?>パス" target="_blank" rel=”noopener”>
 */

/**
 * パーマリンクが日本語だった場合は自動的に英数字（投稿ID）へ変更
 */
function auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
  if (preg_match('/(%[0-9a-f]{2})+/', $slug)) {
    $slug = $post_ID;
  }
  return $slug;
}
add_filter('wp_unique_post_slug', 'auto_post_slug', 10, 4);

/**
 * ページネーション
 * @link https://www.webdesignleaves.com/pr/wp/wp_func_pager.html
 */
function pagination($args = array())
{
  //パラメータのデフォルト値
  $defaults = array(
    'pages' => '',  //サブループを使用する場合は指定
    'range' => 1, //前後に表示するリンクの数
    'start_text' => '&laquo;',  //「先頭へ」のリンクの文字
    'end_text' => '&raquo;',  //「最後へ」のリンクの文字
  );
  //引数の値とデフォルトをマージ
  $args = wp_parse_args($args, $defaults);
  extract($args, EXTR_SKIP);
  // 表示する項目（リンク）の最大数
  $showitems = ($range * 2) + 1;
  // 現在のページ番号を取得（現在のページにはリンクを付けない）
  global $paged;
  // $paged が取得できない場合は1に設定
  if (empty($paged)) $paged = 1;
  // $pages: ページ総数。サブループの場合はパラメータで指定されなければならない
  // 通常のループの場合は $wp_query->max_num_pages から取得
  if ($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if (!$pages) {
      // 取得できない場合は1を設定（リンクは表示されない）
      $pages = 1;
    }
  }
  // ページ総数が1でなければリンクを出力
  if (1 != $pages) {
    echo "<nav class=\"bl_pager\" aria-label=\"ページナビゲーション\">\n";
    echo "<ol class=\"bl_pager_inner\">\n";
    // Prev：現在のページが1より大きい場合は表示
    if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<li><a class=\"bl_pager_link\" href='" . get_pagenum_link(1) . "'>" . $start_text . "</a></li>\n";
    if ($paged > 1 && $showitems < $pages) echo "<li><a class=\"bl_pager_link\" href='" . get_pagenum_link($paged - 1) . "'><img src=\"" . esc_url(get_theme_file_uri()) . "/assets/images/pager-arrowLeft.png\" alt=\"Prev\"></a></li>\n";
    // ページ番号を表示（現在のページはリンクなし）
    for ($i = 1; $i <= $pages; $i++) {
      if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
        // 三項演算子での条件分岐
        echo ($paged == $i) ? "<li><span class=\"bl_pager_link is_active\">" . $i . "</span></li>\n" : "<li><a class=\"bl_pager_link\" href='" . get_pagenum_link($i) . "'>" . $i . "</a></li>\n";
      }
    }
    // Next：総ページ数より現在のページ値が小さい場合は表示
    if ($paged < $pages && $showitems < $pages) echo "<li><a class=\"bl_pager_link\" href=\"" . get_pagenum_link($paged + 1) . "\"><img src=\"" . esc_url(get_theme_file_uri()) . "/assets/images/pager-arrowRight.png\" alt=\"Next\"></a></li>\n";
    if ($paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages) echo "<li><a class=\"bl_pager_link\" href='" . get_pagenum_link($pages) . "'>" . $end_text . "</a></li>\n";
    echo "</ol>\n";
    echo "</nav>\n";
  }
}
// テンプレートファイルへの記述
//   if (function_exists("pagination")) {
//     pagination($max_num_pages);
//   }

/**
 * 管理画面の「投稿」の名前を「ブログ」に変更
 */
function change_post_menu_label()
{
  global $menu;
  global $submenu;
  $post_name = 'ブログ';
  $menu[5][0] = $post_name;
  $submenu['edit.php'][5][0] = $post_name . '一覧';
  $submenu['edit.php'][10][0] = '新規作成';
}
function change_post_object_label()
{
  global $wp_post_types;
  $post_name = 'ブログ';
  $labels = &$wp_post_types['post']->labels;
  $labels->name = $post_name;
  $labels->singular_name = $post_name;
  $labels->add_new = _x('新規作成', $post_name);
  $labels->add_new_item = '記事の新規追加';
  $labels->edit_item = $post_name . 'の編集';
  $labels->new_item = '新規' . $post_name;
  $labels->view_item = 'この記事を表示';
  $labels->search_items = $post_name . 'を検索';
  $labels->not_found = '記事が見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}
add_action('init', 'change_post_object_label');

/**
 * カスタム投稿タイプの追加
 */
function create_post_type()
{
  $custom_post_name = 'カスタム投稿';
  $custom_taxonomy_name = 'タクソノミー';
  // カスタム投稿
  register_post_type(
    'custom', // カスタム投稿名（そのままURLに使われる）
    array(
      'labels'          => array(
        'all_items'          => $custom_post_name . '一覧',
        'name'               => $custom_post_name,
        'singular_name'      => $custom_post_name,
        'menu_name'          => $custom_post_name,
        'add_new'            => '新規作成',
        'add_new_item'       => '記事の新規追加',
        'edit'               => '編集',
        'edit_item'          => $custom_post_name . 'の編集',
        'view'               => '表示',
        'view_item'          => 'この記事を表示',
        'search_items'       => $custom_post_name . 'の検索',
        'not_found'          => '記事が見つかりませんでした',
        'not_found_in_trash' => 'ゴミ箱に記事は見つかりませんでした',
        'parent'             => '親',
      ),
      'description'     => '',
      'show_ui'         => true,
      'show_in_menu'    => true,
      'capadility_type' => 'post',
      'hierarchical'    => false,
      'rewrite'         => true,
      'query_var'       => true,
      'has_archive'     => true,
      'public'          => true,
      'supports'        => array('title', 'editor', 'excerpt', 'thumbnail'),
      'menu_position'   => 5,
      'menu_icon'     => 'dashicons-edit', // メニューで使用するアイコン
      'show_in_rest' => true
    )
  );
  // カスタムタクソノミー
  register_taxonomy(
    'ct-taxonomy', // タクソノミー名（そのままURLに使われる）
    'custom', // 使用するカスタム投稿名
    array(
      'hierarchical'   => true,
      'update_count_callback' => '_update_post_term_count',
      'label'          => $custom_taxonomy_name,
      'show_ui'        => true,
      'query_var'      => true,
      'rewrite'        => true,
      'singular_label' => $custom_taxonomy_name,
      'show_in_rest' => true
    )
  );
}
add_action('init', 'create_post_type');

/**
 * ビジュアルエディタの整形無効
 */
add_filter(
  'tiny_mce_before_init',
  function ($init_array) {
    global $allowedposttags;
    $init_array['valid_elements']          = '*[*]';
    $init_array['extended_valid_elements'] = '*[*]';
    $init_array['valid_children']          = '+a[' . implode('|', array_keys($allowedposttags)) . ']';
    $init_array['indent']                  = true;
    $init_array['wpautop']                 = false;
    $init_array['force_p_newlines']        = false;
    return $init_array;
  }
);

/**
 * 検索結果から固定ページを除外
 */
function search_filter($query)
{
  if (!is_admin() && $query->is_main_query() && $query->is_search()) {
    $query->set('post_type', 'post');
  }
}
add_action('pre_get_posts', 'search_filter');
