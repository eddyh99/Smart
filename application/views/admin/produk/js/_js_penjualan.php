
<script type="text/javascript">

    $(document).ready( function () {
        $('#table_list_penjualan').DataTable({
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>produk/list_allpenjualan",
				"type": "POST",
				"dataSrc":function (data){
					console.log(data);
					return data;							
				}
			},
			"columns": [
				{ data: 'kode_produk' },
				{ data: 'namaproduk' },
				{ data: 'tanggal' },
				{ data: 'total' },
			]
        });
    } );

</script>