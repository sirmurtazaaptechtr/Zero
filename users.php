<?php
    include('layout/header.php');
    $sql = "SELECT * FROM `users` AS u
     JOIN `roles` AS r ON u.RoleID = r.RoleID
     JOIN `genders` AS g ON u.GenderID = g.GenderID
     JOIN `cities` AS ct ON u.CityID = ct.CityID
     JOIN `states` AS s ON u.StateID = s.StateID
     JOIN `countries` AS co ON u.CountryID = co.CountryID";
    $users = mysqli_query($conn,$sql);
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>All Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>      
      <li class="breadcrumb-item active">Users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">All Users</h5>
          <div class="my-2">
          <a href="user_add.php" type="button" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i> Add User</a>
          </div>
          <!-- Table with stripped rows -->
          <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">User ID</th>
                <th scope="col">Role ID</th>
                <th scope="col">Role</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Gender ID</th>
                <th scope="col">Gender</th>
                <th scope="col">Street</th>
                <th scope="col">City ID</th>
                <th scope="col">City</th>
                <th scope="col">State ID</th>
                <th scope="col">State</th>
                <th scope="col">Country ID</th>
                <th scope="col">Country</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $srno = 1;
                    while($user = mysqli_fetch_assoc($users)) 
                {?>
                <tr>
                    <th scope="row"><?php echo $srno;?> </th>
                    <td><img src="<?php echo $user['Photo']?>" alt="<?php echo $user['UserID']."-".$user['FullName']?>" height="50" class="rounded-circle"></td>
                    <td><?php echo $user['UserID']?></td>
                    <td><?php echo $user['RoleID']?></td>
                    <td><?php echo $user['Role']?></td>
                    <td><?php echo $user['FullName']?></td>
                    <td><?php echo $user['Email']?></td>
                    <td><?php echo $user['BirthDate']?></td>
                    <td><?php echo $user['GenderID']?></td>
                    <td><?php echo $user['Gender']?></td>
                    <td><?php echo $user['Street']?></td>
                    <td><?php echo $user['CityID']?></td>
                    <td><?php echo $user['City']?></td>
                    <td><?php echo $user['StateID']?></td>
                    <td><?php echo $user['State']?></td>
                    <td><?php echo $user['CountryID']?></td>
                    <td><?php echo $user['Country']?></td>
                </tr>
                <?php
                $srno++;
                }?>
            </tbody>
          </table>
          </div>
          
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?php
    include('layout/footer.php');
?>