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
          <td align="center">
            <img src="'.base_url("assets/images/Logo.png").'" alt="" width="85%">
          </td>
        </tr>
      </table>
    </div>
    <hr>
    <h3>SALES : <b>' . $print[0]->sales .' [' . $print[0]->plat_nomor. ']</b></h3>
    <h3 style="text-align:center">Laporan Pengiriman</h3>

    <br>
    <table class="table-bordered">
      <thead>
        <tr>
          <th width="5%">No</th>
               <th>Produk/Jasa</th>
               <th>Pelanggan</th>
               <th width="45%">Deskripsi</th>
               <th>Qty</th>
               <th width="10%">Satuan</th>
        </tr>
      </thead>

      <tbody>';
      $no = 1;
      foreach($print as $row) {
          $html .= '<tr>
            <td>'.  $no++  . '</td>
            <td>'.  $row->nama_produk  . '</td>
            <td>'.  $row->nama . '</td>
            <td>'.  $row->deskripsi . '</td>
            <td>'.  $row->berat . '</td>
            <td align="center">' . ('KG') .'</td>
          </tr>';
      }

      $html .= '</tbody>
    </table>

  </div><!-- end page -->';

  $mpdf = new \Mpdf\Mpdf();


  //echo $css . $html;die;
  $mpdf->CSSselectMedia='mpdf';
  $mpdf->WriteHTML($css . $html);
  $mpdf->Output('nota_pengiriman_' . $print[0]->sales . '.pdf', \Mpdf\Output\Destination::INLINE);
