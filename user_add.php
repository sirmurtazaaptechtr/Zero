<?php
include('layout/header.php');
$sql_genders = "SELECT * FROM `genders`";
$genders = mysqli_query($conn,$sql_genders);
$sql_cities = "SELECT * FROM `cities`";
$cities = mysqli_query($conn,$sql_cities);
$sql_states = "SELECT * FROM `states`";
$states = mysqli_query($conn,$sql_states);
$sql_countries = "SELECT * FROM `countries`";
$countries = mysqli_query($conn,$sql_countries);


?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Add User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="users.php">All Users</a></li>
        <li class="breadcrumb-item active">Add User</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add New User</h5>
            <?php 
            // pr(mysqli_fetch_assoc($genders)); 
            // pr(mysqli_fetch_assoc($countries)); 
            // pr(mysqli_fetch_assoc($states)); 
            // pr(mysqli_fetch_assoc($cities)); 
            pr($_REQUEST); 
            ?>
            <!-- Multi Columns Form -->
            <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="col-md-12">
                <label for="imageUrl" class="form-label">Image</label>
                <input class="form-control" type="file" id="imageUrl" name="imageUrl">
              </div>
              <div class="col-md-12">
                <label for="fullName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName">
              </div>
              <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob">
              </div>
              <div class="col-md-6">
                <label for="genderID" class="form-label">Gender</label>
                <select id="genderID" class="form-select" name="gender">
                  <option value="0" selected>Select Gender</option>
                  <?php while($gender = mysqli_fetch_assoc($genders)) { ?>
                  <option value="<?php echo $gender['GenderID']?>"><?php echo $gender['Gender']?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="col-12">
                <label for="street" class="form-label">Street</label>
                <input type="text" class="form-control" id="street" name="street">
              </div>
              <div class="col-md-4">
                <label for="cityID" class="form-label">City</label>
                <select id="cityID" class="form-select" name="cityID">
                  <option value="0" selected>Choose City</option>
                  <?php while($city = mysqli_fetch_assoc($cities)) { ?>
                  <option value="<?php echo $city['CityID']?>"><?php echo $city['City']?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label for="stateID" class="form-label">State</label>
                <select id="stateID" class="form-select" name="stateID">
                  <option value="0" selected>Choose State</option>
                  <?php while($state = mysqli_fetch_assoc($states)) { ?>
                  <option value="<?php echo $state['StateID']?>"><?php echo $state['State']?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label for="countryID" class="form-label">Country</label>
                <select id="countryID" class="form-select" name="countryID">
                  <option value="0" selected>Choose Country</option>
                  <?php while($country = mysqli_fetch_assoc($countries)) { ?>
                  <option value="<?php echo $country['CountryID']?>"><?php echo $country['Country']?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php
include('layout/footer.php');
?>