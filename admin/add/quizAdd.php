<?php session_start(); ?>
<div class="textA"><Span>Quiz Ekle</Span></div>
<form class="formA" action="../form/quizForm.php" method="post" enctype="multipart/form-data">
    <div class="labelForm">
        <label for="nameF">Quiz İsmi</label>
        <input id="nameF" type="text" placeholder="" name="quizAdd">
    </div>
    <div class="labelForm">
        <label for="timeF">Quiz Süresi(Dk)</label>
        <input id="timeF" type="number" name="quizTime" placeholder="">
    </div>
    <div class="ortA">
        <div class="select">
            <select name="kategoriA" id="select">
                <option value="0" selected>kategori Seç</option>
                <?php foreach ($kategori as $value) : ?>
                    <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="altA">
        <label class="quizİmg" for="file-upload"><span id="file-name">Quiz Kapak Resmi Yükle</span>
            <input id="file-upload" type="file" name="img" accept="image/*">
        </label>
    </div>
    <div class="buttonSubmit">
        <button type="submit" onclick="return kontrol();" class="buttonS">Ekle</button>
    </div>
</form>
<?php
if (isset($_SESSION["message"])) {
    if ($_SESSION["message"]["durum"] == 1) { ?>

        <script>
            showToast("Quiz başarıyla eklendi.");

            function showToast(message) {
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.innerText = message;
                document.body.appendChild(toast);
                setTimeout(() => {
                    toast.classList.add('show');
                }, 100);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
            }
        </script>
    <?php } else { ?>
        <script>
            showToast("Quiz eklenirken hata oluştu. Lütfen daha sonra tekrar deneyiniz!");
            
            function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.innerText = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
        </script>
<?php }
}
?>
<script>
    function kontrol() {
        const quizName = document.getElementById('nameF').value.trim();
        const quizTime = document.getElementById('timeF').value.trim();
        const kategori = document.getElementById('select').value;
        const quizImg = document.getElementById('file-upload').value;

        if (!quizName || !quizTime || kategori === "0" || !quizImg) {
            showToast("Lütfen tüm alanları doldurunuz.");
            return false;
        }
        return true;
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.innerText = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
</script>
<style>
    .toast {
        visibility: hidden;
        max-width: 50%;
        margin: 0 auto;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 10px;
        position: fixed;
        z-index: 1;
        left: 0;
        right: 0;
        top: 30px;
        font-size: 17px;
    }

    .toast.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }

        to {
            top: 30px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }

        to {
            top: 30px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            top: 30px;
            opacity: 1;
        }

        to {
            top: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            top: 30px;
            opacity: 1;
        }

        to {
            top: 0;
            opacity: 0;
        }
    }
</style>
<?php unset($_SESSION["message"]); ?>