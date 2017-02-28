<?php get_header(); ?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="header">
    <div class="inside-pagewidth">
      <div class="title">
        <h1><?php echo $post->post_title; ?></h1>
      </div>
      <div class="square-buttons">
        <ul>
          <li class="<?=(!isset($_GET['sub']))?'active':''?>"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo 'Tetszőlegesen választható időpontok'; ?></a></li><!--
       --><li class="<?=(isset($_GET['sub']) && $_GET['sub'] == 'ajanlatkeres')?'active':''?>"><a href="<?php echo get_permalink($post->ID); ?>?sub=ajanlatkeres"><?php echo __('Ajánlatkérés', TD); ?></a></li><!--
       --><li class="<?=(isset($_GET['sub']) && $_GET['sub'] == 'kapcsolatfelvetel')?'active':''?>"><a href="<?php echo get_permalink($post->ID); ?>?sub=kapcsolatfelvetel"><?php echo __('Kapcsolatfelvétel', TD); ?></a></li>
        </ul>
      </div>
    </div>
  </div>
  <?php
  $subpage = 'idopontok.php';

  if (isset($_GET['sub']) && in_array($_GET['sub'], array('ajanlatkeres', 'kapcsolatfelvetel'))) {
    $subpage = $_GET['sub'].'.php';
  }

  ?>
  <div class="subpage-container subpage-of-<?php echo str_replace('.php', '', $subpage); ?>">
    <div class="inside-pagewidth">
      <div class="subpage-wrapper">
        <?php require_once locate_template("templates/utazas/sub/".$subpage); ?>
      </div>
    </div>
  </div>
  <div class="price_desc">
    <div class="inside-pagewidth">
      <h2><?php echo __('Az ár tartalmazza', TD); ?></h2>
    </div>
  </div>
  <div class="desc">
    <div class="inside-pagewidth">
      <?php echo apply_filters('the_content', $post->post_content); ?>
    </div>
  </div>
  <div class="program_desc">
    <div class="inside-pagewidth">
      <h2><?php echo __('Programok', TD); ?></h2>
    </div>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
