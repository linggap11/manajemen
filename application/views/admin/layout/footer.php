  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> <i class="fa fa-clone"></i>CV.INDOMINERALS</strong> 
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
<!-- notify  -->
<script src="<?php echo base_url();?>assets/js/notify.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pace.min.js"></script>

<?php if(isset($js)) {foreach($js as $j) { ?>
<script src="<?php echo base_url($j);?>" type="text/javascript"></script>
<?php }} ?>

<script type="text/javascript">

 $(document).ajaxStart(function () {
   Pace.restart()
 })

 if(typeof $('.currency').autoNumeric != 'undefined'){
    $('.currency').autoNumeric('init', {mDec: '0'});
  }
  
  var option_dt = (typeof(has_button_table) == 'undefined') ? false : true;
  if(typeof $('#table-regular').DataTable != 'undefined'){
  	var table_regular = $('#table-regular').DataTable( {
			columnDefs: [
           { orderable: option_dt, targets: [ -1 ] }
        ],
      "bLengthChange": true,
      "bInfo" : false,
      "language": {
         "search": "Cari:",
         "emptyTable": "Data tidak ditemukan",
         "paginate": {
            "previous": "prev" 
          },
          "zeroRecords": "Data tidak di temukan"
      },
      "drawCallback": function () {
          $('.dataTables_paginate > .pagination').addClass('pagination-sm'); 
          var item_element = $('.dataTables_paginate .paginate_button').length;  
          if(item_element > 3) {
            $('.dataTables_paginate')[0].style.display = "block";
          } else {
            $('.dataTables_paginate')[0].style.display = "none";
          }
      }
    });
  }


  jQuery.fn.onlyNumber =
  function()
  {
      return this.each(function()
      {
          $(this).keydown(function(e)
          {
              var key = e.charCode || e.keyCode || 0;
              // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
              // home, end, period, and numpad decimal
              return (
                  key == 8 || 
                  key == 9 ||
                  key == 13 ||
                  key == 46 ||
                  key == 110 ||
                  key == 190 ||
                  (key >= 35 && key <= 40) ||
                  (key >= 48 && key <= 57) ||
                  (key >= 96 && key <= 105));
          });
      });
  };
 

   <?php
      if($this->session->flashdata('sukses')) { 
      echo alert_sukses($this->session->flashdata('sukses'));
      }
      if($this->session->flashdata('warning')) { 
      echo alert_warning($this->session->flashdata('warning'));
      }
      if($this->session->flashdata('error')) { 
      echo alert_error($this->session->flashdata('error'));
      }
      if($this->session->flashdata('info')) { 
      echo alert_info($this->session->flashdata('info'));
      } 
  ?>


</script>
</body>
</html>
