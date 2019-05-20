<?php

session_start();

if ($_SESSION['logado'] !== true) {
    header("Location: login.php");
} else {

    error_reporting(0);

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agendar consulta</title>

        <link rel="stylesheet" href="agendarConsulta.css">
    </head>

    <body>

        <?php

        include_once 'model/planoSaude.php';
        include_once 'model/cirurgia.php';
        include_once 'model/consulta.php';
        include_once 'dao/conexao.php';
        include_once 'dao/planoSaudeDAO.php';
        include_once 'dao/cirurgiaDAO.php';
        include_once 'dao/consultaDAO.php';

        require_once 'menu.php';

        $planoSaude = '';
        $data = '';
        $horario = '';
        $cirurgia = '';
        $preco = '';
        $pagamento = '';

        $action = 'inserir';

        if (isset($_GET['editar'])) {

            $consulta = consultaDAO::getConsultaByCodigo($_GET['codigo']);

            $planoSaude = $consulta->getPlanoSaude()->getNome();
            $data = $consulta->getData();
            $horario = $consulta->getHorario();
            $cirurgia = $consulta->getCirurgia()->getNome();
            $preco = $consulta->getCirurgia()->getPreco();
            $pagamento = $consulta->getPagamento();

            $action = 'editar&codigo=' . $_GET['codigo'];
        }

        ?>

        <div class="div-form">
            <form action="controller/salvarConsulta.php?<?php echo $action; ?>" method="POST">
                <h1>Agendar consulta</h1>

                <div class="div-plano-saude">

                    <?php

                    $checkedSus = '';
                    $checkedConvenio = '';
                    $checkedParticular = '';

                    if ($planoSaude == 'SUS')
                        $checkedSus = 'checked';
                    else if ($planoSaude == 'Particular')
                        $checkedParticular = 'checked';
                    else if ($planoSaude != '')
                        $checkedConvenio = 'checked';

                    ?>

                    <label>
                        <input type="radio" <?php echo $checkedSus; ?> name="plano" id="sus" value="SUS">
                        SUS
                        <span></span>
                    </label>

                    <label>
                        <input type="radio" <?php echo $checkedConvenio; ?> name="plano" id="convenio" value="Convênio">
                        Convênio
                        <span></span>
                    </label>

                    <label>
                        <input type="radio" <?php echo $checkedParticular; ?> name="plano" id="particular" value="Particular">
                        Particular
                        <span></span>
                    </label>
                </div>

                <div id="divContainerCalendario">
                    <div id="divCalendario">
                        <h3 id="h3MesAno"></h3>
                        <table id="tableDivCalendario">
                            <thead>
                                <tr>
                                    <th>Dom</th>
                                    <th>Seg</th>
                                    <th>Ter</th>
                                    <th>Qua</th>
                                    <th>Qui</th>
                                    <th>Sex</th>
                                    <th>Sáb</th>
                                </tr>
                            </thead>

                            <tbody id="tbodyDivCalendario"></tbody>
                        </table>

                        <div id="divButtons">
                            <button id="buttonRetroceder" type="button">Retroceder</button>
                            <button id="buttonAvancar" type="button">Avançar</button>
                        </div>
                        <div id="divLabelSelectMesAno">
                            <label for="selectMes">Pular para: </label>
                            <div id="divSelectMesAno">
                                <select id="selectMes">
                                    <option value="0">Jan</option>
                                    <option value="1">Fev</option>
                                    <option value="2">Mar</option>
                                    <option value="3">Abr</option>
                                    <option value="4">Mai</option>
                                    <option value="5">Jun</option>
                                    <option value="6">Jul</option>
                                    <option value="7">Ago</option>
                                    <option value="8">Set</option>
                                    <option value="9">Out</option>
                                    <option value="10">Nov</option>
                                    <option value="11">Dez</option>
                                </select>

                                <label for="selectAno"></label>
                                <select id="selectAno">
                                    <option value="1990">1990</option>
                                    <option value="1991">1991</option>
                                    <option value="1992">1992</option>
                                    <option value="1993">1993</option>
                                    <option value="1994">1994</option>
                                    <option value="1995">1995</option>
                                    <option value="1996">1996</option>
                                    <option value="1997">1997</option>
                                    <option value="1998">1998</option>
                                    <option value="1999">1999</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="div-data-consulta-marcada">
                    <div class="div-data">
                        <label>Data:</label>
                        <input type="text" name="data" value="<?php echo $data; ?>" readonly>
                    </div>

                    <div class="div-consulta-marcada">
                        <span>* Data e horário indisponíveis!</span>
                    </div>
                </div>

                <div class="div-select div-horario">
                    <h2>Horário</h2>
                    <select name="horario">

                        <?php

                        echo '<option value="0">Selecione...</option>';

                        $horarios = [
                            '08:00', '08:45', '09:30', '10:15', '11:00', '11:45', '12:30',
                            '13:15', '14:00', '14:45', '15:30', '16:15', '17:00', '17:45'
                        ];

                        foreach ($horarios as $item) {

                            $selected = '';

                            if ($item == $horario) {
                                $selected = 'selected';
                            }

                            echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
                        }

                        ?>

                    </select>
                </div>

                <div class="div-select div-consulta">
                    <h2>Cirurgia</h2>
                    <select name="cirurgia">
                        <?php

                        $lista = cirurgiaDAO::getCirurgias();

                        if ($lista->count() == 0) {
                            echo '<option value="0">Nenhuma cirurgia cadastrada</option>';
                        } else {
                            echo '<option value="0">Selecione...</option>';

                            foreach ($lista as $item) {

                                $selected = '';

                                if ($item->getNome() == $cirurgia)
                                    $selected = 'selected';

                                echo '<option value="' . $item->getNome() . '" ' . $selected . '>' . $item->getNome() . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="div-pagamento">

                    <?php

                    $checkedVisa = '';
                    $checkedMastercard = '';

                    if ($pagamento == 'Visa')
                        $checkedVisa = 'checked';
                    else if ($pagamento == 'Mastercard')
                        $checkedMastercard = 'checked';

                    ?>

                    <label class="label-visa">
                        <input type="radio" <?php echo $checkedVisa; ?> name="pagamento" id="visa" value="Visa">
                    </label>

                    <label class="label-mastercard">
                        <input type="radio" <?php echo $checkedMastercard; ?> name="pagamento" id="mastercard" value="Mastercard">
                    </label>
                </div>

                <div class="div-span-dados-incompletos">
                    <span>* Preencha todos os campos!</span>
                </div>
                
                <input type="submit" value="Agendar">
            </form>
        </div>

        <script src="jquery-3.3.1.js"></script>
        <script src="agendarConsulta.js"></script>

        <?php if ($planoSaude != '') { ?>

            <script>
                setPlanoSaude("<?php echo $planoSaude; ?>");
            </script>

        <?php } ?>

        <?php if ($pagamento != '') { ?>

            <script>
                setPagamento("<?php echo $pagamento; ?>");
            </script>

        <?php } ?>
    </body>

    </html>

<?php
}
