<?php

/**
 * contentテンプレート
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bl_article'); ?>>
  <a href="<?php the_permalink(); ?>">
    <h2>
      <!-- タイトルの表示文字数を制限 -->
      <?php echo wp_trim_words(get_the_title(), 18, '…'); ?>
    </h2>
    <p>
      <!-- 本文の表示改良版 -->
      <?php
      $remove_array = ["\r\n", "\r", "\n", " ", "　"];
      $content = wp_trim_words(strip_shortcodes(get_the_content()), 50, '…');
      $content = str_replace($remove_array, '', $content);
      echo $content;
      ?>
    </p>
    <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
    <figure><?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?></figure>
  </a>
</article>
