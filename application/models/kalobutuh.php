<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Data Buku</h1>
<h3>
    <?php 
        if ($this->session->flashdata('sukses') == TRUE )
        {
            echo $this->session->flashdata('sukses');
        }
    ?>
</h3>
<form action="<?php echo base_url('Buku/search/')?>" method="get">
<input type="search" name="keyword">
<input type="submit" value="cari">
</form> <br>
<a href="<?php echo base_url('Buku/tambah')?>">[Tambah Data]</a> <br><br>
    <table border = '1'>
    <tr>
     <th>Judul</th>
     <th>Penulis</th>
     <th>Tahun Terbit</th>
     <th>Harga</th>
     <th colspan = "2">Pilihan</th>
    </tr>
    <?php
        foreach ($buku as $row) 
        {?>
            <tr>
                <td> <?php echo $row['judul']; ?></td>
                <td> <?php echo $row['penulis']; ?></td>
                <td> <?php echo $row['tahun_terbit']; ?></td>
                <td> <?php echo $row['harga']; ?></td>
                <td><a href="<?php echo base_url('Buku/hapus/').$row['id_buku'];?>" onclick = "return confirm('Anda yakin ingin menghapus?')">Hapus</a></td>
                <td><a href="<?php echo base_url('Buku/edit/').$row['id_buku'];?>">Edit</a></td>
            </tr>
        <?php
        } 
    ?>
    </table>
</body>
</html>