<div class="center-block site">
    <h1 class="text-center">Q&A Online</h1>

    <form class="form-horizontal" method="POST" action="<?= URL_RAIZ . 'perguntas' ?>">
        <fieldset>
            <legend id="titulo"><?= $perguntas->getPergunta()?></legend>

            <?php
            switch ($perguntas->getDificuldade()){
                case '1': ?><easy>Easy Question </easy><?php break;
                case '2': ?><medium>Medium Question </medium> <?php break;
                case '3': ?><hard>Hard Question </hard><?php break;
            }

            ?>
            <!-- Multiple Radios -->

            <div class="form-group">
                <label class="col-md-4 control-label" for="radios" id="correct">Correct Answer:</label>
                <div class="col-md-4">
                    <div class="radio">
                        <label for="radios-0" id="answer">
                            <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
                            <?= $perguntas->getAlternativa1()?>
                        </label>
                    </div>
                    <div class="radio">
                        <label for="radios-1" id="answer">
                            <input type="radio" name="radios" id="radios-1" value="2">
                            <?= $perguntas->getAlternativa2()?>
                        </label>
                    </div>
                    <div class="radio">
                        <label for="radios-2" id="answer">
                            <input type="radio" name="radios" id="radios-2" value="3">
                            <?= $perguntas->getAlternativa3()?>
                        </label>
                    </div>
                    <div class="radio">
                        <label for="radios-3" id="answer">
                            <input type="radio" name="radios" id="radios-3" value="4">
                            <?= $perguntas->getAlternativa4()?>
                        </label>
                    </div>
                    <div class="radio">
                        <label for="radios-4" id="answer">
                            <input type="radio" name="radios" id="radios-4" value="5">
                            <?= $perguntas->getAlternativa5()?>
                        </label>
                    </div>
                </div>
            </div>

        </fieldset>
        <div id="send">

            <button type="submit" class="btn btn-success" >Submit</button>
            </form>
            <form action="<?= URL_RAIZ ?>perguntas" method="get">
            <button type="submit" class="btn btn-danger" >Back</button>
            </form>
        </div>
    </form>
</div>


<style>
    body{
        background-color: #2a5d84;
    }
    #titulo{
        color: black;
    }

    #correct{
        color: #00fa00;
    }
    #answer{
        color: #bfbf00;
    }

    easy{
        color: deeppink;
    }
    medium{
        color: #bfbf00;
    }
    hard{
        color: red;
    }
    legend{
        font-size: 35px;
    }
    #send{

     display: flex;
        align-items: center;
        justify-content: center;

    }
</style>