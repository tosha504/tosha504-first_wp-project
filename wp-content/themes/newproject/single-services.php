<?php get_header(); ?>

<section class="single-page">
	<div class="container">
		<h1><?php the_title() ?></h1>
			<div class="single-page__content">
					<?php the_content(); ?>	
			</div>
	</div>
</section>


<?php get_footer();
