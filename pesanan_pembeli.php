<?php  
include('koneksi.php');
    session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: login.php");
      }else{
?>
<?php 
if(empty($_SESSION["pesanan"]) OR !isset($_SESSION["pesanan"]))
{
  echo "<script>alert('Pesanan kosong, Silahkan Pesan dahulu');</script>";
  echo "<script>location= 'tampil_tiket.php'</script>";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <title>Visit Tasik</title>
  </head>
  <body>
  <!-- Jumbotron -->
      <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
          <h1 class="display-4"><span class="font-weight-bold">Explore Tasik tourism with a smile</span></h1>
          <hr>
          <p class="font-weight">Temukan keindahan alam dan kekayaan budaya Tasikmalaya, sebuah permata di Provinsi Jawa Barat. Dikelilingi oleh pegunungan yang menakjubkan, pantai yang indah dan masih banyak lagi</p>
        </div>
      </div>
  <!-- Akhir Jumbotron -->

  <!-- Navbar -->
      <nav class="navbar navbar-expand-lg  bg-dark">
        <div class="container">
        <a class="navbar-brand text-white" href="user.php"><strong>Visit </strong>Tasik</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link mr-4" href="user.php">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="tampil_tiket.php">DAFTAR TIKET</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="pesanan_pembeli.php">PESANAN ANDA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="logout.php">LOGOUT</a>
            </li>
          </ul>
        </div>
       </div> 
      </nav>
  <!-- Akhir Navbar -->

  <!-- Menu -->
    <div class="container">
      <div class="judul-pesanan mt-5">
       
        <h3 class="text-center font-weight-bold">TIKET ANDA</h3>
        
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pesanan</th>
            <th scope="col">harga_tiket</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subharga_tiket</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $totalharga = 0; ?>
            <?php foreach ($_SESSION["pesanan"] as $id_rute => $jumlah) : ?>

            <?php 
              include('koneksi.php');
              $ambil = mysqli_query($koneksi, "SELECT * FROM tiket_onlybus WHERE id_rute='$id_rute'");
              $pecah = $ambil -> fetch_assoc();
              $subharga_tiket = $pecah["harga_tiket"]*$jumlah;
            ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah["nama_bus"]; ?></td>
            <td>Rp. <?php echo number_format($pecah["harga_tiket"]); ?></td>
            <td><?php echo $jumlah; ?></td>
            <td>Rp. <?php echo number_format($subharga_tiket); ?></td>
            <td>
              <a href="hapus_pesanan.php?id_rute=<?php echo $id_rute ?>" class="badge badge-danger">Hapus</a>
            </td>
          </tr>
            <?php $nomor++; ?>
            <?php $totalharga+=$subharga_tiket; ?>
            <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Belanja</th>
            <th colspan="2">Rp. <?php echo number_format($totalharga) ?></th>
          </tr>
        </tfoot>
      </table><br>
      <form method="POST" action="">
        <a href="tampil_tiket.php" class="btn btn-primary btn-sm">Lihat Tiket</a>
        <button class="btn btn-success btn-sm" name="konfirm">Konfirmasi Pesanan</button>
      </form>        

      <?php 
      if(isset($_POST['konfirm'])) {
          $tanggal_pemesanan=date("Y-m-d");

          // Menyimpan data ke tabel pemesanan
          $insert = mysqli_query($koneksi, "INSERT INTO pemesanan (tanggal_pemesanan, total) VALUES ('$tanggal_pemesanan', '$totalharga')");

          // Mendapatkan ID barusan
          $id_terbaru = $koneksi->insert_id;

          // Menyimpan data ke tabel pemesanan tiket_onlybus
          foreach ($_SESSION["pesanan"] as $id_rute => $jumlah)
          {
            $insert = mysqli_query($koneksi, "INSERT INTO pemesanan_tiket (id_pemesanan, id_rute, jumlah) 
              VALUES ('$id_terbaru', '$id_rute', '$jumlah') ");
          }          

          // Mengosongkan pesanan
          unset($_SESSION["pesanan"]);

          // Dialihkan ke halaman nota
          echo "<script>alert('Pemesanan Sukses! Kelanjutan Tiket Akan Di Hubungi Admin');</script>";
          echo "<script>location= 'tampil_tiket.php'</script>";
      }
      ?>
    </div>
    
  <!-- Akhir Menu -->
    

  <!-- Awal Footer -->
      <hr class="footer">
      <div class="container">
        <div class="row footer-body">
          <div class="col-md-6">
          <div class="copyright">
            <strong>Copyright</strong> <i class="far fa-copyright"></i>2024 - Andy Dev</p>
          </div>
          </div>

          <div class="col-md-6 d-flex justify-content-end">
          <div class="icon-contact">
          <label class="font-weight-bold">Follow Us </label>
          <a href="https://web.facebook.com/andhiey64.co.id"><img src="images/icon/fb.png" class="mr-3 ml-4" data-toggle="tooltip" title="Facebook"></a>
          <a href="https://www.instagram.com/andy_parawali"><img src="images/icon/ig.png" class="mr-3" data-toggle="tooltip" title="Instagram"></a>
          <a href="https://x.com/andy_parawali"><img src="images/icon/twitter.png" class="" data-toggle="tooltip" title="Twitter"></a>
        </div>
          </div>
        </div>
      </div>
  <!-- Akhir Footer -->





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#example').DataTable();
      } );
    </script>
  </body>
</html>
<?php } ?>