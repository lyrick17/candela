<nav class="navbar navbar-expand-sm padding-x-1 py-1">
	<div class="container-fluid">
		<!-- Contact Number -->
		<div class="collapse navbar-collapse navbar-nav">
			0971-697-0022
		</div>
		<!-- Account -->
		<div class="navbar-nav ms-auto text-end">
			<ul class="navbar-nav">
				<?php if (isset($_SESSION['id'])): ?>
					<li class="m-2"><a href="myaccount.php"><?php echo $_SESSION['username'];?>'s Account</a></li>
					<li class="m-2"><a href="utilities/logout.php">Log Out</a></li>
				<?php else: ?>
					<li class="m-2"><a href="login-form.php">Log In</a></li>
					<li class="m-2"><a href="signup-form.php">Create An Account</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>