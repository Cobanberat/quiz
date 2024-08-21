<?php
session_start();
include "../../connect/connect.php";
$AnS = $conn->query("select * from anasayfabilgi where id = 1")->fetch(PDO::FETCH_ASSOC);
$AnS2 = $conn->query("select * from anasayfabilgi where id = 2")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="container">
        <?php include "header.php"; ?>  
        <div id="body">
            <div class="container">
                <span class="adminSpan">
                    Ana Sayfa İçerikleri
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Resim</th>
                            <th>işlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $AnS['id']; ?></td>
                            <td><img src="../../img/<?= $AnS['img']; ?>" alt="Quiz Image"></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    değiştir
                                </button>
                            </td>
                            <form action="../form/İmgEdit.php" onsubmit="return kontrolForm2()" method="post">
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="quizİmg1" for="file-upload"><span id="file-name"> Resim Seç</span>
                                                    <input id="file-upload" type="file" name="img" accept="image/*">
                                                </label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Geri</button>
                                                <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Kaydet</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>email</td>
                            <td>Metin</td>
                            <td>işlem</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td"><?= $AnS2["id"] ?></td>
                            <td class="td"><?= $AnS2["email"] ?></td>
                            <td class="td"><?= $AnS2["metin"] ?></td>
                            <td>
                                <button type="button" id="buttonEd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                    değiştir
                                </button>
                            </td>
                            
                            <form action="../form/İmgEdit.php" onsubmit="return kontrolForm()" method="post">
                                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="email">email</label>
                                                <input id="EmailF" type="text" name="email" placeholder="<?= $AnS2["email"] ?>">
                                                <br>
                                                <br>
                                                <label for="metin">metin</label>
                                                <input id="MetinF" type="text" name="metin" placeholder="<?= $AnS2["metin"] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Geri</button>
                                                <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Kaydet</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </tr>
                    </tbody>
                </table>


            </div>

        </div>
    </div>
</body>

</html>
<script src="../js/admin.js"></script>
<style>
    .table-responsive {
        max-width: 1200px;
        margin: 0 auto;
    }

    table {
        width: 100%;
        table-layout: fixed;
    }

    th,
    td {
        text-align: center;
        word-wrap: break-word;
    }

    th {
        font-size: 1.2rem;
    }

    td {
        font-size: 1rem;
    }

    img {
        max-width: 70px;
        height: auto;
    }

    .questions-row,
    .answers-row {
        display: none;
    }

    .expanded {
        display: table-row;
    }

    .btn-icon {
        display: inline;
    }
</style>
<?php
if (isset($_SESSION["message"])) {
    if ($_SESSION["message"]["durum"] == 1) { ?>

        <script>
            showToast("anasayfa bilgileri başarıyla güncellendi.");

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
            showToast("bilgiler Güncellenirken hata oluştu. Lütfen daha sonra tekrar deneyiniz!");

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
        MetinF = document.getElementById("MetinF").value.trim();
        EmailF = document.getElementById("EmailF").value.trim();
        if (!MetinF || !EmailF) {
            showToast("Lütfen Tüm Alanları Doldurunuz!");
            return false;
        } else {
            return true;
        }
    }
    function kontrolForm2() {
        İmgF = document.getElementById("file-upload").value.trim();
        if (!İmgF) {
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