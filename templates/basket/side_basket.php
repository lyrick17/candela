<?php require("utilities/process_basket_sync.php"); // sync the basket to the databse ?>
<table style="width: 100%; margin: 10px 0;">
<?php foreach ($_SESSION['basket'] as $product_id => $quantity):
        $get_products = Products::get_product_info($product_id);
        if ($get_products):
            $product = mysqli_fetch_array($get_products, MYSQLI_ASSOC);
?>
        <tr>
            <td class="pbasket-td pb_item"><?= $product['name'] ?></td>
            <td class="pbasket-td pb_num"><?= $quantity ?></td>
            <td class="pbasket-td pb_num">P<?= number_format($quantity * $product['price'], 2) ?></td>
            <?php if (isset($remove_item) && $remove_item): ?>
            <form method="post" action="product.php">
                <td class="pbasket-td pb_ri">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>" />
                    <button type="submit" name="remove_item" style="color:red; font-size: 70%; background-color: #fff; border: none;">
                        Remove Item
                    </button>
                </td>
            </form>
            <?php endif; ?>
        </tr>
<?php   endif; 
    endforeach; ?>
        <tr>
            <td colspan="2" align="right" class="pbasket-td pb_total">Total</td>
            <td class="pbasket-td pb_num">P<?= number_format($total, 2) ?></td>
        </tr>
</table>