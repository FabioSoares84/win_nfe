<div class="conteudo-fluido">
			<div class="caixa">
			<div class="caixa-titulo py-1 d-flex justify-content-space-between">
                <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Lista de produto</span>
				<div>
					<a href="<?php echo URL_BASE ."produto/create"?>" class="btn btn-verde  d-inline-block"><i class="fas fa-plus-circle mb-0"></i> Adicionar novo</a>
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
                                    <th align="left" >Produto</th>
                                    <th align="center" >Unidade</th>
                                    <th align="center">Preço</th>
                                    <th align="center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($lista as $produto){
                            ?>                      
								<tr>
									<td align="center"><?php echo $produto->id_produto ?></td>
									<td align="center"><?php echo $produto->produto ?></td>
									<td align="center"><?php echo $produto->unidade ?></td>
									<td align="center"><?php echo $produto->preco ?></td>
									<td align="center">
										<a href="<?php echo URL_BASE . "produto/edit/" .$produto->id_produto ?>" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-edit"></i> Editar</a>
										<a href="<?php echo URL_BASE . "produto/excluir/" .$produto->id_produto ?>" class="d-inline-block btn btn-outline-vermelho btn-pequeno"><i class="fas fa-trash-alt"></i> Excluir</a>
									</td>
								</tr>                    
							<?php } ?>	             
								                   
								     					
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