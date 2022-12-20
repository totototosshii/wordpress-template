<?php

/**
 * Template Name: オリジナルテンプレート
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
