<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>kriteria/bahan" class="btn btn-outline-danger d-flex align-items-center">
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
                    <h5 class="card-title fw-semibold mb-4 text-decoration-underline">Tambah Jenis Produk</h5>
                    <form action="<?= base_url()?>jenis/tambahjenis_proses" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="range" class="form-label">Nama Jenis Produk</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukan Nama Jenis Produk..." required>
                        </div>
                        <button type="submit" class="btn btn-danger mt-3">
                            <i class="ti ti-plus fs-5 me-1"></i>
                            Tambah Jenis Produk
                        </button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

