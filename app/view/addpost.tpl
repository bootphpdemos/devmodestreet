<!DOCTYPE html>
<html>
<head>
    <title>MS Admin Add Post</title>
</head>
<body>
    <form action="poststatus" method="post">
    <ul style="position: absolute;">
    </br>
        <li>
            <label for="posttitle">Post Title: </label>
            <input type="text" name="posttitle" id="posttitle" value="" />
        </li>
        </br>
        <li>
            <label for="linkurl">Media URL: </label>
            <input type="text" name="linkurl" id="linkurl" value="" />
        </li>
        </br>
        <li>
            <label for="linkurl">Post Content: </label>
             <textarea name="message" rows="5" cols="20"></textarea>
        </li>
        </br>
            <input type="submit" value="submit" />
            <input type="reset" value="reset" />
       
    </ul>
    </form>
</body>
</html>