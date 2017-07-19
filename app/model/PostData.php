<?php

namespace app\model {

use app\service\R;

	/**
     * Class PostData <PostDetails>
     * @package app\model
     */
	 class PostData
    {
    	 public static $POST_TABLE = "postdetails";
    	 public static $POST_ERROR = "Something Error";
    	 public static $POST_USER = "userdetails";

    	 public static $SQL = null;
    	 //public static $POST_USER_TABLE = "postuseruetails";

    	/**
         * Add Post
         * @param $userid
         * @param $title
         * @param $content
         * @param $images is string  or Array[]
         * @return $postid OtherWise ERROR
         */
    	 static function AddPost($userid, $title, $content, $images){
        	if(!empty($userid) && (!empty($title) && !empty($content))){

        		$postentery = R::dispense(self::$POST_TABLE);
        		$postentery->userid = $userid;
        		$postentery->title = $title;
        		$postentery->content = $content;
        		$postentery->images = $images;
        		$postid = R::store($postentery);
        	}
        	if(!empty($postid)){
        		return $postid;
        	}else{
        		return self::$POST_ERROR;
        	}

        	}

        /**
         * Add Post
         * @param $postid
         * @return <PostDetails>[] -  All Post Details.
         */

        static function getpost($postid)
        {
        	$postid = R::load(self::$POST_TABLE, $postid);
        	$postdetails = $postid->via(self::$POST_USER)->sharedPostDetails;
        	return $postdetails;
        	}

    	}
	}
?>