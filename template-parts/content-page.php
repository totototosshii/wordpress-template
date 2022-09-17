<?php

/**
 * 固定のコンテンツ部分テンプレート
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bl_article'); ?>>
  <?php $heading_tag = is_front_page() ? 'div' : 'h1'; ?>
  <<?php echo esc_attr($heading_tag); ?>>
    <?php the_title(); ?>
  </<?php echo esc_attr($heading_tag); ?>>
  <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
  <?php if (has_post_thumbnail()) : ?>
    <figure>
      <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
    </figure>
  <?php endif; ?>
  <?php the_content(); ?>
</article>
