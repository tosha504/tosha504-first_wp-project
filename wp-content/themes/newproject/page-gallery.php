<?php
  /**
   * Template Name:Gallery
   *
   */
?>
<?php get_header() ?>

<section class="gallery">
  <div class="container">
     <div class="section-articles__box">
        <h2 class="global-title">Gallery</h2>
      
      </div>

  <div class="gallery__items">  
  <?php 
    $gallery = get_field('gallery',7);

    foreach ($gallery as $pic) { ?>
      <a class="gallery__item"
       data-fancybox='gallery'
       href="<?= $pic['url'] ?>">
       <img src="<?= $pic['sizes']["medium_large"]?>" alt="">
    </a>        
 
   <?php }       
 ?>

  </div>
 </div> 
       

</section>


<?php get_footer(); ?>
