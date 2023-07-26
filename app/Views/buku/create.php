<?= $this->extend('layout/template') ?>
<?= $this->section('content-title') ?>

<div class="row">
    <div class="col">
        <h2><b>Tambah Data Buku</b></h2>
    </div>
</div>

<?= $this->endsection() ?>

<?= $this->section('content-main') ?>

<div class="row">
    <div class="ml-5 col-sm-10">
        <form action="/buku/save" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group row mt-5">
                <label for="judul" class="col-sm-2">Judul Buku</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul') ?>" autofocus autocomplete="off">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('judul')) ? $validation->getError('judul') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="kelas" class="col-sm-2">Kelas</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" value="<?= old('kelas') ?>" autocomplete="off">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('kelas')) ? $validation->getError('kelas') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="penulis" class="col-sm-2">Penulis</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis') ?>">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('penulis')) ? $validation->getError('penulis') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="penerbit" class="col-sm-2">Penerbit</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit') ?>">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('penerbit')) ? $validation->getError('penerbit') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="sampul" class="col-sm-2">Sampul</label>
                <div class="col-sm-2">
                    <img src="/img/default.jpg" alt="" class="img-thumbnail img-preview">
                </div>
                <div class="col-sm-8">
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" value="<?= old('sampul') ?>" onchange="previewImage()">
                    <label class="custom-file-label" for="sampul">Pilih sampul</label>
                    <div class="invalid-feedback">
                        <?= ($validation->hasError('sampul')) ? $validation->getError('sampul') : ''; ?>
                    </div>
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Send</button>
        </form>
    </div>
</div>

<?= $this->endsection() ?>

<?= $this->section('userScript') ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>

    function previewImage() {
      const sampul = document.querySelector('#sampul');
      const sampulLabel = document.querySelector('.custom-file-label');
      const imgPreview = document.querySelector('.img-preview');

      sampulLabel.textContent = sampul.files[0].name;

      const fileSampul = new FileReader();
      fileSampul.readAsDataURL(sampul.files[0]);

      fileSampul.onload = function(e) {
        imgPreview.src = e.target.result;
      }
    }

      
    </script>
<?= $this->endSection() ?>