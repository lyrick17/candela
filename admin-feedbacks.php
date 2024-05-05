<?php
	require("utilities/server.php");
	require("utilities/admin_update_status.php");
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

	<!-- FIRST CONTENT - Time -->
	<div id="welcome-page" class="padding-y-1 padding-x-3">
		<header id="product-header" class="font-35 fw-bold text-center">
			Candela Feedbacks<br />
		</header>
		<div class="font-20 text-center">
			Here are the user feedbacks for Candela. We aim for highest satisfaction from our customers.
		</div>
		<hr />
		<div class="px-3 py-1">
			<form action="admin-feedbacks.php" method="get" id="search-product">
				<input type="text" class="search-text-width py-1 my-1" placeholder="Search a Feedback..." name="search" maxlength="255">
				<input type="submit" value="Search" class="btn btn-success my-1">
				<a href="admin-feedbacks.php" class="btn btn-danger my-1">Clear Search</a>
			</form>
		</div>
		<hr />
		<!-- SECOND CONTENT - Admin Dashboard -->
		<div id="" class="row g-0">
			<?php if (isset($_GET['search'])): ?>
				<div class="text-center font-20">
					Search Results for: <span class="font-25"><?= $_GET['search']; ?></span>
				</div>
			<?php endif; ?>
			<?php 	
					if (isset($_GET['search'])) {
						$feedback_list = Feedbacks::select_search($_GET['search']);
					} else {
						$feedback_list = Feedbacks::select_all();
					}
					if ($feedback_list):
						while ($feedback = mysqli_fetch_array($feedback_list, MYSQLI_ASSOC)):
			?>
				<div class="col-md-6 col-lg-4 paginate" style="z-index: -1;">
					<div class="card m-1">
						<div class="card-header bg-color-1">
							from: <i><?= $feedback['email']; ?></i>
						</div>
						<div class="card-body">
							<h4 class="card-title"><?= $feedback['subject']; ?></h4>
							<p class="card-text"><?= $feedback['comment']; ?></p>
							<hr />
							<span class="card-text">
								: <b><?= $feedback['name']; ?></b> 
								<?php if (isset($feedback['user_id'])) {
									echo "(UID: ".$feedback['user_id'].")";
								} ?>
							</span><br />
							<span class="card-text">: <?= $feedback['email']; ?></span><br />
							<span class="card-text">: <?= $feedback['contactnumber']; ?></span>
						</div>
						<div class="card-footer text-body-secondary">
						feedback #<?=$feedback['contact_id']?> - <i><?= date('F j, Y g:i A', strtotime($feedback['feedback_date'])) ?></i>
						</div>
					</div>
				</div>
			<?php
						endwhile;
					endif;
			?>
			<div class="d-flex justify-content-center py-2">
				<div id="page-nav-content">
					<div id="page-nav"></div>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- FOOTER AND BOTTOM HEADER -->
<?php require("templates/footer.php"); ?>
<?php require("templates/nav_bottom_admin.php"); ?>

<!-- SCRIPTING -->
<script src="resources/js/javas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js" integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="resources/js/product_pagination.js"></script>
</body>
</html>