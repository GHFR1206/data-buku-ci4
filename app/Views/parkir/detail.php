<?= $this->extend('layout/template') ?>

<?= $this->section('breadcrumb') ?>
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/buku">Books</a></li>
<?= $this->endsection() ?>

<?= $this->section('content-title') ?>
      <div class="row">
          <div class="col">
              <h2><b>Detail Kendaraan Parkir</b></h2>
          </div>
      </div>
<?= $this->endSection() ?>

<?= $this->section('content-main') ?>
<div class="container">
    <div class="row">
        <div class="col">

  <div class="card ml-3 mb-3 mt-5" style="max-width: 540px;">
    <div class="row g-0">
    <div class="col-md-9">
        <img src="<?= base_url(); ?>/img/<?= $parkir['gambar']; ?>" class="img-fluid rounded-start mx-auto d-block" alt="">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h2 class="card-title mb-3"><b><?= $parkir['no_kendaraan']; ?></b></h2>
          <p class="card-text"><b>Kode Unik : </b><?= $parkir['kode_unik']; ?></p>
          <p class="card-text"><b>Tipe : </b><?= $parkir['tipe']; ?></p>
          <p class="card-text"><b>Merek : </b><?= $parkir['merk']; ?></p>
          <p class="card-text"><b>Waktu Masuk : </b><?= $parkir['waktu_masuk']; ?></p>
          <p class="card-text"><b>Waktu Keluar : </b><?= $parkir['waktu_keluar']; ?></p>
          <br><br>
          <a href="/parkir" class="mt-5"><i class="fa-solid fa-arrow-left"></i>  Kembali ke daftar kendaraan</a>
      </div>
      </div>
    </div>
</div>

        </div>
    </div>
</div>

<?= $this->endsection() ?>