<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

$message="";

if(isset($_POST['submit']))
{
	$photo= new Photo();
	$photo->title= $_FILES['file'];
    $photo->set_files($_FILES['file']);	
	
	if($photo->save())
	{
		$message="photo uploaded successfully";
	}
	else
	{
		$message= join ("<br>" , $photo->errors);
	}
}

 ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php");?>
			
			
			
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
			<?php include("includes/side_nav.php"); ?>
			
            
			<!-- /.navbar-collapse -->
        </nav>
		
		
		
		

        <div id="page-wrapper">
		
		<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Uploads
                            <small></small>
                        </h1>
						<div class="row">
						<div class="col-md-6">
						<?php echo $message; ?>
                       <form action="" method="post" enctype="multipart/form-data">
					   
					   <div class="form-group">
					   <input type="text" name="title" class="form-control">
					   </div>
					   <div class="form-group">
					   <input type="file" name="file" >
					   </div>
					   <input type="submit" name="submit" value="upload">
					   </form>
                    </div>
                </div>
				<div class="row">
				<div class="col-lg-12">
				
				<form action="upload" class="dropzone"></form>
				
				</div>
				
				
				</div>
				
				</div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

           </div>
        </div>
        <!-- /#page-wrapper -->
		
		<?php include("includes/footer.php"); ?>

 