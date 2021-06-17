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
?>


<?php
  if(isset($_GET["query"]))
  {
    if($_GET["query"]=="goster")
    {
      $id     = $_GET["id"];
      $query  = $_GET["query"];
      $ogrenci_sorgu=$baglan->prepare("SELECT * FROM ogrenci where id=?");
      $ogrenci_sorgu->execute(array($id));
      $ogrenci_getir=$ogrenci_sorgu->fetch();
    }
  

    if($_GET["query"]=="guncelle")
    {
      $id     = $_GET["id"];
      $query  = $_GET["query"];
      $ogrenci_sorgu=$baglan->prepare("SELECT * FROM ogrenci where id=?");
      $ogrenci_sorgu->execute(array($id));
      $ogrenci_getir=$ogrenci_sorgu->fetch();
    }
    if(isset($_POST["tckimlik"]))
    {
      $query            = $_GET["query"];
      $id               = $_GET["id"];
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

      $sql = "UPDATE ogrenci SET adsoyad='".$adsoyad."', tc='".$tckimlik."', sinif='".$sinif."', sube='".$sube."', numara='".$numara."', ogrenim_sekli='".$ogrenim_sekli."', teorik_kaldigi='".$teorik_kaldigi."', uygulama_kaldigi='".$uygulama_kaldigi."', odev_durum='".$odev_durum."', ogretmen_not='".$ogretmen_not."' WHERE id=".$id;
        $stmt = $baglan->prepare($sql);
        $stmt->execute();
        ?>
        <script>
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Başarılı',
            text:'Öğrenci Güncelleme Başarılı.',
            showConfirmButton: false,
            timer: 2000
            })
        </script>
        <?php
        header("Refresh: 2; url=ogrenciler.php");
      }

    if($_GET["query"]=="sil")
    {
      $id     = $_GET["id"];
      $query  = $_GET["query"];
      $sql = "DELETE FROM ogrenci WHERE id=".$id;

      if ($baglan->query($sql) == TRUE) 
      {?>
        <script>
          Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Başarılı',
          text:'Silme Başarılı.',
          showConfirmButton: false,
          timer: 2000
          })
        </script>
        <?php
        header("Refresh: 2; url=ogrenciler.php");
      }
      else 
      {?>
        <script>
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Hata',
            text:'Kayıt Silinemedi.',
            showConfirmButton: false,
            timer: 2000
            })
        </script>
        <?php
        header("Refresh: 2; url=ogrenciler.php");
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
              <a class="nav-link active" href="ogrenciler.php">
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

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Öğrenci Ekle</h1>
        </div>
        <div class="container-fluid d-flex justify-content-center" style="background-color: whitesmoke;">
          <div class="col-10"><br>
            <form method="post" action="ogrencidetay.php?query=guncelle&id=<?php if(isset($ogrenci_getir['id'])){ echo $ogrenci_getir['id']; } else{ echo "";} ?>">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <img src="assets/img/<?php if(isset($ogrenci_getir['resim'])){ echo $ogrenci_getir['resim']; } else{ echo "https://picsum.photos/200";} ?>" class="img-thumbnail" style="max-height:200px; max-width:200px; object-fit:contain;">
                    <hr>
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="tckimlik">TC Kimlik Numarası</label>
                    <input type="hidden" id="id" name="id" class="form-control" required <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?> value="<?php if(isset($ogrenci_getir['id'])){ echo $ogrenci_getir['id']; } else{ echo "";} ?>" />
                    <input type="text" id="tckimlik" name="tckimlik" class="form-control" <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?> value="<?php if(isset($ogrenci_getir['tc'])){ echo $ogrenci_getir['tc']; } else{ echo "";} ?>" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="numara">Numara</label>
                    <input type="text" id="numara" name="numara" class="form-control" required <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?> value="<?php if(isset($ogrenci_getir['numara'])){ echo $ogrenci_getir['numara']; } else{ echo "";} ?>" />
                  </div>
                </div>
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="adsoyad">İsim Soyisim</label>
                <input type="text" id="adsoyad" name="adsoyad" class="form-control" <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?> value="<?php if(isset($ogrenci_getir['adsoyad'])){ echo $ogrenci_getir['adsoyad']; } else{ echo "";} ?>" />
              </div>

              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="sinif">Sınıf</label>
                    <select class="form-control" id="sinif" name="sinif" required <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?>>
                      <option value="" selected disabled>Lütfen Sınıf Seçiniz</option>
                      <option <?php if($ogrenci_getir['sinif'] == "1"){ echo "selected"; } else{ echo "";} ?> value="1">1</option>
                      <option <?php if($ogrenci_getir['sinif'] == "2"){ echo "selected"; } else{ echo "";} ?> value="2">2</option>
                      <option <?php if($ogrenci_getir['sinif'] == "3"){ echo "selected"; } else{ echo "";} ?> value="3">3</option>
                      <option <?php if($ogrenci_getir['sinif'] == "4"){ echo "selected"; } else{ echo "";} ?> value="4">4</option>
                      <option <?php if($ogrenci_getir['sinif'] == "5"){ echo "selected"; } else{ echo "";} ?> value="5">5</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="sube">Şube</label>
                    <select class="form-control" id="sube" name="sube" required <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?>>
                      <option value="" selected disabled>Lütfen Şube Seçiniz</option>
                      <option <?php if($ogrenci_getir['sube'] == "A"){ echo "selected"; } else{ echo "";} ?> value="A">A</option>
                      <option <?php if($ogrenci_getir['sube'] == "B"){ echo "selected"; } else{ echo "";} ?> value="B">B</option>
                      <option <?php if($ogrenci_getir['sube'] == "C"){ echo "selected"; } else{ echo "";} ?> value="C">C</option>
                      <option <?php if($ogrenci_getir['sube'] == "D"){ echo "selected"; } else{ echo "";} ?> value="D">D</option>
                      <option <?php if($ogrenci_getir['sube'] == "E"){ echo "selected"; } else{ echo "";} ?> value="E">E</option>
                      <option <?php if($ogrenci_getir['sube'] == "F"){ echo "selected"; } else{ echo "";} ?> value="F">F</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="alissekli">Eğitim Modeli</label>
                <select class="form-control" id="alissekli" name="alissekli" required <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?>>
                  <option value="" selected disabled>Lütfen Sınıf Seçiniz</option>
                  <option <?php if($ogrenci_getir['ogrenim_sekli'] == "Örgün Eğitim"){ echo "selected"; } else{ echo "";} ?> value="Örgün Eğitim">Örgün Eğitim</option>
                  <option <?php if($ogrenci_getir['ogrenim_sekli'] == "Uzaktan Eğitim"){ echo "selected"; } else{ echo "";} ?> value="Uzaktan Eğitim">Uzaktan Eğitim</option>
                </select>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="teorik_kaldigi">Teorik Derslerde Kaldığı Yer</label>
                <textarea class="form-control" id="teorik_kaldigi" name="teorik_kaldigi" rows="2" enabled <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?>><?php if(isset($ogrenci_getir['teorik_kaldigi'])){ echo $ogrenci_getir['teorik_kaldigi']; } else{ echo "";} ?></textarea>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="uygulama_kaldigi">Uygulama Derslerinde Kaldığı Yer</label>
                <textarea class="form-control" id="uygulama_kaldigi" name="uygulama_kaldigi" rows="2" enabled <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?>><?php if(isset($ogrenci_getir['uygulama_kaldigi'])){ echo $ogrenci_getir['uygulama_kaldigi']; } else{ echo "";} ?></textarea>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="odev_durum">Ödev Durumu</label>
                <textarea class="form-control" id="odev_durum" name="odev_durum" rows="2" enabled <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?>><?php if(isset($ogrenci_getir['odev_durum'])){ echo $ogrenci_getir['odev_durum']; } else{ echo "";} ?></textarea>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="ogretmen_not">Öğretmen Notu</label>
                <textarea class="form-control" id="ogretmen_not" name="ogretmen_not" rows="2" enabled <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?>><?php if(isset($ogrenci_getir['ogretmen_not'])){ echo $ogrenci_getir['ogretmen_not']; } else{ echo "";} ?></textarea>
              </div>
              <!-- Submit button -->
              <button type="submit" class="btn btn-warning btn-block mb-4" <?php if($query=="goster"){ echo "disabled"; }else{ echo "enabled"; } ?> >Güncelle</button>
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