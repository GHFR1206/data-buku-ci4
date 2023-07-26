<?= $this->extend('layout/template') ?>

<!-- Breadcrumb -->
<?= $this->section('breadcrumb') ?>
    <li class="breadcrumb-item"><a href="/">Dasbor</a></li>
    <li class="breadcrumb-item"><a class="text-secondary">Parkir</a></li>
<?= $this->endsection() ?>

<?= $this->section('content-title') ?>
        <h2><b>Daftar Parkir Kendaraan</b></h2>
<?= $this->endsection() ?>

<?= $this->section('content-main') ?>
<div class="container">
    <div class="row">
        <div class="col">

        <a href="/parkir/create" class="btn btn-primary mt-4 mb-3">Tambah Data Kendaraan</a>

        <?php if (session()->getFlashdata('tambah')) :  ?>
            <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('tambah') ?>
        </div>
        <?php endif;?>

        <?php if (session()->getFlashdata('hapus')) :  ?>
            <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('hapus') ?>
        </div>
        <?php endif;?>

        <?php if (session()->getFlashdata('ubah')) :  ?>
            <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('ubah') ?>
        </div>
        <?php endif;?>
        
        <p class="text-right"> Kendaraan Aktif = <b><?= $status['status']; ?></b></p>
        <table class="table mt-3">
            <thead>
                <tr>
                    <b>
                    <th scope="col">No</th>
                    <th scope="col">No Kendaraan</th>
                    <th scope="col">Merek</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Waktu Masuk</th>
                    <th scope="col">Status</th>
                    <th scope="col">Waktu Keluar</th>
                    <th scope="col">Aksi</th>
                    </b>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + (5 * ($currentPage - 1)) ;  ?>
                <?php foreach($parkir as $b) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $b['no_kendaraan']; ?></td>
                    <td><?= $b['merk']; ?></td>
                    <td><?= $b['tipe']; ?></td>
                    <td><?= $b['waktu_masuk']; ?></td>
                    <td><?= $b['status']; ?></td>
                    <td><?= $b['waktu_keluar']; ?></td>
                    <td>
                        <a href="/parkir/detail/<?= $b['no_kendaraan']; ?>" class="btn btn-success"><i class="fa-sharp fa-solid fa-circle-info"></i> Details</a>
                        <?php if ($b['status'] == "Aktif") : ?>
                            <form action="/parkir/keluar/<?= $b['id'] ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
                            </form>        
                        <?php endif; ?>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links('parkir','bs_pagination') ?>
        </div>
    </div>
</div>


<?= $this->endsection() ?>