<?php

/**
 * 固定のコンテンツ部分テンプレート
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bl_article'); ?>>
  <h1><?php the_title(); ?></h1>
  <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
  <?php if (has_post_thumbnail()) : ?>
    <figure>
      <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
    </figure>
  <?php endif; ?>
  <?php the_content(); ?>
</article>
