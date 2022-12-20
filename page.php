<?php

/**
 * 固定テンプレート
 */
get_header();
?>
<?php if (is_front_page()) : ?>
	<div class="splide" aria-label="メインビジュアルスライダー">
		<div class="splide__track">
			<ul class="splide__list bl_slider">
				<li class="splide__slide">
					<div class="bl_slider_inner">
						<div class="bl_slider_body">
							<h1>メインビジュアル01</h1>
							<p>テキストテキスト</p>
						</div>
					</div>
					<picture class="bl_slider_imgWrapper">
						<source srcset="<?php echo do_shortcode('[img]'); ?>mv_01.webp" type="image/webp" /><img src="<?php echo do_shortcode('[img]'); ?>mv_01.jpg" width="375" height="250" alt="メインビジュアル01" />
					</picture>
				</li>
				<li class="splide__slide">
					<div class="bl_slider_inner">
						<div class="bl_slider_body">
							<h1>メインビジュアル02</h1>
							<p>テキストテキスト</p>
						</div>
					</div>
					<picture class="bl_slider_imgWrapper">
						<source srcset="<?php echo do_shortcode('[img]'); ?>mv_02.webp" type="image/webp" /><img src="<?php echo do_shortcode('[img]'); ?>mv_02.jpg" width="375" height="250" alt="メインビジュアル02" />
					</picture>
				</li>
				<li class="splide__slide">
					<div class="bl_slider_inner">
						<div class="bl_slider_body">
							<h1>メインビジュアル03</h1>
							<p>テキストテキスト</p>
						</div>
					</div>
					<picture class="bl_slider_imgWrapper">
						<source srcset="<?php echo do_shortcode('[img]'); ?>mv_03.webp" type="image/webp" /><img src="<?php echo do_shortcode('[img]'); ?>mv_03.jpg" width="375" height="250" alt="メインビジュアル03" />
					</picture>
				</li>
				<li class="splide__slide">
					<div class="bl_slider_inner">
						<div class="bl_slider_body">
							<h1>メインビジュアル04</h1>
							<p>テキストテキスト</p>
						</div>
					</div>
					<picture class="bl_slider_imgWrapper">
						<source srcset="<?php echo do_shortcode('[img]'); ?>mv_04.webp" type="image/webp" /><img src="<?php echo do_shortcode('[img]'); ?>mv_04.jpg" width="375" height="250" alt="メインビジュアル04" />
					</picture>
				</li>
			</ul>
		</div>
	</div>
<?php endif; ?>
<ol class="bl_breadcrumb">
	<?php
	if (function_exists('bcn_display') && !is_front_page()) {
		bcn_display();
	}
	?>
</ol>
<div class="ly_cont ly_cont__col">
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
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
