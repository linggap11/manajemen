$(document).ready(function() {

    'use strict';

    // Initialize the jQuery File Upload widget:
    if(typeof $('#fileupload').fileupload != 'undefined'){
        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: BASE_URL + '/admin/kelola_produk/do_upload',
        }).bind('fileuploaddone', function (e, data) {
        	console.log(data.result.files);
        	var list_foto = $('#foto_produk').val();
        	var pecah = list_foto.split(',');
        	$.each(data.result.files, function(idx, dt) {
        		pecah.push(dt.id);
        	});
        	$('#foto_produk').val(pecah.join());
        });

        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            type: "POST",
            url: BASE_URL + '/admin/kelola_produk/load_gambar',
            dataType: 'json',
            data: {'lid': $('#foto_produk').val()},
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }

	$('.edit_kategori_produk').click(function() {
		$('#id_kategori').val($(this).data('id'));
		$('#nama_kategori').val($(this).data('nama'));
		$('#modal_edit').modal('show');
	});

});
 


