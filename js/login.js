function validateForm() {
    var user = document.getElementById("regUser").value;
    var pass = document.getElementById("regPass").value;
    var tryPass = document.getElementById("regTryPass").value;
    var gmail = document.getElementById("regGmail").value;

    if (!user || !pass || !tryPass || !gmail) {
        Toastify({
            text: "Tüm alanlar doldurulmalıdır.",
            duration: 3000
        }).showToast();
        return false;
    }

    if (pass !== tryPass) {
        Toastify({
            text: "Şifreler eşleşmiyor.",
            duration: 3000
        }).showToast();
        return false;
    }

    return true;
}