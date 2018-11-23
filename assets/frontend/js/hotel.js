$(function () {
		 $('#tanggal2').prop('disabled', true);
        $('#tanggal').datetimepicker({
        	format: 'D-MM-YYYY', 
        	minDate: moment(),
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
        $('#tanggal2').datetimepicker({
            useCurrent: false ,
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
        $("#tanggal").on("dp.change", function (e) { 
        	if(e.date != false){        		
		 		$('#tanggal2').prop('disabled', false);
            	$('#tanggal2').data("DateTimePicker").minDate(e.date);
        	}else{
		 		$('#tanggal2').prop('disabled', true); 
		 		$('#tanggal2').val(''); 
        	}
        });
        $("#tanggal2").on("dp.change", function (e) {
            $('#tanggal').data("DateTimePicker").maxDate(e.date);
        });
    });