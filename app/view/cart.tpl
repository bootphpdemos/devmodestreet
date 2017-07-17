<!DOCTYPE html>
<html>
<head>
    <title>MS Cart</title>
</head>
<body>
{foreach from=$cartdetail key=arrayIndex item=trecord}
   {$arrayIndex}: {$trecord}
   <br>
{/foreach}
<h3> Welcome User </h3>
    <table width="100%" border="1">
      <tr style="text-align: center;">
        <td>Product Name</td>
        <td>Product Price</td>
        <td>Action</td>
      </tr>
      <tr style="text-align: center;">
        <td>{$cartdetail.proname}</td>
        <td>{$cartdetail.proprice}</td>
        <td> Payment </td>
      </tr>
    </table>
</body>
</html>