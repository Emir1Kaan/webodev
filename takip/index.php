<?php 
require_once 'db.php'; 

if(isset($_SESSION['mail']))
  {
    $kullanici_sorgu=$baglan->prepare("SELECT count(*) as total FROM kullanici WHERE mail=?");
    $kullanici_sorgu->execute(array($_SESSION['mail']));
    $kullanici_islem=$kullanici_sorgu->fetch();

    $ogrenci_sorgu=$baglan->prepare("SELECT count(*) as total FROM ogrenci");
    $ogrenci_sorgu->execute();
    $ogrenci_islem=$ogrenci_sorgu->fetch();
  }
  else
  {
    header("Location:giris.php");
  }
?>
<!doctype html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="assets/css/dashboard.css" rel="stylesheet">
  <link href="assets/css/customcss.css" rel="stylesheet">
  <link href="assets/css/offcanvas.css" rel="stylesheet">
  <script src="https://use.fontawesome.com/5c86269acc.js"></script>
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">Öğrenci Takip</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="cikis.php">Çıkış Yap</a>
      </li>
    </ul>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">
                <i class="fa fa-home"></i> &nbsp;
                Anasayfa
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kullanicilar.php">
                <i class="fa fa-users"></i> &nbsp;
                Sistem Kullanıcıları
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ogrenciler.php">
                <i class="fa fa-user"></i> &nbsp;
                Öğrenciler
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ogrenciekle.php">
                <i class="fa fa-edit"></i> &nbsp;
                Öğrenci Kaydet
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><br><br>
        <div class="container bootstrap snippets bootdey">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="kullanicilar.php" style="text-decoration: none;">
                <div class="panel panel-dark panel-colorful">
                  <div class="panel-body text-center">
                    <p class="text-uppercase mar-btm text-sm">Kayıtlı Kullanıcılar</p>
                    <i class="fa fa-users fa-5x"></i>
                    <hr>
                    <p class="h2 text-thin"><?php echo $kullanici_islem['total']; ?></p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="ogrenciler.php" style="text-decoration: none;">
                <div class="panel panel-danger panel-colorful">
                  <div class="panel-body text-center">
                    <p class="text-uppercase mar-btm text-sm">Kayıtlı Öğrenciler</p>
                    <i class="fa fa-user fa-5x"></i>
                    <hr>
                    <p class="h2 text-thin"><?php echo $ogrenci_islem['total']; ?></p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <br><br>

        
      </main>
    </div>
  </div>

  <script src="/assets/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
  </script>
  <script src="/assets/js/dashboard.js"></script>
  <script src="/assets/js/offcanvas.js"></script>
</body>

</html>