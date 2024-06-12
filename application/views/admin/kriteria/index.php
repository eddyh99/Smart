<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row List User-->
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
                    <h5 class="card-title fw-semibold mb-4 text-decoration-underline">Bobot Dasar</h5>
                    <form action="<?= base_url()?>kriteria/proses_editkriteria" method="POST">
                        <div class="mb-3">
                            <label for="absensi" class="form-label">Modal</label>
                            <input type="number" class="form-control" value="<?= $bobot[0]['bobot']?>" id="modal" name="modal" placeholder="Masukan Modal ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="keaktifan" class="form-label">Peminat</label>
                            <input type="number" class="form-control" value="<?= $bobot[1]['bobot']?>" id="peminat" name="peminat" placeholder="Masukan Peminat ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="rombel" class="form-label">Laba</label>
                            <input type="number" class="form-control" value="<?= $bobot[2]['bobot']?>" id="laba" name="laba" placeholder="Masukan Laba ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="tl" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" value="<?= $bobot[3]['bobot']?>" id="hargajual" name="hargajual" placeholder="Masukan Bobot Harga Jual ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="tl" class="form-label">Kualitas</label>
                            <input type="number" class="form-control" value="<?= $bobot[4]['bobot']?>" id="kualitas" name="kualitas" placeholder="Masukan Bobot Kualitas ..." required>
                        </div>
                        <button type="submit" class="btn btn-danger mt-3">
                            <i class="ti ti-plus fs-5 me-1"></i>
                            Edit Kriteria
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4 text-decoration-underline">Detail Kriteria</h5>
                    <table id="table_list_kriteria" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Detail</th>
                                <th>Nilai Min</th>
                                <th>Nilai Max</th>
                                <th>Bobot</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kriteria</th>
                                <th>Detail</th>
                                <th>Nilai Min</th>
                                <th>Nilai Max</th>
                                <th>Bobot</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT END -->

<!-- SWEET ALERT START -->
<?php if(isset($_SESSION["success"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                html: '<?= $_SESSION['success'] ?>',
                position: 'top',
                timer: 3000,
                showCloseButton: true,
                showConfirmButton: false,
                icon: 'success',
                timer: 2000,
                timerProgressBar: true,
            });
        }, 100);
    </script>
<?php } ?>
<!-- SWEET ALERT END -->


