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

    <table>
      <tr>
        <td width="50%">
          <p>Kepada : </p>
          <p><b>' . $print->nama. '</b><br>' . $print->alamat. '<br>No Telp : ' . $print->no_telp. '</p>
          <p><b>TRANSAKSI #'.$print->no_bukti.'</b></p>
        </td>
        <td align="right">
          <h4 align="right">SURAT JALAN</h4>
          <p><h4>NOMOR #' . $print->no_pengiriman .'</h4></p>
          <p>Tanggal : ' . $print->tgl_transaksi. '</p>

        </td>
      </tr>
    </table>

    <br>
    <table class="table-bordered">
      <thead>
        <tr>
          <th width="5%">No</th>
               <th>Produk/Jasa</th>
               <th width="55%">Deskripsi</th>
               <th width="10%">Qty</th>
               <th width="10%">Satuan</th>
        </tr>
      </thead>

      <tbody>';

         $html .=' <tr>
            <td>' . (1). '</td>
            <td>' . $print->nama_produk. '</td>
            <td>' . $print->deskripsi. '</td>
            <td>' . $print->berat. '</td>
            <td align="center">' . ('KG') .'</td>
          </tr>';



      $html .= '</tbody>
    </table>
    <br>
    <p><strong>Catatan :</strong></p>
    <p>Semua barang yang diterima dalam urutan dan kondisi baik.</p>
    <br><br>
    <table>
      <tr>
        <td style="height: 30px;">

        </td>
        <td width="30%"></td>
        <td>
          Barang diterima pada tanggal .........................<br><br>
        </td>
      </tr>
      <tr>
        <td style="text-align: center">
          <div style="text-align: center; ">Pengirim<br><br><br><br><br><br>

          (................................................)
          </div>
        </td>
        <td></td>
        <td style="text-align: center">
          <div style="text-align: center; ">Penerima<br><br><br><br><br><br>

          (................................................)
          </div>
        </td>
      </tr>
    </table>
  </div><!-- end page -->';

  $mpdf = new \Mpdf\Mpdf();


  //echo $css . $html;die;
  $mpdf->CSSselectMedia='mpdf';
  $mpdf->WriteHTML($css . $html);
  $mpdf->Output('nota_pengiriman_' . $print->no_pengiriman . '.pdf', \Mpdf\Output\Destination::INLINE);
