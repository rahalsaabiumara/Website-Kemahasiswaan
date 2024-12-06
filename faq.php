<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Frequently Asked Questions</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        .faq-section {
            margin: 50px auto;
            max-width: 800px;
        }
        .faq-header {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .faq-item {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
        }
        .faq-question {
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .faq-answer {
            display: none;
            margin-top: 10px;
            padding-left: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <?php include 'header_user.php'; ?>

    <div class="container faq-section">
        <div class="faq-header">Yang Sering Ditanyakan</div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>Bagaimana cara mendaftar kegiatan mahasiswa?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                Anda dapat mendaftar kegiatan mahasiswa melalui menu "Pendaftaran Kegiatan" dan mengisi formulir pendaftaran.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Bagaimana cara mengecek status pendaftaran saya?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                Anda dapat memeriksa status pendaftaran melalui menu "Status Kegiatan" di dashboard Anda.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Apakah saya akan mendapatkan notifikasi jika diterima atau ditolak pada kegiatan mahasiswa?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                Ya, Anda dapat memantau notifikasi status diterima atau ditolak pada menu "Notifikasi".
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Dimana Saya bisa melihat statistik Mahasiswa dalam DPTEI?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                Anda dapat mengakses "Statistik Mahasiswa" untuk melihat statistik dari mahasiswa DPTEI.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Apa yang harus Saya lakukan ketika ada kesalahan pada data diri Saya?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                Anda bisa menghubungi admin untuk memperbaiki data Anda.
        </div>

    </div>

    <script>
        document.querySelectorAll('.faq-question').forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.nextElementSibling;
                const symbol = item.querySelector('span:last-child');
                
                // Toggle tampilan jawaban
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
                
                // Toggle simbol '+' dan '-'
                symbol.textContent = symbol.textContent === '+' ? '-' : '+';
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>
