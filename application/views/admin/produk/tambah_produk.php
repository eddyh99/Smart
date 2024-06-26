<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>produk" class="btn btn-outline-danger d-flex align-items-center">
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
                    <h5 class="card-title fw-semibold mb-4 text-decoration-underline">Tambahkan Produk</h5>
                    <form action="<?= base_url()?>produk/tambah_proses" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="produk" name="produk" placeholder="Masukan produk..." required>
                        </div>
                        <div class="mb-3">
                            <label for="produk" class="form-label">Jenis Produk</label>
                            <select name="jenisproduk" id="jenisproduk" class="form-select">
                                <?php foreach($jenisproduk as $jp){?>
                                    <option value="<?= $jp['id']?>"><?= $jp['jenis']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="produk" class="form-label">Jenis Bahan</label>
                            <select name="jenisbahan" id="jenisbahan" class="form-select">
                                <?php foreach($jenisbahan as $jb){?>
                                    <option value="<?= $jb['id']?>"><?= $jb['bahan']?> | <?= $jb['kualitas']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="modal" class="form-label">Modal</label>
                            <input type="number" class="form-control" id="modal" name="modal" placeholder="Masukan Modal..." required>
                        </div>
                        <div class="mb-3">
                            <label for="peminat" class="form-label">Peminat (%)</label>
                            <input type="number" class="form-control" id="peminat" name="peminat" placeholder="Masukan peminat..." required>
                        </div>
                        <div class="mb-3">
                            <label for="jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="jual" name="jual" placeholder="Masukan Harga Jual..." required>
                        </div>
                        <div class="mb-3">
                            <label for="laba" class="form-label">Laba</label>
                            <input type="number" class="form-control" id="laba" name="laba" placeholder="Masukan Laba..." required>
                        </div>
                        <button type="submit" class="btn btn-danger mt-3">
                            <i class="ti ti-plus fs-5 me-1"></i>
                            Tambah Produk
                        </button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

