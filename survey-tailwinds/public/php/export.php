<?php
include 'koneksi.php';

$sql = "SELECT rekap.NIP, Nama, Divisi, Kategori, Total FROM rekap INNER JOIN karyawan ON rekap.NIP = karyawan.Nip";
$result = $conn->query($sql);

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">';
$xml .= '<Worksheet ss:Name="Sheet1"><Table>';

$xml .= '<Row>';
for ($i = 0; $i < $result->field_count; $i++) {
    $xml .= '<Cell><Data ss:Type="String">' . $result->fetch_field_direct($i)->name . '</Data></Cell>';
}
$xml .= '</Row>';

while ($row_data = $result->fetch_assoc()) {
    $xml .= '<Row>';
    foreach ($row_data as $cell) {
        $xml .= '<Cell><Data ss:Type="String">' . $cell . '</Data></Cell>';
    }
    $xml .= '</Row>';
}
$xml .= '</Table></Worksheet></Workbook>';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Rekap_Data_' . date('Ymd') . '.xls"');
header('Cache-Control: max-age=0');

echo $xml;
$conn->close();
