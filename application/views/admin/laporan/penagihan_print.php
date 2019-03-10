

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
    <th width="5%">No</th>
    <th>Pelanggan</th>
    <th >No. Mobil</th>
    <th >Tgl Transaksi</th>
    <th width="12%">Muatan (Kg)</th>
    <th width="30%">Total</th>
  </tr>
  </thead>
  <tbody>';

  $no = 1;
  foreach($result as $row) {
      $html .= '<tr>
          <td align="center">'.  $no++  . '</td>
          <td>'.  $row->nama  . '</td>
          <td align="center">'.  $row->plat_nomor . '</td>
          <td align="center">'.  $row->tgl_transaksi . '</td>
          <td align="center">'.  $row->berat  . '</td>
          <td>'.  format_rupiah($row->total)   . '</td>

      </tr>';
  }

  $html .= '
  </tbody>

  </table>';

  $mpdf = new \Mpdf\Mpdf();

  $mpdf->CSSselectMedia='mpdf';
  $mpdf->WriteHTML($style . $html);
  $mpdf->Output('Laporan_Penagihan_' . date('Y_m_d'). '.pdf', \Mpdf\Output\Destination::INLINE);

?>
