<html>
<head>

</head>

<body>


<table>
    <tr>
        <td width="50%">
            <h4>
                Cart
            </h4>
            <table>
                {foreach $items as $item}
                    <tr>
                        <td>{$item->fetchAs("product")->item->title}</td>
                        <td>{$item->quantity}</td>
                    </tr>
                {/foreach}

            </table>


        </td>
        <td width="50%">


            <h4>
                Products
            </h4>


            <table>
                {foreach $products as $product}
                    <tr>
                        <td>{$product->title}</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="product_id" value="{$product->id}">
                                <button name="action" value="add2cart">Buy</button>
                            </form>
                        </td>
                    </tr>
                {/foreach}
            </table>


            <form method="post" mul>
                <input name="title" value="">
                <button name="action" value="addproduct">Add Product</button>
            </form>


        </td>
    </tr>

</table>


</body>

</html>