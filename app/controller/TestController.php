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
                                  $title = null, $description = null)
        {

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

        /**
         * @Description - Cart page
         *
         * @RequestMapping(url="cart",method="POST",type="template")
         * @RequestParams(true)
         *
         */
        public function cartx($model = null, $userid = null, $prodid = null)
        {
            if (is_numeric($userid) && $userid != '' && $prodid != '') {
                $prod = R::findOne('productdetail', ' id = ? ', array($prodid));
                $cart = R::dispense("cart");
                $cart['userid'] = $userid;
                $cart['prodid'] = $prodid;
                $cart['proname'] = $prod['proname'];
                $cart['proprice'] = $prod['proprice'];
                $cid = R::store($cart);
                $cartdetail = R::findOne('cart', ' id = ? ', array($cid));
                $model->assign("cartdetail", $cartdetail);
                return "cart";
            } else {
                return "userlogin";
            }

        }


    }
}
?>