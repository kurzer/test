<?php
include ('dataconnect.php');
include('list_function.php');

if(isset($_POST['del']) and $_POST['name'] != "" and $_POST['grund'] != "")
  {
    $name = $_POST['name'];
    $auftragsnr = $_POST['auftragsnr'];
    $dellabel = $_POST['dellabel'];
    $grund = $_POST['grund'];
    $kundennr = $_POST['kundennr'];
    $timestamp = time();
    $datumnew = date("d.m.Y",$timestamp);
    $datumnew1 = date_german2mysql($datumnew);
    mysql_query("insert into labelhistorie (name, auftragsnr, grund, labelnr, datum) values ('$name', $auftragsnr, '$grund', $dellabel, '$datumnew1')");
    mysql_query("DELETE FROM repacklabel WHERE labelnr = $dellabel");
    
    header("Location: labelverwaltung.php?kundennr=$kundennr&auftragsnr=$auftragsnr&fromdel=1");
  }
 
if(isset($_POST['abb']))
  {
    $auftragsnr = $_POST['auftragsnr'];
    $kundennr = $_POST['kundennr'];
    
    header("Location: labelverwaltung.php?kundennr=$kundennr&auftragsnr=$auftragsnr&fromdel=1");
  }  
  
if (@$_GET['new'] != 1)
  {
    if(isset($_POST['del']) and $_POST['name'] == "" or $_POST['grund'] == "")
      {
        $error = "Mitarbeiter und Grund sind Pflichtfelder<br>";
        $auftragsnr = $_POST['auftragsnr'];
        $dellabel = $_POST['dellabel'];
        $kundennr = $_POST['kundennr'];
      }
  }

if (@$_GET['new'] == 1)
  {
    @$dellabel = $_GET['dellabel'];
    @$kundennr = $_GET['kundennr'];
    @$auftragsnr = $_GET['auftragsnr'];
  }

?>
<html>
<head>
<title>Repack</title>
<style type="text/css">
<!--
body {font:50px Tahoma; color:#000;}
 body {
 margin: 0px;
 padding: 0px;
}
table.myTable { border-collapse:collapse; }
table.myTable td, table.myTable th { border:1px solid black;padding:2px; } 
</style>
</head>

<body>
<table align=center>
  <td><img src='logo_blau.gif'></td><td><img src='banner_Hamburg.jpg'></td><td><img src='logo_blau.gif'></td>
</table>
<hr>
<form action="labeldel.php" method="post" onkeypress="return checkEnter(event)"><center><?php echo @$error; ?></center>
<input type="hidden" name="dellabel" value="<?php echo $dellabel; ?>"/>
<input type="hidden" name="auftragsnr" value="<?php echo $auftragsnr; ?>"/>
<input type="hidden" name="kundennr" value="<?php echo $kundennr; ?>"/>
  <table align="center" style="border: 1px solid #000000">
    <td style="border: 1px solid #000000">
      <table align="center">
        <td style="border:1px solid #FFFFFF;"><b>Mitarbeiter</b></td>
        <td style="border:1px solid #FFFFFF;"><input type='text' name='name' maxlength="30" size="30">
      </table>
    </td>
  </table>
  <table align="center" style="border: 1px solid #000000">
    <td style="border: 1px solid #000000">
      <table align="center">
        <td><b>Löschgrund</b></td><tr>
        <td><textarea name="grund" cols="55" rows="7"></textarea></td><tr>
        <td align=center><input type="submit" name="del" value="Label löschen"><input type="submit" name="abb" value="Abbrechen"></td>
      </table>
    </td>
  </table>
</form>
</body>
</html>