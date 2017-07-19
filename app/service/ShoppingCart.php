<?php
/**
 * Created by IntelliJ IDEA.
 * User: amitmaddheshiya
 * Date: 21/06/17
 * Time: 4:03 PM
 */

namespace app\service {

    /**
     * Class ShoppingCart <CartItem>
     * @package app\model
     */
    class ShoppingCart
    {
        public static $TABLE_CART = "shoppingcart";
        public static $TABLE_CART_ITEM = "item";
        public static $TABLE_CART_ITEM_LINK = "shoppingcartitem";

        public static $COOKIE_KEY = "cartid";

        public static $cart = null;
        public static $cart_id = null;


        static function configure()
        {
            $config = \Config::getSection("SHOPPINGCART_CONFIG");
            if (!empty($config)) {
                self::$TABLE_CART = (isset($config['TABLE_CART']) && !empty($config['TABLE_CART']))
                    ? $config['TABLE_CART'] : self::$TABLE_CART;
                self::$TABLE_CART_ITEM = (isset($config['TABLE_CART_ITEM']) && !empty($config['TABLE_CART_ITEM']))
                    ? $config['TABLE_CART_ITEM'] : self::$TABLE_CART_ITEM;
                self::$TABLE_CART_ITEM_LINK = (isset($config['TABLE_CART_ITEM_LINK']) && !empty($config['TABLE_CART_ITEM_LINK']))
                    ? $config['TABLE_CART_ITEM_LINK'] : self::$TABLE_CART_ITEM_LINK;
            }
        }

        static function init()
        {
            if (empty(self::$cart) || empty(self::$cart->id)) {
                if (isset($_COOKIE[self::$COOKIE_KEY])) {
                    $cart_id = self::setCartId($_COOKIE[self::$COOKIE_KEY]);
                    self::$cart = R::load(self::$TABLE_CART, $cart_id);
                }
                if (empty(self::$cart) || empty(self::$cart->id)) {
                    self::$cart = R::dispense(self::$TABLE_CART);
                    $cart_id = R::store(self::$cart);
                    self::setCartId($cart_id);
                }
            }
        }

        static function setCartId($cart_id)
        {
            self::$cart_id = $cart_id;
            $_COOKIE[self::$COOKIE_KEY] = self::$cart_id;
            setcookie(self::$COOKIE_KEY, self::$cart_id, 0, "/");
            return self::$cart_id;
        }

        /**
         * @return int - cart id
         */
        static function getCartId()
        {
            return self::$cart_id;
        }


        /**
         * Switch To Another Cart
         *
         */
        static function switchToCart($cart_id)
        {
            $cart_id = self::setCartId($cart_id);
            self::$cart = R::load($cart_id);
        }


        /**
         * Add items from current to another cart.
         * If Given Cart already contains items, items will be merged.
         * And current cart will be loaded with all the items
         *
         * @param $cart_id
         */
        static function mergeToCart($cart_id)
        {
            $cart = R::load(self::$TABLE_CART, $cart_id);
            if (!empty($cart->id)) {
                $cartitems = self::$cart->via(self::$TABLE_CART_ITEM_LINK)->sharedCartitemList;
                foreach ($cartitems as $cartitem) {
                    $cartitem->{self::$TABLE_CART} = $cart;
                }
                R::storeAll($cartitems);
            }
        }


        /**
         * Loads items from given another cart, into current Cart.
         * If Current Cart already contains items, items will be merged.
         *
         * @param $cart_id
         */
        static function loadCartItems($cart_id)
        {
            $cart = R::load(self::$TABLE_CART, $cart_id);
            if (!empty($cart->id)) {
                $cartitems = $cart->via(self::$TABLE_CART_ITEM_LINK)->sharedCartitemList;
                foreach ($cartitems as $cartitem) {
                    $cartitem->{self::$TABLE_CART} = self::$cart;
                }
                R::storeAll($cartitems);
            }
        }

        /**
         * @param <CartItem> $cartitem
         * @param int $quantity
         * @return int - counter
         */
        static function addItem($cartitem, $quantity = 1)
        {
            ShoppingCart::init();
            $cartitemEntry = null;
            if (!empty($cartitem->id)) {
                $cartitemEntry = R::findOne(self::$TABLE_CART_ITEM_LINK,
                    sprintf("%s_id=? AND %s_id=?", self::$TABLE_CART, self::$TABLE_CART_ITEM),
                    array(self::$cart_id, $cartitem->id)
                );
            }
            if (empty($cartitemEntry)) {
                $cartitemEntry = R::dispense(self::$TABLE_CART_ITEM_LINK);
                $cartitemEntry->quantity = $quantity;
            } else {
                $cartitemEntry->quantity = $cartitemEntry->quantity + $quantity;
            }
            $cartitemEntry->{self::$TABLE_CART} = self::$cart;
            $cartitemEntry->{self::$TABLE_CART_ITEM} = $cartitem;
            return R::store($cartitemEntry);
        }

        /**
         * @return <CartItem>[] -  All items in Cart.
         */
        static function getItems()
        {
            ShoppingCart::init();
            $cartitems = self::$cart->{"own" . ucfirst(self::$TABLE_CART_ITEM_LINK) . "List"};
            return $cartitems;
        }

    }

    ShoppingCart::configure();

}
