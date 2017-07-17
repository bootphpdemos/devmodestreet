<?php
namespace app\controller {

    use app\service\R;

    class CartController extends AbstractController
    {

        /**
         * @Description - Products page
         *
         * @RequestMapping(url="products",method="GET",type="template")
         * @RequestParams(true)
         */
        public function productsx($model = null, $userid = null)
        {

            $prolist = R::findAll('productdetail', ' ORDER BY id ASC');
            //return $prolist;
            $profile1 = array(
                "userid" => $userid
            );

            $model->assign("profile1", $profile1);
            $model->assign("productsl", $prolist);

            return "products";
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
                \app\model\ShoppingCart::addItem($prod,1);
                $val = \app\model\ShoppingCart::getItems();
                $model->assign("cartdetail", $val);
                return "cart";
            } else {
                return "userlogin";
            }

        }


    }
}
?>