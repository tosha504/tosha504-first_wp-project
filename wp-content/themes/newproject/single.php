<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package global
 */

get_header();


?>


<section class="single-page">
	<div class="container">
		<img src="<?= get_the_post_thumbnail_url() ?>" alt="">
     
      <h6 class="section-articles__title"><?= get_the_title() ?></h6>
		<?= do_shortcode('[addtoany]') ?>
		<div class="single-page__contetn">
			<?php the_content();?>
		</div>

		

		<div class="related-posts">
			<?php
			$related_posts = get_field("blog_related_posts");
			$home_url =  home_url( '/' ) ;
			foreach ($related_posts as $related_post) { 
			$href = $home_url . $related_post -> post_name
			?>
				<a href="<?= $href ?>"><?= $related_post -> post_title ?></a>
			<?php }
			?>
		</div>
	</div>
</section>


<?php

get_footer();
