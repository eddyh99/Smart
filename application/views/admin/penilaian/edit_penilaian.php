<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>guru/penilaian" class="btn btn-outline-danger d-flex align-items-center">
                <i class="ti ti-chevron-left fs-5 me-2"></i>
                <span>
                    Kembali
                </span>
            </a>
        </div>
    </div>
    <!--  Row Daftar User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <?php if (@isset($_SESSION["error"])) { ?>
                        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="notif-login f-poppins"><?= $_SESSION["error"] ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <h5 class="card-title fw-semibold mb-4 text-decoration-underline">Edit Penilaian</h5>
                    <form action="<?= base_url()?>guru/edit_penilaianproses" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="guru" class="form-label">Pilih Guru</label>
                            <select name="guru" id="guru" class="form-select">
                                <?php foreach($allguru as $gr){?>
                                    <option value="<?= $gr['id']?>" <?= ($gr['id'] == $guru) ? 'selected': '' ?>><?= $gr['nama']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kehadiran" class="form-label">Kehadiran</label>
                            <select name="kehadiran" id="kehadiran" class="form-select">
                                <?php 
                                    foreach($allkriteria as $kr){
                                        if($kr['kriteria'] == 'Absensi'){
                                ?>
                                    <option value="<?= $kr['id']?>"><?= $kr['range']?> | Bobot <?= $kr['skala']?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keaktifan" class="form-label">Keaktifan</label>
                            <select name="keaktifan" id="keaktifan" class="form-select">
                                <?php 
                                    foreach($allkriteria as $kr){
                                        if($kr['kriteria'] == 'Keaktifan'){
                                ?>
                                    <option value="<?= $kr['id']?>"><?= $kr['range']?> | Bobot <?= $kr['skala']?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rombel" class="form-label">Rombel</label>
                            <select name="rombel" id="rombel" class="form-select">
                                <?php 
                                    foreach($allkriteria as $kr){
                                        if($kr['kriteria'] == 'Rombel'){
                                ?>
                                    <option value="<?= $kr['id']?>"><?= $kr['range']?> | Bobot <?= $kr['skala']?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tl" class="form-label">Tugas Lebih</label>
                            <select name="tl" id="tl" class="form-select">
                                <?php 
                                    foreach($allkriteria as $kr){
                                        if($kr['kriteria'] == 'Tugas Lebih'){
                                ?>
                                    <option value="<?= $kr['id']?>"><?= $kr['range']?> | Bobot <?= $kr['skala']?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger mt-3">
                            <i class="ti ti-plus fs-5 me-1"></i>
                            Edit Penilaian
                        </button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

