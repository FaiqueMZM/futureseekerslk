<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="This is the admin portal page of FutureSeekers.lk, Admins can control the profiles, job adverts and web page from here">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />

  <link rel="stylesheet" href="<?= base_url('bootstrap/css/admin.css') ?>" />

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
  <!-- <link rel="stylesheet" href="<?= base_url('bootstrap/css/login_styles.css') ?>" /> -->

  <title>Future Seekers.lk | Admin Portal</title>
  <!-- <style>
    #unverified_profile_tbl tr, #verified_profile_tbl tr {
      cursor: pointer;
      transform: all .25s ease-in-out;
    }

    #unverified_profile_tbl tr:hover, #verified_profile_tbl tr:hover {
      /* background-color: #d4edda; */
      /* background-color: #f8d7da; */
    }

    .selected {
      /* background: #d4edda; */
      background-color: #d4edda;
    }
  </style> -->
</head>

<body>
  <div class="header">
    <div class="menu-bar">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="<?php echo site_url('AdminHome/index') ?>"><span class="badge badge-primary admin_badge">ADMIN</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url('AdminHome/index') ?>">Dashboard </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Member Profiles
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="<?php echo site_url('AdminEmployerProfiles/index') ?>">Company Profiles</a>
                <a class="dropdown-item" href="#">Applicant Profiles</a>
                <!-- <a class="dropdown-item" href="#">Something else here</a> -->
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Job Postings </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Manage Admins</a>
            </li>
            <li class="nav-item">
              <!-- For blue button: btn btn-primary -->
              <a class="nav-link btn btn-danger logoutbtn" href="<?php echo site_url('Admin/logout') ?>">Log out</a>
            </li>
            <li class="nav-item mobile_logout">
              <a class="nav-link mobilelogoutbtn" href="<?php echo site_url('Admin/logout') ?>">Log out</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h2> Applicant Profiles Summary </h2>
    </div>
  </div>

  <!-- All New Profiles Requests -->
  <div>
    <div class="card">
      <div class="card-header">
        <!-- Message comes here -->
      </div>
      <div class="card-body">
        <h3 class="card-title">Profile Requests</h3>
        <form action="<?php echo site_url('/AdminApplicantProfiles/verify') ?>" method="POST">
          <div class="form-inline">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected User ID: </label>
            <input name="account_id" id="account_id" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
            <button class="btn btn-success my-1 acceptbtn_admin" type="submit" id="auser" name="auser">Accept</button>
            <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="ruser" name="ruser">Reject</button>
          </div>
          <br>
          <div class="table-responsive">
            <table id="unverified_profile_tbl" class="table table-hover" style="width:100% !important">

              <thead style="background-color:#007BFF;color:#FFFFFF">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Dob</th>
                  <th>Job Title</th>
                  <th>Username</th>
                  <!-- <th>Password</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $JobSeeker = new \App\Models\jobSeekerModel();
                $UserAccount = new \App\Models\userAccountModel();
                $query = $JobSeeker->query("Select * From job_seeker"); // To get all Applicant
                foreach ($query->getResult() as $row) {
                  $useraccountid = $row->user_account_id;
                  $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 0");
                  foreach ($query_useraccount->getResult() as $row2) {
                    $username = $row2->username;
                    $password = $row2->password;
                ?>
                    <tr>
                      <td><?php echo $row->user_account_id; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->address; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->contactNo; ?></td>
                      <td><?php echo $row->dob; ?></td>
                      <td><?php echo $row->currentJobTitle; ?></td>
                      <td><?php echo $username; ?></td>
                      <!-- <td><?php // echo $password; 
                                ?></td> -->
                    </tr>
                  <?php
                  }
                  ?>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>


    <!-- Accepted Profiles -->
    <div class="card">
      <div class="card-header">
        <!-- Message comes here -->
      </div>
      <div class="card-body">
        <h3 class="card-title">Accepted Profiles</h3>
        <form action="<?php echo site_url('/AdminApplicantProfiles/verify') ?>" method="POST">
          <div class="form-inline">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected User ID: </label>
            <input name="account_id1" id="account_id1" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
            <!-- <button class="btn btn-success my-1 acceptbtn_admin" type="submit" id="duser" name="duser">Accept</button> -->
            <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="duser" name="duser">Delete Profile</button>
          </div>
          <br>
          <div class="table-responsive">
            <table id="verified_profile_tbl" class="table table-hover" style="width:100% !important">

              <thead style="background-color:#007BFF;color:#FFFFFF">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Dob</th>
                  <th>Job Title</th>
                  <th>Username</th>
                  <!-- <th>Password</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $JobSeeker = new \App\Models\jobSeekerModel();
                $UserAccount = new \App\Models\userAccountModel();
                $query = $JobSeeker->query("Select * From job_seeker"); // To get all Applicant
                foreach ($query->getResult() as $row) {
                  $useraccountid = $row->user_account_id;
                  $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 1");
                  foreach ($query_useraccount->getResult() as $row2) {
                    $username = $row2->username;
                    $password = $row2->password;
                ?>
                    <tr>
                      <td><?php echo $row->user_account_id; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->address; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->contactNo; ?></td>
                      <td><?php echo $row->dob; ?></td>
                      <td><?php echo $row->currentJobTitle; ?></td>
                      <td><?php echo $username; ?></td>
                      <!-- <td><?php // echo $password; 
                                ?></td> -->
                    </tr>
                  <?php
                  }
                  ?>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>

    <!-- Rejected Profiles -->
    <div class="card">
      <div class="card-header">
        <!-- Message comes here -->
      </div>
      <div class="card-body">
        <h3 class="card-title">Rejected Profiles</h3>
        <!-- <form action="<?php echo site_url('/AdminApplicantProfiles/verify') ?>" method="POST"> -->
        <br>
        <div class="table-responsive">
          <table class="table" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Dob</th>
                <th>Job Title</th>
                <th>Username</th>
                <!-- <th>Password</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              $JobSeeker = new \App\Models\jobSeekerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $query = $JobSeeker->query("Select * From job_seeker"); // To get all Applicant
              foreach ($query->getResult() as $row) {
                $useraccountid = $row->user_account_id;
                $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 2");
                foreach ($query_useraccount->getResult() as $row2) {
                  $username = $row2->username;
                  $password = $row2->password;
              ?>
                  <tr>
                    <td><?php echo $row->user_account_id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->contactNo; ?></td>
                    <td><?php echo $row->dob; ?></td>
                    <td><?php echo $row->currentJobTitle; ?></td>
                    <td><?php echo $username; ?></td>
                    <!-- <td><?php // echo $password; 
                              ?></td> -->
                  </tr>
                <?php
                }
                ?>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Deleted Profiles -->
    <div class="card">
      <div class="card-header">
        <!-- Message comes here -->
      </div>
      <div class="card-body">
        <h3 class="card-title">Deleted Profiles</h3>
        <!-- <form action="<?php echo site_url('/AdminApplicantProfiles/verify') ?>" method="POST"> -->
        <br>
        <div class="table-responsive">
          <table class="table" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Dob</th>
                <th>Job Title</th>
                <th>Username</th>
                <!-- <th>Password</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              $JobSeeker = new \App\Models\jobSeekerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $query = $JobSeeker->query("Select * From job_seeker"); // To get all Applicant
              foreach ($query->getResult() as $row) {
                $useraccountid = $row->user_account_id;
                $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 3");
                foreach ($query_useraccount->getResult() as $row2) {
                  $username = $row2->username;
                  $password = $row2->password;
              ?>
                  <tr>
                    <td><?php echo $row->user_account_id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->contactNo; ?></td>
                    <td><?php echo $row->dob; ?></td>
                    <td><?php echo $row->currentJobTitle; ?></td>
                    <td><?php echo $username; ?></td>
                    <!-- <td><?php // echo $password; 
                              ?></td> -->
                  </tr>
                <?php
                }
                ?>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- <div><a href="<?php echo site_url('Admin/logout') ?>"><button>Logout</button></a></div> -->

    <script>
      var table = document.getElementById('unverified_profile_tbl'),
        rIndex;
      for (var i = 1; i < table.rows.length; i++) {
        table.rows[i].onclick = function() {
          //Gets the row index
          rIndex = this.rowIndex;
          // console.log(rIndex);
          // table.rows[1].style.backgroundColor = "red";
          document.getElementById('account_id').value = this.cells[0].innerHTML;
        }
      }
      var table = document.getElementById('verified_profile_tbl'),
        rIndex;
      for (var i = 1; i < table.rows.length; i++) {
        table.rows[i].onclick = function() {
          //Gets the row index
          rIndex = this.rowIndex;
          // console.log(rIndex);
          document.getElementById('account_id1').value = this.cells[0].innerHTML;
        }
      }
      // $('unverified_profile_tbl tbody tr').click(function() {
      //   $(this).addClass('active').siblings().removeClass('active');
      // });

      document.querySelector('#verified_profile_tbl').addEventListener('click', function(e) {
        var closestCell = e.target.closest('tr'), // identify the closest td when the click occured
          activeCell = e.currentTarget.querySelector('tr.selected'); // identify the already selected td

        closestCell.classList.add('selected'); // add the "selected" class to the clicked td
        if (activeCell) activeCell.classList.remove('selected'); // remove the "selected" class from the previously selected td
      })

      document.querySelector('#unverified_profile_tbl').addEventListener('click', function(e) {
        var closestCell = e.target.closest('tr'), // identify the closest td when the click occured
          activeCell = e.currentTarget.querySelector('tr.selected'); // identify the already selected td

        closestCell.classList.add('selected'); // add the "selected" class to the clicked td
        if (activeCell) activeCell.classList.remove('selected'); // remove the "selected" class from the previously selected td
      })
    </script>
</body>

</html>