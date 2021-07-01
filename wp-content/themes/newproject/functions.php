<?php
  function theme_load_resources()
  {
    $theme_uri = get_template_directory_uri();
    //    Jquery
    wp_enqueue_script('jquery');

    // fancybox
    if (is_front_page() || is_page(59)) {
      wp_enqueue_script('fancybox_theme_functions', $theme_uri . '/libs/fancybox.umd.js', [], 23, true);
    }

    // Custom JS
    wp_enqueue_script('main_theme_functions', $theme_uri . '/index.js', [], "my ver", true);
    wp_localize_script('main_theme_functions','localizedObject',[
      'ajaxurl'              => admin_url('admin-ajax.php'),
      'nonce'                => wp_create_nonce('ajax_more_nonce_name'),
    ]);

    // Custom css
    wp_enqueue_style('main_theme_style', $theme_uri . '/src/index.css');
  }

  add_action('wp_enqueue_scripts', 'theme_load_resources');

  /**
   * AJAX
   */

  add_action('wp_ajax_ajax_more','ajax_more_callback');
  add_action('wp_ajax_nopriv_ajax_more','ajax_more_callback');

  function ajax_more_callback(){
      check_ajax_referer('ajax_more_nonce_name');

      $gallery = get_field('gallery',7); // 59 -> id page
      $gallery_length = count($gallery);
      $gallery_sub_arrays = array_chunk($gallery,3);

      
      echo json_encode ([
        "data" => $gallery_sub_arrays[ (int) $_REQUEST["page"]],
        "page" => (int) $_REQUEST["page"] + 1,
        "all_items" => $gallery_length,        
        ]);

      die();
  }

  /**
   * thumbnails
   */
  add_theme_support('post-thumbnails');

  /**
   * multi-menu
   */
  if (function_exists('add_theme_support')) {
    add_theme_support('menus');
  }


  /**
   * Disable acf updates
   */
  add_filter('site_transient_update_plugins', 'my_remove_update_nag');
  function my_remove_update_nag($value)
  {
    unset($value->response['advanced-custom-fields-pro/acf.php']);

    return $value;
  }

  /**
   * Exclude node_modules
   */
  add_filter('ai1wm_exclude_content_from_export', static function ($exclude) {
    $exclude[] = 'themes/velor/node_modules';

    return $exclude;
  });


  /**
   * Disable Gutenberg
   */
  add_filter('use_block_editor_for_post', '__return_false');

  /**
   * Register MENU
   */
  register_nav_menus([
    'header_menu' => 'Header menu',
    'footer_menu' => 'Footer menu',

  ]);

  /**
   * Fix symbols after excerpt
   */
  add_filter('excerpt_more', static function () {
    return '...';
  });

  /**
   * Make ACF Options
   */
  if (function_exists('acf_add_options_page')) {
    $option_page = acf_add_options_page([
      'page_title' => 'General settings',
      'menu_title' => 'General settings',
      'menu_slug' => 'theme-general-settings',
      'post_id' => 'options',
      'capability' => 'edit_posts',
      'redirect' => false
    ]);
  }

  /**
   * Register post type
   */
  add_action('init', 'creations');

  function creations()
  {

    register_taxonomy('type', ['library'], [
      'labels' => [
        'name' => 'Type',
        'all_items' => 'All types',
        'add_new' => 'Add type',
      ],
      'public' => true,
      'hierarchical' => true,
      'rewrite' => true,
      'show_admin_column' => true,
    ]);


    register_post_type('library', [
      'labels' => [
        'name' => 'Resource Library',
        'all_items' => 'All resources',
        'add_new' => 'Add resource',
      ],
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => ['slug' => 'library'],
      'capability_type' => 'post',
      'has_archive' => 'library',
      'hierarchical' => false,
      'menu_position' => null,
      'menu_icon' => 'dashicons-category',
      'supports' => ['title', 'editor', 'thumbnail'],
      'taxonomies' => ['type'],
    ]);
  }


  /**
   * Post per page for custom post types
   *
   * @param $query
   */
  function custom_posts_per_page($query)
  {
    if (!is_admin() && is_post_type_archive(['library'])) {
      $query->set('posts_per_page', 9);
    }
  }

  add_action('pre_get_posts', 'custom_posts_per_page');

