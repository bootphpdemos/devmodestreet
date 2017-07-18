<?php
namespace app\controller {

    use app\model\ShoppingCart;
    use app\service\R;

    class TestController extends AbstractController
    {

        /**
         * @Description - Products page
         *
         * @RequestMapping(url="test/cart",type="template")
         * @RequestParams(true)
         */
        public function productsx($model = null, $action = null, $product_id = null,
                                  $title = null, $description = null, $cart_id = null)
        {

            if (!empty($cart_id)) {
                ShoppingCart::switchToCart($cart_id);
            }

            if ($action == "add2cart") {
                $product = R::load("product", $product_id);
                ShoppingCart::addItem($product, 1);
            } else if ($action == "addproduct") {
                $product = R::dispense("product");
                $product->title = $title;
                $product->description = $description;
                R::store($product);
            }


            $products = R::find("product");
            $model->assign("products", $products);

            $items = ShoppingCart::getItems();
            $model->assign("items", $items);

            return "test/cart";
        }

    }
}
?>