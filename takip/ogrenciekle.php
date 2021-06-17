<?php 
require_once 'db.php'; 

if(isset($_SESSION['mail']))
  {
    $sorgu=$baglan->prepare("SELECT * FROM kullanici WHERE mail=?");
    $sorgu->execute(array($_SESSION['mail']));
    $islem=$sorgu->fetch();
  }
  else
  {
    header("Location:giris.php");
  }

  if(isset($_POST["tckimlik"]))
      {
        $yol=realpath(dirname(__FILE__)); 
        $uploadfile="". htmlspecialchars($yol)."/assets/img/".basename($_FILES['resim']['name']);
        $dosya=basename($_FILES['resim']['name']);
        if (move_uploaded_file($_FILES['resim']['tmp_name'], $uploadfile))
        {
          $tckimlik         = $_POST["tckimlik"];
          $numara           = $_POST["numara"];
          $adsoyad          = $_POST["adsoyad"];
          $sinif            = $_POST["sinif"];
          $sube             = $_POST["sube"];
          $ogrenim_sekli    = $_POST["alissekli"];
          $teorik_kaldigi   = $_POST["teorik_kaldigi"];
          $uygulama_kaldigi = $_POST["uygulama_kaldigi"];
          $odev_durum       = $_POST["odev_durum"];
          $ogretmen_not     = $_POST["ogretmen_not"];

          $ekle = $baglan->query("insert into ogrenci (adsoyad, tc, sinif, sube, numara, resim, ogrenim_sekli, teorik_kaldigi, uygulama_kaldigi, odev_durum, ogretmen_not ) "
                                ."values ('$adsoyad','$tckimlik','$sinif','$sube','$numara','$dosya','$ogrenim_sekli','$teorik_kaldigi','$uygulama_kaldigi','$odev_durum','$ogretmen_not')");
          if($ekle)
          {?>
            <script>
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Başarılı',
                text:'Öğrenci Kayıdı Başarılı',
                showConfirmButton: false,
                timer: 2000
                })
            </script>
            <?php header("Refresh: 2; url=ogrenciler.php");
                  
          }
          else
          {
            header("Location:ogrenciekle.php?query=ekle");
          }
        }
        
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
              <a class="nav-link " aria-current="page" href="index.php">
                <i class="fa fa-home"></i> &nbsp;
                Anasayfa
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="kullanicilar.php">
                <i class="fa fa-users"></i> &nbsp;
                Sistem Kullanıcıları
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="ogrenciler.php">
                <i class="fa fa-user"></i> &nbsp;
                Öğrenciler
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="ogrenciekle.php">
                <i class="fa fa-edit"></i> &nbsp;
                Öğrenci Kaydet
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Öğrenci Ekle</h1>
        </div>
        <div class="container-fluid d-flex justify-content-center" style="background-color: whitesmoke;">
          <div class="col-10"><br>
            <form method="POST" action="#" enctype="multipart/form-data">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="tckimlik">TC Kimlik Numarası</label>
                    <input type="hidden" id="id" name="id" class="form-control" required enabled value="" />
                    <input type="text" id="tckimlik" name="tckimlik" class="form-control" enabled value="" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="numara">Numara</label>
                    <input type="text" id="numara" name="numara" class="form-control" required enabled value="" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="resim">Öğrenci Resmi</label>
                    <input type="file" id="resim" name="resim" class="form-control" required enabled value="" />
                    <small><b><?php echo "Max File Size : ",ini_get('upload_max_filesize'), ", Max Post Size : " , ini_get('post_max_size'); ?></b></small>
                  </div>
                </div>
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="adsoyad">İsim Soyisim</label>
                <input type="text" id="adsoyad" name="adsoyad" class="form-control" enabled value="" />
              </div>

              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="sinif">Sınıf</label>
                    <select class="form-control" id="sinif" name="sinif" required>
                      <option value="" selected disabled>Lütfen Sınıf Seçiniz</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="sube">Şube</label>
                    <select class="form-control" id="sube" name="sube" required>
                      <option value="" selected disabled>Lütfen Şube Seçiniz</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="F">F</option>
                      <option value="G">G</option>
                      <option value="H">H</option>
                      <option value="I">I</option>
                      <option value="J">J</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="alissekli">Eğitim Modeli</label>
                <select class="form-control" id="alissekli" name="alissekli" required>
                  <option value="" selected disabled>Lütfen Sınıf Seçiniz</option>
                  <option value="Örgün Eğitim">Örgün Eğitim</option>
                  <option value="Uzaktan Eğitim">Uzaktan Eğitim</option>
                </select>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="teorik_kaldigi">Teorik Derslerde Kaldığı Yer</label>
                <textarea class="form-control" id="teorik_kaldigi" name="teorik_kaldigi" rows="2" enabled value=""></textarea>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="uygulama_kaldigi">Uygulama Derslerinde Kaldığı Yer</label>
                <textarea class="form-control" id="uygulama_kaldigi" name="uygulama_kaldigi" rows="2" enabled value=""></textarea>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="odev_durum">Ödev Durumu</label>
                <textarea class="form-control" id="odev_durum" name="odev_durum" rows="2" enabled value=""></textarea>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="ogretmen_not">Öğretmen Notu</label>
                <textarea class="form-control" id="ogretmen_not" name="ogretmen_not" rows="2" enabled value=""></textarea>
              </div>
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">Kayıt</button>
            </form>
          </div>

        </div>
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
  <script src="dashboard.js"></script>
</body>

</html>