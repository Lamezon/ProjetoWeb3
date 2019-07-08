<form method="GET" action="">
    <select name="filterSelect" id="select">
        <option selected="selected" value=0>----</option>
        <option value=1>Easy Questions</option>
        <option value=2>Medium Questions</option>
        <option value=3>Hard Questions</option>
    </select>
    <input type="submit" value="Filter" id="filterbutton">
</form>
<div>
    <table class="table-bordered" style="width: 70%;">
        <tr>
            <th id="tableHeader">Level</th>
            <th id="tableHeader">Question</th>
            <th id="tableHeader">Errors</th>
            <th id="tableHeader">Answer</th>
        </tr>
        <?php

        if((isset($_GET['filterSelect']))!=null) {
            $controleDificuldade = $_GET['filterSelect'];
            foreach ($registros as $registros) : ?>
                <?php

                switch ($_GET['filterSelect']) {


                    case '1':
                        if($controleDificuldade=='1') {
                            ?>
                            <tr>
                                <td id="easy"> Easy</td>
                                <td class="tg-0lax"><?= $registros->getPergunta() ?></td>
                                <td class="tg-0lax"><?= $registros->getErros() ?></td>
                                <td> <form action="<?= URL_RAIZ . 'perguntas/responder/' . $registros->getId() ?>"><button type="submit" class="btn btn-outline-primary" title="Answer" id="responderP" > </form></td>

                            </tr>

                            <?php
                        }
                        break;
                    case '2':
                        if($controleDificuldade=='2') {
                            ?>
                            <td id="medium"> Medium</td>
                            <td class="tg-0lax"><?= $registros->getPergunta() ?></td>
                            <td class="tg-0lax"><?= $registros->getErros() ?></td>
                            <td> <form action="<?= URL_RAIZ . 'perguntas/responder/' . $registros->getId() ?>"><button type="submit" class="btn btn-outline-primary" title="Answer" id="responderP" > </form></td>

                            </tr>
                            <?php
                        }
                        break;
                    case '3':
                        if($controleDificuldade=='3') {
                            ?>
                            <td id="hard"> Hard</td>
                            <td class="tg-0lax"><?= $registros->getPergunta() ?></td>
                            <td class="tg-0lax"><?= $registros->getErros() ?></td>
                            <td> <form action="<?= URL_RAIZ . 'perguntas/responder/' . $registros->getId() ?>"><button type="submit" class="btn btn-outline-primary" title="Answer" id="responderP" > </form></td>

                            </tr>
                            <?php
                        }
                        break;

                }

            endforeach;
            }


                if ((isset($_GET['filterSelect'])) == null) {
                    foreach ($perguntas as $perguntas) : ?>
                        <?php
                        if ($perguntas->getDificuldade() == 1) {
                            ?>
                            <td id="easy"> Easy</td> <?php
                        } ?>
                        <?php if ($perguntas->getDificuldade() == 2) {
                            ?>
                            <td id="medium"> Medium</td> <?php
                        } ?>
                        <?php if ($perguntas->getDificuldade() == 3) {
                            ?>
                            <td id="hard"> Hard</td> <?php
                        } ?>
                        <td class="tg-0lax"><?= $perguntas->getPergunta() ?></td>
                        <td class="tg-0lax"><?= $perguntas->getErros() ?></td>
                        <td> <form action="<?= URL_RAIZ . 'perguntas/responder/' . $registros->getId() ?>"><button type="submit" class="btn btn-outline-primary" title="Answer" id="responderP" > </form></td>

                        </tr>
                    <?php
                    endforeach;
                }
        ?>
    </table>
    <form action="<?= URL_RAIZ ?>perguntas" method="get">
        <button type="submit" class="btn btn-danger" >Back</button>
    </form>
</div>
<style>
    #filterbutton {
        background-color: black;



    }
    #select {
        text-color: #red;
        background-color: black;
    }
    #tableHeader {
        font-size: 25px;
        background-color: black;

    }
    #easy {
        color: lightgreen;
    }
    #medium{
        color: yellow;
    }
    #hard {
        color: red;
    }
    #responderP {

        background-color: yellow;
    }
    }

</style>