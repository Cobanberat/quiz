<div class="textA"><Span>Quiz Ekle</Span></div>
<form class="formA" action="../form/quizForm.php" method="post">
    <div class="labelForm">
        <label for="">Quiz İsmi</label>
        <input type="text" placeholder="" name="quizAdd">
    </div>
    <div class="labelForm">
        <label for="">Quiz Süresi(Dk)</label>
        <input type="number" name="quizTime" placeholder="">
    </div>
    <div class="ortA">
        <div class="select">
            <select name="kategoriA" id="select">
                <option value="0" selected>kategori Seç</option>
                <?php foreach($kategori as $value) : ?>
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
        <button class="buttonS">Ekle</button>
    </div>
</form>