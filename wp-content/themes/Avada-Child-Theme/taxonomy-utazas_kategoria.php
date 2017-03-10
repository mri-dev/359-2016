<?php get_header(); ?>
	<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
    <?php
      $sliders = new RevSlider();
      $slider_list = (array)$sliders->getAllSliderAliases();
			$cat = get_queried_object();
      $slide_slug = $cat->slug;

			//print_r($cat);

      if( in_array($slide_slug, $slider_list) ) {
        echo do_shortcode('[rev_slider alias="'.$slide_slug.'"]');
      }
    ?>

		<div class="header">
			<div class="page-width">
				<div class="title">
					<h1><?php echo $cat->name; ?></h1>
				</div>
			</div>
		</div>

    <?php echo do_shortcode('[load-page from="category" category="utazas_kategoria" view="2x2" posttype="utazas"]'); ?>
	</div>
	<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
