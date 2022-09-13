<!--
	Template Name: template-pageテンプレート
-->
<?php

/**
 * template-pageテンプレート
 */
get_header();
?>
<div class="ly_cont">
	<main class="ly_cont_main">
		<?php
		if (have_posts()) {
			// ループ開始
			while (have_posts()) {
				the_post();
				get_template_part('template-parts/content-page');
			}
		} else {
			echo '<p>コンテンツがありません。</p>';
		}
		?>
	</main>
</div>
<?php get_footer(); ?>
