document.getElementById("svgİ").addEventListener("click", function() {
    var dropdown = document.getElementById("dropdawn");
    dropdown.classList.toggle("show");
});
document.addEventListener("click", function(event) {
    var dropdown = document.getElementById("dropdawn");
    var svgI = document.getElementById("svgİ");
    if (!dropdown.contains(event.target) && !svgI.contains(event.target)) {
        dropdown.classList.remove("show");
    }
});
document.getElementById('file-upload').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('file-name').textContent = fileName;
});
function toggleQuestions(quizId) {
    var row = document.getElementById('questions-' + quizId);
    var icon = document.getElementById('icon-' + quizId);
    if (row.classList.contains('expanded')) {
        row.classList.remove('expanded');
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    } else {
        row.classList.add('expanded');
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    }
}

function toggleAnswers(questionId) {
    var row = document.getElementById('answers-' + questionId);
    var icon = document.getElementById('icon-ans-' + questionId);
    if (row.classList.contains('expanded')) {
        row.classList.remove('expanded');
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    } else {
        row.classList.add('expanded');
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    }
};

function Delete(url) {
    if (confirm("Silmek istediğinize emin misiniz? Kategoriye bağlı bütün quizler silinir.")) {
        window.location.href = url;
    }
}
function toggleSubCategory(categoryId) {
    var row = document.getElementById('subcategory-' + categoryId);
    var icon = document.getElementById('icon-' + categoryId);

    if (row.style.display === 'none') {
        row.style.display = 'table-row';
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    } else {
        row.style.display = 'none';
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    }
}
const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})

