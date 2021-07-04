<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package global
 */

get_header();
?>
	<section class="search-result">
		<div class="container">
			<?= get_search_query() ?>
		</div>
	</section>

<?php
get_footer();
