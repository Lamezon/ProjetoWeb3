<?php if ($this->temErro($campo)): ?>
    <span class="help-block"><?= $this->getErro($campo) ?></span>
<?php endif ?>
<style>
    .help-block{
        font-size: 20px;
        color: red;
    }


</style>
