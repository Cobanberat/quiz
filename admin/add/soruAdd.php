<div class="textA"><Span>Soru Ekle</Span></div>
<form class="formA" action="../form/questionsForm.php" method="post">
    <div class="labelForm">
        <label for="">Soru</label>
        <textarea type="text" placeholder="" name="soruAdd"></textarea>
    </div>
    <div class="ortA">
        <div class="select">
            <select name="soruQ" id="select">
                <option value="0" selected>quiz Seç</option>
                <?php foreach($quiz as $value): ?>
                    <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="altA">
        <label id="labelS" for="">cevapları Giriniz</label>
        <div class="Cvp">
            <div class="a">
                <input id="inputS" type="text" placeholder="A) Şıkkı" name="A" id="a">
                <input id="inputS" type="text" placeholder="B) Şıkkı" name="B" id="b">
            </div>
            <div class="a">
                <input id="inputS" type="text" placeholder="C) Şıkkı" name="C" id="c">
                <input id="inputS" type="text" placeholder="D) Şıkkı" name="D" id="d">
            </div>
        </div>
        <br>
        <div class="dogruS">
            <label id="labelS" for="">Doğru cevabı Seçin</label>
            <div class="radioD">
                <div class="a">
                    <div class="c">
                        <label id="labelS" for="A">A</label>
                        <input id="radioD" type="radio" id="A" name="durum" value="A">
                    </div>
                    <div class="c">
                        <label id="labelS" for="B">B</label>
                        <input id="radioD" type="radio" id="B" name="durum" value="B">
                    </div>
                </div>
                <div class="a">
                    <div class="c">
                        <label id="labelS" for="C">C</label>
                        <input id="radioD" type="radio" id="C" name="durum" value="C">
                    </div>
                    <div class="c">
                        <label id="labelS" for="D">D</label>
                        <input id="radioD" type="radio" id="D" name="durum" value="D">
                    </div>
                </div>



            </div>
        </div>
    </div>
    <div class="buttonSubmit">
        <button class="buttonS">Ekle</button>
    </div>
</form>