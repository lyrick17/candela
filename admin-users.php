<?php
	require("utilities/server.php");
	require("utilities/admin_update_users.php");
	//require("utilities/admin_update_status.php");
	Restrict::remove_checkout_sess();
	Restrict::remove_order_id_sess();

?>


<!DOCTYPE html>
<html>

<head>
	<title>Candela - Admin</title>
	<?php require("templates/head.php"); ?>
</head>

<body>
<!-- HEADER/NAVIGATION BAR -->
<?php require("templates/nav_admin.php"); ?>

<!-- CONTENT -->

<div class="body-content">
	
	<!-- MODAL CONTENT for Terms and Conditions -->
	<?php include("templates/modals/modal_terms_conditions.php"); ?>
	
	<?php if (!isset($_GET['id'])): ?>
	
	<!-- FIRST CONTENT - Time -->
	<div id="welcome-page" class="padding-y-1 padding-x-3">
		<header id="product-header" class="font-35 fw-bold text-center">
			Candela Users<br />
		</header>
		<div class="font-20 text-center">
			Tip: Click the ID of the user to edit them.
		</div>
		<hr />
		<div class="px-3 py-1">
			<form action="admin-users.php" method="get" id="search-product">
				<input type="text" class="search-text-width py-1 my-1" placeholder="Search a User..." name="search" maxlength="255">
				<input type="submit" value="Search" class="btn btn-success my-1">
				<a href="admin-users.php" class="btn btn-danger my-1">Clear Search</a>
			</form>
		</div>
		<hr />
		<!-- SECOND CONTENT - Admin Dashboard -->
		<div>
			<?php if (isset($_GET['search'])): ?>
				<div class="text-center font-20">
					Search Results for: <span class="font-25"><?= $_GET['search']; ?></span>
				</div>
			<?php endif; ?>
			<?php 	
					if (isset($_GET['search'])) {
						$user_list = Users::select_search($_GET['search']);
					} else {
						$user_list = Users::select_all();
					}
			?>
                <div class="width-100" style="overflow-x: auto;">
                    <table class="w-100 border border-black" id="user-table">
                        <tr class="font-20 fw-bold border-bottom border-black bg-color-1">
                            <td>Id</td>
                            <td>User Name</td>
                            <td>Last Name</td>
                            <td>Email</td>
                            <td>Number</td>
                            <td>Address</td>
                            <td>Barangay</td>
                            
                            <td>Delete</td>
                        </tr>
						<?php if ($user_list):
								while ($user = mysqli_fetch_array($user_list, MYSQLI_ASSOC)):
						?>
							<tr class="paginate">
								<td>
									<?php if ($user['type'] == 0): ?>
										<a href="admin-users.php?id=<?= $user['user_id'] ?>" class="btn btn-secondary">
									<?php else: ?>
										<a href="admin-users.php?id=<?= $user['user_id'] ?>" class="btn btn-danger">
									<?php endif; ?>
										<?= $user['user_id'] ?>
									</a>
								</td>
								<td><?= $user['username'] ?></td>
								<td><?= $user['lastname'] ?></td>
								<td><?= $user['email'] ?></td>
								<td><?= $user['contactnumber'] ?></td>
								<td><?= $user['user_address'] ?></td>
								<td><?= $user['barangay'] ?></td>
								<td>
									<?php if ($user['type'] == 0): ?>
										<a href="admin-users-delete.php?id=<?= $user['user_id'] ?>" class="btn btn-danger">Delete</a>
									<?php endif; ?>
									
								</td>
							</tr>
						<?php 	endwhile;
							  endif; ?>

                    </table>
                </div>
				
			<div class="d-flex justify-content-center py-2">
				<div id="page-nav-content">
					<div id="page-nav"></div>
				</div>
			</div>

			
		</div>
	</div>
	
	<?php else: ?> <!-- Get Edit is set, display specific user -->
		<?php if ($_GET['id'] != '' && is_numeric($_GET['id']) && Users::select_info($_GET['id'])): ?>
			<?php 
				$userlist = Users::select_info($_GET['id']); 
				$user = mysqli_fetch_array($userlist, MYSQLI_ASSOC);
			
			?>
			<div id="welcome-page" class="padding-y-1 padding-x-3">
				<div class="text-center">
					<span class="font-40 text-danger fw-bold">Warning:</span> 
					<div class="font-30">
						Privacy of User is Utmost Important
						<br />Please Edit The Information When Extremely Needed
					</div>
				</div>
				<hr />
				<div id="product-nav">
					<a href="admin-users.php"><< Back To Candela Users</a>
				</div>
				<!-- SECOND CONTENT - Admin Dashboard -->
				<div class="padding-x-4 py-4">
					<?php if ($errors > 0 || $specialerrors > 0): ?>
						<div class="px-5 w-75 mx-auto sidebar-box-red-2 my-2 py-2">
							<div class="font-20 text-center text-danger">
								<?php foreach($errormsg as $msg): ?>
									<?= $msg ?><br />
								<?php endforeach; ?>
							</div>							
						</div>
					<?php endif; ?>
					<?php if (!empty($successfulupdate)): ?>
						<div class="px-5 w-75 mx-auto sidebar-box-green-2 my-2 py-2">
							<div class="font-20 text-center text-success">
								<?php foreach($successfulupdate as $msg): ?>
									<?= $msg ?><br />
								<?php endforeach; ?>
							</div>							
						</div>
					<?php endif; ?>
					<div class="px-5 mx-auto sidebar-box-red-1 py-5">

						<!-- FORM CONTACT-US -->
						<form method="post" action="admin-users.php?id=<?=$_GET['id']?>">

							<div class="row gx-0">
								<div class="col-md-4 py-2">
									<span class="font-25">Type:</span>
								</div>
								<div class="col-md-8">
									<?php if ($user['type'] == 0): ?>
										<input type="text" class="contact-input" value="USER" disabled />
									<?php else: ?>
										<input type="text" class="contact-input" value="ADMIN" disabled />
									<?php endif; ?>
								</div>

								<div class="col-md-4 py-2">
									<span class="font-25">ID:</span>
								</div>
								<div class="col-md-8">
									<input type="text" name="" class="contact-input" value="<?=$user['user_id']?>" maxlength="255" disabled>
								</div>

								<div class="col-md-4 py-2">
									<span class="font-25">Username:</span>
								</div>
								<div class="col-md-8">
									<input type="text" name="username" class="contact-input" value="<?=$user['username']?>" maxlength="255">
								</div>

								<div class="col-md-4 py-2">
									<span class="font-25">Last Name:</span>
								</div>
								<div class="col-md-8">
									<input type="text" name="lastname" class="contact-input" value="<?=$user['lastname']?>" maxlength="255">
								</div>

								<div class="col-md-4 py-2">
									<span class="font-25">Email:</span>
								</div>
								<div class="col-md-8">
									<input type="text" name="email" class="contact-input" value="<?=$user['email']?>" maxlength="255">
								</div>

								<div class="col-md-4 py-2">
									<span class="font-25">Contact Number:</span>
								</div>
								<div class="col-md-8">
									<input type="text" name="contactnumber" class="contact-input" value="<?=$user['contactnumber']?>" maxlength="255">
								</div>

								<div class="col-md-4 py-2">
									<span class="font-25">Address:</span>
								</div>
								<div class="col-md-8">
									<input type="text" name="address" class="contact-input" value="<?=$user['user_address']?>" maxlength="255">
								</div>

								<div class="col-md-4 py-2">
									<span class="font-25">Barangay:</span>
								</div>
								<div class="col-md-8">
									<input type="hidden" id="barangayvalue" value="<?= $user['barangay']; ?>" />
									<select name="barangay" id="barangay" class="contact-input">
										<option>- Select Your Barangay -</option>
										<?php 
											include("utilities/information/barangay_info.php");
											foreach($barangay as $value) {
												echo '<option>'.trim($value).'</option>';
											}
										?>
									</select>
								</div>

								<div class="col-md-4 py-2">
									<span class="font-25">Registration Date:</span>
								</div>
								<div class="col-md-8">
									<input type="text" class="contact-input" value="<?= date('F j, Y g:i A', strtotime($user['registration_date'])) ?>" disabled>
								</div>
								
								<div class="col-md-4 py-2"></div>
								<div class="col-md-8"></div>

								<div class="col-md-4 py-2">
									<span class="font-25">Admin Password:</span>
								</div>
								<div class="col-md-8">
									<input type="password" name="adminpass" class="contact-input">
								</div>
								
								<div class="col-md-4 py-2">
								</div>
								<div class="col-md-8">
									<input type="submit" name="usersubmit" class="w-100 p-1 font-20 btn btn-danger" value="Edit">
								</div>

							</div>
							
						</form>
					</div>
				</div>
			</div>
		<?php else: ?>
			<?php require("templates/admin/wrong_access/candela_users.php"); ?>
	<?php 	endif; 
		endif; ?>
</div>
	

<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom_admin.php"); ?>

<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
<script src="resources/js/barangay_select.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js" integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="resources/js/product_pagination.js"></script>

</body>
</html>