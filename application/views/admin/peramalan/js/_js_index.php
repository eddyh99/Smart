<script>

    $('#periode').on('change', function() {
        let bobot = this.value;
        
        $(".bobot-tambahan").remove();

        if(bobot == 4){
            $(".wrap-bobot").append(
                `
                 <div class="pe-3 bobot-tambahan">
                    <input class="form-control" type="number" step="0.1" name="bobot4" value="0.4">
                </div>
                `
            );
        }else if(bobot == 5){
            $(".wrap-bobot").append(
                `
                 <div class="pe-3 bobot-tambahan">
                    <input class="form-control" type="number" step="0.1" name="bobot4" value="0.4">
                </div>
                <div class="pe-3 bobot-tambahan">
                    <input class="form-control" type="number" step="0.1" name="bobot5" value="0.5">
                </div>
                `
            );
        }
        // alert( this.value );
    });


</script>