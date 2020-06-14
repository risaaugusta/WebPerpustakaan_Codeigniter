<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
        <h1>Data Buku</h1>
        <form action="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Masukkan pencarian..." name="keyword">
        <div class="input-group-append">
        <button class="btn btn-primary" type="button" id="button-addon2">Cari</button>
        </div>
        </form>
       
        </div>
        <a href="<?= base_url('Buku/tambah')?>" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
        <?php 
            if ($this->session->flashdata('sukses')==TRUE) {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                 Data buku <strong>berhasil</strong> <?= $this->session->flashdata('sukses'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
            }
        ?>
    
    <ul class="list-group">
    <?php foreach ($buku as $row) { ?>
        <li class="list-group-item"><?= $row['judul']?>
            <a href="<?= base_url('Buku/hapus/') . $row['id_buku']?>" class="badge badge-danger float-right">Hapus</a>
            <a href="<?= base_url('Buku/edit/') . $row['id_buku']?>" class="badge badge-warning float-right">Edit</a>
            <a href="<?= base_url('Buku/detail/') . $row['id_buku']?>" class="badge badge-success float-right">Detail</a>
        </li>
        
    <?php 
    } ?>
    </ul>
        </div>
    </div>
</div>