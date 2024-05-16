<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM item_list where id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Product Deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'product.php'; </script>";
		
	}
}

?>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="../vendors/images/logo.png" alt=""></div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">
                Loading...
            </div>
        </div>
    </div>

    <?php include('includes/navbar.php')?>

    <?php include('includes/right_sidebar.php')?>

    <?php include('includes/left_sidebar.php')?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h3 mb-0">Administrative Breakdown</h2>
            </div>
            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">

                        <?php
						$sql = "SELECT id from item_list";
						$query = $dbh -> prepare($sql);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$idcount=$query->rowCount();
						?>

                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><?php echo($idcount);?></div>
                                <div class="font-14 text-secondary weight-500">Total Product</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-user-2"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!----------------------------->


                <!---------------->



                <!-------------------------->
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">

                        <?php 
						 $query_reg_qty = mysqli_query($conn,"select * from item_list where qty = 'qty' ")or die('');
						 $count_reg_qty = mysqli_num_rows($query_reg_qty);
						 ?>

                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><?php echo($count_reg_qty); ?></div>
                                <div class="font-14 text-secondary weight-500">Total Qty</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff5b5b"><i class="icon-copy fa fa-hourglass-o"
                                        aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------------->

            <!-------------------------->

            <!-------------------------------->

            <div class="card-box mb-30">
                <div class="pd-20">
                    <h2 class="text-blue h4">ALL PRODUCTS</h2>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus">NAME</th>
                                <th>BRAND</th>
                                <th>CATEGORY</th>
                                <th>PRODUCTTYPE</th>
                                <th>QTY</th>
                                <th>SUPPLIER</th>
                                <th class="datatable-nosort">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
		                         $teacher_query = mysqli_query($conn,"select * from item_list LEFT JOIN tblbrand ON item_list.brand = tblbrand.brandname where brandname != 'brandname' ORDER BY item_list.id") or die('');
		                         while ($row = mysqli_fetch_array($teacher_query)) {
		                         $id = $row['id'];
		                             ?>
                                <?php
		                         $teacher_query = mysqli_query($conn,"select * from item_list LEFT JOIN tblcategory ON item_list.category = tblcategory.categoryname where categoryname != 'categoryname' ORDER BY item_list.id") or die('');
		                         while ($row = mysqli_fetch_array($teacher_query)) {
		                         $id = $row['id'];
		                             ?>

                                <td><?php echo $row['brandname']; ?></td>
                                <td><?php echo $row['categoryname']; ?></td>
                                <td><?php echo $row['producttype']; ?></td>
                                <td><?php echo $row['suppliername']; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item"
                                                href="edit_staff.php?edit=<?php echo $row['emp_id'];?>"><i
                                                    class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item"
                                                href="staff.php?delete=<?php echo $row['emp_id'] ?>"><i
                                                    class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php include('includes/footer.php'); ?>
        </div>
    </div>
    <!-- js -->

    <?php include('includes/scripts.php')?>
</body>

</html>