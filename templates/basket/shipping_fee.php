<div class="shipping-fee">
    <?php if ($total < 2000): ?>
            Shipping Fee : P50.00<br>
            <span style="float: right;">
                <?php 
                $shippingfee = 50;
                $subtotal = $total + $shippingfee; 
                ?>
                Total : <b>P<?= number_format($subtotal, 2); ?></b>
                <?php 
                $_SESSION['total'] = $subtotal;
                ?>
            </span>
    <?php else: ?>
            <span style="text-decoration: line-through;">Shipping Fee: P50.00</span><br>
            <span style="float: right;">
                Total: <b><?= number_format($total, 2); ?></b>
                <?php $_SESSION['total'] = $total; ?>
            </span>
    <?php endif; ?>
</div>