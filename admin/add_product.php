<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php
	if(isset($_POST['product']))
	{
	
	$name=$_POST['name'];
	$brand=$_POST['brand'];   
	$category=$_POST['category']; 
    $producttype=$_POST['producttype']; 
    $qty=$_POST['qty']; 
	$suppliername=$_POST['suppliername'];	
    $remarks=$_POST['remarks'];	
	$status=$_POST['status'];	
	$action=$_POST['action']; 

	$status=1;

	 $query = mysqli_query($conn,"select * from `item_list` where productname = '$name'")or die("query incorrect.....");
	 $count = mysqli_num_rows($query);
     
     if ($count > 0){ ?>


<script>
alert('Data Already Exist');
</script>
<?php
      }else{
        mysqli_query($conn,"INSERT INTO item_list(productname,brand,category,producttype,qty,suppliername,remarks,status,action) VALUES('$productname','$brand','$category','$producttype','$qty','$suppliername','$remarks','$status')         
		") or die("query incorrect....."); ?>
<script>
alert('Product Successfully  Added');
</script>;
<script>
window.location = "add_product.php";
</script>
<?php   }
}

?>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="../vendors/images/logo1.png" alt=""></div>
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
                                <h4>Add Product Portal</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Module</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Add New Product Form</h4>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                        <form method="post" action="">
                            <section>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Name :</label>
                                            <input name="name" type="text" class="form-control wizard-required"
                                                required="true" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Brand :</label>
                                            <select name="brandname" class="custom-select form-control" required="true"
                                                autocomplete="off">
                                                <option value="">Select Brand</option>
                                                <?php
													$query = mysqli_query($conn,"select * from tblbrand");
													while($row = mysqli_fetch_array($query)){
													
													?>
                                                <option value="<?php echo $row['brandname']; ?>">
                                                    <?php echo $row['brandname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-------->
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Category :</label>
                                            <select name="categoryname" class="custom-select form-control"
                                                required="true" autocomplete="off">
                                                <option value="">Select Category</option>
                                                <?php
													$query = mysqli_query($conn,"select * from tblcategory");
													while($row = mysqli_fetch_array($query)){
													
													?>
                                                <option value="<?php echo $row['categoryname']; ?>">
                                                    <?php echo $row['categoryname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!---->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>ProductType :</label>
                                                <select name="producttype" class="custom-select form-control"
                                                    required="true" autocomplete="off">
                                                    <option value="">Select Category</option>
                                                    <?php
													$query = mysqli_query($conn,"select * from tblproducttype");
													while($row = mysqli_fetch_array($query)){
													
													?>
                                                    <option value="<?php echo $row['producttype']; ?>"></option>
                                                    <?php echo $row['producttype']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Qty :</label>
                                                <input name="qty" type="text" class="form-control" required="true"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Supplier :</label>
                                                <select name="suppliername" class="custom-select form-control"
                                                    required="true" autocomplete="off">
                                                    <option value="">Select Supplier</option>
                                                    <?php
													$query = mysqli_query($conn,"select * from supplier_list");
													while($row = mysqli_fetch_array($query)){
													
													?>
                                                    <option value="<?php echo $row['suppliername']; ?>"></option>
                                                    <?php echo $row['suppliername']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Remarks :</label>
                                                <input name="remarks" type="text" class="form-control" required="true"
                                                    autocomplete="off">
                                            </div>
                                        </div>



                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Status :</label>
                                                <input name="status" type="text" class="form-control" required="true"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-size:16px;"><b></b></label>
                                            <div class="modal-footer justify-content-center">
                                                <button class="btn btn-primary" name="add_product" id="add_product"
                                                    data-toggle="modal">Add
                                                    Product</button>
                                            </div>
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

    <?php include('includes/scripts.php')?>
</body>

</html>