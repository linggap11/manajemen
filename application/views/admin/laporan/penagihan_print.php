

<?php
  $style = '<style type="text/css">
  body{
    font-size:10px;
    color: #222;
    font-family: arial, sans-serif;
  }
  table{
    width: 100%;
    border-collapse: collapse;
  }
  .table td, .table th{
    border: 1px solid #777;
    padding-top: 5px;
    padding-bottom: 5px;
    padding-left: 15px;
    padding-right: 15px;
  }
  h3{
    font-size: 16px;
  }
  h4{
    font-size: 14px;
  }
</style>';
  $html = '
  <table style="vertical-align: top">
    <tr>
      <td style="text-align:center">
        <td align="center">
          <img src="'.base_url("assets/images/Logo.png").'" alt="" width="85%">
        </td>
      </td>
    </tr>
  </table>

  <hr>

  <h4 style="text-align:center"> Laporan Penagihan </h4>
  <table class="table">
  <thead>
  <tr>
    <th width="7%">No</th>
    <th>Pelanggan</th>
    <th >No. Mobil</th>
    <th >Tgl Transaksi</th>
    <th width="12%">Muatan (Kg)</th>
    <th width="30%">Total</th>
  </tr>
  </thead>
  <tbody>';

  $no = 1;
  $grand_total = 0;
  foreach($result as $row) {
      $html .= '<tr>
          <td align="center">'.  $no++  . '</td>
          <td>'.  $row->nama  . '</td>
          <td align="center">'.  $row->plat_nomor . '</td>
          <td align="center">'.  $row->tgl_transaksi . '</td>
          <td align="center">'.  $row->berat  . '</td>
          <td>'.  format_rupiah($row->total)   . '</td>

      </tr>';
      $grand_total += $row->total;
  }

  $html .= '
  </tbody>
  <tfoot>
    <tr>
      <td style="text-align:right" colspan="5"><b>Grand Total</b></td>
      <td colspan="1"><b>' . format_rupiah($grand_total) .'</b></td>
    </tr>
  </tfoot>
  </table>';

  $mpdf = new \Mpdf\Mpdf();

  $mpdf->CSSselectMedia='mpdf';
  $mpdf->WriteHTML($style . $html);
  $mpdf->Output('Laporan_Penagihan_'.$status.'_'.$tgl_awal.'_'.$tgl_akhir.'.pdf', \Mpdf\Output\Destination::INLINE);

?>
