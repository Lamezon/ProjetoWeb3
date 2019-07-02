<div class="center-block site">
    <h1 class="text-center">Q&A Online</h1>

    <?php if ($mensagemFlash) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagemFlash ?>
        </div>
    <?php endif ?>

    <form action="<?= URL_RAIZ . 'perguntas/relatorio';?>" method="get">
        <input type="hidden" name="_metodo" value="GET">
        <button type="submit" class="btn btn-success">Relatorio</button>
    </form>

    <form action="<?= URL_RAIZ . 'login' ?>" method="post">
        <input type="hidden" name="_metodo" value="DELETE">
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    <h2>Create Question</h2>
    <div class="margin-bottom">
        <form action="<?= URL_RAIZ . 'perguntas' ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('photo') ?>">
                <label class="control-label" for="photo">Question Picture (PNG file)</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'photo']) ?>
                <input id="photo" name="photo" class="form-control" type="file">
            </div>
            <br><br>
            <div class="form-group <?= $this->getErroCss('pergunta') ?>">
                <input id="pergunta" name="pergunta" class="form-control campo-medio" autofocus placeholder="Question" value="<?= $this->getPost('pergunta') ?>">
                <br>
                <input id="alternativa_1" name="alternativa_1" class="form-control campo-grande" autofocus placeholder="First Answer" value="<?= $this->getPost('alternativa_1') ?>">
                <br>
                <input id="alternativa_2" name="alternativa_2" class="form-control campo-grande" autofocus placeholder="Second Answer" value="<?= $this->getPost('alternativa_2') ?>">
                <br>
                <input id="alternativa_3" name="alternativa_3" class="form-control campo-grande" autofocus placeholder="Third Answer" value="<?= $this->getPost('alternativa_3') ?>">
                <br>
                <input id="alternativa_4" name="alternativa_4" class="form-control campo-grande" autofocus placeholder="Fourth Answer" value="<?= $this->getPost('alternativa_4') ?>">
                <br>
                <input id="alternativa_5" name="alternativa_5" class="form-control campo-grande" autofocus placeholder="Fifth Answer" value="<?= $this->getPost('alternativa_5') ?>">

            </div>
            <div class="form-group <?= $this->getErroCss('dificulty') ?>">
                <label class="control-label" for="dificulty">Dificulty</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'dificulty']) ?>
                <select id="dificulty" name="dificulty" class="form-control" autofocus>
                        <?php $selected = $this->getPost('dificulty')  ? 'selected' : '' ?>
                        <option value=1>Easy</option>
                        <option value=2>Medium</option>
                        <option value=3>Hard</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Create Question</button>

            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'pergunta']) ?>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'alternativa_1']) ?>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'alternativa_2']) ?>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'alternativa_3']) ?>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'alternativa_4']) ?>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'alternativa_5']) ?>
        </form>

    </div>

    <h2>All Q&A</h2>
    <?php
    foreach ($perguntas as $perguntas) : ?>
        <form action="<?= URL_RAIZ . 'perguntas/responder/' . $perguntas->getId();?>" method="post">
            <input type="hidden" name="_metodo" value="GET">
            <?= $perguntas->getPergunta() ?>
            <button type="submit" class="btn btn-xs btn-group-xs" title="Answer" id="editar"> ANSWER
                <span class="glyphicon glyphicon-education"></span>
            </button>
        </form>
        <form action="<?= URL_RAIZ . 'perguntas/' . $perguntas->getId() ?>" method="post" class="clearfix margin-bottom">
            <input type="hidden" name="_metodo" value="DELETE">
            <button type="submit" class="btn btn-xs btn-danger" title="Delete">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </form>
    --------------------------------------------------------------------------
    <?php endforeach; ?>
    <div>
        <?php if ($pagina > 1) : ?>
            <a href="<?= URL_RAIZ . 'perguntas?p=' . ($pagina-1) ?>" class="btn btn-default">Prev</a>
        <?php endif ?>
        <?php if ($pagina < $ultimaPagina) : ?>
            <a href="<?= URL_RAIZ . 'perguntas?p=' . ($pagina+1) ?>" class="btn btn-default">Next</a>
        <?php endif ?>
    </div>
</div>
<style>
    body{
        background-color: #2a5d84;
    }
    #photo{
        height: 40px;
        width: 148px;
        background-color: darkblue;
    }

    #editar{
        color: black;
        background-color: #2b669a;
    }
</style>