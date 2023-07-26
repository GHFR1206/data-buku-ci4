<?= $this->extend('layout/template') ?>
<?= $this->section('content-title') ?>
<div class="row">
    <div class="col">
        <h2><b>Edit Data Kendaraan</b></h2>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content-main') ?>
<div class="container">
<div class="row">
    <div class="col">

        <form action="/parkir/update/<?= $parkir['id'] ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="kode_unik" value="<?= $parkir['kode_unik'] ?>">
            <input type="hidden" name="waktu_masuk" value="<?= $parkir['waktu_masuk'] ?>">
            <div class="form-group row mt-5">
                <label for="no_kendaraan" class="col-sm-2">Nomor Kendaraan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('no_kendaraan')) ? 'is-invalid' : ''; ?>" id="no_kendaraan" name="no_kendaraan" value="<?= (old('no_kendaraan') ? old('no_kendaraan') : $parkir['no_kendaraan']) ?>">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('no_kendaraan')) ? $validation->getError('no_kendaraan') : ''; ?>
                </div>
                </div>
            </div><div class="form-group row">
            <label for="tipe" class="col-sm-2">Tipe</label>
            <div class="col-sm-10">
            <select class="custom-select <?= ($validation->hasError('tipe')) ? 'is-invalid' : ''; ?>" id="tipe" name="tipe" aria-label="">
                        <option selected>Pilih..</option>
                        <option value="Motor">Motor</option>
                        <option value="Mobil">Mobil</option>
                        <option value="Truk/Lainnya">Truk/lainnya</option>
                    </select>
            <div class="invalid-feedback">
                <?= ($validation->hasError('tipe')) ? $validation->getError('tipe') : ''; ?>
            </div>
            </div>
        </div>
            <div class="form-group row">
                <label for="penulis" class="col-sm-2">Penulis</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= (old('penulis') ? old('penulis') : $parkir['penulis']) ?>">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('penulis')) ? $validation->getError('penulis') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="penerbit" class="col-sm-2">Penerbit</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit') ? old('penerbit') : $parkir['penerbit']) ?>"
                <div class="invalid-feedback">
                    <?= ($validation->hasError('penerbit')) ? $validation->getError('penerbit') : ''; ?>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="sampul" class="col-sm-2">Sampul</label>
                <div class="col-sm-2">
                    <img src="/img/<?= $parkir['sampul'] ?>" alt="" class="img-thumbnail img-preview">
                </div>
                <div class="col-sm-8">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="sampul" name="sampul" onchange="previewImage()">
                    <label class="custom-file-label" for="sampul"><?= $parkir['sampul'] ?></label>
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