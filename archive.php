<?php

/**
 * archiveテンプレート
 */
get_header();
?>
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
			// コンテンツがない場合
			echo '<p>コンテンツがありません。</p>';
		}
		?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
