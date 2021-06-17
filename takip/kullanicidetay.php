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
    if($_GET["query"]=="ekle")
    {
      if(isset($_POST["mail"]))
      {
        $adsoyad  = $_POST["adsoyad"];
        $mail     = $_POST["mail"];
        $sifre    = $_POST["sifre"];
        $ekle = $baglan->query("insert into kullanici (adsoyad, mail, sifre ) "
                              ."values ('$adsoyad','$mail','$sifre')");
        if($ekle)
        {?>
          <script>
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Başarılı',
              text:'Kullanıcı Kayıdı Başarılı',
              showConfirmButton: false,
              timer: 2000
              })
          </script>
          <?php header("Refresh: 2; url=kullanicilar.php");
                
        }else
        {
          header("Location:kullanicidetay.php?query=ekle");
        }
      }
    }

    if($_GET["query"]=="guncelle")
    {
      $id     = $_GET["id"];
      $query  = $_GET["query"];
      $kullanici_sorgu=$baglan->prepare("SELECT * FROM kullanici where id=?");
      $kullanici_sorgu->execute(array($id));
      $kullanici_getir=$kullanici_sorgu->fetch();
    }

    if($_GET["query"]=="guncelle" && isset($_POST["mail"]))
    {
      $id       = $_POST["id"];
      $adsoyad  = $_POST["adsoyad"];
      $mail     = $_POST["mail"];
      $sifre    = $_POST["sifre"];

      $sql = "UPDATE kullanici SET adsoyad='".$adsoyad."', mail='".$mail."', sifre='".$sifre."' WHERE id=".$id."";
        $stmt = $baglan->prepare($sql);
        $stmt->execute();
        ?>
        <script>
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Başarılı',
            text:'Güncelleme Başarılı.',
            showConfirmButton: false,
            timer: 2000
            })
        </script>
        <?php
        header("Refresh: 2; url=kullanicilar.php");
    }

    if($_GET["query"]=="sil")
    {
      $id = $_GET["id"];
      $sql = "DELETE FROM kullanici WHERE id=".$id;

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
        header("Refresh: 2; url=kullanicilar.php");
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
        header("Refresh: 2; url=kullanicilar.php");
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
              <a class="nav-link active" href="kullanicilar.php">
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

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Sistem Kullanıcısı</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
          </div>
        </div>
        <div class="container-fluid d-flex justify-content-center" style="background-color: whitesmoke;">
          <div class="col-10"><br>
            <form method="POST" action="kullanicidetay.php?query=<?php if(isset($query)=="guncelle"){ echo "guncelle&id=".$id;} else{ echo "ekle";} ?>">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <label class="form-label" for="adsoyad">Adı Soyadı</label>
                    <input type="text" id="adsoyad" name="adsoyad" class="form-control" required enabled value="<?php if(isset($kullanici_getir['adsoyad'])){ echo $kullanici_getir['adsoyad']; } else{ echo "";} ?>" />
                    <input type="hidden" name="id" value="<?php if(isset($kullanici_getir['id'])){ echo $kullanici_getir['id']; } else{ echo "";} ?>">
                  </div>
                </div>
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="mail">Mail Adresi</label>
                <input type="email" id="mail" name="mail" class="form-control" required enabled value="<?php if(isset($kullanici_getir['mail'])){ echo $kullanici_getir['mail']; } else{ echo "";} ?>" />
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="sifre">Şifre</label>
                <input type="password" id="sifre" name="sifre" class="form-control" required enabled value="<?php if(isset($kullanici_getir['sifre'])){ echo $kullanici_getir['sifre']; } else{ echo "";} ?>" />
              </div>
              <!-- Submit button -->
              <button type="submit" class="btn <?php if(isset($query)=="guncelle"){ echo "btn-warning";} else{ echo "btn-primary";} ?>  btn-block mb-4"><?php if(isset($query)=="guncelle"){ echo "Güncelle";} else{ echo "Ekle";} ?></button>
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