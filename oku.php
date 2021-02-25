<?php
require_once('baglan.php');
$GelenId    =   filtre($_GET['id']);
$HitGuncelle = $VeriTabaniBaglantisi->prepare("UPDATE makaleler SET gosterimsayisi=gosterimsayisi+1 WHERE id = ?");
$HitGuncelle->execute([$GelenId]);
?>

<!doctype html>
<html lang="tr-Tr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-language" content="tr">
    <meta charset="utf-8">
    <title>Örnekler</title>
</head>

<body>
    <table width="1000" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr height="30">
            <td align="left"><b>Görüntülenme ve Hit Uygulaması</b></td>
            <td align="right"><a href="index.php" style="text-decoration: none; color:black;">Anasayfa</a></td>
        </tr>

    <?php
        $Sorgu = $VeriTabaniBaglantisi->prepare("SELECT * FROM makaleler WHERE id = ?");
        $Sorgu->execute([$GelenId]);
        $KayitSayisi    =   $Sorgu->rowCount();
        $Kayitlar       =   $Sorgu->fetch(PDO::FETCH_ASSOC);

        if ($KayitSayisi > 0) {
    ?>
            <tr height="30">
                <td align="left" colspan="2"><h3><?php echo $Kayitlar['makalebasligi']; ?></h3></td>
            </tr>
            <tr height="30">
                <td align="left" colspan="2"><?php echo $Kayitlar['makaleicerigi']; ?></td>
            </tr>
              <tr height="30">
                <td align="left" colspan="2">Görüntülenme Sayısı: <?php echo $Kayitlar['gosterimsayisi']; ?></td>
            </tr>
       <?php
        }else{
            header('Location:index.php');
        }
        ?>
    </table>
</body>

</html>
<?php
$VeriTabaniBaglantisi   =   null;
?>