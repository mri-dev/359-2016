<?php
  $bgc = 'default';

  if (!empty($bgcolor['orange']) && in_array($i, $bgcolor['orange'])) {
    $bgc = 'orange';
  }
  if (!empty($bgcolor['white']) && in_array($i, $bgcolor['white'])) {
    $bgc = 'white';
  }


?>
<div class="load-page-item item-<?php echo $i; ?> pos-<?php echo $pos; ?> bg-<?php echo $bgc; ?>">
  <div class="lpi-wrapper">
    <div class="item-data">
      <div class="cwrapper">
        <div class="title">
          <h2><?php echo $row->post_title; ?></h2>
          <div class="excerpt">
            <?php echo $row->post_excerpt; ?>
          </div>
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
