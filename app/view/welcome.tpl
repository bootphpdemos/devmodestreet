<!DOCTYPE html>
<html>
<head>
    <title>RudraX : Welcome page</title>
</head>
<body>
<h1>
    Hello {$profile.name}
</h1>
This is my Home Page
</br>
Date: {$smarty.now|date_format:"%b %e, %Y"}
</body>
</html>