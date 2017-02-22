<?php get_header(); ?>
	<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
    <?php
      $sliders = new RevSlider();
      $slider_list = (array)$sliders->getAllSliderAliases();
      $slide_slug = get_queried_object()->slug;

      if( in_array($slide_slug, $slider_list) ) {
        echo do_shortcode('[rev_slider alias="'.$slide_slug.'"]');
      } 
    ?>
    <?php echo do_shortcode('[load-page from="category" category="utazas_kategoria" view="2x2" posttype="utazas"]'); ?>
	</div>
	<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
