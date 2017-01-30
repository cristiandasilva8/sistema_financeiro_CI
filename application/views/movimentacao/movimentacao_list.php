<!doctype html>
<html>
    <head>
        <title>Lista de Movimentações</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Lista de Movimentações</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('movimentacao/create'),'Cadsatrar', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('movimentacao/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('movimentacao'); ?>" class="btn btn-default">Limpar</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Procurar</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>Código</th>
        		<th>Tipo</th>
        		<th>Data</th>
        		<th>Categoria</th>
        		<th>Descricao</th>
        		<th>Valor</th>
        		<th>Ações</th>
            </tr><?php
            foreach ($movimentacao_data as $movimentacao)
            {
                ?>
                <tr>
        			<td width="80px"><?php echo $movimentacao->id ?></td>
        			<td><?php echo ($movimentacao->tipo == 1) ? "Receita" : "Despesa" ?></td>
        			<td><?php echo $movimentacao->dia ."/". $movimentacao->mes ."/". $movimentacao->ano?></td>
        			<td><?php echo $movimentacao->nome_categoria ?></td>
        			<td><?php echo $movimentacao->descricao ?></td>
        			<td><?php 
                        echo sprintf('%.2f', $movimentacao->valor); ?></td>
        			<td style="text-align:center" width="200px">
        				<?php 
        				echo anchor(site_url('movimentacao/read/'.$movimentacao->id),'Visualizar'); 
        				echo ' | '; 
        				echo anchor(site_url('movimentacao/update/'.$movimentacao->id),'Atualizar'); 
        				echo ' | '; 
        				echo anchor(site_url('movimentacao/delete/'.$movimentacao->id),'Excluix','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
        				?>
        			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total de Registros : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('movimentacao/excel'), 'Exportar para Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
   </body>
</html>