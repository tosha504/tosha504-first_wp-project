<?php
  /**
   * Template Name: Home
   *
   * Show default home page
   *
   */
  $trimWords = 4
?>
<?php get_header() ?>
  <section class="main-screen" style="background: url(<?= get_template_directory_uri()?>/img/main.jpg) no-repeat top/cover">
    <h1 class="main-screen__title">Title</h1>
    <p class="main-screen__subtitle">Subtitle</p>
    <div class="btn main-screen__btn ">CTA</div>

  </section>

  <section class="section-articles">
    <div class="container">
     <div class="section-articles__box">
        <h2 class="global-title">Blog</h2>

        <a href="" class="section-articles__all btn">All articles</a>
     </div>
      
     <div class="section-articles__items">

      <?php $blog = new WP_Query([
        'order'         => 'DECS',
        'orderby'       => 'date',
        'posts_per_page' => 3
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
    </div>
  </section>

  <section class="section-testimonials">
    <div class="container">
      <h2 class="global-title">Testimonials</h2> 

         <div class="section-articles__items">

 
          <?php 
          $testimonials = get_field("testimonials");
          $testimonials_length = count($testimonials);
          $firstThreeTestimonials = array_slice($testimonials,0,3);
          ?>


         <?php  
         foreach ($firstThreeTestimonials as $testimonial) { ?> 
          <div class="section-articles__item">
            <div class="section-articles__pic">
              <img src="<?= $testimonial['testimonials_pic'] ?>" alt="">
              </div>
                <h6 class="section-articles__title"><?= $testimonial["testimonials_name"] ?></h6>
              
              <div class="section-articles__except"><?= wp_trim_words($testimonial["testimonials_text"]   ,$trimWords," ...") ?></div>

              <div class="section-articles__except full-text d-none"><?= $testimonial["testimonials_text"]  ?></div>
              
              <?php
              $word_count = str_word_count(trim(strip_tags($testimonial["testimonials_text"]  )));
              ?>

              <?php
              if($word_count > $trimWords){ ?>
                  <div class="section-articles__read-more section-testimonials__btn btn">Read more</div>
              <?php } ?>
          </div> 
        <?php } ?>

        </div>
        <?php if($testimonials_length > 3 ){?>
          <div class="btn  section-testimonials__show-more">Showmore</div>
          <?php } ?>
        
    </div>
  </section>

  <div class="testimonial-dialog dialog">
     <div class="container">
        <div class="dialog__overlay"></div>
          <div class="dialog__content">
          <div class="dialog__close">X</div>
          <div class="section-articles__pic testimonial-dialog__pic">
            <img src="" alt="">
          </div>
          <h6 class="section-articles__title testimonial-dialog__name"></h6>      
          <div class="section-articles__except testimonial-dialog__full-text"></div>
        </div>
      </div>
</div>

<section class="gallery">
  <div class="container">
     <div class="section-articles__box">
        <h2 class="global-title">Gallery</h2>
      <a href="<?= get_page_link(59)?>" class="section-articles__all btn">All images</a>
      </div>

  <div class="gallery__items">  
    
  <?php 
    $gallery = get_field('gallery');
     $gallery_length = count($gallery);
    $gallery_sub_arrays = array_chunk($gallery,3);

    foreach ( $gallery_sub_arrays[0] as $pic) { ?>
    
      <a class="gallery__item"
       data-fancybox='gallery'
       href="<?= $pic['url'] ?>">
       <img src="<?= $pic['sizes']["medium_large"] ?>" alt="">
    </a>        
 
   <?php }       
 ?>
  </div>


<p class="gallery__loading">Loading..</p>



   <?php if($gallery_length > 3 ){?>
          <div class="btn  section-testimonials__show-more gallary__show-more">Showmore</div>
          <?php } ?>
  </div>   
       

</section>

<!-- <?= get_template_part( 'parts/tabs' ) ?> -->

<?php get_footer(); ?>

