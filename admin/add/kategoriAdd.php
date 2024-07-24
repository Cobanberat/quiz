    <?php $ustKategori = $conn->query("select * from kategoriler where ust_id = 0")->fetchAll(PDO::FETCH_ASSOC); ?>
<div class="textA"><Span>Kategori Ekle</Span></div>
<form class="formA" action="../form/categoryForm.php" method="post">
    <div class="labelForm">
        <label for="">Kategori İsmi</label>
        <input type="text" placeholder="" name="categoryAdd">
    </div>
    <div class="ortA">
        <div class="select">
            <select name="kategoriA" id="select">
                <option value="0" selected>Üst Kategorisi(var ise)</option>
                <?php foreach( $ustKategori as $value): ?>
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