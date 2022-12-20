<?php

/**
 * 記事一覧テンプレート
 */
get_header();
?>
<ol class="bl_breadcrumb">
	<?php
	if (function_exists('bcn_display') && !is_front_page()) {
		bcn_display();
	}
	?>
</ol>
<div class="ly_cont ly_cont__col">
	<main class="ly_cont_main">
		<?php the_archive_title('<h1 class="">', '</h1>'); ?>
		<?php
		if (have_posts()) {
			// ループ開始
			while (have_posts()) {
				the_post();
				get_template_part('template-parts/content-archive');
			}
			// ページネーション
			if (function_exists("pagination")) {
				pagination($max_num_pages);
			}
		} else {
			echo '<p>コンテンツがありません。</p>';
		}
		?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
