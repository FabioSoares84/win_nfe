<div class="conteudo-fluido">
    <div class="caixa">
	<div class="caixa-titulo py-1 d-flex justify-content-space-between">
            <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Lista de emitente</span>
            <div>
                <a href="javascript:;" onclick="abrirModal('#janela1')" class="btn btn-verde  d-inline-block"><i class="fas fa-plus-circle mb-0"></i> Adicionar novo</a>
                <a href="" class="btn btn-amarelo filtro mx-1 d-inline-block"><i class="fas fa-filter"></i> Filtrar</a>
            </div>
        </div>
			 
	<div class="rows">	
            <div class="col-12">
                <div class="col-12 mt-3 mb-3">    				
                    <div class="radius-4 p-2 mostraFiltro bg-padrao">    				
                        <form action="" method="">
                            <div class="rows px-2 pb-3">  	
                                <div class="col-9">
                                    <label class="text-label text-branco">Empresa</label>	
                                    <input type="text" value="" name="razao_social" placeholder="Digite aqui..." class="form-campo">
                                </div>
                                <div class="col-3 mt-4">	
                                    <input type="submit" value="Pesquisar" class="btn btn-verde width-100 text-uppercase">
                                </div>
                            </div> 
                        </form>
                    </div>               
		</div>               
		<div class="col-12">
                    <div class="tabela-responsiva px-0">
                        <?php 
                           $this->verMsg();
                        ?>
			<table cellpadding="0" cellspacing="0" id="dataTable">
                            <thead>
                                <tr>
                                    <th align="center">Id</th>
                                    <th align="left" width="270">Empresa</th>
                                    <th align="center" width="270">Fantasia</th>
                                    <th align="center">CNPJ</th>
                                    <th align="center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($lista as $emitente){?>    
                                <tr>
                                    <td align="center"><?php echo $emitente->id_emitente   ?></td>
                                    <td align="center"><?php echo $emitente->razao_social  ?></td>
                                    <td align="center"><?php echo $emitente->nome_fantasia ?></td>
                                    <td align="center"><?php echo $emitente->cnpj?></td>
                                    <td align="center">
                                        <a href="<?php echo URL_BASE."emitente/edit/".$emitente->id_emitente ?>" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-edit"></i> Editar</a>
                                        <a href="javascript:;" onclick="excluir(this)" data-entidade="emitente" data-id="<?php echo $emitente->id_emitente ?>" class="d-inline-block btn btn-outline-vermelho btn-pequeno"><i class="fas fa-trash-alt"></i> Excluir</a>
                                    </td>
                                </tr>   
                            <?php }?>    
                            </tbody>
    			    <tfoot>
                                <tr>
                                    <th align="center">Id</th>
                                    <th align="left" width="270">Empresa</th>
                                    <th align="center" width="270">Fantasia</th>
                                    <th align="center">CNPJ</th>
                                    <th align="center">Ação</th>
                                </tr>
                            </tfoot>
			</table>
                    </div>
		</div> 
            </div>
        </div>
   </div>
</div>

<div class="window formulario" id="janela1">
<div class="p-4 width-100 d-inline-block">
<form action="" method="">
	<div class="rows">
		<div class="col-12">
			<span class="label text-label">Nome</span>
			<input type="text" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-4">
			<span class="label text-label">Endereço</span>
			<input type="text" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-4">
			<span class="label text-label">Cidade</span>
			<input type="text" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-4">
			<span class="label text-label">Bairro</span>
			<input type="text" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-4">
			<span class="label text-label">Telefone</span>
			<input type="text" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-4">
			<span class="label text-label">Cep</span>
			<input type="text" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-4">
			<span class="label text-label">Sexo</span>
			<input type="radio" name="sexo" value="M"><label> Masculino</label>
			<input type="radio" name="sexo" value="F"><label> Feminino</label>
		</div>
		<div class="col-6">
			<span class="label text-label">Opções</span>
			<div class="d-inline-block mr-1"><input type="checkbox" name="" value="1"><label> Opção 1</label></div>
			<div class="d-inline-block mr-1"><input type="checkbox" name="" value="3"><label> Opção 2</label></div>
			<div class="d-inline-block mr-1"><input type="checkbox" name="" value="3"><label> Opção 3</label></div>
			<div class="d-inline-block mr-1"><input type="checkbox" name="" value="3"><label> Opção 4</label></div>
		</div>
		<div class="col-6">
			<span class="label text-label">Seleção</span>
			<select class="form-campo campo-form">
				<option>Opçoes</option>
				<option>Opçoes</option>
				<option>Opçoes</option>
			</select>
		</div>
		<div class="col-6">
			<span class="label text-label">Data</span>
			<input type="date" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-3">
			<span class="label text-label">Número</span>
			<input type="number" value="1" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-3">
			<span class="label text-label">Hora</span>
			<input type="time" value="1" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-8">
			<span class="label text-label">Email</span>
			<input type="text" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-4">
			<span class="label text-label">Senha</span>
			<input type="text" placeholder="Nome.." class="form-campo campo-form">
		</div>
		<div class="col-12 mt-3">
			<input type="submit" class="btn m-auto d-block" value="cadastrar">
		</div>
	</div>
</form>
<a href="#" class="fechar">x</a>
	</div>
</div>
<div id="mascara"></div>