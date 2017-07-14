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
      {foreach key=pid item=prod from=$products}
      <tr>
        <td>{$prod.proname}</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      {/foreach}
    </table>
     Hello {$profile.userid}
</body>
</html>