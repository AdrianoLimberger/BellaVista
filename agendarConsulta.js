$('.div-plano-saude input[type="radio"]').change(function () {
    $(this).closest("label").siblings().find("span").css("backgroundColor", "transparent");
    $(this).closest("label").siblings().find("span").css("border-color", "#808080");
    $(".div-plano-saude label").css("color", "#808080");

    $(this).closest("label").find("span").css("backgroundColor", "#7ed56f");
    $(this).closest("label").find("span").css("border-color", "#7ed56f");
    $(this).closest("label").css("color", "#28b485");
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

let dataAtual = new Date();
let mesAtual = dataAtual.getMonth();
let anoAtual = dataAtual.getFullYear();

let selectAno = document.getElementById("selectAno");
let selectMes = document.getElementById("selectMes");

let arrayMeses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];

let h3MesAno = document.getElementById("h3MesAno");

criarCalendario(mesAtual, anoAtual);

$(document).on("click", "#buttonRetroceder", function () {
    retroceder();
});

function retroceder() {

    if (mesAtual == 0) {
        mesAtual = 11;
        anoAtual -= 1;
    } else {
        mesAtual -= 1;
    }

    criarCalendario(mesAtual, anoAtual);
}

$(document).on("click", "#buttonAvancar", function () {
    avancar();
});

function avancar() {

    if (mesAtual == 11)
        anoAtual += 1;

    mesAtual = (mesAtual + 1) % 12;

    criarCalendario(mesAtual, anoAtual);
}

$(document).on("change", "#divSelectMesAno select", function () {
    pularData();
});

function pularData() {

    anoAtual = selectAno.value;
    mesAtual = selectMes.value;

    criarCalendario(mesAtual, anoAtual);
}

function criarCalendario(mes, ano) {

    let numeroDiaSemana = new Date(ano, mes).getDay();

    let numeroDiasMes = 32 - new Date(ano, mes, 32).getDate();

    let tbodyDivCalendario = document.getElementById("tbodyDivCalendario");

    tbodyDivCalendario.innerHTML = "";

    h3MesAno.innerHTML = arrayMeses[mes] + " " + ano;
    selectAno.value = ano;
    selectMes.value = mes;

    let diaMes = 1;

    for (let i = 0; i < 6; i++) {

        let linha = document.createElement("tr");

        for (let j = 0; j < 7; j++) {

            if (i == 0 && j < numeroDiaSemana) {
                let td = document.createElement("td");
                let tdTexto = document.createTextNode("");
                td.appendChild(tdTexto);
                linha.appendChild(td);

            } else if (diaMes > numeroDiasMes)
                break;
            else {

                let td = document.createElement("td");
                let tdTexto = document.createTextNode(diaMes);
                if (diaMes == dataAtual.getDate() && mes == dataAtual.getMonth() && ano == dataAtual.getFullYear()) {
                    td.style.backgroundColor = "#7ed56f";
                }
                td.appendChild(tdTexto);
                linha.appendChild(td);
                diaMes++;
            }
        }
        tbodyDivCalendario.appendChild(linha);
    }
}

$(document).on("click", "td", function () {

    $("td").css("backgroundColor", "#fff")
    $(this).css("backgroundColor", "#7ed56f");

    let dia = $(this).text();
    let mesAno = $("#h3MesAno").text();
    let mes = mesAno.substring(0, 3);
    mes = arrayMeses.indexOf(mes) + 1;
    let ano = mesAno.substring(4);

    $(".div-data input").val(dia + "/" + mes + "/" + ano);

    let data = $(".div-data input").val();
    let horario = $(".div-horario select").val();

    $.ajax({
        type: 'POST',
        url: 'ajax.php?verificarAgendarConsulta',
        data: { data: data, horario: horario },
        datatype: 'json',
        success: function (data) {

            let verificar = $.parseJSON(data);

            if (verificar == true) {
                $(".div-consulta-marcada").css("visibility", "visible");
            } else {
                $(".div-consulta-marcada").css("visibility", "hidden");
            }
        }
    });

});

$(".div-horario select").change(function () {

    let data = $(".div-data input").val();
    let horario = $(this).val();

    $.ajax({
        type: 'POST',
        url: 'ajax.php?verificarAgendarConsulta',
        data: { data: data, horario: horario },
        datatype: 'json',
        success: function (data) {

            let verificar = $.parseJSON(data);

            if (verificar == true) {
                $(".div-consulta-marcada").css("visibility", "visible");
            } else {
                $(".div-consulta-marcada").css("visibility", "hidden");
            }
        }
    });
});

$('.div-pagamento input[type="radio"]').change(function () {
    $(".div-pagamento label").css("backgroundImage", "none");
    $(".div-pagamento label").css("background-color", "#fff");
    $(".div-pagamento label").css("border-color", "#808080");

    $(this).closest("label").css("backgroundImage", "url('img/icones/check-branco.png')");
    $(this).closest("label").css("background-color", "#7ed56f");
    $(this).closest("label").css("border-color", "#28b485");
});

function setPagamento(pagamento) {

    if (pagamento == 'Visa') {
        $(".div-pagamento .label-visa").css("backgroundImage", "url('img/icones/check-branco.png')");
        $(".div-pagamento .label-visa").css("background-color", "#7ed56f");
        $(".div-pagamento .label-visa").css("border-color", "#28b485");
    } else {
        $(".div-pagamento .label-mastercard").css("backgroundImage", "url('img/icones/check-branco.png')");
        $(".div-pagamento .label-mastercard").css("background-color", "#7ed56f");
        $(".div-pagamento .label-mastercard").css("border-color", "#28b485");
    }
}

$("form").submit(function (e) {

    if (!document.getElementById('sus').checked
        && !document.getElementById('convenio').checked
        && !document.getElementById('particular').checked
        || $(".div-data input").val() == ''
        || $(".div-horario select").val() == 0
        || $(".div-consulta select").val() == 0
        || !document.getElementById("visa").checked
        && !document.getElementById("mastercard").checked
        || $(".div-consulta-marcada").css("visibility") == 'visible') {

            $(".div-span-dados-incompletos").css("visibility", "visible");

            e.preventDefault();
    }
});