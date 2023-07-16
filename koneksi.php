<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "visit_count";
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa apakah terjadi kesalahan koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengecek apakah ada data kunjungan sebelumnya di database
$sql = "SELECT visit_count FROM visitors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Data kunjungan tersedia, maka mengambil nilai dan meningkatkannya
    $row = $result->fetch_assoc();
    $visitCount = $row["visit_count"] + 1;

    // Memperbarui nilai kunjungan di database
    $sql = "UPDATE visitors SET visit_count = $visitCount";
    $conn->query($sql);
} else {
    // Tidak ada data kunjungan sebelumnya, maka membuat data baru
    $visitCount = 1;

    $sql = "INSERT INTO visitors (visit_count) VALUES ($visitCount)";
    $conn->query($sql);
}

// Menampilkan jumlah kunjungan pada halaman
echo "<h1>Selamat datang di website kami!</h1>";
echo "<p>Jumlah kunjungan: $visitCount</p>";

// Menutup koneksi ke database
$conn->close();
?>
