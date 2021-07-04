<?php
  /**
   * Template Name: Blog
   *
   */
?>
<?php get_header() ?>

<section class="blog">
  <div class="container">
    <div class="search">
      <?php echo do_shortcode('[wpdreams_ajaxsearchlite]') ?>

      <!-- <form action="<?= home_url('/') ?>">
        <input type="text"
               name="s">
        <button type="submit">search</button>
      </form> -->
    </div>
    <div class="section-articles__items">

      <?php  
      $paged = ( get_query_var('paged') ) ?: 1;
      
      $blog = new WP_Query([
        'order'         => 'DECS',
        'orderby'       => 'date',
        'paged'         => $paged,
      ]);

      if ( $blog->have_posts() ) : while ($blog->have_posts() ) : $blog->the_post();
            $external_link = get_field('blog_external_link');
      ?>

        <div class="section-articles__item ">
          <div class="section-articles__pic">
           
            <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
            </div>
              <h6 class="section-articles__title"><?= get_the_title() ?></h6>
             <div class="section-articles__date"><?= get_the_date() ?></div>
             <div class="section-articles__except"><?= get_the_excerpt() ?></div>
         
             <a href="<?= $external_link ? : get_the_permalink() ?>"
              class="section-articles__read-more btn">Read more</a>
        </div> 
   

      <?php endwhile; endif ;
      wp_reset_query(); ?>

    </div> 
    <div class="pagination">
    <?php 
      global $wp_query;
      $big = 999999999;
      echo paginate_links([
        'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link($big) ) ),
        'format'     => '?paged=%#%',
        'current'    => max(1, get_query_var('paged') ),
        'total'      => $blog->max_num_pages,
        'prev_text'  => "<span>Prev</span>",
        'next_text'  => "<span>Next</span>",
      ]);
    ?>  
    </div>  
  </div>
</section>

<?php get_footer(); ?>
