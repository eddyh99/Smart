<style>
	.th-role {
		width: 500px;
	}
</style>

<script type="text/javascript">

    $(document).ready( function () {
        $('#table_list_produk').DataTable({
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>kriteria/getAllBahan",
				"type": "POST",
				"dataSrc":function (data){
					console.log(data);
					return data;							
				}
			},
			"columns": [
				{ data: 'id' },
				{ data: 'bahan' },
				{ data: 'kualitas' },
			],
            "aoColumnDefs": [{	
				"aTargets": [3],
				"mRender": function (data, type, full, meta){
					button='<a href="<?=base_url()?>kriteria/edit_bahan/'+encodeURI(btoa(full.id))+'" class="btn btn-primary mx-1 my-1"><i class="ti ti-pencil-minus fs-4"></i></a>'
					return button;
				}
			}],
        });
    } );


	$(document).on("click", ".del-data", function(e){
		e.preventDefault();
		let url_href = $(this).attr('href');
		Swal.fire({
			text:"Are you sure you delete this data?",
			type: "warning",
			position: 'center',
			showCancelButton: true,
			confirmButtonText: "Delete",
			cancelButtonText: "Cancel",
			confirmButtonColor: '#FA896B',
			closeOnConfirm: true,
			showLoaderOnConfirm: true,
		}).then((result) => {
			if (result.isConfirmed) {
				document.location.href = url_href;
			}
		})
	});
</script>