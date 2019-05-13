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
if ($ppn != 0) {
  $pajak = 'PPN 10%';
} else {
  $pajak = '';
}

$html = '<body width="100%">
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
        <td width="74%">
          <p><strong>Kepada :</strong> </p>
          <p>' . $print[0]->nama . '</p>
          <p><strong>Alamat : </strong></p>
          <p>' . $print[0]->alamat . ' ('.$print[0]->kode_pos.') ' . $print[0]->no_telp .'</p>
          <h4><b>NO INVOICE #'.$print[0]->no_bukti.'</b></h4>
            <p><b>'.$pajak .'</b></p>
        </td>

      </tr>
    </table>

    <h1 style="text-align:center"> FAKTUR </h1>

    <table class="table-bordered">
      <thead>
        <tr>
         <th width="7%">No</th>
         <th width="13%">Tanggal</th>
         <th width="12%">No. Mobil</th>
         <th>Produk / Jasa</th>
         <th width="10%">Qty (KG)</th>
         <th >Harga</th>
         <th >Total</th>
        </tr>
      </thead>

      <tbody>';

         $grand_total = 0; $no = 1;
         foreach ($print as $row) {
          $html .=' <tr>
            <td align="center">' . $no++ . '</td>
            <td align="center">' . $row->tgl_transaksi. '</td>
            <td align="center">' . $row->plat_nomor. '</td>
            <td>' . $row->nama_produk. ' ('.$row->produk_deskripsi.')</td>
            <td>' . $row->berat.'</td>
            <td>' . format_rupiah($row->harga) .'</td>
            <td>' . format_rupiah($row->total) . '</td>
          </tr>';
           $grand_total += $row->total;

         }

      $html .= '</tbody>
      <tfoot>
      ';
      if ($ppn == 0) {
        $html .= '
        <tr>
          <td style="text-align:right" colspan="6"><b>TOTAL</b></td>
          <td><b>' . format_rupiah($grand_total) .'</b></td>
        </tr>';
      } else {
        $html .= '
        <tr>
          <td style="text-align:right" colspan="6"><b>PPN</b></td>
          <td><b>' . format_rupiah($ppn) .'</b></td>
        </tr>
        <tr>
          <td style="text-align:right" colspan="6"><b>TOTAL</b></td>
          <td><b>' . format_rupiah($grand_total + $ppn) .'</b></td>
        </tr>';
      }
      $html .= '
      </tr>
  </tfoot>
    </table>
    <br>
    <i>*Harap melakukan pembayaran ke rekening BCA 2780189005 An/ Usen Suryanto</i><br>
    <i>*Harap mengirim kembali bukti faktur melalui fax (022) 6623907 / WA 081394786706 / E-Mail usen_suryanto@yahoo.co.id </i>
    <table>
      <tr>
        <td style="height: 30px;">

        </td>
        <td width="30%"></td>
        <td>

        </td>
      </tr>
      <tr>
        <td style="text-align: center">


        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center">
          Bandung, '.tanggal_lokal(date('Y-m-d')).'
          <div style="text-align: center; ">Hormat Kami,<br><br><br><br><br><br><br><br><br>

          (Usen Suryanto)
          </div>
        </td>
      </tr>
    </table>
  </div>';

  $mpdf = new \Mpdf\Mpdf();


  //echo $css . $html;die;
  $mpdf->CSSselectMedia='mpdf';
  $mpdf->WriteHTML($css . $html);
  $mpdf->Output('no_invoice_' . (date('Y-m-d')) . '_' . $print[0]->pelanggan_id . '_.pdf', \Mpdf\Output\Destination::INLINE);
