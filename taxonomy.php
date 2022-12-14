<?php

/**
 * カスタムタクソノミーテンプレート
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
		<h1><?php echo get_the_archive_title(); ?>の一覧</h1>
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$type = get_query_var('ct-taxonomy');
		$args = array(
			'post_type' => 'custom', // 投稿タイプを指定（カスタム投稿名を記述）
			'posts_per_page' => 1, // 1ページに表示したい記事を最大1件に指定
			'post_status' => 'publish', // 公開済みページのみ指定
			'order' => 'DESC', // 記事の順番を降順に指定
			'tax_query' => array(
				array(
					'taxonomy' => 'ct-taxonomy',
					'field' => 'slug',
					'terms' => $type
				)
			),
			'paged' => $paged // ページ分割時のページ
		);
		$the_query = new WP_Query($args);
		if ($the_query->have_posts()) :
		?>
			<?php while ($the_query->have_posts()) : $the_query->the_post();
				get_template_part('template-parts/content-archive'); ?>
			<?php endwhile; ?>
			<?php
			// ページネーション
			if (function_exists("pagination")) {
				pagination(array('pages' => $the_query->$max_num_pages, 'range' => 1));
			}
			?>
		<?php else : ?>
			<p>コンテンツがありません。</p>
		<?php endif;
		wp_reset_postdata(); ?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
