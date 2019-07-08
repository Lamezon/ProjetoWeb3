<div class="center-block site">
    <h1 class="text-center">Q&A Online</h1>

    <form class="form-horizontal" method="POST" name="resposta" action="<?= URL_RAIZ . 'perguntas/responder/' . $perguntas->getId() ?>">
        <fieldset>
            <legend id="titulo"><?= $perguntas->getPergunta()?></legend>
            <legend><?= $perguntas->getFotoPergunta() ?></legend>

            <?php

            switch ($perguntas->getDificuldade()){
                case '1': ?><easy>Easy Question </easy><?php break;
                case '2': ?><medium>Medium Question </medium> <?php break;
                case '3': ?><hard>Hard Question </hard><?php break;
            }
            ?>
            <div class="form-group" name="respostas">
                <h4>Answer 1: </h4><h5><?=$perguntas->getAlternativa1()?></h5>
                <h4>Answer 2: </h4><h5><?=$perguntas->getAlternativa2()?></h5>
                <h4>Answer 3: </h4><h5><?=$perguntas->getAlternativa3()?></h5>
                <h4>Answer 4: </h4><h5><?=$perguntas->getAlternativa4()?></h5>
                <h4>Answer 5: </h4><h5><?=$perguntas->getAlternativa5()?></h5>
            </div>


            <h3>Correct Answer is:</h3>
                <select name="respostaSelecionada" id="select">
                    <option selected="selected" value=0 disabled="">----</option>
                    <option value=1>Answer 1</option>
                    <option value=2>Answer 2</option>
                    <option value=3>Answer 3</option>
                    <option value=4>Answer 4</option>
                    <option value=5>Answer 5</option>
                </select>
                <input type="submit" value="Confirm" class="btn btn-sucess" id="confirmbutton">
        </fieldset>
        <div id="send">
            <?php
            $id_pergunta = $perguntas->getId();
            $id_usuario = $perguntas->getIdUsuario();

            ?>
    </form>

    <form action="<?= URL_RAIZ ?>perguntas" method="get">
</div>
<div id="back">
    <button type="submit" class="btn btn-danger" >Back</button>
</div>
</form>

</form>
</div>


<style>
    body{
        background-color: #2a5d84;
    }
    #confirmbutton{
        background: green;
    }
    #titulo{
        color: yellow;
    }

    easy{
        color: deeppink;
    }
    medium{
        color: #bfbf00;
    }
    h4{
        text-decoration: underline;
        font-size: 20px;
    }
    h5{
        color: yellow;
    }
    hard{
        color: red;
    }
    legend{
        color: white;
        font-size: 35px;
    }
    #send, #back{

        display: flex;
        align-items: center;
        justify-content: center;

    }
    #select {
        color: black;
        background-color: green;
    }

</style>