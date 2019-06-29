<div class="center-block site">
    <div class="col-sm-6 col-sm-offset-3">
        <h1 class="text-center">Register on Q&A!</h1>
        <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post" class="margin-bottom" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('login') ?>">
                <label class="control-label" for="login">Username*</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
                <input id="login" name="login" class="form-control" autofocus value="<?= $this->getPost('login') ?>">
            </div>
            <div class="form-group <?= $this->getErroCss('password') ?>">
                <label class="control-label" for="password">Password *</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'password']) ?>
                <input id="password" name="password" class="form-control" type="password">
            </div>
            <div class="form-group <?= $this->getErroCss('password2') ?>">
                <label class="control-label" for="password2">Reinsert Password *</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'password2']) ?>
                <input id="password2" name="password2" class="form-control" type="password">
            </div>
            <div class="form-group <?= $this->getErroCss('photo') ?>">
                <label class="control-label" for="photo">Picture (PNG file)</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'photo']) ?>
                <input id="photo" name="photo" class="form-control" type="file">
            </div>
            <button type="submit" class="btn btn-primary center-block">Create Account</button>
        </form>
        <p class="text-center">
            <a href="<?= URL_RAIZ . 'login' ?>">Back</a>
        <p class="text-danger"> *Required fields  </p>
        </p>
    </div>

</div>
