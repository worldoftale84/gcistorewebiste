<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php $get_id = $_GET['edit']; ?>
<?php 
	 if (isset($_GET['delete'])) {
		$Product_type_id = $_GET['delete'];
		$sql = "DELETE FROM tblproducttype where id = ".$Product_type_id;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>alert('ProductType Deleted Successfully');</script>";
     		echo "<script type='text/javascript'> document.location = 'product_type.php'; </script>";
			
		}
	}
?>

<?php
 if(isset($_POST['edit']))
{
	 $producttype=$_POST['producttype'];
	 $remarks=$_POST['remarks'];
	 $dtefrom=date('Y-m-d', strtotime($_POST['date_from']));
	 $dteto=date('Y-m-d', strtotime($_POST['date_to']));

    $result = mysqli_query($conn,"update tblproducttype set producttype='$producttype', remarks='$remarks', date_from='$dtefrom', date_to='$dteto' where id = '$get_id' ");
    if ($result) {
     	echo "<script>alert('Record Successfully Updated');</script>";
     	echo "<script type='text/javascript'> document.location = 'Product_type.php'; </script>";
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

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Product Type List</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Product Type</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                        <div class="card-box pd-30 pt-10 height-100-p">
                            <h2 class="mb-30 h4">Edit Product Type</h2>
                            <section>
                                <?php
									$query = mysqli_query($conn,"SELECT * from tblproducttype where id = '$get_id'")or die('');
									$row = mysqli_fetch_array($query);
									?>
                                <form name="save" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Type</label>
                                                <input name="producttype" type="text" class="form-control"
                                                    required="true" autocomplete="off"
                                                    value="<?php echo $row['producttype']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea name="remarks" style="height: 5em;"
                                                    class="form-control text_area"
                                                    type="text"><?php echo $row['remarks']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 text-right">
                                        <div class="dropdown">
                                            <input class="btn btn-primary" type="submit" value="UPDATE" name="edit"
                                                id="edit">
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-6 col-sm-12 mb-30">
                        <div class="card-box pd-30 pt-10 height-100-p">
                            <h2 class="mb-30 h4">Product Type List</h2>
                            <div class="pb-20">
                                <table class="data-table table stripe hover nowrap">
                                    <thead>
                                        <tr>
                                            <th class="table-plus">PRODUCT TYPE</th>
                                            <th class="table-plus">REMARKS</th>
                                            <th class="datatable-nosort">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $sql = "SELECT * from tblproducttype";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{               ?>

                                        <tr>
                                            <td> <?php echo htmlentities($result->producttype);?></td>
                                            <td><?php echo htmlentities($result->remarks);?></td>
                                            <td><?php echo htmlentities($result->date_from." - ".$result->date_to);?>
                                            </td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="product_type.php?delete=<?php echo htmlentities($result->id);?>"
                                                        data-color="#e95959"><i
                                                            class="icon-copy dw dw-delete-3"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php $cnt++;} }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
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