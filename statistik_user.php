<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Statistik Mahasiswa</title>
</head>
<body>
  <?php include 'header_user.php'; ?>

  <div class="container mt-5">
    <h2 class="text-center">Statistik Mahasiswa Berdasarkan Program Studi</h2>
    <div class="d-flex justify-content-center align-items-center">
      <!-- Pembungkus untuk mengatur ukuran chart -->
      <div style="width: 600px; height: 600px;">
        <canvas id="chartMahasiswa"></canvas>
      </div>
      <button id="changeChartType" class="btn btn-primary ms-3">Ubah ke Pie Chart</button>
    </div>
  </div>

  <script>
    // Ambil data dari PHP
    <?php
    require_once('koneksi.php');

    $koneksiObj = new koneksi();
    $koneksi    = $koneksiObj->getKoneksi();

    if ($koneksi->connect_error) {
      die("Gagal Koneksi: " . $koneksi->connect_error);
    }

    // Query jumlah mahasiswa per program studi
    $query = "SELECT prodi, COUNT(*) as jumlah FROM mahasiswa GROUP BY prodi";
    $result = $koneksi->query($query);

    $labels = [];
    $data = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $labels[] = $row['prodi'];
        $data[] = $row['jumlah'];
      }
    }

    $koneksi->close();
    ?>

    // Siapkan data untuk chart
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($data); ?>;

    // Warna berbeda untuk setiap batang
    const colors = [
      'rgba(255, 99, 132, 0.5)', 
      'rgba(54, 162, 235, 0.5)', 
      'rgba(255, 206, 86, 0.5)', 
      'rgba(75, 192, 192, 0.5)', 
      'rgba(153, 102, 255, 0.5)', 
      'rgba(255, 159, 64, 0.5)'
    ];

    const borderColors = [
      'rgba(255, 99, 132, 1)', 
      'rgba(54, 162, 235, 1)', 
      'rgba(255, 206, 86, 1)', 
      'rgba(75, 192, 192, 1)', 
      'rgba(153, 102, 255, 1)', 
      'rgba(255, 159, 64, 1)'
    ];

    // Konfigurasi chart
    const ctx = document.getElementById('chartMahasiswa').getContext('2d');
    let chartMahasiswa = new Chart(ctx, {
      type: 'bar', // Jenis chart awal (bar chart)
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Mahasiswa',
          data: data,
          backgroundColor: colors.slice(0, labels.length), // Potong warna sesuai jumlah label
          borderColor: borderColors.slice(0, labels.length),
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false, // Nonaktifkan aspect ratio agar menyesuaikan ukuran canvas
        plugins: {
          legend: {
            display: true
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Logika untuk mengubah tipe chart
    const changeChartTypeBtn = document.getElementById('changeChartType');
    changeChartTypeBtn.addEventListener('click', () => {
      // Hapus chart lama
      chartMahasiswa.destroy();

      // Toggle jenis chart
      const newType = chartMahasiswa.config.type === 'bar' ? 'pie' : 'bar';
      changeChartTypeBtn.textContent = newType === 'bar' ? 'Ubah ke Pie Chart' : 'Ubah ke Bar Chart';

      // Buat chart baru
      chartMahasiswa = new Chart(ctx, {
        type: newType,
        data: {
          labels: labels,
          datasets: [{
            label: 'Jumlah Mahasiswa',
            data: data,
            backgroundColor: colors.slice(0, labels.length),
            borderColor: borderColors.slice(0, labels.length),
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false, // Nonaktifkan aspect ratio agar menyesuaikan ukuran canvas
          plugins: {
            legend: {
              display: true
            }
          }
        }
      });
    });
  </script>

  <?php include 'footer.php'; ?>
</body>
</html>
