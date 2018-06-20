<?php

require_once('vendor/autoload.php');


$comments=new Newtask\comments;


$getComments=$comments->getAllComments();  
$totalComment=$comments->totalComments();

$adminGetComments=$comments->getAllCommentsAdmin();

if(isset($_POST['addcomment'])){
	$addcomment=$comments->addComments($_POST['fname'], $_POST['comment']);
}//add comment
if(isset($_GET['edit']) && is_numeric($_GET['edit'])){
	$GeteditComm=$comments->GetEditComment($_GET['edit']);
}//GetEditComment
if(isset($_POST['editComment'])){
	$editcomment=$comments->editComments($_POST['fname'], $_POST['comment'], $_POST['status'], $_GET['edit']);
}//add editComment

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="imgs/favicon.ico">

    <title>new Task</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
  </head>

  <body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="index.php">newTask</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item active">
			<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		  </li>
		</ul>
		<ul class="navbar-nav justify-content-end">
		  <li class="nav-item">
			<a class="nav-link" href="index.php?page=admin">admin</a>
		  </li>
		</ul>
	  </div>
	</nav>
    <main role="main" class="container">
    	<?php if(isset($_GET['page']) && $_GET['page']=='admin'){ ?>
    		<div class="adminArea">
    		<h2>Admin</h2>
    		<?php if(isset($_GET['edit']) && is_numeric($_GET['edit'])){ 
				if(isset($editcomment)){ echo $editcomment; } ?>
    			<form action="index.php?page=admin&edit=<?php echo $GeteditComm['id']; ?>" method="post">
    				<select class="form-control" name="status">
    					<option>choose status</option>
    					<option value="0"<?php $comments->selected($GeteditComm['status'], 0, ' selected');?>>inactive</option>
    					<option value="1"<?php $comments->selected($GeteditComm['status'], 1, ' selected');?>>active</option>
    				</select>
					<input type="text" required name="fname" class="form-control" placeholder="First Name" value="<?php echo $GeteditComm['fname']; ?>" />
					<textarea rows="5"  class="form-control" name="comment" placeholder="Your comment" required><?php echo $GeteditComm['comment']; ?></textarea>
					<button type="submit" name="editComment" class="btn btn-default">Edit comment</button>
				</form>
    		<?php } ?>
    		<div class="table-responsive">
			  <table class="table">
				  <thead>
				  	<tr>
				  		<td width="72%">Name</td>
				  		<td width="10%">Status</td>
				  		<td width="18%">Actions</td>
				  	</tr>
				  </thead>
				  <tbody>
					<?php foreach($adminGetComments as $comment){  ?>
				  	<tr>
				  		<td><?php echo $comment['fname']; ?></td>
				  		<td><?php $comments->detectStatus($comment['status'], '<span class="alert alert-success">active</span>', '<span class="alert alert-danger">inactive</span>'); ?></td>
				  		<td>
				  			<a href="index.php?page=admin&edit=<?php echo $comment['id']; ?>"><button class="btn btn-warning"><i class="fa fa-edit"></i></button></a>
				  			<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
				  		</td>
				  	</tr>
					<?php } ?>
				  </tbody>
			  </table>
			</div>
   			</div><!--end adminArea-->
    	<?php }else{ ?>
    	<?php if(isset($addcomment)){ echo $addcomment; } ?>
    	<div class="comment-wrapper">
    	<h5>all comment <span>(<?php echo $totalComment; ?>)</span></h5>
			<?php foreach($getComments as $comment){  ?>
			<div class="media">
			  <img class="align-self-start mr-3" src="imgs/64.svg" alt="Generic placeholder image">
			  <div class="media-body">
				<h5 class="mt-0"><?php echo $comment['fname']; ?></h5>
				<p><?php echo $comment['comment']; ?></p>
			  </div>
			</div>
		<?php } ?>
		</div><!--end comment-wrapper-->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<input type="text" required name="fname" class="form-control" placeholder="First Name" />
			<textarea rows="5"  class="form-control" name="comment" placeholder="Your comment" required></textarea>
			<button type="submit" name="addcomment" class="btn btn-default">Add comment</button>
		</form>
   		<?php } ?>
    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">newTask &copy; <?php echo date('Y'); ?></span>
      </div>
    </footer>
  </body>
</html>



