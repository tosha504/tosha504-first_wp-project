<?php
  /**
   * Template Name: Contacts
   *
   */
?>
<?php get_header() ?>

<section class="contact-us">
    <div class="container">
    <h2 class="global-title">Contact Us</h2>
      <?= get_template_part('parts/contact-form') ?>
    </div>
</section>

<?php get_footer(); ?>
