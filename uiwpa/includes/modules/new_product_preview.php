<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: new_product_preview.php 3009 2006-02-11 15:41:10Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// copy image only if modified
/*
        if (!isset($_GET['read']) || $_GET['read'] == 'only') {
          $products_image = new upload('products_image');
          $products_image->set_destination(DIR_FS_CATALOG_IMAGES . $_POST['img_dir']);
          if ($products_image->parse() && $products_image->save($_POST['overwrite'])) {
            $products_image_name = $_POST['img_dir'] . $products_image->filename;
          } else {
            $products_image_name = (isset($_POST['products_previous_image']) ? $_POST['products_previous_image'] : '');
          }
        }
*/
$image_limitation_num = 4;
$no_image_upload = true;
$products_image = array();
$products_image_name = array();
$products_saved_folder = $_POST['img_dir'];
for($i=0;$i<=$image_limitation_num-1;$i++){
    if (!isset($_GET['read']) || $_GET['read'] == 'only') {
        $form_name = 'products_image_' . $i;
        $products_image[$i] = new upload($form_name);
        $products_image[$i]->set_destination(DIR_FS_CATALOG_IMAGES . $_POST['img_dir']);
        if ($products_image[$i]->parse() && $products_image[$i]->save($_POST['overwrite'])) {
            $products_image_name[$i] = $_POST['img_dir'] . $products_image[$i]->filename;
        } else {
            $products_image_name[$i] = (isset($_POST['products_previous_image']) ? $_POST['products_previous_image'] : '');
        }
        if($products_image_name[$i]!= ''){
            $no_image_upload = false;
        }
    }
}
?>