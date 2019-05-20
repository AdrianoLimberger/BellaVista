let cpf = '';

function setCpf(sessionCpf) {
    cpf = sessionCpf;

    getConsultasByCpf();
}

function getConsultasByCpf() {

    $.ajax({
        type: 'POST',
        url: 'ajax.php?getConsultas',
        data: { cpf: cpf },
        datatype: 'json',
        success: function (data) {

            let lista = $.parseJSON(data);

            if (lista == null) {

            } else {
                criarLista(lista);
            }
        }
    });
}

function criarLista(lista) {

    let divContainer = document.getElementById("div-container");

    let titulos = ['Código', 'Data', 'Horário', 'Preço', 'Pagamento', 'Cirurgia', 'Plano de saúde', 'CPF', 'Paciente', 'Idade'];

    let dados = ['codigo', 'data', 'horario', 'cirurgiaPreco', 'pagamento', 'cirurgiaNome', 'planoSaudeNome', 'clienteCpf', 'clienteNome', 'clienteIdade'];

    for (let i = 0; i < lista['contador']; i++) {
        let divConsulta = document.createElement("div");
        divConsulta.classList.add("div-consulta");

        for (let j = 0; j < 10; j++) {

            let divDados = document.createElement("div");
            divDados.classList.add("div-dados");

            let h2 = document.createElement("h2");
            h2.innerHTML = titulos[j];

            let p = document.createElement("p");

            if (j == 3)
                p.innerHTML = 'R$' + lista[dados[j] + i];
            else {
                if (j == 0)
                    p.classList.add("p-codigo");

                p.innerHTML = lista[dados[j] + i];
            }

            divDados.appendChild(h2);
            divDados.appendChild(p);

            divConsulta.appendChild(divDados);

        }

        let imgEditar = document.createElement("img");
        imgEditar.setAttribute("src", "img/icones/editar.png");
        imgEditar.classList.add("img-editar");

        divConsulta.appendChild(imgEditar);

        divContainer.appendChild(divConsulta);
    }
}

$(document).on('click', '.img-editar', function () {
    let codigo = $(this).closest(".div-consulta").find(".p-codigo").text();

    window.location.href = 'agendarConsulta.php?editar&codigo=' + codigo;
});