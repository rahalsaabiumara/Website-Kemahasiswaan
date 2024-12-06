<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Statistik Mahasiswa</title>
</head>
<body>
  <?php include 'header.php'; ?>

  <div class="container mt-5">
    <h2 class="text-center">Statistik Mahasiswa</h2>

    <!-- Filter -->
    <div class="mb-4">
      <label for="filter-statistik" class="form-label">Pilih Statistik:</label>
      <select id="filter-statistik" class="form-select">
        <option value="prodi" selected>Program Studi</option>
        <option value="kegiatan">Kegiatan Mahasiswa</option>
      </select>
      <button id="showChartBtn" class="btn btn-primary mt-3">Tampilkan Statistik</button>
    </div>

    <!-- Area Grafik -->
    <div class="d-flex justify-content-center align-items-center mb-5">
      <div style="width: 600px; height: 600px;">
        <canvas id="chartMahasiswa"></canvas>
      </div>
    </div>
  </div>

  <script>
    <?php
    require_once('koneksi.php');
    $koneksiObj = new Koneksi();
    $koneksi = $koneksiObj->getKoneksi();

    // Query Program Studi
    $queryProdi = "SELECT prodi, COUNT(*) as jumlah FROM mahasiswa GROUP BY prodi";
    $resultProdi = $koneksi->query($queryProdi);
    $labelsProdi = [];
    $dataProdi = [];
    if ($resultProdi->num_rows > 0) {
      while ($row = $resultProdi->fetch_assoc()) {
        $labelsProdi[] = $row['prodi'];
        $dataProdi[] = $row['jumlah'];
      }
    }

    // Query Kegiatan Mahasiswa
    $queryKegiatan = "SELECT kegiatan, COUNT(*) as jumlah FROM pendaftaran_kegiatan WHERE status='Diterima' GROUP BY kegiatan";
    $resultKegiatan = $koneksi->query($queryKegiatan);
    $labelsKegiatan = [];
    $dataKegiatan = [];
    if ($resultKegiatan->num_rows > 0) {
      while ($row = $resultKegiatan->fetch_assoc()) {
        $labelsKegiatan[] = $row['kegiatan'];
        $dataKegiatan[] = $row['jumlah'];
      }
    }

    $koneksi->close();
    ?>

    // Data
    const dataSets = {
      prodi: {
        labels: <?php echo json_encode($labelsProdi); ?>,
        data: <?php echo json_encode($dataProdi); ?>
      },
      kegiatan: {
        labels: <?php echo json_encode($labelsKegiatan); ?>,
        data: <?php echo json_encode($dataKegiatan); ?>
      }
    };

    // Warna
    const colors = [
      'rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)',
      'rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)',
      'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'
    ];
    const borderColors = [
      'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
      'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)',
      'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
    ];

    const ctx = document.getElementById('chartMahasiswa').getContext('2d');
    let chartMahasiswa = null;

    function renderChart(type) {
      if (chartMahasiswa) chartMahasiswa.destroy();
      const selectedData = dataSets[type];
      chartMahasiswa = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: selectedData.labels,
          datasets: [{
            label: `Jumlah Mahasiswa per ${type === 'prodi' ? 'Program Studi' : 'Kegiatan'}`,
            data: selectedData.data,
            backgroundColor: colors.slice(0, selectedData.labels.length),
            borderColor: borderColors.slice(0, selectedData.labels.length),
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { display: true } },
          scales: { y: { beginAtZero: true } }
        }
      });
    }

    document.getElementById('showChartBtn').addEventListener('click', () => {
      const selectedFilter = document.getElementById('filter-statistik').value;
      renderChart(selectedFilter);
    });

    // Tampilkan chart default
    renderChart('prodi');
  </script>

  <?php include 'footer.php'; ?>
</body>
</html>
