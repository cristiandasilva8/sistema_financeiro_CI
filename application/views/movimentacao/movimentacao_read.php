<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Movimentacao Read</h2>
        <table class="table">
	    <tr><td>Tipo</td><td><?php echo $tipo; ?></td></tr>
	    <tr><td>Dia</td><td><?php echo $dia; ?></td></tr>
	    <tr><td>Mes</td><td><?php echo $mes; ?></td></tr>
	    <tr><td>Ano</td><td><?php echo $ano; ?></td></tr>
	    <tr><td>Cat</td><td><?php echo $cat; ?></td></tr>
	    <tr><td>Descricao</td><td><?php echo $descricao; ?></td></tr>
	    <tr><td>Valor</td><td><?php echo $valor; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('movimentacao') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>