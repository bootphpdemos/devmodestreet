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
      <tr style="text-align: center;">
        <td>{$prod.id}</td>
        <td>{$prod.proname}</td>
        <td>{$prod.proprice}</td>
        <td><a href="/cart?userid={$profile1.userid}&prodid={$prod.id}"> BUY </a></td>
      </tr>
      {/foreach}
    </table>
</body>
</html>