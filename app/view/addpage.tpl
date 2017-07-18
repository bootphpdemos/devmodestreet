<!DOCTYPE html>
<html>
<head>
    <title>MS Admin Add Page</title>
</head>
<body>
    <form action="pagestatus" method="post">
    <ul style="position: absolute;">
    </br>
        <li>
            <label for="pagename">Page Name: </label>
            <input type="text" name="pagename" id="pagename" value="" />
        </li>
        </br>
        <li>
            <label for="redirect_uri">Redirect URL: </label>
            <input type="text" name="redirect_uri" id="redirect_uri" value="" />
        </li>
        </br>
        <li>
            <label for="app_id">app_id: </label>
            <input type="text" name="app_id" id="app_id" value="" />
        </li>
        </br>
            <input type="submit" value="submit" />
            <input type="reset" value="reset" />
       
    </ul>
    </form>
</body>
</html>