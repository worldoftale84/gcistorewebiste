<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php $get_id = $_GET['edit']; ?>
<?php
	if(isset($_POST['add_product']))
	{
	
        $name=$_POST['productname'];
        $brand=$_POST['brand'];   
        $category=$_POST['category']; 
        $producttype=$_POST['producttype']; 
        $qty=$_POST['qty']; 
        $suppliername=$_POST['suppliername'];	
        $remarks=$_POST['remarks'];	
        $status=$_POST['status'];	
        $action=$_POST['action']; 

        $status = 1;

	$result = mysqli_query($conn,"update item_list set productname='$productname', brand='$brand', category='$category', producttype='$producttype', qty='$qty', suppliername='$suppliername', remarks='$remarks' where id='$get_id'         
		"); 		
	if ($result) {
     	echo "<script>alert('Record Successfully Updated');</script>";
     	echo "<script type='text/javascript'> document.location = 'product.php'; </script>";
	} else{
	  die('');
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

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Product Manage Portal</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Edit</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Edit Product</h4>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                        <form method="post" action="">
                            <section>
                                <?php
									$query = mysqli_query($conn,"select * from item_list where id = '$get_id' ")or die('');
									$row = mysqli_fetch_array($query);
									?>

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Name :</label>
                                            <input name="productname" type="text" class="form-control wizard-required"
                                                required="true" autocomplete="off"
                                                value="<?php echo $row['productname']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Brand:</label>
                                            <select name="brandname" type="text" class="form-control" required="true"
                                                autocomplete="off">
                                                <?php
													$row_brand = mysqli_query($conn,"select * from item_list join  tblbarnd where id = '$get_id'")or die('');
													$row_brand = mysqli_fetch_array($row_brand);
													
												 ?>

                                                <?php echo $row_brand['brandname']; ?></option>
                                                <?php
													$query = mysqli_query($conn,"select * from tblbrand");
													while($row = mysqli_fetch_array($query)){
													
													?>

                                                <?php echo $row['brandname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>




                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label> Category :</label>
                                                <select name="category" type="text" class="form-control" required="true"
                                                    autocomplete="off">
                                                    <?php
													$row_category = mysqli_query($conn,"select * from item_list join  tblcategory where id = '$get_id'")or die('');
													$row_category = mysqli_fetch_array($row_category);
													
												 ?>

                                                    <?php echo $row_category['category']; ?></option>
                                                    <?php
													$query = mysqli_query($conn,"select * from tblcategory");
													while($row = mysqli_fetch_array($query)){
													
													?>

                                                    <?php echo $row['category']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>ProductType :</label>
                                                <select name="producttype" class="custom-select form-control"
                                                    required="true" autocomplete="off">
                                                    <?php
													$row_producttype = mysqli_query($conn,"select * from item_list join  tblproducttype where id = '$get_id'")or die('');
													$row_producttype = mysqli_fetch_array($row_producttype);
													
												 ?>

                                                    <?php echo $row_producttype['producttype']; ?></option>
                                                    <?php
													$query = mysqli_query($conn,"select * from tblproducttype");
													while($row = mysqli_fetch_array($query)){
													
													?>

                                                    <?php echo $row['producttype']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Qty :</label>
                                                <select name="qty" type="text" class="form-control" required="true"
                                                    autocomplete="off">
                                                    <?php
													$row_qty = mysqli_query($conn,"select * from item_list join  item_list where id = '$get_id'")or die('');
													$row_qty = mysqli_fetch_array($row_qty);
													
												 ?>

                                                    <?php echo $row_qty['qty']; ?></option>
                                                    <?php
													$query = mysqli_query($conn,"select * from item_list");
													while($row = mysqli_fetch_array($query)){
													
													?>

                                                    <?php echo $row['qty']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Supplier :</label>
                                                <select name="suppliername" class="custom-select form-control"
                                                    required="true" autocomplete="off">
                                                    <?php
													$row_supplier = mysqli_query($conn,"select * from item_list join  supplier_list where id = '$get_id'")or die('');
													$row_supplier = mysqli_fetch_array($row_supplier);
													
												 ?>

                                                    <?php echo $row_supplier['suppliername']; ?></option>
                                                    <?php
													$query = mysqli_query($conn,"select * from supplier_list");
													while($row = mysqli_fetch_array($query)){
													
													?>

                                                    <?php echo $row['suppliername']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">


                                    </div>

                                    <?php
									$query = mysqli_query($conn,"select * from item_list where emp_id = '$get_id' ")or die('');
									$new_row = mysqli_fetch_array($query);
									?>
                                    <div class="row">


                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>User Role :</label>
                                                <select name="user_role" class="custom-select form-control"
                                                    required="true" autocomplete="off">
                                                    <option value="<?php echo $new_row['role']; ?>">
                                                        <?php echo $new_row['role']; ?></option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="HOD">HOD</option>
                                                    <option value="HODIT">HODIT</option>

                                                    <option value="StoreManager">Store Manager</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label style="font-size:16px;"><b></b></label>
                                                <div class="modal-footer justify-content-center">
                                                    <button class="btn btn-primary" name="add_product" id="add_product"
                                                        data-toggle="modal">Update&nbsp;product</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </section>
                        </form>
                    </div>
                </div>

            </div>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
    <!-- js -->
    <?php include('includes/scripts.php')?>
</body>

</html>