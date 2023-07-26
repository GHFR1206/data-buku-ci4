<?= $this->extend('layout/template') ?>
<?= $this->section('content-title') ?>
<div class="row">
    <div class="col">
        <h2><b>Book's Edit Form</b></h2>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content-main') ?>
<div class="container">
<div class="row">
    <div class="col">

        <form action="/buku/update/<?= $buku['id'] ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="slug" value="<?= $buku['slug'] ?>">
            <input type="hidden" name="sampulLama" value="<?= $buku['sampul'] ?>">
            <div class="form-group row mt-5">
                <label for="judul" class="col-sm-2">Judul Buku</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= (old('judul') ? old('judul') : $buku['judul']) ?>">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('judul')) ? $validation->getError('judul') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="kelas" class="col-sm-2">Kelas</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" value="<?= (old('kelas') ? old('kelas') : $buku['kelas']) ?>">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('kelas')) ? $validation->getError('kelas') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="penulis" class="col-sm-2">Penulis</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= (old('penulis') ? old('penulis') : $buku['penulis']) ?>">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('penulis')) ? $validation->getError('penulis') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="penerbit" class="col-sm-2">Penerbit</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit') ? old('penerbit') : $buku['penerbit']) ?>"
                <div class="invalid-feedback">
                    <?= ($validation->hasError('penerbit')) ? $validation->getError('penerbit') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="sampul" class="col-sm-2">Sampul</label>
                <div class="col-sm-2">
                    <img src="/img/<?= $buku['sampul'] ?>" alt="" class="img-thumbnail img-preview">
                </div>
                <div class="col-sm-8">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="sampul" name="sampul" onchange="previewImage()">
                    <label class="custom-file-label" for="sampul"><?= $buku['sampul'] ?></label>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->hasError('sampul')) ? $validation->getError('sampul') : ''; ?>
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Kirim</button>
        </form>
    </div>
</div>
</div>

<?= $this->endsection('content') ?>