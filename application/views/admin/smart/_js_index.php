<script>
    $(document).ready( function () {
        $('#table_list_alternatif_kriteria').DataTable({
            "scrollX": true,
            "ordering": false,
			"ajax": {
				"url": "<?=base_url()?>smart/list_alternatifkritera",
				"type": "POST",
				"dataSrc":function (data){
					return data;							
				}
			},
			"columns": [
				{ data: 'ProductName' },
				{ data: 'ModalNilai' },
				{ data: 'PeminatNilai' },
				{ data: 'LabaNilai' },
				{ data: 'HargaJualNilai' },
				{ data: 'KualitasNilai' },
			],
        });


        $('#table_list_nilaiutility').DataTable({
            "scrollX": true,
            "ordering": false,
			"ajax": {
				"url": "<?=base_url()?>smart/list_nilaiutility",
				"type": "POST",
				"dataSrc":function (data){
					return data;							
				}
			},
			"columns": [
				{ data: 'ProductName' },
				{ data: 'K1' },
				{ data: 'K2' },
				{ data: 'K3' },
				{ data: 'K4' },
				{ data: 'K5' },
			],
        });

        $('#table_list_nilaiakhirnormalisasi').DataTable({
            "scrollX": true,
            "ordering": false,
			"ajax": {
				"url": "<?=base_url()?>smart/list_nilaiakhirnormalisasi",
				"type": "POST",
				"dataSrc":function (data){
					return data;							
				}
			},
			"columns": [
				{ data: 'ProductName' },
				{ data: 'K1' },
				{ data: 'K2' },
				{ data: 'K3' },
				{ data: 'K4' },
				{ data: 'K5' },
				{ data: 'NormalizedScore' },
			],
        });

        $('#table_list_perangkingan').DataTable({
            "scrollX": true,
            "ordering": false,
			"ajax": {
				"url": "<?=base_url()?>smart/perangkingan",
				"type": "POST",
				"dataSrc":function (data){
					return data;							
				}
			},
			"columns": [
				{ data: 'ProductName' },
				{ data: 'NormalizedScore' },
				{ data: 'Rank' },
			],
        });


    } );


</script>