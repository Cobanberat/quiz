    <?php session_start(); ?>
    <?php $ustKategori = $conn->query("select * from kategoriler where ust_id = 0")->fetchAll(PDO::FETCH_ASSOC); ?>
    <div class="textA"><Span>Kategori Ekle</Span></div>
    <form class="formA" action="../form/categoryForm.php" method="post" onsubmit="return KontrolForm()">
        <div class="labelForm">
            <label for="">Kategori İsmi</label>
            <input id="NameF" type="text" placeholder="" name="categoryAdd">
        </div>
        <div class="ortA">
            <div class="select">
                <select name="kategoriA" id="select">
                    <option value="0" selected>Üst Kategorisi(var ise)</option>
                    <?php foreach ($ustKategori as $value): ?>
                        <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="altA">
        </div>
        <div class="buttonSubmit">
            <button class="buttonS">Ekle</button>
        </div>
    </form>
    <?php
    if (isset($_SESSION["message"])) {
        if ($_SESSION["message"]["durum"] == 1) { ?>

            <script>
                showToast("kategori başarıyla eklendi.");

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
                showToast("kategori eklenirken hata oluştu. Lütfen daha sonra tekrar deneyiniz!");

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
        function KontrolForm() {
            nameF = document.getElementById("NameF").value.trim();
            if (!nameF) {
                showToast("Lütfen tüm alanları doldurunuz.");
                return false;
            } else {
                return true
            }
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
