<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Fluxo de Caixa</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css')?>">
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>" ></script>
<script src="<?php echo base_url('assets/js/function.js') ?>" ></script>
</head>
<body>



<div class="container">
    <div cellpadding="1" cellspacing="10" align="center" style="background-color:#13668B">
        <div>
            <div colspan="11" style="background-color:#1BA8EE;">
                <h2 style="color:#FFF; margin:5px">Fluxo de Caixa</h2>
            </div>
            <div colspan="2" align="right" style="background-color:#1BA8EE;">
                <a style="color:#FFF" href="#">Hoje:<strong> <?php echo date('d')?> de <?php echo $mes?> de <?php echo date('Y')?></strong></a>&nbsp; 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <select class="form-control" id="sel">
            <?php
            for ($i=2008;$i<=2080;$i++){
            ?>
            <option value="<?php echo $i?>" <?php if ($i==date('Y')) echo "selected=selected"?> ><?php echo $i?></option>
            <?php }?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        <ul class="nav nav-pills">
          <li><a id="mes" href="#" data="1">Janeiro</a></li>
          <li><a id="mes" href="#" data="2">Feverero</a></li>
          <li><a id="mes" href="#" data="3">Março</a></li>
          <li><a id="mes" href="#" data="4">Abril</a></li>
          <li><a id="mes" href="#" data="5">Maio</a></li>
          <li><a id="mes" href="#" data="6">Junho</a></li>
          <li><a id="mes" href="#" data="7">Julho</a></li>
          <li><a id="mes" href="#" data="8">Agosto</a></li>
          <li><a id="mes" href="#" data="9">Setembro</a></li>
          <li><a id="mes" href="#" data="10">Outubro</a></li>
          <li><a id="mes" href="#" data="11">Novembro</a></li>
          <li><a id="mes" href="#" data="12">Dezembro</a></li>
        </ul>
        </div>
    </div>

    <div class="row">
    <div class="clo-sm-12 text-right">
        <div class="btn-group">
          <?php echo anchor(site_url('movimentacao'),'Listar Movimentações', 'class="btn btn-primary"'); ?>
           <?php echo anchor(site_url('categoria'),'Listar Categorias', 'class="btn btn-primary"'); ?>
        </div>
    </div>
        <div class="col-sm-6" style="background-color:rgba(211, 255, 226, 0.5);">
            <fieldset>
                <legend><strong>Entradas e Saídas deste mês</strong></legend>
                <table class="table table-hover table-bordered">
                    <tr class="text-success">
                        <td><span style="font-size:18px;">Entradas:</span></td>
                        <td align="right"><span id="entradas" style="font-size:18px;"></span></td>
                    </tr>
                    <tr class="text-danger">
                        <td><span style="font-size:18px;">Saídas:</span></td>
                        <td align="right"><span id="saidas" style="font-size:18px;"></span></td>
                    </tr>
                    <tr>
                        <td><strong style="font-size:22px;">Resultado:</strong></td>
                        <td align="right"><strong style="font-size:18px;"><span id="resultado_mes"></span></strong></td>
                    </tr>
                </table>
            </fieldset>
        </div>
        <div class="col-sm-6" style="background-color:rgba(241, 241, 241, 0.5)">
            <fieldset>
                <legend>Balanço Geral <span id="ano"></span></legend>
                <table class="table table-hover table-bordered">
                    <tr class="text-success">
                        <td><span class="text-success" style="font-size:18px;">Entradas:</span></td>
                        <td align="right"><span id="entradas_total" style="font-size:18px;"></span></td>
                    </tr>
                    <tr class="text-danger">
                        <td><span class="text-danger" style="font-size:18px;">Saídas:</span></td>
                        <td align="right"><span id="saidas_total" style="font-size:18px;"></span></td>
                    </tr>
                    <tr>
                        <td><strong style="font-size:22px; color:">Resultado:</strong></td>
                        <td align="right"><strong style="font-size:18px;"><span id="resultado_geral"></span></strong></td>
                    </tr>
                </table>

            </fieldset>
        </div>
    </div>
    <div class="clo-sm-12 text-right">
        <div class="btn-group">
        <button id="add-movimentacao" type="button" class="btn btn-info btn-small pagar" data-toggle="modal" data-target="#myModal">Adicionar Movimentação</button>
        <button id="add-categoria" type="button" class="btn btn btn-primary btn-small pagar" data-toggle="modal" data-target="#myModal">Adicionar Categoria</button>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pagamento de Custos</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success salvar" data-dismiss="modal" data-controller="">Salvar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>" ></script>
<script src="<?php echo base_url('assets/js/atualizar.js') ?>" ></script>
</body>
</html>