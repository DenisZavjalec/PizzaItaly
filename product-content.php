<?php
$product_id = get_the_ID();
$product_attributes = carbon_get_post_meta($product_id, 'item_attributes');
$product_price = carbon_get_post_meta($product_id, 'item_price');
$product_img_src = get_the_post_thumbnail_url($product_id, 'product');

$product_categories = get_the_terms($product_id, 'product-categories');
$product_categories_str = '';
foreach ($product_categories as $category) {
  $product_categories_str .= $category->name;
}
$product_categories_str = rtrim($product_categories_str, ',');
?>


<div class="catalog__item" data-category="<?php echo $product_categories_str; ?>">
  <div class="product catalog__product">
    <picture>
      <source type="image/webp"
        srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
        data-srcset="<?php echo $product_img_src; ?>">
      <img class="product__img lazy"
        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="
        data-src="<?php echo get_template_directory_uri(); ?>/assets/img/section-catalog/1.png" alt="">
    </picture>
    <div class="product__content">
      <h3 class="product__title">
        <?php echo the_title(); ?>
      </h3>
      <p class="product__description">
        <?php echo the_excerpt(); ?>
      </p>
    </div>
    <div class="product__footer">
      <?php if ($product_attributes): ?>
        <div class="product__sizes">
          <?php $is_first_item = true; ?>
          <?php foreach ($product_attributes as $attribute): ?>
            <?php
            $attribute_active_class = $is_first_item ? 'is-active' : ''; ?>
            <button data-product-size-price="<?php echo $attribute['price']; ?>"
              class="product__size <?php echo $attribute_active_class; ?>" type="button">
              <?php echo $attribute['name']; ?>
            </button>
            <?php
            $is_first_item = false;
          endforeach;
          ?>
        </div>
      <?php endif; ?>
      <div class="product__bottom">
        <div class="product__price">
          <span class="product__price-value">
            <?php echo $product_price ?>
          </span>
          <span class="product__currency">&#8372;</span>
        </div>
        <button class="btn product__btn" type="button" data-popup="popup-order">Замовити</button>
      </div>
    </div>
  </div>
</div>

