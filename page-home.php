<?php
/*
Template Name: Головна
*/
?>
<?php $page_id = get_the_ID(); ?>
<?php get_header(); ?>

<?php
$image_id = carbon_get_post_meta($page_id, 'top_img');

if ($image_id) {
  $image_url = wp_get_attachment_image_url($image_id, 'full');

  if ($image_url) {
    echo '<style>';
    echo '.section-top { background-image: url("' . esc_url($image_url) . '"); }';
    echo '</style>';
  }
}
?>
<section class="section-top">
  <div class="container section-top__container">
    <p class="section-top__info">
      <?php echo carbon_get_post_meta($page_id, 'top_info'); ?>
    </p>
    <p class="section-top__title">
      <?php echo carbon_get_post_meta($page_id, 'top_title'); ?>
    </p>
    <div>
      <button class="btn" type="button"
        data-scroll-to="<?php echo carbon_get_post_meta($page_id, 'top_btn_scroll_to'); ?>">
        <?php echo carbon_get_post_meta($page_id, 'top_btn_text'); ?>
      </button>
    </div>
  </div>
</section>
<!-- /.section-top -->


<!-- section-catalog -->
<section class="section section-catalog">
  <div class="container">
    <header class="section__header">
      <h2 class="page-title page-title--accent">
        <?php echo carbon_get_post_meta($page_id, 'catalog_title'); ?>
      </h2>
      <nav class="catalog-nav">

        <?php
        $catalog_nav = carbon_get_post_meta($page_id, 'catalog_nav');
        $catalog_nav_ids = wp_list_pluck($catalog_nav, 'id');
        $catalog_nav_items = get_terms([
          'include' => $catalog_nav_ids,
        ]);
        ?>

        <ul class="catalog-nav__wrapper">
          <li class="catalog-nav__item">
            <button class="catalog-nav__btn is-active" type="button" data-filter="all">Все</button>
          </li>

          <?php foreach ($catalog_nav_items as $item): ?>
            <li class="catalog-nav__item">
              <button class="catalog-nav__btn" type="button" data-filter="<?php echo $item->name; ?>">
                <?php echo $item->name; ?>
              </button>
            </li>


          <?php endforeach; ?>
        </ul>
      </nav>
    </header>

    <?php
    $catalog_products = carbon_get_post_meta($page_id, 'catalog_products');
    $catalog_products_ids = wp_list_pluck($catalog_products, 'id');

    $catalog_products_args = [
      'post_type' => 'product',
      'post__in' => $catalog_products_ids
    ];
    $catalog_products_query = new WP_Query($catalog_products_args);
    ?>

    <?php if ($catalog_products_query->have_posts()): ?>
      <div class="catalog">

        <?php while ($catalog_products_query->have_posts()):
          $catalog_products_query->the_post(); ?>

          <?php echo get_template_part('product-content'); ?>

        <?php endwhile; ?>

      <?php endif; ?>
    </div>
  </div>
</section>



<!-- /.section-catalog -->

<!-- section-about -->
<section class="section section-about">
  <picture>
    <img class="section-about__img lazy"
      src="<?php echo wp_get_attachment_image_url(carbon_get_post_meta($page_id, 'about_img'), "full"); ?>"
      data-src="<?php echo wp_get_attachment_image_url(carbon_get_post_meta($page_id, 'about_img'), "full"); ?>" alt="">
    <div class="container section-about__container">
      <div class="section-about__content">
        <h2 class="page-title section-about__title">Про нас</h2>
        <p class="section-about__text">Доставимо вам гарячу піцу менш як за годину або піца безкоштовно.
          Ми готуємо піцу лише зі свіжих продуктів. Щодня ми купуємо свіжі овочі, гриби та м'ясо.</p>
      </div>
    </div>
</section>
<!-- /.section-about -->

