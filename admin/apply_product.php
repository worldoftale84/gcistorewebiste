<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
	if(isset($_POST['apply']))
	{
	$empid=$session_id;
	$product_type=$_POST['product_type'];
	$fromdate=date('d-m-Y', strtotime($_POST['date_from']));
	$todate=date('d-m-Y', strtotime($_POST['date_to']));
	$description=$_POST['description'];  
	$status=0;
	$isread=0;
	
	$datePosting = date("Y-m-d");

	if($fromdate > $todate)
	{
	    echo "<script>alert('End Date should be greater than Start Date');</script>";
	  }
	elseif($product_days <= 0)
	{
	    echo "<script>alert('YOU HAVE EXCEEDED YOUR PRODUCT LIMIT. PRODUCT APPLICATION FAILED');</script>";
	  }

	else {
		
		$DF = date_create($_POST['date_from']);
		$DT = date_create($_POST['date_to']);

		$diff =  date_diff($DF , $DT );
		

		$sql="INSERT INTO tblproduct(ProductType,ToDate,FromDate,Description,Status,IsRead,empid,PostingDate) VALUES(:product_type,:fromdate,:todate,:description,:status,:isread,:empid,:datePosting)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':product_type',$product_type,PDO::PARAM_STR);
		$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
		$query->bindParam(':todate',$todate,PDO::PARAM_STR);
		$query->bindParam(':description',$description,PDO::PARAM_STR);
		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->bindParam(':isread',$isread,PDO::PARAM_STR);
		$query->bindParam(':empid',$empid,PDO::PARAM_STR);
		
		$query->bindParam(':datePosting',$datePosting,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			echo "<script>alert('Product Application Was Successful.');</script>";
			echo "<script type='text/javascript'> document.location = 'product_history.php'; </script>";
		}
		else 
		{
			echo "<script>alert('Something went wrong. Please try again');</script>";
		}

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
        <div class="pb-20">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Product Request Application</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Apply for Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Product Request Form</h4>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                        <form method="post" action="">
                            <section>

                                <?php if ($role_id = 'Staff'): ?>
                                <?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die('');
									$row = mysqli_fetch_array($query);
								?>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>First Name </label>
                                            <input name="firstname" type="text" class="form-control wizard-required"
                                                required="true" readonly autocomplete="off"
                                                value="<?php echo $row['FirstName']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Last Name </label>
                                            <input name="lastname" type="text" class="form-control" readonly
                                                required="true" autocomplete="off"
                                                value="<?php echo $row['LastName']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input name="email" type="text" class="form-control" required="true"
                                                autocomplete="off" readonly value="<?php echo $row['EmailId']; ?>">
                                        </div>
                                    </div>

                                    <?php endif ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Product Type :</label>
                                            <select name="product_type" class="custom-select form-control"
                                                required="true" autocomplete="off">
                                                <option value="">Select Product type...</option>
                                                <?php $sql = "SELECT  ProductType from tblproducttype";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{   ?>
                                                <option value="<?php echo htmlentities($result->ProductType);?>">
                                                    <?php echo htmlentities($result->ProductType);?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Start Product Date :</label>
                                            <input name="date_from" type="text" class="form-control date-picker"
                                                required="true" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>End Product Date :</label>
                                            <input name="date_to" type="text" class="form-control date-picker"
                                                required="true" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label>Reason For Product :</label>
                                            <textarea id="textarea1" name="description" class="form-control" required
                                                length="150" maxlength="150" required="true"
                                                autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-size:16px;"><b></b></label>
                                            <div class="modal-footer justify-content-center">
                                                <button class="btn btn-primary" name="apply" id="apply"
                                                    data-toggle="modal">Apply&nbsp;Product</button>
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