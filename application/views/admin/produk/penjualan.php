<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>produk/list_penjualan" class="btn btn-outline-danger d-flex align-items-center">
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
                    <?php } if (@isset($_SESSION["success"])){?>
                        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                            <span class="notif-login f-poppins"><?= $_SESSION["success"] ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <h5 class="card-title fw-semibold mb-4 text-decoration-underline">PENJUALAN</h5>
                    <form action="<?= base_url()?>produk/penjualan_proses" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="produk" class="form-label">Produk</label>
                                <select name="produk" class="form-select">
                                    <?php foreach ($produk as $dt){?>
                                        <option value="<?=$dt["id"]?>"><?=$dt["namaproduk"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="month" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m')?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="total" class="form-label">Total</label>
                                <input type="text" class="form-control" id="total" name="total" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger mt-3">
                            <i class="ti ti-plus fs-5 me-1"></i>
                            Tambah Penjualan
                        </button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->