<!-- section-contacts -->
<section class="section section-contacts">
  <div class="container section-contacts__container">
    <div class="section-contacts__img lazy"
      data-src="<?php echo get_template_directory_uri(); ?>/assets/img/section-contacts/tomatoes.webp"
      data-src-replace-webp="img/section-contacts/tomatoes.jpg"></div>
    <header class="section__header">
      <h2 class="page-title sectoin-contacts__title">Контакти</h2>
    </header>
    <div class="contacts">
      <div class="contacts__start">
        <div class="contacts__map" id="ymap" data-cordinates=""><iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10211.20863848851!2d25.93114162286959!3d48.28538078084236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473408bd832dcfcb%3A0x39135024bccee88d!2z0JPQvtGC0LXQu9GM0L3Qvi3RgNC10YHRgtC-0YDQsNC90L3QuNC5INC60L7QvNC_0LvQtdC60YEg0J_QsNC90YHRjNC60LjQuSDQlNCy0ZbRgA!5e0!3m2!1suk!2sua!4v1696435106252!5m2!1suk!2sua"
            width="580" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe></div>
      </div>
      <div class="contacts__end">
        <div class="contacts__item">
          <h3 class="contacts__title">Адреса</h3>
          <p class="contacts__text">
            <?php echo $GLOBALS['pizza_time']['address']; ?>
          </p>
        </div>
        <div class="contacts__item">
          <h3 class="contacts__title">Телефон</h3>
          <p class="contacts__text">
            <a class="contacts__phone" href="tel:<?php echo $GLOBALS['pizza_time']['phone_digits']; ?>">
              <?php echo $GLOBALS['pizza_time']['phone']; ?>
            </a>
          </p>
        </div>
        <div class="contacts__item">
          <h3 class="contacts__title">Соціальні мережі</h3>
          <ul class="socials">
            <li class="socials__item">
              <a href="#" class="socials__link" target="_blank">
                <svg class="socials__icon socials__icon--fb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <g>
                    <path
                      d="M332.3,136.2H179.7a44.21,44.21,0,0,0-44.2,44.2V333a44.21,44.21,0,0,0,44.2,44.2H332.3A44.21,44.21,0,0,0,376.5,333V180.4A44.21,44.21,0,0,0,332.3,136.2ZM256,336a79.3,79.3,0,1,1,79.3-79.3A79.42,79.42,0,0,1,256,336Zm81.9-142.2A18.8,18.8,0,1,1,356.7,175,18.78,18.78,0,0,1,337.9,193.8Z" />
                    <path d="M256,210.9a45.8,45.8,0,1,0,45.8,45.8A45.86,45.86,0,0,0,256,210.9Z" />
                    <path
                      d="M256,0C114.6,0,0,114.6,0,256S114.6,512,256,512,512,397.4,512,256,397.4,0,256,0ZM410,333a77.78,77.78,0,0,1-77.7,77.7H179.7A77.78,77.78,0,0,1,102,333V180.4a77.84,77.84,0,0,1,77.7-77.7H332.3A77.84,77.84,0,0,1,410,180.4Z" />
                  </g>
                </svg>

              </a>
            </li>
            <li class="socials__item">
              <a href="#" class="socials__link" target="_blank">
                <svg class="socials__icon socials__icon--inst" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                  width="35" height="35">
                  <g>
                    <path
                      d="M332.3,136.2H179.7a44.21,44.21,0,0,0-44.2,44.2V333a44.21,44.21,0,0,0,44.2,44.2H332.3A44.21,44.21,0,0,0,376.5,333V180.4A44.21,44.21,0,0,0,332.3,136.2ZM256,336a79.3,79.3,0,1,1,79.3-79.3A79.42,79.42,0,0,1,256,336Zm81.9-142.2A18.8,18.8,0,1,1,356.7,175,18.78,18.78,0,0,1,337.9,193.8Z" />
                    <path d="M256,210.9a45.8,45.8,0,1,0,45.8,45.8A45.86,45.86,0,0,0,256,210.9Z" />
                    <path
                      d="M256,0C114.6,0,0,114.6,0,256S114.6,512,256,512,512,397.4,512,256,397.4,0,256,0ZM410,333a77.78,77.78,0,0,1-77.7,77.7H179.7A77.78,77.78,0,0,1,102,333V180.4a77.84,77.84,0,0,1,77.7-77.7H332.3A77.84,77.84,0,0,1,410,180.4Z" />
                  </g>
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>