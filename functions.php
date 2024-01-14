<?php

add_filter('show_admin_bar', '__return_false');

remove_action('wp_head',             'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles',     'print_emoji_styles' );
remove_action('admin_print_styles',  'print_emoji_styles' );

remove_action('wp_head', 'wp_resource_hints', 2 ); //remove dns-prefetch
remove_action('wp_head', 'wp_generator'); //remove meta name="generator"
remove_action('wp_head', 'wlwmanifest_link'); //remove wlwmanifest
remove_action('wp_head', 'rsd_link'); // remove EditURI
remove_action('wp_head', 'rest_output_link_wp_head');// remove 'https://api.w.org/
remove_action('wp_head', 'rel_canonical'); //remove canonical
remove_action('wp_head', 'wp_shortlink_wp_head', 10); //remove shortlink
remove_action('wp_head', 'wp_oembed_add_discovery_links'); //remove alternate

add_action('wp_enqueue_scripts', 'site_scripts');
function site_scripts() {
  $version = '0.0.0.0';
  wp_dequeue_style( 'wp-block-library' );
  wp_deregister_script( 'wp-embed' );

  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:900%7CRoboto:300&display=swap&subset=cyrillic', [], $version);
  wp_enqueue_style('main-style', get_stylesheet_uri(), [], $version);

  wp_enqueue_script('focus-visible', 'https://unpkg.com/focus-visible@5.0.2/dist/focus-visible.js', [], $version, true);
  wp_enqueue_script('lazy-load', 'https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js', [], $version, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', ['focus-visible', 'lazy-load'], $version, true);

  wp_localize_script('main-js', 'WPJS', [
    'siteUrl' => get_template_directory_uri(),
  ]);
}


add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'includes/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action('carbon_fields_register_fields', 'register_carbon_fields');
function register_carbon_fields() {
  require_once( 'includes/carbon-fields-options/theme-options.php' );
  require_once( 'includes/carbon-fields-options/post-meta.php' );
}


add_action('init', 'create_global_variable');
function create_global_variable() {
  global $pizza_time;
  $pizza_time = [
    'phone' => carbon_get_theme_option( 'site_phone' ),
    'phone_digits' => carbon_get_theme_option( 'site_number_digits' ),
    'address' => carbon_get_theme_option( 'site_address' ),
  ];

}

add_action( 'after_setup_theme', 'theme_support' );
function theme_support() {
  register_nav_menu( 'menu_main_header', 'Меню в шапці' );
  add_theme_support('post-thumbnails');
};

add_action('init', 'register_post_types');
function register_post_types() {
    register_post_type('product', [
        'labels' => [
            'name'               => 'Товари', // основна назва для типу запису
            'singular_name'      => 'Товар', // назва для одного запису цього типу
            'add_new'            => 'Додати товар', // для  додавання нового запису
            'add_new_item'       => 'Додавання товару', // заголовок у новоствореного запису в адмін-панелі
            'edit_item'          => 'Редагування товару', // для редагування типу запису
            'new_item'           => 'Новий товар', // текст нового запису
            'view_item'          => 'Переглянути товар', // для перегляду запису цього типу
            'search_items'       => 'Пошук товару', // для пошуку по цим типам запису
            'not_found'          => 'Не знайдено', // якщо під час пошуку нічого не знайдено
            'not_found_in_trash' => 'Не знайдено в кошику', // якщо не знайдено в кошику
            'menu_name'          => 'Товари', // назва меню
        ],
        'menu_icon'          => 'dashicons-cart',
        'public'             => true,
        'menu_position'      => 5,
        'supports'           => ['title', 'price', 'editor', 'thumbnail', 'excerpt'],
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'products']
    ]);
    register_taxonomy('product-categories', 'product', [
      'labels'        => [
          'name'                        => 'Категорії товарів',
          'singular_name'               => 'Категорія товару',
          'search_items'                =>  'Шукати категорії',
          'popular_items'               => 'Популярні категорії',
          'all_items'                   => 'Всі категорії',
          'edit_item'                   => 'Редагувати категорію',
          'update_item'                 => 'Оновити категорію',
          'add_new_item'                => 'Додати нову категорію',
          'new_item_name'               => 'Нова назва категорії',
          'separate_items_with_commas'  => 'Відокремити категорії комами',
          'add_or_remove_items'         => 'Додати або видалити категорію',
          'choose_from_most_used'       => 'Вибрати найбільш популярну категорію',
          'menu_name'                   => 'Категорії',
      ],
      'hierarchical'  => true,
  ]);
}