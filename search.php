<?php

/**
 * searchテンプレート
 */
get_header();
?>
<div class="ly_cont ly_cont__col">
	<main class="ly_cont_main">
		<h1 class="bl_page_ttl">
			「<span class="bl_searchTerm"><?php echo esc_html(get_search_query()); ?></span>」の検索結果
		</h1>
		<?php
		if (have_posts()) {
			// ループ開始
			while (have_posts()) {
				the_post();
				get_template_part('template-parts/content');
			}
			// ページネーション
			if (function_exists("pagination")) {
				pagination($max_num_pages);
			}
		} else {
			// コンテンツがない場合
			echo '<p>コンテンツがありません。</p>';
		}
		?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
