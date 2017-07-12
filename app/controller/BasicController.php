<?php

namespace app\controller {

    use app\service\R;

    class BasicController extends AbstractController
    {

        /**
         * @Description - Welcome page
         *
         * @RequestMapping(url="welcome",method="GET",type="template")
         * @RequestParams(true)
         */
        public function welcome($model = null, $name = null)
        {

            $profile = array(
                "name" => $name
            );

            $model->assign("profile", $profile);

            return "welcome";
        }


        /**
         * @Description - Json Api
         *
         * @RequestMapping(url="api/product/add",method="POST",type="json")
         * @RequestParams(true)
         */
        public function sampleApi($product_name = null, $pro_price = null)
        {

            $product = R::dispense("productdetail");
            $product['proname'] = $product_name;
            $product['proprice'] = $pro_price;
            $id = R::store($product);
            return array(
                "id" => $id,
                "Product Name" => $product_name,
                "Product Price" => $pro_price
            );

        }

         /**
         * @Description - Json Api
         *
         * @RequestMapping(url="api/product/list",method="POST",type="json")
         * @RequestParams(true)
         */
        public function productlist()
        {

            $prolist = R::findAll( 'productdetail' , ' ORDER BY id DESC LIMIT 10 ' );
            return $prolist;
        }


        /**
         * @Description - Json Api
         *
         * @RequestMapping(url="api/product/buy",method="POST",type="json")
         * @RequestParams(true)
         */
        public function productbuy($pro_id = null, $user_id =  null)
        {
            $prod = R::findOne('productdetail',' id = ? ',array($pro_id));
            $cart = R::dispense("cart");
            $cart['userid'] = $user_id;
            $cart['prodid'] = $pro_id;
            $cart['proname'] = $prod['proname'];
            $cart['proprice'] = $prod['proprice'];
            $cid = R::store($cart);
            $cartdetail = R::findOne('cart',' id = ? ',array($cid));
           return $cartdetail;
        }

        /**
         * @Description - Default page
         *
         * @RequestMapping(url="",method="GET",type="template")
         * @RequestParams(true)
         */
        public function index($model = null)
        {
            return "index";
        }
    }
}