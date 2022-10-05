<?php
  session_start();
  include 'includes/header.php';

  if(!isset($_SESSION['admin_name']))
  {
    header('Location:login.php');
  }
?>
<head>
  <title>Admin Page</title>
</head>

<section>
    <div class="container">
      <div class="card">
        <div class="card-header text-white" style="background-color: #596275;">
          <h3>THIS IS ADMIN PAGE</h3>
        </div>
        <div class="card-body">
          <h3>Welcome <span> <?php echo $_SESSION['admin_name']?></span></h3>
          <form action="logout.php" method="post">
            <button type="submit" class="btn btn-sm btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </div>
</section>

  
<?php
  include 'includes/footer.php';
?>