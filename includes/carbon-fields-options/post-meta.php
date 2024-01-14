<?php

if (!defined('ABSPATH')) {
  exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Додадаткові поля')
  ->show_on_page(9)

  ->add_tab('Перший екран', [
    Field::make('text', 'top_info', 'Надзаголовок'),
    Field::make('text', 'top_title', 'Заголовок'),
    Field::make('text', 'top_btn_text', 'Текст кнопки')
      ->set_width(50),
    Field::make('text', 'top_btn_scroll_to', 'Класс для скрола')
      ->set_width(50),
    Field::make('image', 'top_img', 'Фото'),
  ])

  ->add_tab('Каталог', [
    Field::make('text', 'catalog_title', 'Заголовок'),
    Field::make('association', 'catalog_nav', __('Категорії товарів'))
      ->set_types([
        [
          'type' => 'term',
          'taxonomy' => 'product-categories',
        ]
      ]),
    Field::make('association', 'catalog_products', __('Товари'))
      ->set_types([
        [
          'type' => 'post',
          'post_type' => 'product',
        ]
      ])
  ])


  ->add_tab('Про нас', [
    Field::make('text', 'about_title', 'Заголовок'),
    Field::make('rich_text', 'about_text', 'Текст'),
    Field::make('image', 'about_img', 'Фото'),
  ])
  ->add_tab('Контакти', [
    Field::make('text', 'contacts_title', 'Заголовок'),
    Field::make('checkbox', 'contacts_is_img', 'Фото помідора')
  ]);




Container::make('post_meta', 'Товарні поля')
  ->show_on_post_type('product')

  ->add_tab('Інформація про товар', [
    Field::make('text', 'item_price', 'Ціна'),
    Field::make('complex', 'item_attributes', ('Атрибути'))
      ->set_max(3)
      ->add_fields([
        Field::make('text', 'name', ('Назва'))->set_width(50),
        Field::make('text', 'price', ('Ціна'))->set_width(50),
      ]),
  ]);
?>