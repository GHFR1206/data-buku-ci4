<?= $this->extend('layout/template') ?>

<?= $this->section('breadcrumb') ?>
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/buku">Books</a></li>
    <li class="breadcrumb-item"><a href="/buku/detail/<?= $buku['slug']; ?>"><?= $buku['slug']; ?></a></li>
<?= $this->endsection() ?>

<?= $this->section('content-title') ?>
      <div class="row">
          <div class="col">
              <h2><b>Book's Details</b></h2>
          </div>
      </div>
<?= $this->endSection() ?>

<?= $this->section('content-main') ?>
<div class="container">
    <div class="row">
        <div class="col">

  <div class="card ml-3 mb-3 mt-5" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="/img/<?= $buku['sampul']; ?>" class="img-fluid rounded-start" alt="">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h2 class="card-title mb-3"><b><?= $buku['judul']; ?></b></h2>
          <p class="card-text"><b>Class : </b><?= $buku['kelas']; ?></p>
          <p class="card-text"><b>Author : </b><?= $buku['penulis']; ?></p>
          <p class="card-text"><b>Publisher : </b><?= $buku['penerbit']; ?></p>
          
          <a href="/buku/edit/<?= $buku['slug'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
          <form action="/buku/<?= $buku['id'] ?>" method="post" class="d-inline">
          <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa-solid fa-trash"></i> Delete</button>
          </form>        
          <br><br>
          <a href="/buku" class="mt-5"><i class="fa-solid fa-arrow-left"></i>  Back to Book's List</a>
      </div>
      </div>
    </div>
</div>

        </div>
    </div>
</div>

<?= $this->endsection() ?>