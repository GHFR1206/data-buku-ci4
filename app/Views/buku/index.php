<?= $this->extend('layout/template') ?>

<!-- Breadcrumb -->
<?= $this->section('breadcrumb') ?>
    <li class="breadcrumb-item"><a href="/">Dasbor</a></li>
    <li class="breadcrumb-item"><a class="text-secondary">Buku</a></li>
<?= $this->endsection() ?>

<?= $this->section('content-title') ?>
        <h2><b>Daftar Buku</b></h2>
<?= $this->endsection() ?>

<?= $this->section('content-main') ?>
<div class="container">
    <div class="row">
        <div class="col">

        <a href="/buku/create" class="btn btn-primary mt-4 mb-3">Tambah Data Buku</a>

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
        
        <table class="table mt-3">
            <thead>
                <tr>
                    <b>
                    <th scope="col">No</th>
                    <th scope="col">Sampul</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Aksi</th>
                    </b>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + (5 * ($currentPage - 1)) ;  ?>
                <?php foreach($buku as $b) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><img src="/img/<?= $b['sampul']; ?>" alt="" srcset="" class="sampul"></td>
                    <td><?= $b['judul']; ?></td>
                    <td>
                        <a href="/buku/detail/<?= $b['slug']; ?>" class="btn btn-success"><i class="fa-sharp fa-solid fa-circle-info"></i> Details</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links('buku','bs_pagination') ?>
        </div>
    </div>
</div>


<?= $this->endsection() ?>