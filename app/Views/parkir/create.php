<?= $this->extend('layout/template') ?>
<?= $this->section('content-title') ?>

<div class="row">
    <div class="col">
        <h2><b>Masukkan Kendaraan Baru</b></h2>
    </div>
</div>

<?= $this->endsection() ?>

<?= $this->section('content-main') ?>

<div class="row">
    <div class="ml-5 col-sm-10">
        <form action="/parkir/save" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="status" id="status" value="Aktif">
            <input type="hidden" name="waktu_keluar" id="waktu_keluar" value="null">
            <div class="form-group row mt-5">
                <label for="no_kendaraan" class="col-sm-2">Nomor Kendaraan</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('no_kendaraan')) ? 'is-invalid' : ''; ?>" id="no_kendaraan" name="no_kendaraan" value="<?= old('no_kendaraan') ?>" placeholder="Masukkan nomor kendaraan / plat nomor" autofocus autocomplete="off">
                <div class="invalid-feedback">
                    <?= ($validation->hasError('no_kendaraan')) ? $validation->getError('no_kendaraan') : ''; ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
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
                <label for="merk" class="col-sm-2">Merk</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input class="custom-select <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" list="option" id="merk" name="merk" placeholder="Isi sendiri..">
                            <datalist id="option">
                                <option selected>Pilih..</option>
                                <option value="Honda">Honda</option>
                                <option value="Yamaha">Yamaha</option>
                                <option value="Kawasaki">Kawasaki</option>
                                <option value="Benelli">Benelli</option>
                                <option value="Daihatsu">Daihatsu</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Mazda">Mazda</option>
                                <option value="Nissan">Nissan</option>
                                <option value="Mitsubishi">Mitsubishi</option>
                                <option value="Datsun">Datsun</option>
                                <option value="Jeep">Jeep</option>
                                <option value="Suzuki">Suzuki</option>
                            </datalist>    
                        </input>
                        <div class="invalid-feedback">
                            <?= ($validation->hasError('merk')) ? $validation->getError('merk') : ''; ?>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Kirim</button>
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

    $(document).ready(function(){
        $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        todayHighlight:true,
        defaultViewDate:true,
        toggleActive:true,
        startDate: '0d'
        });
    })

      
    </script>
<?= $this->endSection() ?>