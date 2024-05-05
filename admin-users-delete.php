<?php
	require("utilities/server.php");
	require("utilities/admin_delete_users.php");
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
	
    <?php if (isset($_GET['id']) && is_numeric($_GET['id']) && Users::select_info($_GET['id'])): ?>
        <?php 
            $userlist = Users::select_info($_GET['id']); 
            $user = mysqli_fetch_array($userlist, MYSQLI_ASSOC);
            if ($user['type'] == 1) {
                require("templates/admin/wrong_access/candela_users.php");
            } else {
        ?>
        <div id="welcome-page" class="padding-y-1 padding-x-3">
            <div class="text-center">
                <span class="font-40 text-danger fw-bold">Warning:</span> 
                <div class="font-30">
                    Deleting Candela user is irreversible <br />
                    It can affect Candela Business when done incorrectly <br />
                    Please ensure you have thoroughly reviewed all associated data and permissions before proceeding. <br />
                    Confirm deletion only after careful consideration and verification. <br />
                </div>
            </div>
            <hr />
            <div id="product-nav">
                <a href="admin-users.php"><< Back To Candela Users</a>
            </div>
            <!-- SECOND CONTENT - Admin Dashboard -->
            <div class="py-4">
                <div class="row gx-0">
                    <div class="col-lg-8 col-md-7 px-2 my-1">
                        <div class="px-5 mx-auto sidebar-box-red-1 py-5">
                            <div class="font-30 fw-bold">
                                USER INFORMATION
                            </div>
                            
                            <!-- USER INFORMATION -->
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
                                    <input type="text" name="" class="contact-input" value="<?=$user['username']?>" maxlength="255" disabled>
                                </div>

                                <div class="col-md-4 py-2">
                                    <span class="font-25">Last Name:</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="contact-input" value="<?=$user['lastname']?>" maxlength="255" disabled>
                                </div>

                                <div class="col-md-4 py-2">
                                    <span class="font-25">Email:</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="contact-input" value="<?=$user['email']?>" maxlength="255" disabled>
                                </div>

                                <div class="col-md-4 py-2">
                                    <span class="font-25">Contact Number:</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="contact-input" value="<?=$user['contactnumber']?>" maxlength="255" disabled>
                                </div>

                                <div class="col-md-4 py-2">
                                    <span class="font-25">Address:</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="contact-input" value="<?=$user['user_address']?>" maxlength="255" disabled>
                                </div>

                                <div class="col-md-4 py-2">
                                    <span class="font-25">Barangay:</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="" class="contact-input" value="<?= $user['barangay']; ?>" disabled />
                                </div>

                                <div class="col-md-4 py-2">
                                    <span class="font-25">Registration Date:</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="contact-input" value="<?= date('F j, Y g:i A', strtotime($user['registration_date'])) ?>" disabled>
                                </div>

                            </div>
                                
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 px-2 my-1">
                        <div class="px-5 mx-auto sidebar-box-red-1 py-5">
                            <div class="font-30 fw-bold">
                                USER BASKET    
                            </div>
                            <?php if (mysqli_num_rows(Basket::get_all_items($user['user_id'])) > 0): ?>
                                <div class="font-20">This user has <b>items</b> in their basket. <br /> Please ensure to inform the user before deleting their account.</div>
                            <?php else: ?>
                                <div class="font-20">This user has no items in their basket.</div>
                            <?php endif; ?>
                        </div>
                        <div class="mt-4 px-5 mx-auto sidebar-box-red-1 py-5">
                            <div class="font-30 fw-bold">
                                CONFIRM DELETE  
                            </div>
                            <?php if (mysqli_num_rows(Orders::get_recent_orders($user['user_id'])) > 0): ?>
                                <p class="font-20">This user has pending orders. The account cannot be deleted until the orders have been delivered.</p>
                            <?php else: ?>
                                <form method="post" action="admin-users-delete.php?id=<?=$_GET['id']?>">
                                    <div class="py-1">
                                        <span class="text-danger"><?= $delete_error; ?></span><br />
                                        <span class="font-20">Admin Password:</span>
                                        <input type="password" name="adminpass" class="contact-input">
                                        <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                                    </div>
                                    <div class="py-1">
                                        <input type="submit" name="usersubmit" class="w-100 p-1 font-20 btn btn-danger" value="Delete Account">
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            } // end of else
        ?>
    <?php else: ?>
       <?php require("templates/admin/wrong_access/candela_users.php"); ?>
    <?php endif; ?>
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
<script src="resources/js/del_acc_confirmation.js"></script>
</body>
</html>