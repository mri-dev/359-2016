<?php
  $bgc = 'default';
  $last = false;

  if ($max_item == $i) {
    $last = true;
  }

  if (!empty($bgcolor['orange']) && in_array($i, $bgcolor['orange'])) {
    $bgc = 'orange';
  }
  if (!empty($bgcolor['grey']) && in_array($i, $bgcolor['grey'])) {
    $bgc = 'grey';
  }
?>
<div class="load-page-item item-<?php echo $i; ?> pos-<?php echo $pos; ?> bg-<?php echo $bgc; ?>">
  <div class="lpi-wrapper">
    <div class="item-data">
      <div class="cwrapper">
        <div class="title">
          <h2>
            <?php if ($attr['buttons'] == 1): ?>
              <a href="<?php echo get_permalink($row->ID); ?>"><?php echo $row->post_title; ?></a>
            <?php else: ?>
              <?php echo $row->post_title; ?>
            <?php endif; ?>
          </h2>
          <div class="excerpt">
            <?php if ($attr['content'] == 'excerpt'): ?>
              <?php echo $row->post_excerpt; ?>
            <?php elseif( $attr['content'] == 'full' ): ?>
              <?php echo apply_filters('the_content', $row->post_content); ?>
            <?php endif; ?>
          </div>
          <?php if ($attr['buttons'] == 1): ?>
            <a class="fusion-button" href="<?php echo get_permalink($row->ID); ?>"><?php echo __('Tovább', TD); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="item-image">
      <div class="cwrapper">
        <?php
          $img = get_the_post_thumbnail_url($row->ID);
        ?>
        <img src="<?=$img?>" alt="<?php echo $row->post_title; ?>">
      </div>
    </div>
  </div>
</div>
