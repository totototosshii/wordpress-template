<?php

/**
 * 投稿詳細のコンテンツ部分テンプレート
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bl_article'); ?>>
  <h2><?php the_title(); ?></h2>
  <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
  <figure>
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
    <?php else : ?>
      <picture class="bl_imgWrap">
        <source srcset="<?php echo do_shortcode('[img]'); ?>no-image.webp" type="image/webp" />
        <img src="<?php echo do_shortcode('[img]'); ?>no-image.png" width="375" height="375" alt="No Image" loading="lazy" />
      </picture>
    <?php endif; ?>
  </figure>
  <?php the_content(); ?>
</article>
