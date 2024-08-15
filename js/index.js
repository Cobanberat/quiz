document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('.body').classList.add('show');
});

document.getElementById("svgİ").addEventListener("click", function () {
    var dropdown = document.getElementById("dropdawn");
    dropdown.classList.toggle("show");
});

document.addEventListener("click", function (event) {
    var dropdown = document.getElementById("dropdawn");
    var svgI = document.getElementById("svgİ");
    if (!dropdown.contains(event.target) && !svgI.contains(event.target)) {
        dropdown.classList.remove("show");
    }
});

$(document).ready(function () {
    $(".quizC").hide();
    $("#cardL").hide();

    let soruPage = 0;

    $(".buttonL").on("click", function () {
        $(".buttonL").hide();
        $("#text").hide();
        $("#cardL").show();
        showQuestion(soruPage);
        startTime(quizTime);
    });

    $("#nextBtn").on("click", function () {
        if (soruPage < $(".quizC").length - 1) {
            soruPage++;
            showQuestion(soruPage);
        }
    });

    $("#prevBtn").on("click", function () {
        if (soruPage > 0) {
            soruPage--;
            showQuestion(soruPage);
        }
    });

    function showQuestion(index) {
        $(".quizC").hide();
        $("#soru-" + index).show();
        $("#prevBtn").toggle(index > 0);
        $("#nextBtn").toggle(index < $(".quizC").length - 1);
    }

    function startTime(süre) {
        var time = süre, dakika, saniye;
        var countdown = setInterval(function () {
            dakika = parseInt(time / 60, 10);
            saniye = parseInt(time % 60, 10);

            dakika = dakika < 10 ? "0" + dakika : dakika;
            saniye = saniye < 10 ? "0" + saniye : saniye;

            $('#time').text(dakika + ":" + saniye);
            $('#KalanSüre').val(time);

            if (--time < 0) {
                clearInterval(countdown);
                $('#quizForm').submit();
            }
        }, 1000);
    }
    $('#categorySelect').on('change', function () {
        var selectedCategory = $(this).val();
        if (selectedCategory == 'all') {
            $('.cards #cardC').show();
        } else {
            $('.cards #cardC').hide();
            $('.' + selectedCategory).show();
        }   
    });
});
