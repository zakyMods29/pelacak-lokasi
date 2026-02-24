<?php
// Mengambil data latitude dan longitude dari kiriman JavaScript
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$waktu = date('d-m-Y H:i:s');

if($lat && $lon) {
    $data = "Waktu: $waktu | Lat: $lat | Lon: $lon | Link: https://www.google.com/maps?q=$lat,$lon\n";
    
    // Simpan ke file teks
    file_put_contents('log_lokasi.txt', $data, FILE_APPEND);
    echo "Lokasi berhasil diperbarui.";
} else {
    echo "Gagal mengambil data.";
}
?>