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
            <div class="card card-body shadow border-0 text-center mt-3">
              <h6>Silakan isi data sesuai permintaan form dibawah</h6>
              <form action="" method="POST">
                <div class="form-group mt-3">
                  <label for="jumlah">Masukan jumlah data</label>
                  <input type="number" name="jumlah" placeholder="jumlah" class="form-control text-center" required autocomplete="on">
                </div>
                <div class="form-group mt-3">
                  <button type="submit" name="jumlah-data" class="btn btn-success btn-sm shadow">Hitung</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <?php if(isset($_POST['jumlah-data'])){ $banyak = $_POST['jumlah'];?>
          <div class="card card-body shadow border-0 text-center mt-3">
            <h6>Silakan masukan data pengadaan komputer</h6>
            <form action="" method="POST">
              <div class="table-responsive">
                <table class="table table-sm">
                  <tr>
                    <th>Pengadaan/Tahun</th>
                    <th>Jumlah Komputer</th>
                  <tr>
                  <?php for($i=0; $i<$banyak; $i++){ ?>
                  <tr>
                    <td><input type=number min=0 name=demand[] placeholder="0" class="form-control" required="" oninvalid="this.setCustomValidity('Harap di isi !')" oninput="setCustomValidity('')"></td>
                    <td><input type=number min=1 name=freq[] placeholder="0" class="form-control" required="" oninvalid="this.setCustomValidity('Harap di isi !')" oninput="setCustomValidity('')"></td>
                  </tr>
                  <?php } ?>
                </table>
                <div class="form-group">
                  <input type="hidden" name="jumlah" value="<?= $banyak; ?>">
                  <button type="submit" name="hitung" class="btn btn-success btn-sm shadow">Hitung</button>
                </div>
              </div>
            </form>
          </div>
          <?php }if(isset($_POST['hitung'])){
            error_reporting(E_ERROR);
            $jumlah = $_POST['jumlah'];
            $demand = $_POST['demand'];
            $freq = $_POST['freq'];
            $total = 0;
            $banyak = $_POST['banyak'];
            $probability[-1] = 0;
            $amount = count($freq);
            $botInterval = [];
            $topInterval = [];
            for($i=0;$i<count($freq);$i++){
              $total = $total + $freq[$i];
            }
            for($i=0;$i<count($freq);$i++){
              $probability[$i] = round($freq[$i]/$total,3);
              $cumulative[$i] =  round($cumulative[$i-1] + $probability[$i],3);
            }
            $length = 0;
            for($i=0;$i<count($freq);$i++){
              if($length < strlen($cumulative[$i])){
                $length = strlen($cumulative[$i]) - 2;
              }
            }
            $lowestInterval = 1;
            for($j=0;$j<$length;$j++){
              $lowestInterval = $lowestInterval/10;
            }
            $lowestInterval = round($lowestInterval,3);
            $botInterval[0] = $lowestInterval;
            $topInterval[0] = $cumulative[0];
            for($i=1;$i<count($freq);$i++){
              $botInterval[$i] = round($topInterval[$i-1] + $lowestInterval,3);
              $topInterval[$i] = round($cumulative[$i],3);
            }
            $pangkat = 1;
            for($j=0;$j<$length;$j++){
              $pangkat = $pangkat * 10;
            }
          ?>
          <div class="card card-body shadow border-0 text-center mt-3">
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
					        <?php $no=1; for($i=0; $i<count($freq); $i++){?>
                  <tr>
                    <th><?= $no;?></th>
                    <td><?= $demand[$i];?></td>
                    <td><?= $freq[$i];?></td>
                    <td><?= $probability[$i];?></td>
                    <td><?= $cumulative[$i];?></td>
                    <td><?= $botInterval[$i]." - ".$topInterval[$i];?></td>
                  </tr>
                  <?php $no++; }?>
                </tbody>
              </table>
            </div>
						<form action="" method="POST">
							<table class="table table-sm table-borderless">
								<tr>
									<td>Jumlah simulasi <?= $banyak;?></td>
									<td>:</td>
									<td><input type="number" value="<?= $jumlah?>" min="1" class="form-control" name="jmlRandom" required oninvalid="this.setCustomValidity('Harap di isi !')" oninput="setCustomValidity('')" style="width: 75px"></td>
									<td>Dengan Asumsi: </td>
								</tr>
								<tr>
									<td>Masukan X0</td>
									<td>:</td>
                  <td><input type="number" min="1" class="form-control" name="x0" required oninvalid="this.setCustomValidity('Harap di isi !')" oninput="setCustomValidity('')" style="width: 75px"></td>
									<td>X0 < m </td>
								</tr>
								<tr>
									<td>Masukan a</td>
									<td>:</td>
									<td><input type="number" min="1" class="form-control" name="a" required oninvalid="this.setCustomValidity('Harap di isi !')" oninput="setCustomValidity('')" style="width: 75px"></td>
									<td>a < m </td>
								</tr>
								<tr>
									<td>Masukan c</td>
									<td>:</td>
									<td><input type="number" min="1" class="form-control" name="c" required oninvalid="this.setCustomValidity('Harap di isi !')" oninput="setCustomValidity('')" style="width: 75px"></td>
									<td>c < m </td>
								</tr>
								<tr>
									<td>Masukan m</td>
									<td>:</td>
									<td><input type="number" min="1" class="form-control" name="m" required oninvalid="this.setCustomValidity('Harap di isi !')" oninput="setCustomValidity('')" style="width: 75px"></td>
									<td>m > 0 </td>
								</tr>
								<input type="hidden" value="<?= $pangkat; ?>" name="pangkat">
								<input type="hidden" value="<?= $banyak; ?>" name="banyak">
								<input type="hidden" value="<?= $amount; ?>" name="amount">
								<input type="hidden" value="<?= $lowestInterval; ?>" name="lowestInterval">
                <input type="hidden" value="<?= print base64_encode(serialize($demand)); ?>" name="demand">
                <input type="hidden" value="<?php print base64_encode(serialize($botInterval)); ?>" name="botInterval">
                <input type="hidden" value="<?php print base64_encode(serialize($topInterval)); ?>" name="topInterval">
								<tr>
                  <td colspan="4"><button type="submit" name="hasil-akhir" class="btn btn-success btn-sm shadow mt-3">Run</button></td>
                </tr>					
							</table>
						</form>
          </div>
          <?php }if(isset($_POST['hasil-akhir'])){
            $jmlRandom = $_POST['jmlRandom'];
            $x0 = $_POST['x0'];
            $a = $_POST['a'];
            $c = $_POST['c'];
            $m = $_POST['m'];
            $angka_random = [];
            $hasil = [];
            $hasil[0] = $x0;
            $pangkat = $_POST['pangkat'];
            $amount = $_POST['amount'];
            $lowestInterval = $_POST['lowestInterval'];
            $dem = $_POST['demand'];
            $demand = unserialize(base64_decode($dem));
            $botInt = $_POST['botInterval'];
            $botInterval = unserialize(base64_decode($botInt));
            $topInt = $_POST['topInterval'];
            $topInterval = unserialize(base64_decode($topInt));
            $demandResult;
          ?>
          <div class="card card-body border-0 shadow mt-3">
            <h6>Hasil akhir</h6>
            <div class="table-responsive">
              <table class="table table-sm">
                <tr>
                  <th>Hari</th>
                  <th>Bilangan Acak</th>
                  <th>Permintaan</th>
                </tr>
                <?php for($i=0; $i<$jmlRandom; $i++){?>
                <tr>
                  <td> <?= $i+1; ?></td>
                  <td><?php
                    $hasil[$i+1] = ($a*$hasil[$i] + $c) % $m;
                    $angka_random[$i] = round($hasil[$i+1]/$m, 5);
                    echo $angka_random[$i]."<br>";
                  ?>
                  </td>
                  <td><?php
                    for($j=0;$j<$amount;$j++){
                      if($angka_random[$i] >= $botInterval[$j] && $angka_random[$i] <= $topInterval[$j]){
                        $demandResult[$i] = $demand[$j];
                        echo $demandResult[$i];
                      }
                    }
                  ?></td>
                </tr>
                <?php }?>
              </table>
              <?php
                $total=0;
                for($i=0; $i<$jmlRandom; $i++){
                  $total=$total+$demandResult[$i];
                }
                $average = $total / $jmlRandom;
              ?>
              <h4>Rata-rata jumlah pengadaan: <?= $average; ?></h4><br/>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
      <?php if(isset($_POST['jumlah-data']) || isset($_POST['hitung']) || isset($_POST['hasil-akhir'])){?>
      <div class="row mt-5 mb-5">
        <div class="col-md-12 text-center">
          <form action="" method="POST">
            <button type="submit" name="clear" class="btn btn-warning btn-sm shadow">Clear Data</button>
          </form>
        </div>
      </div>
      <?php }?>
    </div>
    <?php require_once("../resources/layout/header.php");?>
  </body>
</html>