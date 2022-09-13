<?php

/**
 * 固定のコンテンツ部分テンプレート
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bl_article'); ?>>
  <h2><?php the_title(); ?></h2>
  <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
  <figure>
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
    <?php else : ?>
      <img src="<?php echo do_shortcode('[img]'); ?>noimage.png" alt="NO IMAGE">
    <?php endif; ?>
  </figure>
  <?php the_content(); ?>
</article>
