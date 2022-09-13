<?php

/**
 * 投稿詳細カスタムテンプレート
 */
get_header();
?>
<div class="ly_cont ly_cont__col">
	<main class="ly_cont_main">
		<?php
		if (have_posts()) {
			// ループ開始
			while (have_posts()) {
				the_post();
				get_template_part('template-parts/content-single');
			}
			// ページネーション
			the_post_navigation();
		} else {
			// コンテンツがない場合
			echo '<p>コンテンツがありません。</p>';
		}
		?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
