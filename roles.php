<?php
    include('layout/header.php');
    $sql = "SELECT * FROM `roles`";
    $roles = mysqli_query($conn,$sql);
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>All Roles</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item">Configrations</li>
      <li class="breadcrumb-item active">Roles</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">All Roles</h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Role ID</th>
                <th scope="col">Role</th>
                <th scope="col">Description</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $srno = 1;
                    while($role = mysqli_fetch_assoc($roles)) 
                {?>
                <tr>
                    <th scope="row"><?php echo $srno;?> </th>
                    <td><?php echo $role['RoleID']?></td>
                    <td><?php echo $role['Role']?></td>
                    <td><?php echo $role['Description']?></td>
                </tr>
                <?php
                $srno++;
                }?>
            </tbody>
          </table>
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