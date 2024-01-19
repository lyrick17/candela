<?php include("server.php"); ?>
<!DOCTYPE html><html>
<head><title>Your Basket - Candela</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/png" href="images/candelalogo.png">
</head>
<body>
<!-- HEADER/NAVIGATION BAR -->
	<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav left">
			<li>0971-697-0022</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if (isset($_SESSION['username'])): ?>
				<li><a href="myaccount.php"><?php echo $_SESSION['username'];?>'s Account</a></li>
				<li><a href="logout.php">Log Out</a></li>
			<?php else: ?>
				<li><a href="login-form.php">Log In</a></li>
				<li><a href="signup-form.php">Create An Account</a></li>
			<?php endif ?>
		</ul>
	</div>
</nav>
<div id="header">
	<div id="business-name">
		<a href="index.php"><img src="images/candela.png" alt="Candela" /></a>
	</div>

	<div class="navig-prov">
		<div class="navi">
			<a href="product.php">Product</a>
		</div>
		<div class="navi">
			<a href="faqs.php">FAQs</a>
		</div>
		<div class="navi">
			<a href="about.php">About</a>
		</div>
		<div class="navi">				
			<a href="contact-us.php">Contact Us</a>
		</div>
	</div>

	<div id="nav-basket">
		<a href="basket.php" onmouseover="document.images.basketimg.src = 'images/basket-hover.png'" onmouseout="document.images.basketimg.src='images/basket.png'"><img src="images/basket.png" name="basketimg" height="17px"> Basket</a>
	</div>
</div>
<!-- CONTENT -->
<div class="body-content">
<div id="myModal" class="modal">
<!-- Modal content -->
 	<div class="modal-content">
		<span class="close">&times;</span>
			<?php echo $termsConditions; ?>
	</div>
