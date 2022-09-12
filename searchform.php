<?php

/**
 * searchformテンプレート
 */
?>
<form class="bl_form" role="search" method="get" action="<?php echo do_shortcode('[url]'); ?>">
  <input type="search" name="s" placeholder="<?php if (!is_search()) {
                                                echo 'SEARCH';
                                              } ?>" value="<?php if (is_search()) {
                                                                                                      echo get_search_query();
                                                                                                    } ?>">
  <button type="submit">検索する</button>
</form>
