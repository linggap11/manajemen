<?php

$css = '<style type="text/css"> 

body{  
  font-size: 10px;
  font-family: Arial, Sans Serif;
}

h3{
  font-size:16px;
}

#page {
  width: 100%;  
}
 

p{
  margin-bottom: 2px;
}

h3{
  font-weight: 600;
  text-transform: uppercase;
}

hr{
  height: 2px;
}

table{
  width: 100%;
}
.table-bordered{
  border-collapse: collapse;
}
.table-bordered td, .table-bordered th{
  border: 1px solid #333;
  padding: 7px 15px;
}

.text-left{
  text-align: left;
}
.text-right{
  text-align: right;
}
 
</style>';


$html = '<body>  
  <div id="page">
    <div class="header">
      <table>
        <tr>
          <td>
           <h3>' . $profile->nama_cv . '</h3>
            <p>' . $profile->alamat_cv . '</p>
            <p>Telp: ' . $profile->kontak_cv . ' | Email: ' . $profile->email_cv . '</p>
          </td>
          <td style="text-align: right"> 
            <h4><b>NO INVOICE</b></h4><br>
            <p>Dari Tanggal: <b>#'.$print[0]->tgl_transaksi.'</b></p> 
          </td>
        </tr>
      </table>
    </div>
    <hr>

    <table>
      <tr>
        <td width="74%"> 
          <p><strong>Kepada :</strong> </p> 
          <p>' . $print[0]->nama . '</p>
          <p><strong>Alamat : </strong></p> 
          <p>' . $print[0]->alamat . ' ('.$print[0]->kode_pos.') ' . $print[0]->no_telp .'</p>
        </td>
        <td> 
          
        </td>
      </tr>
    </table>  
    
    <br> 
    <table class="table-bordered">
      <thead>
        <tr>
         <th width="5%">No</th>
         <th width="15%">No Invoice</th>    
         <th >Produk / Jasa</th>    
         <th >Qty</th>  
         <th >Harga</th>
         <th >Total</th>  
        </tr>
      </thead>
      
      <tbody>';

         $grand_total = 0; $no = 1;
         foreach ($print as $row) {
          $html .=' <tr>
            <td>' . $no++ . '</td>   
            <td align="center">' . $row->no_bukti. '</td> 
            <td>' . $row->nama_produk. '</td> 
            <td>' . $row->berat . (' ( KG )') .'</td>    
            <td>' . format_rupiah($row->harga) .'</td>  
            <td>' . format_rupiah($row->total) . '</td>    
          </tr>';
           $grand_total += $row->total;

         }
        
         
      $html .= '</tbody> 
      <tfoot>
      <tr>
        <td style="text-align:right" colspan="5"><b>TOTAL</b></td>
        <td><b>' . format_rupiah($grand_total) .'</b></td>
      </tr>
   
      </tr>
  </tfoot>
    </table> 
    <br>
  </div><!-- end page -->';

  $mpdf = new \Mpdf\Mpdf();
  

  //echo $css . $html;die;
  $mpdf->CSSselectMedia='mpdf';  
  $mpdf->WriteHTML($css . $html);
  $mpdf->Output('no_invoice_' . (date('Y-m-d')) . '_' . $print[0]->pelanggan_id . '_.pdf', \Mpdf\Output\Destination::INLINE);



 