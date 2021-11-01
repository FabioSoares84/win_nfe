<div class="conteudo-fluido">
		<div class="rows">	
			<div class="col-12">
				<div class="caixa">
					<div class="caixa-titulo py-1 d-inline-block width-100">
							<span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Inserir contato</span>
							<a href="lst_contato.html" class="btn btn-amarelo float-right"><i class="fas fa-arrow-left mb-0"></i> Voltar</a>
					</div>
					<?php 
                       $this->verErro();
                       $this->verMsg();
                       ?>
					<form action="<?php echo URL_BASE ."cliente/salvar"?>" method="POST">
						<div class="p-5 pb-0 pt-4 width-100 float-left">
						<div id="tab">
							<ul class="tabs">
								<li><a href="#tab-1">Dados Gerais</a></li>
								<li><a href="#tab-2">Endereço</a></li>
								<li><a href="#tab-3">Informações Adicionais</a></li>
							</ul>
							
						<div id="tab-1" class="cx-tab">
								<span class="d-block mt-4 mb-4 h4 border-bottom">Informações básicas</span>
								<div class="rows pb-4">	
								
								<div class="col-6 mb-3">
										<label class="text-label">Nome</label>	
										<input type="text" name="nome" value="<?php echo isset($cliente->nome) ? $cliente->nome : null ?>" class="form-campo">
								</div>                                    
								<div class="col-6 mb-3">
										<label class="text-label">Nome Fantasia</label>	
										<input type="text" name="nome_fantasia" value="<?php echo isset($cliente->nome_fantasia) ? $cliente->nome_fantasia : null ?>" class="form-campo">
								</div>

								<div class="col-3 mb-3">
										<label class="text-label">CPF</label>	
										<input type="text" name="cpf" value="<?php echo isset($cliente->cpf) ? $cliente->cpf : null ?>"  class="form-campo">
								</div>
								
														
								<div class="col-3 mb-3">
										<label class="text-label">CNPJ</label>	
										<input type="text" name="cnpj" value="<?php echo isset($cliente->cnpj) ? $cliente->cnpj : null ?>"  class="form-campo">
								</div>
							   <div class="col-3 mb-3">
										<label class="text-label">Fone:</label>	
										<input type="text" name="fone" value="<?php echo isset($cliente->fone) ? $cliente->fone : null ?>"  class="form-campo">
								</div>
								<div class="col-3 mb-3">
										<label class="text-label">Celular:</label>	
										<input type="text" name="celular" value="<?php echo isset($cliente->celular) ? $cliente->celular : null ?>"  class="form-campo">
								</div>
								

								<div class="col-8 mb-3">
										<label class="text-label">E-mail</label>	
										<input type="text" name="email" value="<?php echo isset($cliente->email) ? $cliente->email : null ?>" class="form-campo">
								</div>
															

							</div>
						</div>
												
						<div id="tab-2" class="cx-tab">									
							<span class="d-block mt-4 h4 border-bottom">Endereço</span>										
							<div class="rows pb-4">																					
								<div class="col-2 mb-3">
                            <label class="text-label">Cep</label>	
                            <input type="text" name="cep"  value="<?php echo isset($cliente->cep) ? $cliente->cep : null ?>" placeholder="Digite aqui..." class="form-campo busca_cep">
                            </div>
                            
                            <div class="col-4 mb-3">
                                    <label class="text-label">Logradouro</label>	
                                    <input type="text" name="logradouro" value="<?php echo isset($cliente->logradouro) ? $cliente->logradouro : null ?>" placeholder="Digite aqui..." class="form-campo rua">
                            </div>
                            <div class="col-2 mb-4">
                                    <label class="text-label">Numero</label>	
                                    <input type="text" name="numero" value="<?php echo isset($cliente->numero) ? $cliente->numero : null ?>" placeholder="Digite aqui..." class="form-campo">
                            </div>
                            <div class="col-4 mb-3">
                                     <label class="text-label">Bairro</label>	
                                     <input type="text" name="bairro" value="<?php echo isset($cliente->bairro) ? $cliente->bairro : null ?>" placeholder="Digite aqui..." class="form-campo bairro">
                             </div>
                             <div class="col-4 mb-3">
                                     <label class="text-label">Complemento</label>	
                                     <input type="text" name="complemento" value="<?php echo isset($cliente->complemento) ? $cliente->complemento : null ?>" placeholder="Digite aqui..." class="form-campo">
                             </div>	
                            
        						 
                             <div class="col-2 mb-2">
                                 <label class="text-label">UF</label>	
                                 <input type="text" name="uf" value="<?php echo isset($cliente->uf) ? $cliente->uf : null ?>"   class="form-campo estado"> 
                             </div>                    
                             
                             <div class="col-4 mb-3">
                                     <label class="text-label">Cidade</label>	
                                     <input type="text" name="cidade" value="<?php echo isset($cliente->cidade) ? $cliente->cidade : null ?>" placeholder="Digite aqui..." class="form-campo cidade">
                             </div>	
                             <div class="col-2 mb-3">
                                     <label class="text-label">Ibge</label>	
                                     <input type="text" name="ibge" value="<?php echo isset($cliente->ibge) ? $cliente->ibge : null ?>"  class="form-campo ibge mascara-cep">
                             </div>
							</div>
						</div>
												
						<div id="tab-3" class="cx-tab">									
							<span class="d-block mt-4 h4 border-bottom">Informações Adicionais</span>										
							<div class="rows pb-4">
								<div class="col-4 mb-3">
										<label class="text-label">Insc. Estadual</label>	
										<input type="text" name="ie" value="<?php echo isset($cliente->ie) ? $cliente->ie : null ?>"  class="form-campo">
								</div>
								<div class="col-4 mb-3">
										<label class="text-label">Insc. Municipal</label>	
										<input type="text" name="im" value="<?php echo isset($cliente->im) ? $cliente->im : null ?>"  class="form-campo">
								</div>
								<div class="col-4 mb-3">
										<label class="text-label">Suframa</label>	
										<input type="text" name="suframa" value="<?php echo isset($cliente->suframa) ? $cliente->suframa : null ?>"  class="form-campo">
								</div>
											   
								<div class="col-4 mb-3">
										 <label class="text-label">RG</label>	
										 <input type="text" name="rg" value="<?php echo isset($cliente->rg) ? $cliente->rg : null ?>"  class="form-campo">
								 </div>
								 <div class="col-4 mb-3">
										 <label class="text-label">Cód. Estrangeiro</label>	
										 <input type="text" name="cod_estrangeiro" value="<?php echo isset($cliente->cod_estrangeiro) ? $cliente->cod_estrangeiro : null ?>"  class="form-campo">
								 </div>
								 <div class="col-4 mb-3">
										 <label class="text-label">IE Subst. Trib.</label>	
										 <input type="text" name="ie_subt_trib" value="<?php echo isset($cliente->ie_subt_trib) ? $cliente->ie_subt_trib : null ?>"  class="form-campo">
								 </div>

								 </div>
						 </div>
						</div>
						<!--Botao-->
						<div class="mb-5 mt-4 width-100 d-inline-block" style="clear:both">
								<input type="hidden" name="id_cliente" value="<?php echo isset($cliente->id_cliente) ? $cliente->id_cliente : null ?>">
								<input type="submit" value="Salvar" class="btn btn-azul btn-grande d-block m-auto">
						 </div>
							
						</div>
						</form>
				</div>
			</div>
		</div>
	</div>
