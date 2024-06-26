<?php require("utilities/process_basket_sync.php"); // sync the basket to the databse ?>
<table class="w-100">
<?php foreach ($_SESSION['basket'] as $product_id => $quantity):
        $get_products = Products::get_product_info_hide($product_id, 0);
        if ($get_products):
            $product = mysqli_fetch_array($get_products, MYSQLI_ASSOC);
?>
            <tr class="row p-2">
                
                <?php if (isset($remove_item) && $remove_item): // this is displayed WITHOUT picture ?>
                    <td class="pbasket-td col-5"><?= $product['name'] ?></td>
                <?php else: // this is displayed WITH picture ?>
                    <td class="pbasket-td col-4 text-center"><img src="<?= $product['image'] ?>"  alt="<?= $product['name'] ?>" height="75"></td>
                    <td class="pbasket-td col-3"><?= $product['name'] ?></td>
                <?php  endif; ?>

                <td class="pbasket-td col-2"><?= $quantity ?></td>

                <td class="pbasket-td col-3">P<?= number_format($quantity * $product['price'], 2) ?></td>
                
                <?php if (isset($remove_item) && $remove_item): // this is displayed WITHOUT picture ?>
                <form method="post" action="product.php">
                    <td class="pbasket-td col-2">
                        <input type="hidden" name="product_id" value="<?= $product_id ?>" />
                        <button type="submit" name="remove_item" class="remove-item">
                            Remove Item
                        </button>
                    </td>
                </form>
                <?php endif; ?>
            </tr>
<?php   endif; 
    endforeach; ?>
            <tr class="row">
                <td colspan="2" class="pbasket-td col-7 text-end">Total</td>
                <td class="pbasket-td col-5">P<?= number_format($total, 2) ?></td>
            </tr>
</table>