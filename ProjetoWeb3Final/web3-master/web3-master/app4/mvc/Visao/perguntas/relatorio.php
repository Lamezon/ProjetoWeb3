
<table class="table-bordered" style="width: 70%; position: absolute; top: 10%; left: 15%; right: 15%;">
    <tr>
        <th id="tableHeader">Level</th>
        <th id="tableHeader">Question</th>
        <th id="tableHeader">Errors</th>
    </tr>
<?php
foreach ($perguntas as $perguntas) : ?>
<tr>
    <?php if($perguntas-> getDificuldade()==1){
       ?> <td id="easy"> Easy </td> <?php
    } ?>
    <?php if($perguntas-> getDificuldade()==2){
        ?> <td id="medium"> Medium </td> <?php
    } ?>
    <?php if($perguntas-> getDificuldade()==3){
        ?> <td id="hard"> Hard </td> <?php
    } ?>
         <td class="tg-0lax"><?= $perguntas-> getPergunta() ?></td>
         <td class="tg-0lax"><?= $perguntas-> getAlternativa1() ?></td>
</tr>

<?php endforeach; ?>
</table>
<br>
<form action="<?= URL_RAIZ ?>perguntas" method="get">
    <button type="submit" class="btn btn-danger" >Back</button>
</form>

<style>
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

</style>