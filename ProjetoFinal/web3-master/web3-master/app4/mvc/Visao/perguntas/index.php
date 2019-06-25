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
            <div class="form-group <?= $this->getErroCss('texto') ?>">
                <input id="texto" name="texto" class="form-control campo-medio" autofocus placeholder="Pergunta" value="<?= $this->getPost('texto') ?>">
                <br>
                <input id="resposta1" name="resposta1" class="form-control campo-grande" autofocus placeholder="Primeira Alternativa" value="<?= $this->getPost('texto') ?>">
                <br>
                <input id="resposta2" name="resposta2" class="form-control campo-grande" autofocus placeholder="Segunda Alternativa" value="<?= $this->getPost('texto') ?>">
                <br>
                <input id="resposta3" name="resposta3" class="form-control campo-grande" autofocus placeholder="Terceira Alternativa" value="<?= $this->getPost('texto') ?>">
                <br>
                <input id="resposta4" name="resposta4" class="form-control campo-grande" autofocus placeholder="Quarta Alternativa" value="<?= $this->getPost('texto') ?>">
                <br>
                <input id="resposta5" name="resposta5" class="form-control campo-grande" autofocus placeholder="Quinta Alternativa" value="<?= $this->getPost('texto') ?>">

            </div>
            <button type="submit" class="btn btn-default">Criar pergunta</button>

            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'texto']) ?>
        </form>

    </div>

    <h2>Todas as perguntas do Q&A</h2>
    <?php foreach ($pergunta as $pergunta) : ?>
        <form action="<?= URL_RAIZ . 'perguntas/' . $mensagem->getId() ?>" method="post" class="clearfix margin-bottom">
            <input type="hidden" name="_metodo" value="DELETE">
            <img src="<?= URL_IMG . $mensagem->getUsuario()->getImagem() ?>" alt="Imagem do perfil" class="imagem-usuario pull-left">
            <strong><?= $mensagem->getUsuario()->getEmail() ?>:</strong>
            <?= $mensagem->getTexto() ?>
            <br>
            <button type="submit" class="btn btn-xs btn-danger" title="Deletar">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </form>
    <?php endforeach ?>
    <div>
        <?php if ($pagina > 1) : ?>
            <a href="<?= URL_RAIZ . 'perguntas?p=' . ($pagina-1) ?>" class="btn btn-default">Página anterior</a>
        <?php endif ?>
        <?php if ($pagina < $ultimaPagina) : ?>
            <a href="<?= URL_RAIZ . 'perguntas?p=' . ($pagina+1) ?>" class="btn btn-default">Próxima página</a>
        <?php endif ?>
    </div>
</div>
