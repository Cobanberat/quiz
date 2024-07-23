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