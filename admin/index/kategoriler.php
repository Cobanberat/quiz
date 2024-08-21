<?php
session_start();
include "../../connect/connect.php";
$kategoriler = $conn->query("SELECT * FROM kategoriler")->fetchAll(PDO::FETCH_ASSOC);

function categoriA($dizi, $ustKategori = 0)
{
    $dal = array();
    foreach ($dizi as $value) {
        if ($value["ust_id"] == $ustKategori) {
            $alt = categoriA($dizi, $value["id"]);
            if ($alt) {
                $value["alt"] = $alt;
            } else {
                $value["alt"] = array();
            }
            $dal[] = $value;
        }
    }
    return $dal;
}

$kategori_agaci = categoriA($kategoriler);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <title>Kategoriler</title>
</head>

<body>
    <div class="container">
        <?php include "header.php"; ?>

        <div class="bodys">
            <div class="container">
                <span class="adminSpan">Kategoriler</span>
            </div>
            <div class="container">
                <div class="quizList">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ad</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                function kategori($categories)
                                {
                                    foreach ($categories as $kategori) : ?>
                                        <tr>
                                            <td><?= $kategori['id']; ?></td>
                                            <td><?= $kategori['name']; ?></td>
                                            <td>
                                                <?php if (!empty($kategori['alt'])): ?>
                                                    <button class="btn btn-dark btn-sm" onclick="toggleSubCategory(<?= $kategori['id']; ?>)">Alt Kategori <i id="icon-<?= $kategori['id']; ?>" class="bi bi-chevron-down btn-icon"></i></button>
                                                <?php endif; ?>
                                                <a href="Kategoriedit.php?id=<?= $kategori['id']; ?>" class="btn btn-warning btn-sm">Düzenle</a>
                                                <a href="javascript:void(0);" onclick="Delete('../form/deleteKategoriForm.php?id=<?= $kategori['id']; ?>')" class="btn btn-danger btn-sm">Sil</a>
                                            </td>
                                        </tr>
                                        <?php if (!empty($kategori['alt'])) : ?>
                                            <tr id="subcategory-<?= $kategori['id']; ?>" class="sub-category-row" style="display: none;">
                                                <td colspan="3">
                                                    <table class="table">
                                                        <?php kategori($kategori['alt']); ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                <?php endforeach;
                                }
                                kategori($kategori_agaci);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

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

    .sub-category-row {
        display: none;
    }

    .expanded {
        display: table-row;
    }

    .btn-icon {
        display: inline;
    }
</style>

<script src="../js/admin.js"></script>
<?php
if (isset($_SESSION["message"])) {
    if ($_SESSION["message"]["durum"] == 1) { ?>

        <script>
            showToast("kategori başarıyla silindi.");

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
            showToast("kategori silinirken hata oluştu. Lütfen daha sonra tekrar deneyiniz!");

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