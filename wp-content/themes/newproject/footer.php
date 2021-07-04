<footer class="footer">
   <div class="container">
      <div class="footer__box">
         <a href="<?= esc_url( home_url( '/' ) ) ?>"
            class="footer__logo">
         <?php
          $image = get_field('logo','options');
          if( ! empty($image) ) : ?>
               <img src="<?= esc_url($image['url'] ) ?>"
                    alt="<?= esc_attr($image['alt'] ) ?>" />
         <?php endif; ?>
      </a> 
      <div class="footer__socials">
      <?php if( have_rows('socials','options') ):while (have_rows('socials','options')  ):
      the_row();
    
       ?>
      <a href=" <?= get_sub_field('socials_link') ?> "
         class="footer__social">
      
      <?php 
         $image = get_sub_field('socials_icon') ;
         if (! empty( $image) ) : ?>   
      <img src="<?= esc_url( $image['url'] ) ?>" 
           alt=" <?= esc_attr( $image['alt'] ) ?>" />
      <?php endif; ?>
      </a>
      <?php endwhile; endif; ?>   
   
      </div>
      </div>
   </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
