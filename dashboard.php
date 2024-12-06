<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <title> DPTEI UNY </title>
</head>

<body>
    <?php 
        include 'header_user.php';
    ?>
    
    <div class="container">
        <br>  
        <h2>Data Mahasiswa</h2>
        <hr>
        <br>

        <div class="container">
            <div class="row justify-content-end">
                <div class="col-auto">
                    <!-- start filter form -->
                    <form class="form-horizontal" method="get">
                        <div class="form-group">
                            <select name="filter" class="form-control" onchange="form.submit()">
                                <option value="0">Filter Berdasarkan Prodi</option>
                                <?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
                                <option value="S1 Pendidikan Teknik Informatika" <?php if($filter == 'S1 Pendidikan Teknik Informatika'){ echo 'selected'; } ?>>S1 Pendidikan Teknik Informatika</option>
                                <option value="S1 Teknologi Informasi" <?php if($filter == 'S1 Teknologi Informasi'){ echo 'selected'; } ?>>S1 Teknologi Informasi</option>
                                <option value="S1 Teknik Elektronika" <?php if($filter == 'S1 Teknik Elektronika'){ echo 'selected'; } ?>>S1 Teknik Elektronika</option>
                                <option value="S1 Pendidikan Teknik Elektronika" <?php if($filter == 'S1 Pendidikan Teknik Elektronika'){ echo 'selected'; } ?>>S1 Pendidikan Teknik Elektronika</option>
                                <option value="0" <?php if($filter == ''){ echo 'selected'; } ?>>Semua Prodi</option>
                            </select>
                        </div>
                    </form> <!-- end filter -->
                </div>
            </div>
        </div>
        
        <!-- start table data responsive -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="tb-mahasiswa">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Semester</th>
                        <th>Prodi</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        require_once('koneksi.php');

                        $no = 1;
                        $koneksiObj = new koneksi();
                        $koneksi    = $koneksiObj->getKoneksi();
                        
                        if($koneksi->connect_error){
                            echo "Gagal Koneksi : ". $koneksi->connect_error;
                            echo "</td></tr>";
                        }

                        if($filter){
                            $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE prodi='$filter' ORDER BY nim ASC"); // query jika filter dipilih
                        }else{
                            $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nim ASC"); // jika tidak ada filter maka tampilkan semua entri
                        }

                        if(mysqli_num_rows($sql) == 0){ 
                            echo '<tr><td colspan="8">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
                        }else{ // jika terdapat entri maka tampilkan datanya
                            while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
                                echo "<tr>";
                                echo "<td>".$no++."</td>";
                                echo "<td class='center'>".$row['nim']."</td>";
                                echo "<td>".$row['nama']."</td>";
                                echo "<td>".$row['jenis_kelamin']."</td>";
                                echo "<td class='center'>".$row['semester']."</td>";
                                echo "<td>".$row['prodi']."</td>";
                                echo "<td>".$row['alamat']."</td>";
                                echo "<td>".$row['no_hp']."</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php 
        include 'footer.php';
    ?>

</body>
</html>