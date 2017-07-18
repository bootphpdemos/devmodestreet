<?php
namespace app\controller {

    use app\service\R;

    class AdminController extends AbstractController
    {
    	/**
         * @Description - Admin Home page
         *
         * @RequestMapping(url="admin/home",method="GET",type="template")
         * @RequestParams(true)
         */
        public function adminhome($model = null)
        {
            return "adminhome";
        }

        /**
         * @Description - Admin add page
         *
         * @RequestMapping(url="admin/addpage",method="Post",type="template")
         * @RequestParams(true)
         */
        public function addpage($model = null)
        {
        	return "addpage";
        }

        /**
         * @Description - Check Add page
         *
         * @RequestMapping(url="admin/pagestatus",method="Post",type="template")
         * @RequestParams(true)
         */
        public function addpagestatus($model = null, $pagename = null)
        {
           	if(isset($pagename) && $_POST['redirect_uri'] != '' && !empty($pagename)){
	           	$addpage = R::dispense("addpage");
	            $addpage['name'] = $pagename;
	            $addpage['redirecturl'] = $_POST['redirect_uri'];
	            $id = R::store($addpage);

           		return "addpagesuccess"; 
           	}else{

           		echo "Please Enter Correct Detail";
           		return "addpage";
           	}
        	
        }

        /**
         * @Description - Admin add post
         *
         * @RequestMapping(url="admin/addpost",method="Post",type="template")
         * @RequestParams(true)
         */
        public function addpost($model = null)
        {
        	return "addpost";
        }

        /**
         * @Description - Check Add post
         *
         * @RequestMapping(url="admin/poststatus",method="Post",type="template")
         * @RequestParams(true)
         */
        public function addpoststatus($model = null, $posttitle = null)
        {
           	if(isset($posttitle) && $_POST['message'] != '' && !empty($posttitle)){
           		// $dir_path = "app/media/";
           		// $main_file = $dir_path . basename($_FILES["fileToUpload"]["name"]);
           		// print_r($_FILES);
           		// $dir_path = "app/media/";
           		// $main_file = $dir_path . basename($_FILES["fileToUpload"]["name"]);
           		// if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $main_file)){

           			$addpost = R::dispense("addpost");
	            	$addpost['title'] = $posttitle;
	            	$addpost['content'] = $_POST['message'];
	            	$addpost['imageurl'] = $_POST['linkurl'];
	            	$id = R::store($addpost);

           			return "addpostsuccess";
           		// }else{
           		// 	echo "File Not Upload";
           		 return "addpost";
           		// }
           	}else{
           		echo "Please Enter Correct Detail";
           		return "addpost";
           	}
        }

        /**
         * @Description - Admin add User
         *
         * @RequestMapping(url="admin/adduser",method="Post",type="template")
         * @RequestParams(true)
         */
        public function adduser($model = null)
        {
        	return "adduser";
        }

        /**
         * @Description - Check Add user
         *
         * @RequestMapping(url="admin/userstatus",method="Post",type="template")
         * @RequestParams(true)
         */
        public function adduserstatus($model = null, $username = null)
        {
           	if(isset($username) && !empty($_POST['useremail']) && !empty($username) && !empty($_POST['userpasword']) ){
	           	$adduser = R::dispense("adduser");
	            $adduser['username'] = $username;
	            $adduser['userimage'] = $_POST['userimage'];
	            $adduser['email'] = $_POST['useremail'];
	            $adduser['password'] = $_POST['userpasword'];
	            $id = R::store($adduser);

           		return "addusersuccess"; 
           	}else{

           		echo "Please Enter Correct Detail";
           		return "adduser";
           	}
        	
        }


    }
}

?>