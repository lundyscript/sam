<?php
include 'head.php';
include 'navbar.php';
?>
</br>
<main role="main" class="container col-md-6">
<h4 class="display-4 text-center" style="font-size: 26pt">BIAYA PRODUKSI</h4>
<hr />
<center>
<table class="table table-sm table-hover">
  <thead>
    <tr>
      <th scope="col">LINK</th>
      <th scope="col">No</th>
      <th scope="col">Tipe Barang</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Harga (Rp)</th>
    </tr>
  </thead>
  <tbody>
<?php
  $arraynomer = array();
  $query = mysql_query("SELECT *FROM biaya ORDER BY no") or die ('Error!!'.mysql_error());
  while ($row = mysql_fetch_array ($query)) {
    array_push($arraynomer, $row['no']);
  }
  for($i=0; $i<count($arraynomer); $i++){
    $query = mysql_query("SELECT *FROM biaya WHERE no='$arraynomer[$i]'") or die ('Error!!'.mysql_error());
    $row = mysql_fetch_array ($query);
    extract($row);
    echo "
      <tr>
        <td><a href='proe.php?no=$no'><img src='../img/doc.png' width='20'/></a></td>
        <td>".$no."</td>
        <td>".$tipe."</td>
        <td>".$nama."</td>
        <td align='right'>".number_format($harga,0,",",".")."</td>
      </tr>
    ";
  }
?>
</tbody>
</table>
</center>
</main>
<?php
include 'foot.php';
//biaya produksi pertgl 30.08 : +35 *Kardus,Cup,Sedotan,Botol330ml
//Harga Baru : 99/Cup,  
?>
