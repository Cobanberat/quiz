<?php session_start(); ?>

<div class="textA"><span>Soru Ekle</span></div>
<form class="formA" action="../form/questionsForm.php" method="post" onsubmit="return kontrolForm()">
    <div class="labelForm">
        <label for="">Soru</label>
        <textarea placeholder="" name="soruAdd"></textarea>
    </div>
    <div class="ortA">
        <div class="select">
            <select name="soruQ" id="select">
                <option value="0" selected>Quiz Seç</option>
                <?php foreach ($quiz as $value): ?>
                    <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="altA">
        <label id="labelS" for="">Cevapları Giriniz</label>
        <div class="Cvp">
            <div class="a">
                <input type="text" placeholder="A) Şıkkı" name="A" id="a">
                <input type="text" placeholder="B) Şıkkı" name="B" id="b">
            </div>
            <div class="a">
                <input type="text" placeholder="C) Şıkkı" name="C" id="c">
                <input type="text" placeholder="D) Şıkkı" name="D" id="d">
            </div>
        </div>
        <br>
        <div class="dogruS">
            <label id="labelS" for="">Doğru cevabı seçin</label>
            <div class="radioD">
                <div class="a">
                    <div class="c">
                        <label id="labelS" for="A">A</label>
                        <input type="radio" id="A" name="durum" value="A">
                    </div>
                    <div class="c">
                        <label id="labelS" for="B">B</label>
                        <input type="radio" id="B" name="durum" value="B">
                    </div>
                </div>
                <div class="a">
                    <div class="c">
                        <label id="labelS" for="C">C</label>
                        <input type="radio" id="C" name="durum" value="C">
                    </div>
                    <div class="c">
                        <label id="labelS" for="D">D</label>
                        <input type="radio" id="D" name="durum" value="D">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="buttonSubmit">
        <button type="submit" class="buttonS">Ekle</button>
    </div>
</form>
<?php
if (isset($_SESSION["message"])) {
    if ($_SESSION["message"]["durum"] == 1) { ?>

        <script>
            showToast("soru başarıyla eklendi.");

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
            showToast("Soru eklenirken hata oluştu. Lütfen daha sonra tekrar deneyiniz!");
            
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
unset($_SESSION["message"]);
}
?>
<script>
    function kontrolForm() {
        const soru = document.querySelector('textarea[name="soruAdd"]').value.trim();
        const quizId = document.getElementById('select').value;
        const cevapA = document.getElementById('a').value.trim();
        const cevapB = document.getElementById('b').value.trim();
        const cevapC = document.getElementById('c').value.trim();
        const cevapD = document.getElementById('d').value.trim();
        const durum = document.querySelector('input[name="durum"]:checked');

        if (!soru || quizId === "0" || !cevapA || !cevapB || !cevapC || !cevapD || !durum) {
            showToast("Lütfen tüm alanları doldurunuz ve doğru cevabı seçiniz.");
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
