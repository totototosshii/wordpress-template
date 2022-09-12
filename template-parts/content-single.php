<?php

/**
 * contentテンプレート
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bl_article'); ?>>
  <a href="<?php the_permalink(); ?>">
    <h2><?php the_title(); ?></h2>
    <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
    <p><?php the_content(); ?></p>
    <figure><?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?></figure>
  </a>
</article>
