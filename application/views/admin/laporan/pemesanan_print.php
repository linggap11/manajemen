

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
      <td align="center">
        <img src="'.base_url("assets/images/Logo.png").'" alt="" width="85%">
      </td>
    </tr>
  </table>

  <hr>

  <h4 style="text-align:center"> Laporan Pemesanan </h4>
  <table class="table">
  <thead>
  <tr>
      <th>No Bukti</th>
      <th>Tanggal</th>
      <th>Sales </th>
      <th>Pelanggan</th>
      <th>Total Biaya</th>
      <th>Kas Jalan</th>
  </tr>
  </thead>
  <tbody>';

  $grand_total = 0;
  foreach($result as $row) {
      $html .= '<tr>
          <td>'.  $row->no_bukti  . '</td>
          <td>'.  $row->tgl_transaksi . '</td>
          <td>'.  $row->sales . '</td>
          <td>'.  $row->nama  . '</td>
          <td>'.  format_rupiah($row->total) . '</td>
          <td>'.  format_rupiah($row->biaya_tambahan) . '</td>
      </tr>';
      $grand_total += $row->total;
  }

  $html .= '
  </tbody>
  <tfoot>
    <tr>
      <td style="text-align:right" colspan="4"><b>Grand Total</b></td>
      <td colspan="2"><b>' . format_rupiah($grand_total) .'</b></td>
    </tr>
  </tfoot>
  </table>';

  $mpdf = new \Mpdf\Mpdf();

  $mpdf->CSSselectMedia='mpdf';
  $mpdf->WriteHTML($style . $html);
  $mpdf->Output('Laporan_Pemesanan_'.$status.'_'.$tgl_awal.'_'.$tgl_akhir.'.pdf', \Mpdf\Output\Destination::INLINE);

?>
