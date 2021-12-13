<?php require_once("../controller/script.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../resources/layout/header.php");?>
  </head>
  <body>
    <?php require_once("../resources/layout/navbar.php");?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mt-3 text-center">
          <div class="h1">Simulasi Pengadaan Komputer <br> Menggunakan Metode Monte Carlo</div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-6">
          <div class="col-8 m-auto">
            <div class="card card-body shadow border-0 text-center">
              <h6>Silakan isi data sesuai permintaan form dibawah</h6>
              <form action="" method="POST">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tahun">Dari Tahun</label>
                      <input type="number" name="tahun1" placeholder="tahun" class="form-control text-center" required autocomplete="on">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tahun">Sampe Tahun</label>
                      <input type="number" name="tahun2" placeholder="tahun" class="form-control text-center" required autocomplete="on">
                    </div>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <label for="komputer">Perkiraan Pengadaan Komputer/tahun</label>
                  <input type="number" name="komputer" placeholder="komputer" class="form-control text-center" required autocomplete="on">
                </div>
                <div class="form-group mt-3">
                  <button type="submit" name="hitung1" class="btn btn-success btn-sm shadow">Hitung</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <?php if(isset($_SESSION['table1'])>0){?>
          <div class="card card-body shadow border-0">
            <div class="table-responsive">
              <table class="table table-sm text-center">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pengadaan komputer/Tahun</th>
                    <th scope="col">Jumlah Komputer</th>
                    <th scope="col">Probalitas</th>
                    <th scope="col">Komulatif Probabilitas</th>
                    <th scope="col">Interval Bilangan Acak</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1;
                    $start_year=$_SESSION['start_year'];
                    $end_year=$_SESSION['end_year'];
                    $komputer=$_SESSION['komputer'];
                    $all_komputer=0;
                    for($year=$start_year; $year<=$end_year; $year++){
                  ?>
                  <tr>
                    <th scope="row"><?= $no;?></th>
                    <td><?= $year?></td>
                    <td><?php $total_komputer=rand(0, $komputer); echo $total_komputer;?></td>
                    <td><?php $probabilitas=$total_komputer / $_SESSION['komputer']; echo $probabilitas;?></td>
                    <td><?php $komulatif=$probabilitas+$probabilitas; echo $komulatif;?></td>
                  </tr>
                  <?php $no++; $all_komputer += $total_komputer; }?>
                  <tr>
                    <th colspan="2">Jumlah</th>
                    <td><?= $_SESSION['all_komputer']=$all_komputer;?></td>
                    <td colspan="3"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
      <div class="row"></div>
      <div class="row mt-5">
        <div class="col-md-12 text-center">
          <form action="" method="POST">
            <button type="submit" name="clear" class="btn btn-warning btn-sm shadow">Clear Data</button>
          </form>
        </div>
      </div>
    </div>
    <?php require_once("../resources/layout/header.php");?>
  </body>
</html>