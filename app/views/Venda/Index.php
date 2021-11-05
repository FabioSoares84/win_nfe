<div class="rows">			
    <div class="col-12">
	<div class="caixa">
            <div class="caixa-titulo py-1 d-flex justify-content-space-between">
                <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Lista de Vendas</span>
                <div>
                    <a href="<?php echo URL_BASE ."venda/create" ?>" class="btn btn-verde  d-inline-block"><i class="fas fa-plus-circle mb-0"></i> Adicionar novo</a>
                    <a href="" class="btn btn-amarelo filtro mx-1 d-inline-block"><i class="fas fa-filter"></i> Filtrar</a>
                </div>
            </div>
            <div class="rows">
		<div class="col-12">
                    <div class="col-12 mt-3 mb-3">    				
			<div class="radius-4 mostraFiltro bg-padrao"> 
                            <span class="caixa-titulo d-block"><i class="fas fa-search"></i> Buscar contatos</span>
                            <form action="" method="">
                                <div class="rows p-4 px-5">
                                   <div class="col-6">
                                        <label class="text-label text-branco">Nome</label>	
                                        <input type="text" value="" name="razao_social" placeholder="Digite aqui..." class="form-campo">
                                   </div>
                                   <div class="col-6">
                                        <label class="text-label text-branco">Email</label>	
                                        <input type="text" value="" name="razao_social" placeholder="Digite aqui..." class="form-campo">
                                   </div>
                                   <div class="col-12 mt-2">
                                        <div class="rows">
                                            <div class="col-3 mb-3">	
                                               <div class="check"><input type="checkbox" name="eh_venda" value="S" class="form-campo" id="venda"><label for="venda"></label> <strong class="text-label d-inline-block text-branco">Cliente </strong></div>
                                            </div>
                                            <div class="col-3 mb-3">															
                                                <div class="check"><input type="checkbox" name="eh_fornecedor" value="S" class="form-campo" id="fornecedor"><label for="fornecedor"></label> <strong class="text-label d-inline-block text-branco">Fornecedor</strong></div>
                                            </div>
                                            <div class="col-3 mb-3">							
                                                <div class="check"><input type="checkbox" name="eh_transportador" value="S" class="form-campo" id="transportador"><label for="transportador"></label> <strong class="text-label d-inline-block text-branco">Transportador</strong></div>
                                            </div>
                                            <div class="col-3">	
                                                <input type="submit" value="Pesquisar" class="btn btn-verde width-100 text-uppercase">
                                            </div>
                                        </div>
                                   </div>
                                </div> 
                            </form>
			</div>               
                    </div> 
                    <div class="col-12">
			<div class="tabela-responsiva px-0">
                            <table cellpadding="0" cellspacing="0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th align="center">Id</th>
                                        <th align="left" >Cliente</th>
                                        <th align="center" >Data</th>
                                        <th align="center">Hora</th>
                                        <th align="center">Total</th>
                                        <th align="center">Ação</th>
                                    </tr>
                                </thead>
				<tbody>
                                <?php foreach($vendas as $venda) {?>
                                    <tr>
                                        <td align="center"><?php echo $venda->id_venda ?></td>
                                        <td align="left"><?php echo $venda->nome ?> </td>
                                        <td align="center"><?php echo databr($venda->data_venda)?></td>
                                        <td align="center"><?php echo $venda->hora_venda ?></td>	
                                        <td align="center"><?php echo $venda->total ?></td>										
                                        <td align="center">
                                            <a href="<?php echo URL_BASE ."venda/edit/". $venda->id_venda ?>" class="d-inline-block btn btn-outline-roxo btn-pequeno"><i class="fas fa-edit"></i> Editar</a>
                                            <a href="index.htmlcontato/create" class="d-inline-block btn btn-outline-vermelho btn-pequeno"><i class="fas fa-trash-alt"></i> Excluir</a>
                                        </td>
                                    </tr>
                                <?php } ?>    
				</tbody>
                            </table>								
			</div>
                    </div>
		</div> 
	    </div> 
	</div>
    </div>
</div>
    
