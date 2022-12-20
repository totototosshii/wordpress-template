<?php

/**
 * ヘッダーテンプレート
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<?php wp_head(); ?>
</head>

<body <?php body_class("js_body"); ?>>
	<?php wp_body_open(); ?>
	<div class="ly_siteWrapper">
		<div class="bl_loading js_loading">
			<div class="bl_loading_animation"></div>
		</div>
		<header class="ly_header js_header">
			<div class="ly_header_inner">
				<?php $logo_tag = is_front_page() ? 'h1' : 'div'; ?>
				<<?php echo esc_attr($logo_tag); ?> class="bl_headerLogo">
					<?php if (has_custom_logo()) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo do_shortcode('[url]'); ?>"><?php bloginfo('name'); ?></a>
					<?php endif; ?>
				</<?php echo esc_attr($logo_tag); ?>>
				<nav class="bl_headerNav" aria-label="ヘッダーナビゲーションメニュー">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'header',
							'container' => false,
							'menu_class' => 'bl_headerList',
							'menu_id' => 'bl_headerList',
							'fallback_cb' => false,
						)
					);
					?>
				</nav>
			</div>
		</header>
		<div class="bl_drawer_wrapper">
			<button class="bl_drawer js_drawer" type="button" aria-label="メニューを開く場合はこちら" aria-controls="bl_drawerNav" aria-expanded="false"><span class="bl_drawerLine" aria-hidden="true"></span><span class="bl_drawer_txt">Menu</span></button>
		</div>
		<nav class="bl_drawerNav js_drawerNav" aria-hidden="true" id="bl_drawerNav">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'drawer',
					'container' => false,
					'menu_class' => 'bl_drawerList',
					'menu_id' => 'bl_drawerList',
					'fallback_cb' => false,
				)
			);
			?>
		</nav>
