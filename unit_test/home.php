<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">

   <title>Catchee</title>
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo_full.svg" width="30" height="30" class="d-inline-block align-top"> CATCHEE
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item mr-3 active" id="nav_list_home">
            <a class="nav-link" href="#"><i class="fas fa-home mr-1"></i>Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item mr-3" id="nav_list_help">
            <a class="nav-link" href="#"><i class="fas fa-question-circle mr-1"></i>Help</a>
          </li>
          <li class="nav-item" id="nav_list_aboutus">
            <a class="nav-link" href="#"><i class="fas fa-cat mr-1"></i>About Us</a>
          </li>
        </ul>
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item mr-3">
            <a class="nav-link" id="nav_login" data-toggle="modal" data-target="#LoginModal"style="cursor:pointer;"><i class="fas fa-sign-in-alt mr-1"></i>Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="nav_signup" href="test_signup.html"><i class="fas fa-user mr-1"></i>Sign Up</a>
          </li>
        </ul>
      </div>
    </nav>

    <img src="midnight.png" style="width:100%;height:500px;">

    <!-- Modal -->
    <form name="signup" action="login.php" method="post">
      <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="LoginModalTitle">Login</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <!-- <label for="UsernameInput">Username/Email:*</label> -->
                <input type="text" class="form-control" name="credential" placeholder="Username/Email"/>
              </div>
              <div class="form-group">
                <!-- <label for="PasswordInitInput">Password:*</label> -->
                <input type="password" class="form-control" name="password" placeholder="Password"/>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" name="submit_login" value="Login" onclick=""/>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php include("item_loader.php"); ?>

    <!--
    <div class="card" style="width: 18rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
    -->

    <div class="container-fluid" style="width:100%;height:200px;background-color:#ecf0f1;">
      <div class="row">
        <div class="col">
        </div>
        <div class="col">
        </div>
        <div class="col">
        </div>
      </div>
      <div class="row">
        <div class="col" >
          <label>&copy; Catchee 2019 - 2020</label>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="user_identifier.js"></script>

  </body>
</html>
