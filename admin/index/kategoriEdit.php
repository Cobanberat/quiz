<?php session_start() ?>
<?php include "../../connect/connect.php"; ?>
<?php $kategoriler = $conn->query("select * from kategoriler where id = '" . $_GET["id"] . "'")->fetch(PDO::FETCH_ASSOC);
$ustK = $conn->query("select * from kategoriler where id = '" . $kategoriler["ust_id"] . "'")->fetch(PDO::FETCH_ASSOC); ?>
<?php $ktg = $conn->query("select * from kategoriler where id")->fetchAll(PDO::FETCH_ASSOC);  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <title>edit</title>
</head>

<body>
    <div class="container">
        <?php include "header.php"; ?>
        <div class="body">
            <div class="editCard">
                <form class="cardE" action="../form/kategoriEditForm.php" onsubmit="return kontrolForm()" method="post">
                    <div class="cardE">
                        <div class="ustE">
                            <span class="text"><?= $kategoriler["name"] ?></span>
                        </div>
                        <div class="ort">
                            <div class="labelForm">
                                <label for="">kategori Adı</label>
                                <input id="NameF" type="text" name="name" placeholder="<?= $kategoriler["name"] ?>">
                            </div>
                        </div>
                        <div class="alt">
                            <select class="select" name="kategori" id="select">
                                <option value="<?php if ($ustK): echo $ustK["id"];
                                                else: echo "0";
                                                endif; ?>" selected><?php if ($ustK): echo $ustK["name"];
                                                                    else: echo "üst kategori seç";
                                                                    endif;  ?></option>
                                <?php foreach ($ktg as $value) : ?>
                                    <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?= $kategoriler["id"] ?>">
                        <button class="buttonS" type="submit">değiştir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="../js/admin.js"></script>
<?php
if (isset($_SESSION["message"])) {
    if ($_SESSION["message"]["durum"] == 1) { ?>

        <script>
            showToast("kategori başarıyla güncellendi.");

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
            showToast("kategori Güncellenirken hata oluştu. Lütfen daha sonra tekrar deneyiniz!");

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
    function kontrolForm() {
        NameF = document.getElementById("NameF").value.trim();
        if (!NameF) {
            showToast("Lütfen Tüm Alanları Doldurunuz!");
            return false;
        } else {
            return true;
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
<?php unset($_SESSION["message"]) ?>