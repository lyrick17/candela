<nav id="bottom_header" class="navbar bg-color-1 padding-x-1 sticky-bottom collapse show">
	<div class="container-fluid">
		<!-- BRAND -->
		<div class="btn-group dropup">
            <button type="button" class="btn candela-btn-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Candela Menu
            </button>
            <ul class="dropdown-menu bg-color-1">
                <li>
					<a href="index.php" class="navi">Home</a>
				</li>
                <li>
					<a href="product.php" class="navi">Product</a>
				</li>
				<li>
					<a href="faqs.php" class="navi">FAQs</a>
				</li>
				<li>
					<a href="about.php" class="navi">About</a>
				</li>
				<li>
					<a href="contact-us.php" class="navi">Contact Us</a>
				</li>
				<?php if (isset($_SESSION['type']) && $_SESSION['type'] == 1): ?>
					<li>
						<a href="admin.php" class="navi">Admin</a>
					</li>
				<?php endif; ?>
            </ul>
        </div>
	
		
		<!-- BASKET -->
		<div id="nav-basket">
			<a href="basket.php" onmouseover="document.images.basketimg.src = 'images/basket-hover.png'" onmouseout="document.images.basketimg.src='images/basket.png'">
				<img src="images/basket.png" name="basketimg" height="17px"> 
				Basket
			</a>
		</div>

	</div>
</nav>