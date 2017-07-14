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

             $prolist = R::findAll( 'productdetail' , ' ORDER BY id ASC' );
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
         */
        public function cartx($model =null, $userid = null, $prodid = null)
        {
            if(is_numeric($userid) && $userid != '' && $prodid != ''){
                $prod = R::findOne('productdetail',' id = ? ',array($prodid));
                $cart = R::dispense("cart");
                $cart['userid'] = $userid;
                $cart['prodid'] = $prodid;
                $cart['proname'] = $prod['proname'];
                $cart['proprice'] = $prod['proprice'];
                $cid = R::store($cart);
                $cartdetail = R::findOne('cart',' id = ? ',array($cid));
                $model->assign("cartdetail", $cartdetail);
                 return "cart";
            }else{
            	return "userlogin";
            }
          
        }        


    }
}
?>