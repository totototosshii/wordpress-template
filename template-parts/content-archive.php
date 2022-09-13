<?php

/**
 * 投稿一覧のコンテンツ部分テンプレート
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bl_article'); ?>>
  <a href="<?php the_permalink(); ?>">
    <h2>
      <?php echo wp_trim_words(get_the_title(), 18, '…'); ?>
    </h2>
    <p>
      <?php
      $remove_array = ["\r\n", "\r", "\n", " ", "　"];
      $content = wp_trim_words(strip_shortcodes(get_the_content()), 50, '…');
      $content = str_replace($remove_array, '', $content);
      echo $content;
      ?>
    </p>
    <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
    <figure>
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
      <?php else : ?>
        <img src="<?php echo do_shortcode('[img]'); ?>noimage.png" alt="NO IMAGE">
      <?php endif; ?>
    </figure>
  </a>
</article>
