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
<!doctype html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

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
          <h1 class="h2">Sistem Kullanıcıları</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <a href="kullanicidetay.php?query=ekle"><button type="button"
                  class="btn btn-sm btn-outline-success">Kullanıcı Ekle</button></a>
            </div>
          </div>
        </div>
        <div class="">
          <table id="example" class="table table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Avatar</th>
                <th>Ad Soyad</th>
                <th>E Posta Adresi</th>
                <th>İşlemler</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $sorgu=$baglan->prepare("SELECT * FROM ebeveynler WHERE mail=?");
            $sorgu->execute(array($_SESSION['mail']));
            $islem=$sorgu->fetch();

            $sql1="SELECT * FROM kullanici"; 

              foreach ($baglan->query($sql1) as $row)
              {
                $id       = $row['id'];
                $adsoyad  = $row['adsoyad'];
                $mail     = $row['mail'];
                echo "<tr>
                      <td class='align-middle'>".$id."</td>
                      <td class='align-middle'><img src='https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=g'
                          style='max-width: 50px; max-height: 50px;'></td>
                      <td class='align-middle'>".$adsoyad."</td>
                      <td class='align-middle'>".$mail."</td>
                      <td class='align-middle'>
                        <a class='btn btn-primary' href='kullanicidetay.php?query=guncelle&id=".$id."'><i class='fa fa-edit' title='Düzenle'></i></a>&nbsp;
                        <a class='btn btn-danger' href='kullanicidetay.php?query=sil&id=".$id."'><i class='fa fa-trash' title='Sil'></i></a>
                      </td>
                    </tr>";
              }
            ?>
            </tbody>
          </table>
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
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#example').DataTable({
        deferRender: true,
        scrollCollapse: true,
        scroller: true
      });
    });
  </script>

</body>

</html>