<?php
/**
* Template designed by pixemus.com
* pixemus.com - Free ecommerce templates and design services
*
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_reviews_default.php 4852 2006-10-28 06:47:45Z drbyte $
 */
?>
<div class="centerColumn" id="reviewsDefault">
<h1 id="productReviewsDefaultHeading"><?php echo $products_name . $products_model; ?></h1>

<?php
  if (zen_not_null($products_image)) {
  /**
   * require the image display code
   */
?>
<div id="productReviewsDefaultProductImage" class="centeredContent back"><?php require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?></div>
<?php
  }
?>
<div class="forward">
<div class="buttonRow">
<?php
        // more info in place of buy now
        if (zen_has_product_attributes($review->fields['products_id'] )) {
          //   $link = '<p>' . '<a href="' . zen_href_link(zen_get_info_page($review->fields['products_id']), 'products_id=' . $review->fields['products_id'] ) . '">' . MORE_INFO_TEXT . '</a>' . '</p>';
          $link = '';
        } else {
          $link= '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action', 'reviews_id')) . 'action=buy_now') . '">' . zen_image_button(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT) . '</a>';
        }
        $the_button = $link;
        $products_link = '';
        echo zen_get_buy_now_button($review->fields['products_id'], $the_button, $products_link) . '<br />' . zen_get_products_quantity_min_units_display($review->fields['products_id']);
      ?>
</div>
<div id="productReviewsDefaultProductPageLink" class="buttonRow"><?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT) . '</a>'; ?></div>
</div>

<span id="productReviewsDefaultPrice" class=""><?php echo $products_price; ?></span>

<br class="clearBoth" />

<?php
  if ($reviews_split->number_of_rows > 0) {
    if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
?>

<div id="productReviewsDefaultListingTopNumber" class="navSplitPagesResult"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div>

<div id="productReviewsDefaultListingTopLinks" class="navSplitPagesLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>

<?php
    }
    foreach ($reviewsArray as $reviews) {
?>
<hr />

<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . (int)$_GET['products_id'] . '&reviews_id=' . $reviews['id']) . '">' . zen_image_button(BUTTON_IMAGE_READ_REVIEWS , BUTTON_READ_REVIEWS_ALT) . '</a>'; ?></div>

<div class="productReviewsDefaultReviewer bold"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, zen_date_short($reviews['dateAdded'])); ?>&nbsp;<?php echo sprintf(TEXT_REVIEW_BY, zen_output_string_protected($reviews['customersName'])); ?></div>

<div class="rating"><?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $reviews['reviewsRating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviewsRating'])), sprintf(TEXT_OF_5_STARS, $reviews['reviewsRating']); ?></div>

<div class="productReviewsDefaultProductMainContent content"><?php echo zen_break_string(zen_output_string_protected(stripslashes($reviews['reviewsText'])), 60, '-<br />') . ((strlen($reviews['reviewsText']) >= 100) ? '...' : ''); ?></div>


<br class="clearBoth" />
<?php
    }
?>
<?php
  } else {
?>
<hr />
<div id="productReviewsDefaultNoReviews" class="content"><?php echo TEXT_NO_REVIEWS . (REVIEWS_APPROVAL == '1' ? '<br />' . TEXT_APPROVAL_REQUIRED: ''); ?></div>
<br class="clearBoth" />
<?php
  }

  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<hr />
<div id="productReviewsDefaultListingBottomNumber" class="navSplitPagesResult"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div>
<div id="productReviewsDefaultListingBottomLinks" class="navSplitPagesLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>

<?php
  }
?>

    <div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?></div>

</div>
