<?php $AnS2 = $conn->query("select * from anasayfabilgi where id = 2")->fetch(PDO::FETCH_ASSOC); ?>
<footer style="background-color: black; color: white; text-align: center; padding: 20px;">
    <div class="footer-content">
        <p>© 2024 Quiz Platform. All rights reserved.</p>
        <p><?= $AnS2["metin"] ?>.</p>
        <p>İletişim: <a href="mailto:info@quizplatform.com" style="color: white;">Cobanberat71@gmail.com</a></p>
        <p><a href="contact.php" style="color: white;">İletişim Formu</a> | <a href="about.php" style="color: white;">Hakkımızda</a></p>
    </div>
</footer>