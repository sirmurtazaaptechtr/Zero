<?php
    include('layout/header.php');
    $sql = "SELECT * FROM `cities`";
    $cities = mysqli_query($conn,$sql);
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>All Cities</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item">Configrations</li>
      <li class="breadcrumb-item active">cities</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">All Cities</h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">City ID</th>
                <th scope="col">State ID</th>
                <th scope="col">City</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $srno = 1;
                    while($city = mysqli_fetch_assoc($cities)) 
                {?>
                <tr>
                    <th scope="row"><?php echo $srno;?> </th>
                    <td><?php echo $city['CityID']?></td>
                    <td><?php echo $city['StateID']?></td>
                    <td><?php echo $city['City']?></td>
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