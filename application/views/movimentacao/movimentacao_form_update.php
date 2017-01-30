<!doctype html>
<html>
    <head>
        <title>Atualizar Movimentacao</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Movimentacao <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="int">Data <?php echo form_error('data') ?></label>
            <input type="date" class="form-control" name="data" id="data" placeholder="data" value="<?php echo $data; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Tipo <?php echo form_error('tipo') ?></label>
            <div class="radio">
              <label style="color:#030"><input type="radio" name="tipo_receita" value="1">Receita</label>
            </div>
            <div class="radio">
              <label style="color:#C00"><input type="radio" name="tipo_receita" value="0">Despesa</label>
            </div>
        </div>
        <div class="form-group">
            <label>Categoria</label>
            <?php
            $options = array ('' => 'Escolha');
            $selected = '';
            foreach($categoria as $c){
                if($cat === $c->id){
                    $selected = $c->id;
                }
                $options[$c->id] = $c->nome;
            }
            echo form_dropdown('cat', $options,$selected,'class="form-control"');
        ?>
        </div>
	    <div class="form-group">
            <label for="longtext">Descricao <?php echo form_error('descricao') ?></label>
            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descricao" value="<?php echo $descricao; ?>" />
        </div>
	    <div class="form-group">
        <label for="float">Valor <?php echo form_error('valor') ?></label>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">R$:</span>
            <input type="number" class="form-control" name="valor" id="valor" placeholder="Valor" value="<?php echo $valor; ?>" />
            </div>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('movimentacao') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>