<?php if (isset($_GET['orders'])): ?>
<?php   if ($_GET['orders'] == 1): ?>
            <a href="admin.php?orders=1" class="order-buttons active">New</a>
            <a href="admin.php?orders=2" class="order-buttons">Prepared</a>
            <a href="admin.php?orders=3" class="order-buttons">Out</a>
            <a href="admin.php?orders=4" class="order-buttons">Delivered</a>
            <a href="admin.php?orders=5" class="order-buttons">Cancelled</a>
<?php 	elseif ($_GET['orders'] == 2): ?>
            <a href="admin.php?orders=1" class="order-buttons">New</a>
            <a href="admin.php?orders=2" class="order-buttons active">Prepared</a>
            <a href="admin.php?orders=3" class="order-buttons">Out</a>
            <a href="admin.php?orders=4" class="order-buttons">Delivered</a>
            <a href="admin.php?orders=5" class="order-buttons">Cancelled</a>
<?php	elseif ($_GET['orders'] == 3): ?>
            <a href="admin.php?orders=1" class="order-buttons">New</a>
            <a href="admin.php?orders=2" class="order-buttons">Prepared</a>
            <a href="admin.php?orders=3" class="order-buttons active">Out</a>
            <a href="admin.php?orders=4" class="order-buttons">Delivered</a>
            <a href="admin.php?orders=5" class="order-buttons">Cancelled</a>
<?php	elseif ($_GET['orders'] == 4): ?>
            <a href="admin.php?orders=1" class="order-buttons">New</a>
            <a href="admin.php?orders=2" class="order-buttons">Prepared</a>
            <a href="admin.php?orders=3" class="order-buttons">Out</a>
            <a href="admin.php?orders=4" class="order-buttons active">Delivered</a>
            <a href="admin.php?orders=5" class="order-buttons">Cancelled</a>
<?php 	else: ?>
            <a href="admin.php?orders=1" class="order-buttons">New</a>
            <a href="admin.php?orders=2" class="order-buttons">Prepared</a>
            <a href="admin.php?orders=3" class="order-buttons">Out</a>
            <a href="admin.php?orders=4" class="order-buttons">Delivered</a>
            <a href="admin.php?orders=5" class="order-buttons active">Cancelled</a>
<?php 	endif; ?>
<?php else: ?>
            <a href="admin.php?orders=1" class="order-buttons active">New</a>
            <a href="admin.php?orders=2" class="order-buttons">Prepared</a>
            <a href="admin.php?orders=3" class="order-buttons">Out</a>
            <a href="admin.php?orders=4" class="order-buttons">Delivered</a>
            <a href="admin.php?orders=5" class="order-buttons">Cancelled</a>
<?php endif; ?>