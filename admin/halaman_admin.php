<html>
<head>
    <title>APOTEK ONLINE</title>
    <link rel="stylesheet" type="text/css" href="../src/style.css">
</head>
<body>

<?php
    session_start();
    
    if($_SESSION['level']==""){
        header("location:index.php?pesan=gagal");
    }
?>

<br/><br/>


<header>
    <h1 class="judul">SISTEM INFORMASI APOTEK</h1>
</header>



<div class="wrap">
    <nav class="menu">
        <?php include "menu.php"; ?>
    </nav>



<aside class="sidebar">
    <div class="widget">
        <h2>Selamat Datang, <?php echo $_SESSION['username']; ?></h2>
        <p>Selamat datang di aplikasi sistem informasi apotek</p>
    </div>
</aside>



<div class="blog">
    <div class="conteudo">
        <?php include "buka_file.php"; ?>
    </div>
</div>


</div>

</body>
</html>