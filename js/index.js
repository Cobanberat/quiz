document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('.body').classList.add('show');
});
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