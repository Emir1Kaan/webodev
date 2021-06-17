<?php
require_once 'db.php'; 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Öğrenci Takip</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

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
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post" action="#">
    
    <h1 class="h3 mb-3 fw-normal">Giriş Yapınız</h1>
    <label for="email" class="visually-hidden">E Posta Adresiniz</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="E Posta Adresiniz" required autofocus>
    <label for="sifre" class="visually-hidden">Şifre</label>
    <input type="password" id="sifre" name="sifre" class="form-control" placeholder="Şifre" required>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Beni Hatırla
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş Yap</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
</main>

<?php
  if(isset($_POST["email"]))
  {
    $email=$_POST["email"];
    $sifre=$_POST["sifre"];
 
        if(!empty($email) || !empty($sifre))
        {
            $sorgu=$baglan->prepare("SELECT * FROM kullanici WHERE mail=? and sifre=?");
            $sorgu->execute(array($email,$sifre));
            $islem=$sorgu->fetch();
 
            if($islem)
            {
                $_SESSION['mail'] = $islem['mail'];
                $_SESSION['ebeveynid'] = $islem['id'];
                ?>
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Başarılı',
                        text:'Giriş Başarılı, Lütfen Bekleyin Yönlendiriyorum.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                </script>
                <?php
                header("Refresh: 2; url=index.php");
            }
            else
            {
                ?>
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hata',
                        text:'Kullanıcı Adınız veya Şifreniz Yanlış.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                </script>
                <?php
                header("Refresh: 2; url=giris.php");
            }
        }
        else
        {
        ?>
        <script>
          Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hata',
                        text:'Lütfen Boş Alan Bırakmayınız.',
                        showConfirmButton: false,
                        timer: 2000
                    })
        </script>
        <?php
        header("Refresh: 2; url=giris.php");
        }
  }
?>

    
  </body>
</html>
