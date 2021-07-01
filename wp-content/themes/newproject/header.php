<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta
    name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
  />
  <meta http-equiv="X-UA-Compatible"
        content="ie=edge" />
        
  
<?= get_template_part( 'parts/favicons' ) ?>

  <title><?php bloginfo( 'name' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="header">
  <div class="container">
    
<div class="header__box">
<a href="<?= esc_url( home_url( '/' ) ) ?>"
      class="header__logo">
      <?php
      $image = get_field('logo','options');
      if( ! empty($image) ) : ?>
            <img src="<?= esc_url($image['url'] ) ?>"
                 alt="<?= esc_attr($image['alt'] ) ?>" />
      <?php endif; ?>
      </a>
      
  <nav class="header__nav">
      <?php wp_nav_menu( [
        'theme_location' => 'header_menu',
        'menu'           => '',
        'container'      => false,
        'menu_class'     => 'header__nav-list',
        'menu_id'        => '',
        'echo'           => true,
        'fallback_cb'    => 'wp_page_menu',
        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'          => 0
      ] ); ?>
    </nav>

      </div>
  </div>
</header>
