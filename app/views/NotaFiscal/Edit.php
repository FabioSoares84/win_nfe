	
			<div class="">				
				<div class="conteudo-fluido">
				<div class="rows">	
                <div class="col-12">
                <div class="caixa">
                    <div class="caixa-titulo py-1 d-inline-block width-100">
                            <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Adicionar Nota</span>
							<a href="notas_nfe.html" class="btn btn-amarelo float-right"><i class="fas fa-arrow-left mb-0"></i> Voltar</a>
                    </div>
					
            <div class="p-5 pb-0 pt-0 width-100 float-left">
			<div id="tab">
               <ul class="tabs">
                  <li><a href="#tab-1">Dados gerais</a></li>
                  <li><a href="#tab-2">Dados Destinatário</a></li>
                  <li><a href="#tab-3">Produtos</a></li>
                  <li><a href="#tab-4">Totalizadores</a></li>
               </ul>	
			<div id="tab-1" class="cx-tab">
				<div class="rows">	
					<div class="col-12 mt-2">
						<a href="javascript:;" onclick="abrirModal('#carregar')" class="btn btn-outline-verde float-right text-uppercase"><i class="far fa-save"></i> Salvar</a>
					</div>
				</div>
					<span class="d-block mt-3 h4 border-bottom">Informações básicas</span>
					<div class="rows pb-4">
							<div class="col-2 mb-3">
									<label class="text-label">Num NFe</label>	
									<input type="text" name="numero_nfe" value="<?php echo $notafiscal->nNF ?>" readonly class="form-campo">
							</div>	
							
							<div class="col-1 mb-3">
                                        <label class="text-label">Série</label>	
                                        <input type="text" name="serie_nfe" value="<?php echo $notafiscal->serie ?>" readonly  class="form-campo">
                                </div>						

							<div class="col-2 mb-3">
									<label class="text-label">Tipo de operação</label>	
									<select class="form-campo" name="tpNF" id="tpNF" onchange="selecionar_tipo_operacao();">
                                            <option value="0" <?php echo ($notafiscal->tpNF=="0") ? "selected": NULL ?>>ENTRADA</option>
                                            <option value="1" <?php echo (($notafiscal->tpNF=="1") || (!$notafiscal->tpNF)) ? "selected": NULL ?>>SAÍDA</option>
                                    </select>
							</div>

							<div class="col-6 mb-3">
									<label class="text-label">Natureza Operação</label>	
                                   <select class="form-campo" name="natOp" id="natOp" >
                                   
                                 </select>  
							</div>
                                
                                 <div class="col-1 mb-3">
                                    <label class="text-label">UF</label>
                                    <input type="text" name="cUF" value="<?php echo $notafiscal->cUF ?>" readonly class="form-campo">
                                    	
                               </div>
                                <div class="col-3 mb-3">
                                        <label class="text-label">Data Emissão NF</label>	
                                        <input type="date" name="data_emissao_nfe" value="<?php echo ($notafiscal->dhEmi)? dataNfe($notafiscal->dhEmi):date("Y-m-d") ?>"  class="form-campo">
                                </div>
                                <div class="col-3 mb-3">
                                        <label class="text-label">Hora emissão NF</label>	
                                        <input type="time" name="hora_emissao_nfe" value="<?php echo ($notafiscal->dhEmi) ? horaNfe($notafiscal->dhEmi):date("H:i:s") ?>"  class="form-campo">
                                </div>                             
                    
                                <div class="col-3 mb-3">
                                        <label class="text-label">Data saída/entrada</label>	
                                        <input type="date" name="data_saida_nfe" value="<?php echo ($notafiscal->dhSaiEnt)? dataNfe($notafiscal->dhSaiEnt):date("Y-m-d") ?>"  class="form-campo">
                                </div> 
                                <div class="col-3 mb-3">
                                        <label class="text-label">Hora saída/entrada</label>	
                                        <input type="time" name="hora_saida_nfe" value="<?php echo ($notafiscal->dhSaiEnt)? horaNfe($notafiscal->dhSaiEnt):date("H:i:s") ?>" class="form-campo">
                                </div>                  
                                                                                

					</div>
			</div>

        <div id="tab-2" class="cx-tab">
				<div class="rows">
					<div class="col-12 mt-4">						
						<button onclick="salvarDestinatario()"   name="aba02" class="btn btn-outline-verde float-right text-uppercase"><i class="far fa-save"></i> Salvar</button>
					</div>
				</div>		
            <span class="d-block mt-4 h4 border-bottom">Dados Destinatário</span>										
            <div class="rows pb-4">																					
            
            <div class="col-6 mb-3">
                   <label class="text-label"><b class="text-vermelho">*</b> Razão Social</label>
                   <select name="id_cliente" id="id_cliente" class="form-campo" onchange="selecionarDestinatario()">
                   <option value="">Selecione uma Opção</option>
                       
                   </select>	
           </div>
                   	
            <div class="col-6 mb-3">
                    <label class="text-label">Nome Fantasia</label>	
                    <input type="text" name="dest_xNome" id="dest_xNome" value="<?php echo isset($destinatario->dest_xNome) ? $destinatario->dest_xNome : null ?>"  class="form-campo">
            </div>	            
                
            <div class="col-3 mb-3">
                     <label class="text-label">CPF </label>	
                     <input type="text" name="dest_CPF" id="dest_CPF" value="<?php echo isset($destinatario->dest_CPF) ? $destinatario->dest_CPF : null ?>" class="form-campo">
             </div>
             
             <div class="col-3 mb-3">
                     <label class="text-label">CNPJ </label>	
                     <input type="text" name="dest_CNPJ" id="dest_CNPJ" value="<?php echo isset($destinatario->dest_CNPJ) ? $destinatario->dest_CNPJ : null ?>" class="form-campo">
             </div>
                
            <div class="col-3 mb-3">
                    <label class="text-label">Insc. Estadual</label>	
                    <input type="text" name="dest_IE" id="dest_IE" value="<?php echo isset($destinatario->dest_IE) ? $destinatario->dest_IE : null ?>"  class="form-campo">
            </div>	
             
             <div class="col-3 mb-3">
                    <label class="text-label">indIEDest</label>	
                    <input type="text" name="dest_indIEDest" id="dest_indIEDest" value="<?php echo isset($destinatario->dest_indIEDest) ? $destinatario->dest_indIEDest : null ?>"  class="form-campo">
            </div>	
               
            <div class="col-3 mb-3">
                    <label class="text-label">Suframa</label>	
                    <input type="text" name="dest_ISUF" id="dest_ISUF" value="<?php echo isset($destinatario->dest_ISUF) ? $destinatario->dest_ISUF : null ?>" class="form-campo">
            </div>  
            
             <div class="col-3 mb-3">
                     <label class="text-label">Insc. Municipal</label>	
                     <input type="text" name="dest_IM" id="dest_IM" value="<?php echo isset($destinatario->dest_IM) ? $destinatario->dest_IM : null ?>"  class="form-campo">
             </div>
                
            <div class="col-3 mb-3">
                    <label class="text-label">Fone</label>	
                    <input type="text" name="dest_fone" id="dest_fone" value="<?php echo isset($destinatario->dest_fone) ? $destinatario->dest_fone : null ?>"  class="form-campo">
            </div>	
                
            <div class="col-4 mb-3">
                    <label class="text-label">Email</label>	
                    <input type="text" name="dest_email" id="dest_email"  value="<?php echo isset($destinatario->dest_email) ? $destinatario->dest_email : null ?>" class="form-campo">
            </div> 
            
            <div class="col-2 mb-3">
                    <label class="text-label">Ind IE Dest</label>	
                    <input type="text" name="dest_idEstrangeiro" id="dest_idEstrangeiro" value="<?php echo isset($destinatario->dest_idEstrangeiro) ? $destinatario->dest_idEstrangeiro : null ?>"  class="form-campo">
            </div>
           </div>
           
           <span class="d-block mt-4 h4 border-bottom">Endereço Destinatário</span>
           <div class="rows pb-4">
           		<div class="col-2 mb-3">
                            <label class="text-label">Cep</label>	
                            <input type="text" name="dest_CEP" id="dest_CEP" value="<?php echo isset($destinatario->dest_CEP) ? $destinatario->dest_CEP : null ?>"  class="form-campo busca_cep">
                    </div>
                    
                    <div class="col-4 mb-3">
                            <label class="text-label">Logradouro</label>	
                            <input type="text" name="dest_xLgr" id="dest_xLgr" value="<?php echo isset($destinatario->dest_xLgr) ? $destinatario->dest_xLgr : null ?>" class="form-campo rua">
                    </div>
                    <div class="col-2 mb-4">
                            <label class="text-label">Numero</label>	
                            <input type="text" name="dest_nro" id="dest_nro" value="<?php echo isset($destinatario->dest_nro) ? $destinatario->dest_nro : null ?>"  class="form-campo">
                    </div>
                    <div class="col-4 mb-3">
                             <label class="text-label">Bairro</label>	
                             <input type="text" name="dest_xBairro" id="dest_xBairro" value="<?php echo isset($destinatario->dest_xBairro) ? $destinatario->dest_xBairro : null ?>"  class="form-campo bairro">
                     </div>
                     <div class="col-4 mb-3">
                             <label class="text-label">Complemento</label>	
                             <input type="text" name="dest_xCpl" id="dest_xCpl" value="<?php echo isset($destinatario->dest_xCpl) ? $destinatario->dest_xCpl : null ?>"  class="form-campo">
                     </div>	
                    
						 
                     <div class="col-2 mb-2">
                         <label class="text-label">UF</label>	
                         <input type="text" name="dest_UF" id="dest_UF" value="<?php echo isset($destinatario->dest_UF) ? $destinatario->dest_UF : null ?>"   class="form-campo estado"> 
                     </div>                    
                     
                     <div class="col-4 mb-3">
                             <label class="text-label">Cidade</label>	
                             <input type="text" name="dest_xMun" id="dest_xMun" value="<?php echo isset($destinatario->dest_xMun) ? $destinatario->dest_xMun : null ?>"  class="form-campo cidade">
                     </div>	
                     <div class="col-2 mb-3">
                             <label class="text-label">Ibge</label>	
                             <input type="text" name="dest_cMun" id="dest_cMun" value="<?php echo isset($destinatario->dest_cMun) ? $destinatario->dest_cMun : null ?>"  class="form-campo ibge mascara-cep">
                     </div>
           
					 <input type="text" name="id_destinatario" id="id_destinatario" value="<?php echo isset($destinatario->id_destinatario) ? $destinatario->id_destinatario : null ?>"  class="form-campo ibge mascara-cep">
					
            </div>
    </div> 
    
    <div id="tab-3" class="cx-tab">	
		<div class="rows">
			<div class="col-12 mt-2">
				<a href="#janela_despesas" rel="modal"  class="btn btn-outline-verde float-right text-uppercase"><i class="far fa-save"></i> Salvar</a>
			</div>
		</div>	
            								
        <div class="rows pb-4">	
			<div class="col-12">
				<span class="d-block mt-0 h4 pb-2 border-bottom">Produto </span>
					<div class="caixa">
						<div class="rows p-4">
							<div class="col-6 mb-3 position-relative">
									 <label class="text-label">Nome do Produto (<a href="javascript:;" onclick="abrirModal('#janela_produto')"  class="btn btn-azul p-0 px-1 d-inline-block btn-pequeno">Novo</a>)</label>
									 <input type="text" id="produto" data-type="localizar_produto" class="form-campo">									  
							</div>
														
							<div class="col-2 mb-3">
									 <label class="text-label">Preço</label>
									 <input type="text" name="preco" id="preco"   class="form-campo">
							</div>	
							<div class="col-2 mb-3">
									 <label class="text-label">Qtde</label>
									 <input type="text" name="qtde" id="qtde"  class="form-campo">
							</div>
							<div class="col-2 mt-4  mt-sm-4">
									<input type="hidden" id="id_produto" name="id_produto">                              
                                <input type="button" value="Inserir" id="btnInserirProduto" class="btn btn-azul width-100">
							</div>                                                                                                                    
						</div>
					</div>				
					<div class="tabela-responsiva border">
						<table cellpadding="0" cellspacing="0">
						<thead>
							   <tr>
                                        <th align="left">Id_prod</th>
                                        <th align="left">Produto</th>
                                        <th align="center">Preço</th>
                                        <th align="center">Quantidade</th>							
                                        <th align="center">Subtotal</th>
                                        <th align="center">Excluir</th>
                                  </tr>
						</thead>
						<tbody id="lista_itens">
                               
                                    <td align="left">Produ</td>
                                    <td align="left">produto 01</td>
                                    <td align="center">R$ 1</td>
                                    <td align="center">10</td>							
                                    <td align="center">R$ 10</td>
                                    <td align="center"><a href="javascript:;" onclick="excluirProduto(<?php echo $item->id_item ?>)" class="btn btn-outline-vermelho btn-pequeno">Excluir</a></td>
                                </tr>
                              
                       </tbody>
						</table>
						
						<footer class="caixa-rodape text-right"> 
								<a href="" class="btn btn-amarelo d-inline-block"><i class="fas fa-broom"></i> Limpar</a>
								<a href="" class="btn btn-vermelho d-inline-block"><i class="fas fa-trash"></i> Excluir Pedido</a>
								<a href="" class="btn btn-verde d-inline-block"><i class="fas fa-check"></i> Finalizar</a>
						</footer>
					</div>
                </div>   
            </div>
    </div>
                    
    <div id="tab-4" class="cx-tab">
			<div class="rows">
					<div class="col-12 mt-2">
						<button type="submit" name="aba04" class="btn btn-outline-verde float-right text-uppercase"><i class="far fa-save"></i> Salvar</button>
					</div>
			</div>	
            <span class="d-block mt-3 h4 border-bottom">Totalizadores</span>										
            <div class="rows pb-4">																					
            
            <div class="col-2 mb-3">
                    <label class="text-label">Total BC ICMS</label>	
                    <input type="text" name="vBC" value="<?php echo $notafiscal->vBC ?>"  class="form-campo">
            </div>	
            <div class="col-2 mb-3">
                    <label class="text-label">Total ICMS</label>	
                    <input type="text" name="vICMS" value="<?php echo $notafiscal->vICMS ?>" class="form-campo">
            </div>	
            <div class="col-2 mb-3">
                    <label class="text-label">Total ICMS desonerado</label>	
                    <input type="text" name="vICMSDeson" value="<?php echo $notafiscal->vICMSDeson ?>"  class="form-campo">
            </div>
                
            <div class="col-2 mb-3">
                     <label class="text-label">Total do FCP</label>	
                     <input type="text" name="vFCP" value="<?php echo $notafiscal->vFCP ?>"  class="form-campo">
             </div>	
             <div class="col-2 mb-3">
                     <label class="text-label">Total BC ICMS ST</label>	
                     <input type="text" name="tot_base_calculoST" value="<?php echo $notafiscal->serie ?>"  class="form-campo">
             </div>	
             <div class="col-2 mb-3">
                     <label class="text-label">Total ICMS ST</label>	
                     <input type="text" name="vBCST" value="<?php echo $notafiscal->vBCST ?>"  class="form-campo">
             </div>

            <div class="col-2 mb-3">
                    <label class="text-label">Total do FCPST</label>	
                    <input type="text" name="vFCPST" value="<?php echo $notafiscal->vFCPST ?>"  class="form-campo">
            </div>
            <div class="col-2 mb-4">
                    <label class="text-label">Total do FCPST Ret.</label>	
                    <input type="text" name="vFCPSTRet" value="0<?php echo $notafiscal->vFCPSTRet ?>"  class="form-campo">
            </div>          

            <div class="col-2 mb-3">
                    <label class="text-label">Total bruto dos produtos</label>	
                    <input type="text" name="vProd" value="<?php echo $notafiscal->vProd ?>"  class="form-campo">
            </div>	
            <div class="col-2 mb-3">
                    <label class="text-label">Total de frete</label>	
                    <input type="text" name="vFrete" value="<?php echo $notafiscal->vFrete ?>"  class="form-campo">
            </div>	
            <div class="col-2 mb-3">
                    <label class="text-label">Total de seguro</label>	
                    <input type="text" name="vSeg" value="<?php echo $notafiscal->vSeg ?>"  class="form-campo">
            </div>
                
            <div class="col-2 mb-3">
                    <label class="text-label">Total de desconto</label>	
                    <input type="text" name="vDesc" value="<?php echo $notafiscal->vDesc ?>"  class="form-campo">
            </div>	

            <div class="col-2 mb-3">
                    <label class="text-label">Total de II</label>	
                    <input type="text" name="vII" value="<?php echo $notafiscal->vII ?>"  class="form-campo">
            </div>
                
            <div class="col-2 mb-3">
                    <label class="text-label">Total de IPI</label>	
                    <input type="text" name="vIPI" value="<?php echo $notafiscal->vIPI ?>"  class="form-campo">
            </div>
                
                <div class="col-2 mb-3">
                    <label class="text-label">Total de IPI Devolução</label>	
                    <input type="text" name="vIPIDevol" value="<?php echo $notafiscal->vIPIDevol ?>"  class="form-campo">
            </div>             
                
            <div class="col-2 mb-3">
                    <label class="text-label">Total de PIS</label>	
                    <input type="text" name="vPIS" value="<?php echo $notafiscal->vPIS ?>"  class="form-campo">
            </div>
            <div class="col-2 mb-3">
                    <label class="text-label">Total de COFINS</label>	
                    <input type="text" name="vCOFINS" value="<?php echo $notafiscal->vCOFINS ?>"  class="form-campo">
            </div>
                
            <div class="col-2 mb-3">
                    <label class="text-label">Total Outras Despesas</label>	
                    <input type="text" name="vOutro" value="<?php echo $notafiscal->vOutro ?>"  class="form-campo">
            </div>
                
            <div class="col-2 mb-3">
                    <label class="text-label">TOTAL DA NF</label>	
                    <input type="text" name="vNF" value="<?php echo $notafiscal->vNF ?>"  class="form-campo">
            </div>
            <div class="col-2 mb-3">
                    <label class="text-label">Total Aproximado</label>	
                    <input type="text" name="vTotTrib" value="<?php echo $notafiscal->vTotTrib ?>"  class="form-campo">
            </div>
                       
            </div>
			
			
	</div>  
	
	<div class="col-12 mb-5 pt-4  text-center">
		
		<input type="submit" value="Finalizar Nota" class="btn btn-verde btn-grande d-block m-auto">
	</div>
        
</div>
</div>

    
    </div>


    </div>
    </div>
</div>
</div>
