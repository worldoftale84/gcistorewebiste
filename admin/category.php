<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php 
	 if (isset($_GET['delete'])) {
		$category_id = $_GET['delete'];
		$sql = "DELETE FROM tblcategory where id = ".$category_id;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>alert('Category Deleted Successfully');</script>";
     		echo "<script type='text/javascript'> document.location = 'category.php'; </script>";
			
		}
	}
?>

<?php
 if(isset($_POST['add']))
{
	 $categoryname=$_POST['categoryname'];
	$categoryshortname=$_POST['categoryshortname'];

     $query = mysqli_query($conn,"select * from tblcategory where categoryname = '$categoryname'")or die('');
	 $count = mysqli_num_rows($query);
     
     if ($count > 0){ 
     	echo "<script>alert('Category Already exist');</script>";
      }
      else{
        $query = mysqli_query($conn,"insert into tblcategory (categoryname, categoryshortname)
  		 values ('$categoryname', '$categoryshortname')      
		") or die(''); 

		if ($query) {
			echo "<script>alert('Category Added Successfully');</script>";
			echo "<script type='text/javascript'> document.location = 'category.php'; </script>";
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

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Category List</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category Module</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                        <div class="card-box pd-30 pt-10 height-100-p">
                            <h2 class="mb-30 h4">New Category</h2>
                            <section>
                                <form name="save" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input name="categoryname" type="text" class="form-control"
                                                    required="true" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category Short Name</label>
                                                <input name="categoryshortname" type="text" class="form-control"
                                                    required="true" autocomplete="off" style="text-transform:uppercase">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <div class="dropdown">
                                            <input class="btn btn-primary" type="submit" value="REGISTER" name="add"
                                                id="add">
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-6 col-sm-12 mb-30">
                        <div class="card-box pd-30 pt-10 height-100-p">
                            <h2 class="mb-30 h4">Category List</h2>
                            <div class="pb-20">
                                <table class="data-table table stripe hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>SR NO.</th>
                                            <th class="table-plus">CATEGORY</th>
                                            <th>CATEGORY SHORT NAME</th>
                                            <th class="datatable-nosort">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $sql = "SELECT * from tblcategory";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{               ?>

                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->categoryname);?></td>
                                            <td><?php echo htmlentities($result->categoryshortname);?></td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="edit_category.php?edit=<?php echo htmlentities($result->id);?>"
                                                        data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                                    <a href="category.php?delete=<?php echo htmlentities($result->id);?>"
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