</div>
	<div id="basket-box">
		<div id="basket-header">
			Your Basket
		</div>
			<hr>
			<!-- PHP NEEDED --><!-- changing its quantity on the basket itself -->
		<!-- When An Order Has Been Added to Basket -->

				<?php
					while ($p1_stockrow = mysqli_fetch_array($p1result)) {
						$p1_stock = $p1_stockrow['stocks'];
					}
					while ($p2_stockrow = mysqli_fetch_array($p2result)) {
						$p2_stock = $p2_stockrow['stocks'];
					}
					while ($p3_stockrow = mysqli_fetch_array($p3result)) {
						$p3_stock = $p3_stockrow['stocks'];
					}
					while ($p4_stockrow = mysqli_fetch_array($p4result)) {
						$p4_stock = $p4_stockrow['stocks'];
					}
					while ($p5_stockrow = mysqli_fetch_array($p5result)) {
						$p5_stock = $p5_stockrow['stocks'];
					}
					while ($p6_stockrow = mysqli_fetch_array($p6result)) {
						$p6_stock = $p6_stockrow['stocks'];
					}
				if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
					$basket_id = intval($_SESSION['id']);

					$basketsql = "SELECT basket_content FROM basket_items WHERE user_id = '". $basket_id ."'";
					$basketsql_result = mysqli_query($mysqli, $basketsql) or die("Query to retrieve basket failed");
					if (mysqli_num_rows($basketsql_result) < 1) {
				?>
				
					<div style="text-align: center;margin-top: 15px;">
						<p>Your Basket Is Empty.</p>
						<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
					</div>

				<?php
					} else {

						$total = 0;

				?>
		<form method="POST" action="basket.php">
		<div class="table-responsive">
			<table>
				<tr>
					<td class="basket-td bktd1">Item</td>
					<td class="basket-td bktd2"></td>
					<td class="basket-td bktd3">Price</td>
					<td class="basket-td bktd4">Quantity</td>
					<td class="basket-td bktd3">Total</td>
					<td class="basket-td bktd4"></td>
				</tr>
				<?php
				 while ($basketrow = mysqli_fetch_array($basketsql_result)) {
						$basket = unserialize( $basketrow['basket_content'] );
						$_SESSION['basket'] = $basket;
						foreach ($_SESSION['basket'] as $key => $product) {
							$lessStock = array();
								if ($product['id'] == 1) {
									if ($product['quantity'] > $p1_stock) {
										$product['quantity'] = $p1_stock;
										array_push($lessStock, "Error");
										$update_qty_sql1 = mysqli_query($mysqli, "UPDATE basket_items SET quantity = '". $p1_stock ."' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 1");
										$basket[1]['quantity'] = $p1_stock;
										$updated_basket = serialize($basket);
										$update_basket_string_sql1 = mysqli_query($mysqli, "UPDATE basket_items SET basket_content = '" . mysqli_real_escape_string($mysqli, $updated_basket) . "' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 1 ");
										$basket = unserialize($updated_basket);
										$_SESSION['basket'] = $basket;
										if ($p1_stock == 0) {
											$delete_order_sql = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 1");
										}
									}
								}
								if ($product['id'] == 2) {
									if ($product['quantity'] > $p2_stock) {
										$product['quantity'] = $p2_stock;
										array_push($lessStock, "Error");
										$update_qty_sql2 = mysqli_query($mysqli, "UPDATE basket_items SET quantity = '". $p2_stock ."' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 2");
										$basket[1]['quantity'] = $p2_stock;
										$updated_basket = serialize($basket);
										$update_basket_string_sql2 = mysqli_query($mysqli, "UPDATE basket_items SET basket_content = '" . mysqli_real_escape_string($mysqli, $updated_basket) . "' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 2 ");
										$basket = unserialize($updated_basket);
										$_SESSION['basket'] = $basket;
										if ($p2_stock == 0) {
											$delete_order_sql = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 2");
										}

									}
								}
								if ($product['id'] == 3) {
									if ($product['quantity'] > $p3_stock) {
										$product['quantity'] = $p3_stock;
										array_push($lessStock, "Error");
										$update_qty_sql3 = mysqli_query($mysqli, "UPDATE basket_items SET quantity = '". $p3_stock ."' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 3");
										$basket[1]['quantity'] = $p3_stock;
										$updated_basket = serialize($basket);
										$update_basket_string_sql3 = mysqli_query($mysqli, "UPDATE basket_items SET basket_content = '" . mysqli_real_escape_string($mysqli, $updated_basket) . "' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 3 ");
										$basket = unserialize($updated_basket);
										$_SESSION['basket'] = $basket;
										if ($p3_stock == 0) {
											$delete_order_sql = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 3");
										}
									}
								}
								if ($product['id'] == 4) {
									if ($product['quantity'] > $p4_stock) {
										$product['quantity'] = $p4_stock;
										array_push($lessStock, "Error");
										$update_qty_sql4 = mysqli_query($mysqli, "UPDATE basket_items SET quantity = '". $p4_stock ."' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 4");
										$basket[1]['quantity'] = $p4_stock;
										$updated_basket = serialize($basket);
										$update_basket_string_sql4 = mysqli_query($mysqli, "UPDATE basket_items SET basket_content = '" . mysqli_real_escape_string($mysqli, $updated_basket) . "' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 4 ");
										$basket = unserialize($updated_basket);
										$_SESSION['basket'] = $basket;
										if ($p4_stock == 0) {
											$delete_order_sql = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 4");
										}
									}
								}
								if ($product['id'] == 5) {
									if ($product['quantity'] > $p5_stock) {
										$product['quantity'] = $p5_stock;
										array_push($lessStock, "Error");
										$update_qty_sql5 = mysqli_query($mysqli, "UPDATE basket_items SET quantity = '". $p5_stock ."' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 5");
										$basket[1]['quantity'] = $p5_stock;
										$updated_basket = serialize($basket);
										$update_basket_string_sql5 = mysqli_query($mysqli, "UPDATE basket_items SET basket_content = '" . mysqli_real_escape_string($mysqli, $updated_basket) . "' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 5 ");
										$basket = unserialize($updated_basket);
										$_SESSION['basket'] = $basket;
										if ($p5_stock == 0) {
											$delete_order_sql = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 5");
										}
									}
								}
								if ($product['id'] == 6) {
									if ($product['quantity'] > $p6_stock) {
										$product['quantity'] = $p6_stock;
										array_push($lessStock, "Error");
										$update_qty_sql6 = mysqli_query($mysqli, "UPDATE basket_items SET quantity = '". $p6_stock ."' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 6");
										$basket[1]['quantity'] = $p6_stock;
										$updated_basket = serialize($basket);
										$update_basket_string_sql6 = mysqli_query($mysqli, "UPDATE basket_items SET basket_content = '" . mysqli_real_escape_string($mysqli, $updated_basket) . "' WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 6 ");
										$basket = unserialize($updated_basket);
										$_SESSION['basket'] = $basket;
										if ($p6_stock == 0) {
											$delete_order_sql = mysqli_query($mysqli, "DELETE FROM basket_items WHERE user_id = '". $_SESSION['id'] ."' AND product_id = 6");
										}
									}
								}
								if (count($lessStock) != 0) {
									echo "<script>alert('Sorry, some of your orders have been reduced its quantity or removed, we have less stocks than your chosen quantity.')</script>";
								}
							
				?>
				<tr>
					<td class="basket-td bktd1">
						<img src="<?php echo $product['image']; ?>" height="200px">
					</td>
					<td class="basket-td bktd2"><i><?php echo $product['pname']; ?></i><br></td>
					<td class="basket-td bktd3">P<?php echo $product['price']; ?></td>
					<td class="basket-td bktd4"><?php echo $product['quantity']; ?></td>
					<td class="basket-td bktd3">P<?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
					<td class="basket-td bktd4"><a href="basket.php?action=delete&id=<?php echo $product['id'] ?>" style="color:red">Remove Item</a></td>
				</tr>
				<?php
							$total = $total + ($product['quantity'] * $product['price']);
						} // end foreach
						$_SESSION['total'] = $total;
				} // end while
				?>

				 <tr>
				 	<td colspan="4" align="right" class="basket-td bktd4">Total</td>
				 	<td class="basket-td bktd3">P<?php echo number_format($total, 2); ?></td>
				 	<td class="basket-td bktd4"></td>
				 </tr>
			</table>
		</div>
		<div style="text-align: center; margin-top: 15px;">
			<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
			<!--<a href="basket.php?action=update&id=<?php echo $product['id'] ?>" name="update" value="Update Basket" class="basket_buttons">Update Basket</a>-->
			<a href="product.php?action=clear&id=<?php echo $product['id'] ?>" class="basket_buttons" name="clear">Clear Basket</a>
			<a href="checkout.php" class="basket_buttons" name="checkout">Checkout >></a>
		</div>
	</form>
				<?php
					} //end else
					//else { ?>
				<?php
					//} //end else
				?>
				<?php
				} // end if isset username isset id 
				else {
					if (!empty($_SESSION['basket'])) {
						$total = 0;
				?>
		<form method="POST" action="basket.php">
		<div class="table-responsive">
			<table>
				<tr>
					<td class="basket-td bktd1">Item</td>
					<td class="basket-td bktd2"></td>
					<td class="basket-td bktd3">Price</td>
					<td class="basket-td bktd4">Quantity</td>
					<td class="basket-td bktd3">Total</td>
					<td class="basket-td bktd4"></td>
				</tr>
				<?php
						foreach ($_SESSION['basket'] as $key => $product) {
							if ($product['id'] == 1) {
								if ($product['quantity'] > $p1_stock) {
									$product['quantity'] = $p1_stock;
									if ($p1_stock == 0) {
										unset($_SESSION['basket'][$key]);
									}
								}
							}
							if ($product['id'] == 2) {
								if ($product['quantity'] > $p2_stock) {
									$product['quantity'] = $p2_stock;
									if ($p2_stock == 0) {
										unset($_SESSION['basket'][$key]);
									}
								}	
							}
							if ($product['id'] == 3) {
								if ($product['quantity'] > $p3_stock) {
									$product['quantity'] = $p3_stock;
									if ($p3_stock == 0) {
										unset($_SESSION['basket'][$key]);
									}
								}
							}
							if ($product['id'] == 4) {
								if ($product['quantity'] > $p4_stock) {
								$product['quantity'] = $p4_stock;
									if ($p4_stock == 0) {
										unset($_SESSION['basket'][$key]);
									}
								}
							}
							if ($product['id'] == 5) {
								if ($product['quantity'] > $p5_stock) {
									$product['quantity'] = $p5_stock;
									if ($p5_stock == 0) {
										unset($_SESSION['basket'][$key]);
									}
								}
							}
							if ($product['id'] == 6) {
								if ($product['quantity'] > $p6_stock) {
									$product['quantity'] = $p6_stock;
									if ($p6_stock == 0) {
										unset($_SESSION['basket'][$key]);
									}
								}
							}
				?>
				<tr>
					<td class="basket-td bktd1">
						<img src="<?php echo $product['image']; ?>" height="200px">
					</td>
					<td class="basket-td bktd2"><i><?php echo $product['pname']; ?></i><br></td>
					<td class="basket-td bktd3">P<?php echo $product['price']; ?></td>
					<td class="basket-td bktd4"><?php echo $product['quantity']; ?></td>
					<td class="basket-td bktd3">P<?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
					<td class="basket-td bktd4"><a href="basket.php?action=delete&id=<?php echo $product['id'] ?>" style="color:red">Remove Item</a></td>
				</tr>
				<?php
							$total = $total + ($product['quantity'] * $product['price']);
						} // end foreach
						$_SESSION['total'] = $total;
				?>

				 <tr>
				 	<td colspan="4" align="right" class="basket-td bktd4">Total</td>
				 	<td class="basket-td bktd3">P<?php echo number_format($total, 2); ?></td>
				 	<td class="basket-td bktd4"></td>
				 </tr>
			</table>
		</div>
		<div style="text-align: center; margin-top: 15px;">
			<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
			<!--<a href="basket.php?action=update&id=<?php echo $product['id'] ?>" name="update" value="Update Basket" class="basket_buttons">Update Basket</a>-->
			<a href="product.php?action=clear&id=<?php echo $product['id'] ?>" class="basket_buttons" name="clear">Clear Basket</a>
			<a href="checkout.php" class="basket_buttons" name="checkout">Checkout >></a>
		</div>
				<?php
					} //end if
					else { ?>
			<!-- If there is no order. -->
			<div style="text-align: center;margin-top: 15px;">
				<p>Your Basket Is Empty.</p>
				<a href="product.php" class="basket_buttons"><< Keep Shopping</a>
			</div>

				<?php
					} //end else
				} // end else of if isset username
				?>

		</form>
		
	</div>
</div>
<!-- FOOTER -->
<div class="footer">
	&copy; 2018 Candela, All Rights Reserved 
	<span>
		<a href="about.php" class="fnav">About Candela</a> | 
		<a href="contact-us.php" class="fnav">Contact Us</a> |
		<a id="myBtn">Terms and Conditions</a>
	</span><br />
		
	Bricklane Fake Subdivision Medicion II-E Block 90 Lot 1 Imus City, Cavite
		&nbsp;&nbsp;:&nbsp;&nbsp; <i>0971-697-0022</i>
		
	<span>
	
		<i>Exclusively available at Imus City Only</i>&nbsp;&nbsp;&nbsp;
		<a href="https://www.instagram.com/"><img src="images/instagramlogo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
		<a href="https://twitter.com/"><img src="images/twitter-logo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
		<a href="https://www.facebook.com/"><img src="images/facebooklogo.png" class="fsocial-acc"></a>&nbsp;&nbsp;&nbsp;
	</span>
</div>
<!-- SCRIPTING -->
<script src="javas.js"></script>
</body></html>