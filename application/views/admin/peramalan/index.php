<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <form action="<?=base_url()?>peramalan" method="post">
                        <div class="row">
                            <div class="col-3">
                                Periode
                            </div>
                            <div class="col-9 d-flex">
                                <div class="pe-3">
                                    <input type="month" id="awal" class="form-control" name="awal" min="2021-01" value="2021-01" />
                                </div>
                                <div class="px-3">
                                    <input type="month" id="akhir" class="form-control" name="akhir" min="2021-06" value="2021-06" />
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-3">
                                Produk
                            </div>
                            <div class="col-5">
                                <select name="produk" class="form-select">
                                    <?php foreach ($produk as $dt){?>
                                        <option value="<?=$dt["id"]?>"><?=$dt["namaproduk"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                Dasar Periode
                            </div>
                            <div class="col-5">
                                <select id="periode" class="form-select" name="dasar">
                                    <option value="3">Periode 3</option>
                                    <option value="4">Periode 4</option>
                                    <option value="5">Periode 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-3">
                                Bobot
                            </div>
                            <div class="col-9 d-flex wrap-bobot">
                                <div class="pe-3">
                                    <input class="form-control" type="number" step="0.1" name="bobot1" value="0.1">
                                </div>
                                <div class="px-3">
                                    <input class="form-control" type="number" step="0.1" name="bobot2" value="0.2">
                                </div>
                                <div class="px-3">
                                    <input class="form-control" type="number" step="0.1" name="bobot3" value="0.3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-danger">Hitung</button>
                            </div>
                        </div>
                
                    </form>
                </div >
            </div >
        </div >
    </div >

    <!-- Hasil Peramalan -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4 text-decoration-underline">Hasil Peramalan</h5>
                    <table id="table_list_produk" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Periode</th>
                                <th>Jumlah</th>
                                <th>Peramalan</th>
                                <th>Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($result)){
                                    foreach($result as $dt){
                            ?>
                                <tr>
                                    <td>
                                        <?= $dt['bulan']?>
                                    </td>
                                    <td>
                                        <?= $dt['jumlah']?>
                                    </td>
                                    <td>
                                        <?= $dt['peramalan']?>
                                    </td>
                                    <td>
                                        <?= $dt['error']?>
                                    </td>
                                </tr>
                            <?php 
                                    }
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Periode</th>
                                <th>Jumlah</th>
                                <th>Peramalan</th>
                                <th>Error</th>
                            </tr>
                        </tfoot>
                    </table>
                    <?php if(!empty($result)){?>
                        <div class="mt-5">
                            <h5>MAPE : <?= $mape?> %</h5>
                        </div>
                        <div class="mt-3">
                            <h5>MSE : <?= $mse?></h5>
                        </div>
                        <div class="mt-3">
                            <h5>MAD : <?= $mad?></h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>