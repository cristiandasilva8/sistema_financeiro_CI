
<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Nome <?php echo form_error('nome') ?></label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?php echo $nome; ?>" />
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
</form>
