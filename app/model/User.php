<?php

namespace app\model {

    /**
     * Description of User, it basically extends AbstractUser and implemetns atleast two methods
     *
     * @Model(sessionUser)
     */
    class User extends AbstractUser
    {

        public function auth($username, $passowrd)
        {
            return true;
        }

    }
}
