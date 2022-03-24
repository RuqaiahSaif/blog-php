<?php
session_start();
//return to login if not logged in
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}

include_once('User.php');

$user = new User();

//fetch user data
$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);
  include 'post.php';

  $postObj = new Post();
   // Delete record from table
  if(isset($_GET['delid']) && !empty($_GET['delid'])) {
      $deleteId = $_GET['delid'];
      $postObj->deleteRecord($deleteId);
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Login using OOP Approach</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>
<div class="container">
<div class="row">
		<div class="col-md-4 col-md-offset-4">
			
			<a href="logout.php" class="btn btn-danger" style="margin-left:55rem;margin-top:2rem;"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
		</div>
	</div>

<div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>post<b>Management</b></h2>
                    </div>
                       <div class="col-sm-7" align="right">
                        <a href="insert.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New post</span></a>
                                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> post title</th>                       
                        <th> post desc</th> 
                       
                    </tr>
                </thead>
                <tbody>
                 
                                            <?php 
                  $cnt=1;
          $catogrys =  $postObj->displayData(); 
          foreach ($catogrys as $post){
        ?>  
 
                    <tr>
      
            
                        <td><?php echo $cnt;?></td>
                        <td><?php  echo $post['post_title'];?> </td>
						<td><?php  echo $post['post_desc'];?> </td>
                       <td>
  
                            <a href="edit.php?editid=<?php echo htmlentities ($post['post_id']);?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="home.php?delid=<?php echo ($post['post_id']);?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');"><i class="material-icons">&#xE872;</i></a>
                        </td>

  </tr>
<?php 
$cnt=$cnt+1;
 } ?>
<tr>
    <th style="text-align:center; color:red;" colspan="6">No Record Found</th>
</tr>
               
                
                </tbody>
            </table>
       
        </div>
    </div>
</div> 


	
</div>
</body>
</html>