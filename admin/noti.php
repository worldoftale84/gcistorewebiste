<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php 
	 if (isset($_GET['delete'])) {
		$comment_id = $_GET['delete'];
		$sql = "DELETE FROM comments where id = ".$comment_id;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>alert('Notification Deleted Successfully');</script>";
     		echo "<script type='text/javascript'> document.location = 'noti.php'; </script>";
			
		}
	}
?>

<?php
 if(isset($_POST['add']))
{
	 $comment_subject=$_POST['comment_subject'];
	$comment_text=$_POST['comment_text'];

     $query = mysqli_query($conn,"select * from comments where comment_subject = '$comment_subject'")or die('');
	 $count = mysqli_num_rows($query);
     
     if ($count > 0){ 
     	echo "<script>alert('Notification Already Exist');</script>";
      }
      else{
        $query = mysqli_query($conn,"insert into comments (comment_subject, comment_text)
  		 values ('$comment_subject', '$comment_text')      
		") or die(''); 

		if ($query) {
			echo "<script>alert('Notification Send Successfully');</script>";
			echo "<script type='text/javascript'> document.location = 'noti.php'; </script>";
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
                                <h4>Notification List</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Notification Module</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                        <div class="card-box pd-30 pt-10 height-100-p">
                            <h2 class="mb-30 h4">New Notification</h2>
                            <section>
                                <form name="save" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Notification Subject</label>
                                                <input name="comment_subject" type="text" class="form-control"
                                                    required="true" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Notification Text</label>
                                                <input name="comment_text" type="text" class="form-control"
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
                            <h2 class="mb-30 h4">Notification List</h2>
                            <div class="pb-20">
                                <table class="data-table table stripe hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>SR NO.</th>
                                            <th class="table-plus">Notification Subject</th>
                                            <th>Notification Text</th>
                                            <th class="datatable-nosort">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $sql = "SELECT * from comments";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{               ?>

                                        <tr>
                                            <?php
//insert.php
if(isset($_POST["subject"]))
{
 include("connect.php");
 $subject = mysqli_real_escape_string($con, $_POST["subject"]);
 $comment = mysqli_real_escape_string($con, $_POST["comment"]);
 $query = "
 INSERT INTO comments(comment_subject, comment_text)
 VALUES ('$subject', '$comment')
 ";
 mysqli_query($con, $query);
}
?>
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
<script>
$(document).ready(function() {

    function load_unseen_notification(view = '') {
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
                view: view
            },
            dataType: "json",
            success: function(data) {
                $('.dropdown-menu').html(data.notification);
                if (data.unseen_notification > 0) {
                    $('.count').html(data.unseen_notification);
                }
            }
        });
    }

    load_unseen_notification();

    $('#comment_form').on('submit', function(event) {
        event.preventDefault();
        if ($('#subject').val() != '' && $('#comment').val() != '') {
            var form_data = $(this).serialize();
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#comment_form')[0].reset();
                    load_unseen_notification();
                }
            });
        } else {
            alert("Both Fields are Required");
        }
    });

    $(document).on('click', '.dropdown-toggle', function() {
        $('.count').html('');
        load_unseen_notification('yes');
    });

    setInterval(function() {
        load_unseen_notification();;
    }, 5000);

});
</script>