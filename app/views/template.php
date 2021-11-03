<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema ERP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">		
        <!--css-->
        <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/js/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/js/datatables/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/js/datatables/css/style_dataTable.css">
        <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/auxiliar.css">
        <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/grade.css">
        <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/style.css">	

        <script src="<?php echo URL_BASE ?>assets/js/jquery.min.js"></script>	
        <script>
                var base_url = "<?php echo URL_BASE ?>";
        </script>
    </head>
    <body>
	<?php include("cabecalho.php") ?>
        
        <section class="conteudo">
            <?php $this->load($view, $viewData); ?>			
        </section>

	
	<!--carregar modal-->
	<div class="window load" id="carregar">
		<div class="px-4 width-100 d-inline-block text-center">
			<img src="img/ajax-loader_1.gif" class="d-block m-auto">
			<span class="d-block text-center text-azul pb-2">Carregando...</span>
		</div>
	</div>
	
	
	<!--modal duplicatas-->
	<div class="window" id="janela1">
            <div class="caixa mb-0">
                <div class="caixa-titulo">
                    Informações de duplicatas
                    <a href="" class="text-branco d-inline-block fechar">X</a>
                </div>
                <div class="rows p-4">  		
                    <div class="col-6 mb-3">
                        <label class="text-label">Vencimento</label>	                   
                        <input type="text" name="" value="" placeholder="Digite aqui..." class="form-campo">
                    </div>    		
                    <div class="col-6 mb-3">
                        <label class="text-label">Valor</label>	                   
                        <input type="text" name="" value="" placeholder="Digite aqui..." class="form-campo">
                    </div>  
                    <div class="col-12 mt-3">
                        <input type="submit" value="Salvar" class="btn d-block m-auto">
                    </div>  
                </div>  
            </div>
	</div>
	
	<!--modal cadastro de produto-->
	<div class="window formulario" id="janela_produto">
		<div class="p-4 width-100 d-inline-block">
			<form action="" method="">
			<div class="rows">
                <div class="col-12">
                        <label class="text-label">Titulo do produto</label>
                        <input type="text" value="" name="produto" placeholder="Digite aqui..." class="form-campo">
                </div>
                <div class="col-4">
                        <label class="text-label">Categoria</label>
                        <select class="form-campo" name="id_categoria">                             
                            <option value="1"> Panela</option>
							<option value="2"> Cuzcuzeira</option>
							<option value="3"> Copo</option>
							<option value="4"> Caneca</option>
							<option value="5"> Papeiro</option>
							<option value="6"> Leiteira</option>
							<option value="7"> Frigideira</option>
							<option value="8"> Bacia</option>
							<option value="9"> Balde</option>
							<option value="10"> Assadeira</option>                                                
                        </select>
                </div>
                <div class="col-4">
                        <label class="text-label">Código Personalizado</label>
                        <input type="text" name="codigo_personalizado" value="" placeholder="Digite aqui..." class="form-campo">
                </div>
                <div class="col-4">
                        <label class="text-label">Unidade</label>
                        <select class="form-campo" name="id_unidade">
                                <option value="1"> Unidade</option><option value="3"> Pacote</option><option value="4"> Kilograma</option>                                        </select>
                </div>
               
                <div class="col-6">
                        <label class="text-label">Upload da imagem</label>
                        <input type="file" name="arquivo" class="form-campo">
                </div>
                <div class="col-6">
                        <label class="text-label">Nome do arquivo</label>
                        <input type="text" value="" name="nome_do_arquivo" placeholder="Digite aqui..." class="form-campo">
                </div>
                <div class="col-4">
                        <label class="text-label">Preço Alto</label>
                        <input type="text" name="preco_alto" value="" placeholder="Digite aqui..." class="form-campo">
                </div>
                <div class="col-4">
                        <label class="text-label">Preço atual</label>
                        <input type="text" name="preco" value="" placeholder="Digite aqui..." class="form-campo">
                </div>												

                <div class="col-4">
                        <label class="text-label">Ativo</label>
                        <select class="form-campo" name="ativo">
                                <option value="S">Sim</option>                                                 
                                <option value="N">Não</option> 
                        </select>
                </div>
				<div class="col-12 mt-3">
					<input type="submit" value="Salvar cadastro" class="btn dblock m-auto">
				</div>
            </div> 
			</form>			
            </div>
			<a href="#" class="fechar">x</a>
	</div>

	
	
	<!--lista de produto-->
	<div class="window formulario" id="janela_listagem">
				<div class="caixa">
                    <div class="caixa-titulo py-1 d-inline-block width-100">
                            <span class="h5  pt-1 mb-0 d-inline-block"><i class="fas fa-search"></i> Buscar produto</span>
							<a href="" class="link-vermelho d-inline-block fechar float-right">x</a>
                    </div>					
					<form action="" method="">
						<div class="rows p-4">
                                 <div class="col-6">
                                         <label class="text-label">Nome</label>
                                         <input type="text" placeholder="Digite aqui..." class="form-campo">
                                 </div>
                                 <div class="col-4">
                                         <label class="text-label">Opção</label>
                                         <select class="form-campo">
                                                 <option>Opção 01</option>
                                                 <option>Opção 02</option>
                                                 <option>Opção 03</option>
                                         </select>
                                 </div>
								  <div class="col-2 mt-4">
                                       <input type="submit" value="Buscar" class="btn btn-azul text-uppercase width-100">
                                   </div>					
						</div>	
					</form>
				</div>
				<div class="caixa">
						<div class="caixa-titulo py-1 d-inline-block width-100">
							<span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Lista produtos</span>
							
						</div>	
						<div class="row">
						<div class="tabela-responsiva rolagem-290">
							<table cellpadding="0" cellspacing="0" id="dataTable" width="100%">
								<thead>
									<tr>
                                        <th align="center">Id</th>
                                        <th align="center" width="20">Imagem</th>
                                        <th align="left">Produto</th>
                                        <th align="center">Preço</th>
                                        <th align="center">Ação</th>
                                    </tr>
								</thead>
								<tbody>                      
									<tr>
                                         <td align="center">8</td>
                                         <td align="center"><img src="http://mjailton.com.br/nfe/v1/upload/PANELA_5.jpg" class="img-fluido radius-circulo opaco" width="40"></td>
                                         <td align="left">Panela 5</td>
                                         <td align="center">100.00</td>
                                         <td align="center">
											<a href="" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-check"></i> Selecionar</a>
                                         </td>
									</tr>                       
									<tr>
                                         <td align="center">8</td>
                                         <td align="center"><img src="http://mjailton.com.br/nfe/v1/upload/PANELA_5.jpg" class="img-fluido radius-circulo opaco" width="40"></td>
                                         <td align="left">Panela 5</td>
                                         <td align="center">100.00</td>
                                         <td align="center">
											<a href="" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-check"></i> Selecionar</a>
                                         </td>
									</tr>                       
									<tr>
                                         <td align="center">8</td>
                                         <td align="center"><img src="http://mjailton.com.br/nfe/v1/upload/PANELA_5.jpg" class="img-fluido radius-circulo opaco" width="40"></td>
                                         <td align="left">Panela 5</td>
                                         <td align="center">100.00</td>
                                         <td align="center">
											<a href="" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-check"></i> Selecionar</a>
                                         </td>
									</tr>                       
									<tr>
                                         <td align="center">8</td>
                                         <td align="center"><img src="http://mjailton.com.br/nfe/v1/upload/PANELA_5.jpg" class="img-fluido radius-circulo opaco" width="40"></td>
                                         <td align="left">Panela 5</td>
                                         <td align="center">100.00</td>
                                         <td align="center">
											<a href="" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-check"></i> Selecionar</a>
                                         </td>
									</tr>                       
									<tr>
                                         <td align="center">8</td>
                                         <td align="center"><img src="http://mjailton.com.br/nfe/v1/upload/PANELA_5.jpg" class="img-fluido radius-circulo opaco" width="40"></td>
                                         <td align="left">Panela 5</td>
                                         <td align="center">100.00</td>
                                         <td align="center">
											<a href="" class="d-inline-block btn btn-outline-verde btn-pequeno"><i class="fas fa-check"></i> Selecionar</a>
                                         </td>
									</tr>   		
								</tbody>
							</table>
									
						</div>
						</div> 
			</div>
	</div>
	
	<!--produto despesas-->
	<div class="window" id="janela_despesas">
		<div class="caixa mb-0">
			<div class="caixa-titulo py-1 d-inline-block width-100">
				<span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Salvar</span>
				<a href="" class="link-vermelho d-inline-block fechar float-right">x</a>
			</div>					
				<div class="caixa mb-0" style="border-top-left-radius:0;border-top-right-radius:0">				
					<div class="px-3 py-4">
						<div class="rows">
							<div class="col-3 mb-3 position-relative">
									<label class="text-label">Frete </label>
									<input type="text" id="frete_produto"  name="frete_produto" class="form-campo">
							</div>
													
							<div class="col-3 mb-3">
									 <label class="text-label">Seguro</label>
									 <input type="text" id="seguro_produto" name="seguro_produto"   class="form-campo">
							</div>	
							<div class="col-3 mb-3">
									 <label class="text-label">Despesa</label>
									 <input type="text" id="despesa_produto" name="despesa_produto"   class="form-campo">
							</div>
							<div class="col-3 mb-3">
									 <label class="text-label">Desconto</label>
									 <input type="text" id="desconto_produto" name="desconto_produto"  class="form-campo">
							</div>																									 
						</div>
					</div>		
					<div class="caixa-rodape text-right">
					<input type="submit" value="Salvar" class="btn d-inline-block">
					<button class="btn btn-vermelho d-inline-block fechar">Fechar</button>
			</div>			
				</div>
		</div>
	</div>
        <div id="fundo_preto"></div>
	
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://kit.fontawesome.com/9480317a2f.js"></script>
        <script src="<?php echo URL_BASE ?>assets/js/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo URL_BASE ?>assets/js/datatables/js/dataTables.responsive.min.js"></script>

        <script src="<?php echo URL_BASE ?>assets/js/jquery.mask.js"></script>	
        <script src="<?php echo URL_BASE ?>assets/js/componentes/js_data_table.js"></script>
        <script src="<?php echo URL_BASE ?>assets/js/componentes/js_modal.js"></script>
        <script src="<?php echo URL_BASE ?>assets/js/componentes/js_mascara.js"></script>
        <script src="<?php echo URL_BASE ?>assets/js/js.js"></script>	
    </body>
</html>