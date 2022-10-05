<?php
  session_start();
  include 'connection.php';



  if(isset($_POST['btn-submit-login']))
  {
    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    // $cpass = md5($_POST['confirm_password']);
    $role = $_POST['role'];

    $query = "SELECT * FROM multi_user_tbl WHERE email = '$email' AND password = '$pass' AND role = '$role' ";
    $query_run = mysqli_query($conn,$query);

    if(mysqli_num_rows($query_run) > 0)
    {
      $row = mysqli_fetch_array($query_run);
      if($row['role'] === 'ADMIN')
      {
        $_SESSION['admin_name'] = $row['name'];
        // $_SESSION['admin_email'] = $row['email'];
        header('Location:admin.php');
      }
      else if($row['role'] === 'USER')
      {
        $_SESSION['user_name'] = $row['name'];
        // $_SESSION['user_email'] = $row['email'];
        header('Location:user.php');
      }
      else 
      {
        $err[] = 'User not found';
      }
    } 
    else 
    {
      $err[] = 'Incorrect Email or Password';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multi-UserLogin</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Fontawesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />

  <!-- Prevent going back to Login Page -->
  <script language="javascript" text="text/javascript">
        window.history.forward(1);
    </script>
</head>
<body>
  <section>
    <div class="container">
      <div class="card">
        <div class="card-header text-white" style="background-color: #596275;">
          <h3>Multi User Role Login</h3>
        </div>
        <div class="card-body">
          <?php
            if (isset($err)) {
              foreach($err as $msg) :
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  '.$msg.'
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
              endforeach;
            }
          ?>
          <form action="" method="post">
            <div class="form-group mb-3">
              <input type="text" name="email" class="form-control" placeholder="Enter Email">
            </div>

            <div class="form-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>

            <div class="form-group mb-3">
              <select name="role" id="" class="form-control" requ>
                <option value="selected">--Select User Role--</option>
                <option value="ADMIN">Admin</option>
                <option value="USER">User</option>
              </select>
            </div>

            <a href="signup.php" style="text-decoration: none;">
                <p class="h6 text-muted">Don't have an account ?</p>
            </a>

            <div class="float-end">  
              <button type="submit" name="btn-submit-login" class="btn btn-sm btn-success">
                Login
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
  

  <!-- Bootstrap Script -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>