<div class="center-block site">
    <h1 class="text-center">Perguntas Online</h1>
    
    <?php if ($mensagemFlash) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagemFlash ?>
        </div>
    <?php endif ?>
    <form action="<?= URL_RAIZ . 'login' ?>" method="post">
        <input type="hidden" name="_metodo" value="DELETE">
        <button type="submit" class="btn btn-danger">Sair</button>
    </form>
    <h2>Criar Pergunta</h2>
    <div class="margin-bottom">
        <form action="<?= URL_RAIZ . 'perguntas' ?>" method="post">
            <div class="form-group <?= $this->getErroCss('pergunta') ?>">
                <input id="pergunta" name="pergunta" class="form-control campo-medio" autofocus placeholder="Pergunta" value="<?= $this->getPost('pergunta') ?>">
                <br>
                <input id="alternativa1" name="alternativa1" class="form-control campo-grande" autofocus placeholder="Primeira Alternativa" value="<?= $this->getPost('alternativa1') ?>">
                <br>
                <input id="alternativa2" name="alternativa2" class="form-control campo-grande" autofocus placeholder="Segunda Alternativa" value="<?= $this->getPost('alternativa2') ?>">
                <br>
                <input id="alternativa3" name="alternativa3" class="form-control campo-grande" autofocus placeholder="Terceira Alternativa" value="<?= $this->getPost('alternativa3') ?>">
                <br>
                <input id="alternativa4" name="alternativa4" class="form-control campo-grande" autofocus placeholder="Quarta Alternativa" value="<?= $this->getPost('alternativa4') ?>">
                <br>
                <input id="alternativa5" name="alternativa5" class="form-control campo-grande" autofocus placeholder="Quinta Alternativa" value="<?= $this->getPost('alternativa5') ?>">

            </div>
            <button type="submit" class="btn btn-default">Criar pergunta</button>

            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'pergunta']) ?>
        </form>

    </div>

    <h2>Todas as perguntas do Q&A</h2>
    <?php
    foreach ($pergunta as $pergunta) : ?>
        <form action="<?= URL_RAIZ . 'perguntas/' . $pergunta->getPergunta() ?>" method="post" class="clearfix margin-bottom">
            <input type="hidden" name="_metodo" value="DELETE">

            <?= $pergunta->getUsuario() ?>
            <br>
            <button type="submit" class="btn btn-xs btn-success" title="Responder">
                <span class="glyphicon glyphicon-edit"></span>
            </button>
            <button type="submit" class="btn btn-xs btn-danger" title="Deletar">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </form>
    <?php endforeach; ?>
    <div>
        <?php if ($pagina > 1) : ?>
            <a href="<?= URL_RAIZ . 'perguntas?p=' . ($pagina-1) ?>" class="btn btn-default">Página anterior</a>
        <?php endif ?>
        <?php if ($pagina < $ultimaPagina) : ?>
            <a href="<?= URL_RAIZ . 'perguntas?p=' . ($pagina+1) ?>" class="btn btn-default">Próxima página</a>
        <?php endif ?>
    </div>
</div>
<style>
    body{
        background-color: #2a5d84;
    }

</style>