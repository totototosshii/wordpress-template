<?php

/**
 * footerテンプレート
 */
?>
<footer class="ly_footer">
	<div class="ly_footer_inner">
		<nav class="bl_footerNav" aria-label="フッターナビゲーションメニュー">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container' => false,
					'menu_class' => 'bl_footerList',
					'menu_id' => 'bl_footerList',
					'fallback_cb' => false,
				)
			);
			?>
		</nav>
		<small class="bl_footerCopy">@2021 - <?php echo date('Y'); ?></small>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>

</html>
