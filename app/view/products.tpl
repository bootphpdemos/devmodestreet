<!DOCTYPE html>
<html>
<head>
    <title>MS Products</title>
</head>
<body>
    <table width="100%" border="1">
      <tr style="text-align: center;">
        <td>Product Id</td>
        <td>Product Name</td>
        <td>Product Price</td>
        <td>Action</td>
      </tr>
      {foreach key=pid item=prod from=$productsl}
      <form action="cart" method="post">
      <tr style="text-align: center;">
        <td>{$prod.id}</td>
        <td>{$prod.proname}</td>
        <td>{$prod.proprice}</td>
        <input type="hidden" name="userid" value="{$profile1.userid}" />
        <input type="hidden" name="prodid" value="{$prod.id}" />
        <td><input type="submit" value="BUY" /></td>
      </tr>
      </form>
      {/foreach}
    </table>
</body>
</html>