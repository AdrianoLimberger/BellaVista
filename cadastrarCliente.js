$(document).ready(function () {
    $('#input-cpf').mask('000.000.000-00');
});

$('.div-plano-saude input[type="radio"]').change(function () {
    $(this).closest("label").siblings().find("span").css("backgroundColor", "transparent");
    $(this).closest("label").siblings().find("span").css("border-color", "#808080");
    $(".div-plano-saude label").css("color", "#808080");

    $(this).closest("label").find("span").css("backgroundColor", "#7ed56f");
    $(this).closest("label").find("span").css("border-color", "#7ed56f");
    $(this).closest("label").css("color", "#28b485");

    if ($(this).val() == "Convênio")
        $(".div-select").css("display", "block");
    else
        $(".div-select").css("display", "none");
});

function setPlanoSaude(planoSaude) {

    if (planoSaude == 'SUS') {
        $(".div-plano-saude label:nth-child(1) span").css("backgroundColor", "#7ed56f");
        $(".div-plano-saude label:nth-child(1) span").css("border-color", "#7ed56f");
        $(".div-plano-saude label:nth-child(1)").closest("label").css("color", "#28b485");
    } else if (planoSaude == 'Particular') {
        $(".div-plano-saude label:nth-child(3) span").css("backgroundColor", "#7ed56f");
        $(".div-plano-saude label:nth-child(3) span").css("border-color", "#7ed56f");
        $(".div-plano-saude label:nth-child(3)").closest("label").css("color", "#28b485");
    } else {
        $(".div-plano-saude label:nth-child(2) span").css("backgroundColor", "#7ed56f");
        $(".div-plano-saude label:nth-child(2) span").css("border-color", "#7ed56f");
        $(".div-plano-saude label:nth-child(2)").closest("label").css("color", "#28b485");
    }
}

function showPlanosSaude() {
    $(".div-select").css("display", "block");
}