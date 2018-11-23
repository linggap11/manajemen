$(function () { 
        $('#tanggal').datetimepicker({
        	format: 'D-MM-YYYY',  
	 		icons: {
			 	time: 'fa fa-clock-o',
			 	date: 'fa fa-calendar',
			 	up: 'fa fa-chevron-up',
			 	down: 'fa fa-chevron-down',
			 	previous: 'fa fa-chevron-left',
			 	next: 'fa fa-chevron-right',
			 	today: 'glyphicon glyphicon-screenshot',
			 	clear: 'fa fa-trash',
			 	close: 'fa fa-times'
		 	}
        });

        $(".btn_tambah").on("click", function () {  
        	var id = $(this).data('id');
			var url = BASE_URL + 'pelanggan/pendaftaran_event/pendaftaran/' + id + '/' + $(this).data('mulai');
        	$('#link_daftar').attr('href', url);
    		$('#modal_tambah').modal('show'); 
        	$('#tanggal').data("DateTimePicker").minDate(moment($(this).data('mulai'))); 
        	$('#tanggal').data("DateTimePicker").maxDate(moment($(this).data('selesai'))); 

        	$("#tanggal").on("dp.change", function (e) { 
				var url = BASE_URL + 'pelanggan/pendaftaran_event/pendaftaran/' + id + '/' + $(this).val();
		    	$('#link_daftar').attr('href', url); 
        	});
        });
       
    });