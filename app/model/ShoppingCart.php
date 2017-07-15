<?php
/**
 * Created by IntelliJ IDEA.
 * User: amitmaddheshiya
 * Date: 21/06/17
 * Time: 4:03 PM
 */

namespace app\model;

use app\service\R;

/**
 * Class ShoppingCart <CartItem>
 * @package app\model
 */
class ShoppingCart
{
    public static $USER_CART = "shoppingcart";
    public static $USER_CART_ITEM = "cartitem";
    public static $USER_CART_ITEM_LINK = "shoppingcartitem";

    public static $COOKIE_KEY = "cartid";

    public static $cart = null;
    public static $cart_id = null;

    static function init()
    {
        if (isset($_COOKIE[self::$COOKIE_KEY])) {
            self::$cart_id = $_COOKIE[self::$COOKIE_KEY];
            self::$cart = R::load(self::$USER_CART, self::$cart_id);
        }
        if (empty(self::$cart) || empty(self::$cart->id)) {
            self::$cart = R::dispense(self::$USER_CART);
            self::$cart_id = R::store(self::$cart);
        }
        setcookie(self::$COOKIE_KEY, self::$cart_id, 0, "/");
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
        self::$cart_id = $cart_id;
        self::$cart = R::load(self::$USER_CART, self::$cart_id);
        setcookie(self::$COOKIE_KEY, self::$cart_id, 0, "/");
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
        $cart = R::load(self::$USER_CART, $cart_id);
        if (!empty($cart->id)) {
            $cartitems = self::$cart->via(self::$USER_CART_ITEM_LINK)->sharedCartitemList;
            foreach ($cartitems as $cartitem) {
                $cartitem->{self::$USER_CART} = $cart;
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
        $cart = R::load(self::$USER_CART, $cart_id);
        if (!empty($cart->id)) {
            $cartitems = $cart->via(self::$USER_CART_ITEM_LINK)->sharedCartitemList;
            foreach ($cartitems as $cartitem) {
                $cartitem->{self::$USER_CART} = self::$cart;
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
        self::$cart->link(self::$USER_CART_ITEM_LINK, array(
            "quantity" => $quantity
        ))->cartitem = $cartitem;
        return R::store(self::$cart);
    }

    /**
     * @return <CartItem>[] -  All items in Cart.
     */
    static function getItems()
    {
        ShoppingCart::init();
        $cartitems = self::$cart->via(self::$USER_CART_ITEM_LINK)->sharedCartitemList;
        return $cartitems;
    }


}