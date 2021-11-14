<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/register_employerStyles.css') ?>" />

  <!-- CSS stylesheet for navigation bar -->
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/navbar.css') ?>" />

  <!-- For the Font Library -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300&family=Raleway:wght@300&display=swap" rel="stylesheet">

  <!-- Scripts for Navbar -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <title>Future Seekers.lk | My Profile</title>
</head>

<body>


  <div class="header">
    <div class="menu-bar">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href=""><img class="websitelogo" src="<?= base_url('Images/logo4.jpg') ?>"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">My Inbox</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('MyProfileApplicant/index') ?>">My Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">About Us</a>
            </li>
            <!-- Enter PHP code to check if the user is logged in or not in order to show login button -->
            <!-- <li class="nav-item">
                            <a class="nav-link btn btn btn-primary logoutbtn" href="#">Sign in / Register</a>
                        </li> -->
            <li class="nav-item">
              <!-- For blue button: btn btn-primary -->
              <a class="nav-link btn btn-danger logoutbtn" href="<?php echo site_url('Home/logout') ?>">Log out</a>
            </li>
            <!-- <li class="nav-item mobile_logout">
                            <a class="nav-link mobileloginbtn" href="#">Sign in / Register</a>
                        </li>      -->
            <li class="nav-item mobile_logout">
              <a class="nav-link mobilelogoutbtn" href="<?php echo site_url('Home/logout') ?>">Log out</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

  <br />
  <div class="card" style="margin-left:20px;margin-right:20px">
    <div class="card-header bg-primary" style="color:white">
      My Profile
    </div>
    <div class="card-body">
    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        <div style="margin-top:5px" class="alert alert-danger text-muted"> <?= session()->getFlashdata('fail'); ?> </div>
      <?php endif ?>

      <?php if (!empty(session()->getFlashdata('success'))) : ?>
        <div style="margin-top:5px" class="alert alert-success text-muted"> <?= session()->getFlashdata('success'); ?> </div>
      <?php endif ?>
      <h5 class="card-title">Application Details</h5>
      <p class="card-text" style="color:#787878">Click on the save changes to update your record</p>

      <form action="<?php echo site_url('/MyProfileApplicant/editProfile') ?>" method="POST">
        <?php
        session();
        session()->regenerate();
        $user_id = session()->get('user_id');
        $JobSeekerM = new \App\Models\jobSeekerModel();
        $UserAccountM = new \App\Models\userAccountModel();
        $jobSeeker_info = $JobSeekerM->where('user_account_id', $user_id)->first();

        $query_jobSeeker = $JobSeekerM->query("Select * from job_seeker where user_account_id = $user_id");
        foreach ($query_jobSeeker->getResult() as $row) {
          $name = $row->name;
          $address = $row->address;
          $email = $row->email;
          $dob = $row->dob;
          $contactNo = $row->contactNo;
          $currentJobTitle = $row->currentJobTitle;

          $query_useraccount = $UserAccountM->query("Select * from user_account where id = $user_id");
          foreach ($query_useraccount->getResult() as $row2) {
            $username = $row2->username;
            $password = $row2->password;
            $status = $row2->status;
          }
        }

        ?>


        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Full Name</label>
            <input class="form-control" type="text" placeholder="Full Name" name="name" id="name" value="<?= set_value('name');
                                                                                                          echo $name ?>" <?php if ($status == 0) { ?> readonly <?php } ?>>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'name') : '' ?></small>
          </div>
          <div class="form-group col-md-4">
            <label>Address</label>
            <input class="form-control" type="text" placeholder="Address" name="address" id="address" value="<?= set_value('address');
                                                                                                              echo $address ?>" <?php if ($status == 0) { ?> readonly <?php } ?>>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'address') : '' ?></small>
          </div>
          <div class="form-group col-md-4">
            <label>Email</label>
            <input class="form-control" type="email" placeholder="Email" name="email" id="email" value="<?= set_value('email');
                                                                                                        echo $email ?>" <?php if ($status == 0) { ?> readonly <?php } ?>>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'email') : '' ?></small>
          </div>
        </div>
        <div class="form-row">
          
          <div class="form-group col-md-4">
            <label>Dob</label>
            <input class="form-control" type="date" placeholder="Date of Birth" name="dob" id="dob" value="<?= set_value('dob');
                                                                                                            echo $dob ?>" <?php if ($status == 0) { ?> readonly <?php } ?>>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'dob') : '' ?></small>
          </div>
          <div class="form-group col-md-4">
            <label>Contact No</label>
            <input class="form-control" type="tel" placeholder="Contact No" name="contactNo" id="contactNo" value="<?= set_value('contactNo');
                                                                                                                    echo $contactNo ?>" <?php if ($status == 0) { ?> readonly <?php } ?>>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'contactNo') : '' ?></small>
          </div>
          <div class="form-group col-md-4">
            <label>Current Job Title</label>
            <input class="form-control" type="text" placeholder="Current Job Title" name="currentJobTitle" id="currentJobTitle" value="<?= set_value('currentJobTitle');
                                                                                                                                        echo $currentJobTitle ?>" <?php if ($status == 0) { ?> readonly <?php } ?>>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'currentJobTitle') : '' ?></small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Username</label>
            <input class="form-control" type="text" placeholder="Username" name="username" id="username" value="<?= set_value('username');
                                                                                                                echo $username ?>" <?php if ($status == 0) { ?> readonly <?php } ?>>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'username') : '' ?></small>
          </div>
          <div class="form-group col-md-6">
            <label>Password</label>
            <input class="form-control" type="password" placeholder="Password" name="password" id="password" value="<?= set_value('password');
                                                                                                                    echo $password ?>" <?php if ($status == 0) { ?> readonly <?php } ?>>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'password') : '' ?></small>
          </div>
          <br>
          <div class="form-row">
            <button type="submit" class="btn btn-primary btnlogin" <?php if ($status == 0) { ?> disabled <?php } ?>>Save Changes</button>
            <!-- <button id="loginbtn" class="btn btn-primary btnlogin">Register</button><br> -->
          </div>
      </form>
        </div>
    </div>
  </div>



  <!-- <a href="<?php echo site_url('Home/logout') ?>"><button>Logout</button></a> -->
  <?php

  ?>
</body>

</html>