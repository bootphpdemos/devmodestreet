<?php
/**
 * Created by IntelliJ IDEA.
 * User: lalittanwar
 * Date: 19/07/17
 * Time: 8:59 PM
 */

namespace app\model;


class PostModel extends BasicModel
{

    public function __construct($post_id = null)
    {
        $this->bean = R::load(self::$POST_TABLE, $post_id);
    }

    public function setAuthor($user_id)
    {
        $this->bean->user = $user_id;
    }

}