
			<div class="">				
				<div class="conteudo-fluido">
				<div class="rows">	
                <div class="col-12">
                <div class="caixa">
                    <div class="caixa-titulo py-1 d-inline-block width-100">
						<a href="<?php echo URL_BASE . "emitente" ?>" class="btn btn-amarelo float-right"><i class="fas fa-arrow-left mb-0"></i> Voltar</a>
                    </div>
				<?php 
                   $this->verErro();
                   $this->verMsg();
                ?>
           <form action="<?php echo URL_BASE ."notafiscal/salvar"?>" method="POST">	
            <div class="p-5 pb-0 pt-0 width-100 float-left">
			<div id="tab">
               <ul class="tabs">
                  <li><a href="#tab-1">Dados gerais</a></li>
                  <li><a href="#tab-2">Emitente</a></li>
               </ul>	
			<div id="tab-1" class="cx-tab">
					<span class="d-block mt-3 h4 border-bottom">Informações básicas</span>
					<div class="rows pb-4">
						<div class="col-2 mb-3">
									<label class="text-label">Num NFe</label>	
									<input type="text" name="nNF" value="<?php echo $nNF ?>" readonly="true" placeholder="Digite aqui..." class="form-campo">
							</div>	
							
							<div class="col-1 mb-3">
                                        <label class="text-label">Série</label>	
                                        <input type="text" name="serie" value="1" readonly="true" placeholder="Digite aqui..." class="form-campo">
                                </div>						

							<div class="col-2 mb-3">
									<label class="text-label">Tipo de operação</label>	
									<select class="form-campo" name="tpNF" id="tpNF" onchange="selecionar_tipo_operacao();">
                                            <option value="0">ENTRADA</option>
                                            <option value="1">SAÍDA</option>
                                    </select>
							</div>
							
							<div class="col-6 mb-3">
									<label class="text-label">CFOP</label>	
								   <select class="form-campo" name="natOp" id="natOp" >
                                        
                                     </select>  
							</div>
							
							 <div class="col-1 mb-3">
                                    <label class="text-label">UF</label>
                                    <input type="text" name="uf_emitente" id ="uf_emitente" class="form-campo">
                                    	
                               </div>
                                <div class="col-3 mb-3">
                                        <label class="text-label">Data Emissão NF</label>	
                                        <input type="date" name="data_emissao_nfe" value="<?php echo date("Y-m-d") ?>"  class="form-campo">
                                </div>
                                <div class="col-3 mb-3">
                                        <label class="text-label">Hora emissão NF</label>	
                                        <input type="time" name="hora_emissao_nfe" value="<?php echo date("H:i:s") ?>" class="form-campo">
                                </div>                             
                    
                                <div class="col-3 mb-3">
                                        <label class="text-label">Data saída/entrada</label>	
                                        <input type="date" name="data_saida_nfe" value="<?php echo date("Y-m-d") ?>" class="form-campo">
                                </div> 
                                <div class="col-3 mb-3">
                                        <label class="text-label">Hora saída/entrada</label>	
                                        <input type="time" name="hora_saida_nfe" value="<?php echo date("H:i:s") ?>" class="form-campo">
                                </div>
					</div>
					
					<span class="d-block mt-4 h4 border-bottom">Frete/Despesas/Desconto</span>										
                    <div class="rows pb-4">																					
                    	<div class="col-3 mb-3 position-relative">
                            <label class="text-label">Frete </label>
                            <input type="text" id="vFrete"  name="vFrete"  class="form-campo">
                        </div>
        
                        <div class="col-3 mb-3">
                            <label class="text-label">Seguro</label>
                            <input type="text" id="vSeg" name="vSeg"    class="form-campo">
                        </div>	
                        <div class="col-3 mb-3">
                            <label class="text-label">Despesa</label>
                            <input type="text" id="vOutro" name="vOutro"   class="form-campo">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="text-label">Desconto</label>
                            <input type="text" id="vDesc" name="vDesc"     class="form-campo">
                        </div>
                    	    
                   </div>
           
			</div>

        <div id="tab-2" class="cx-tab">	
            <span class="d-block mt-4 h4 border-bottom">Dados Emitente</span>										
            <div class="rows pb-4">																					
            		 <div class="col-6 mb-3">
                               <label class="text-label"><b class="text-vermelho">*</b> Razão Social</label>
                               <select name="id_emitente" id="id_emitente" class="form-campo" onchange="selecionarEmitente()">
                               <option value="">Selecione uma Opção</option>
                               
                               </select>	
                       </div>
                       
                       <div class="col-6 mb-3">
                               <label class="text-label">Nome Fantasia</label>
                               <input type="text" name="em_xFant" id="nome_fantasia"  class="form-campo">
                       </div>
					
                       <div class="col-3 mb-3">
                               <label class="text-label">CNPJ</label>	
                               <input type="text" name="em_CNPJ" id="cnpj"  class="form-campo mascara-cnpj">
                       </div> 
                       
                       <div class="col-3 mb-3">
                               <label class="text-label"><b class="text-vermelho">*</b> Insc. Estadual</label>	
                               <input type="text" name="em_IE" id="ie"  class="form-campo">
                       </div>
                       <div class="col-3 mb-1">
                            <label class="text-label">Ins. Est. Subst. Trib.</label>	
                            <input type="text" name="em_IEST" id="iest" class="form-campo">
                        </div> 
            
                       <div class="col-3 mb-3">
                               <label class="text-label">Insc. Municipal</label>	
                               <input type="text" name="em_IM"  id="im" class="form-campo">
                       </div>                      
                       
                       <div class="col-3 mb-3">
                               <label class="text-label">Fone:</label>	
                               <input type="text" name="em_fone" id="fone"   class="form-campo">
                       </div>                                                                    
					
                       <div class="col-4 mb-3">
                               <label class="text-label">E-mail</label>	
                               <input type="text" name="email" id="email"  class="form-campo">
                       </div>
                       
                       <div class="col-4 mb-3">
                               <label class="text-label">E-mail Contabilidade</label>	
                               <input type="text" name="email_contabilidade" id="email_contabilidade"  class="form-campo">
                       </div>
            	    
           </div>
           
           <span class="d-block mt-4 h4 border-bottom">Endereço Emitente</span>	
				<div class="rows pb-4">																					
                   
                   <div class="col-2 mb-3">
                            <label class="text-label">Cep</label>	
                            <input type="text" name="em_CEP" id="cep" class="form-campo">
                    </div>
                    
                    <div class="col-4 mb-3">
                            <label class="text-label">Logradouro</label>	
                            <input type="text" name="em_xLgr" id="logradouro"   class="form-campo">
                    </div>
                    <div class="col-2 mb-4">
                            <label class="text-label">Numero</label>	
                            <input type="text" name="em_nro" id="numero"  class="form-campo">
                    </div>
                    <div class="col-4 mb-3">
                             <label class="text-label">Bairro</label>	
                             <input type="text" name="em_xBairro" id="bairro"  class="form-campo">
                     </div>
                     <div class="col-4 mb-3">
                             <label class="text-label">Complemento</label>	
                             <input type="text" name="em_xCpl" id="complemento"  class="form-campo">
                     </div>	
                    
						 
                     <div class="col-2 mb-2">
                         <label class="text-label">UF</label>	
                         <input type="text" name="em_UF" id="uf"  class="form-campo"> 
                     </div>                    
                     
                     <div class="col-4 mb-3">
                             <label class="text-label">Cidade</label>	
                             <input type="text" name="em_xMun" id="cidade" class="form-campo">
                     </div>	
                     <div class="col-2 mb-3">
                             <label class="text-label">Ibge</label>	
                             <input type="text" name="em_cMun" id="ibge"  class="form-campo">
                     </div>
                     
             </div>
             
             <div class="rows pb-4">
				<div class="col-12"><span class="d-block mt-4 h4 border-bottom">Dados Fiscais</span></div>			 
            		<div class="col-4 mb-3">
                           <label class="text-label">Cnae</label>	
                           <input type="text" name="em_CNAE" id="cnae"  class="form-campo">
                   </div>
                   <div class="col-4 mb-3">
                           <label class="text-label">Regime Tributário</label>	
                           <input type="text" name="em_CRT" id="regime_tributario"  class="form-campo">
                   </div> 
				
           </div>
    </div> 
  			<div class="col-12 mb-5 pt-4  text-center">
					<input type="hidden" name="em_xNome" id="razao_social"  >
					<input type="submit" value="Salvar alterações" class="btn btn-verde btn-grande d-block m-auto">
				</div>
        
</div>
</div>
</form>
    
    </div>


    </div>
    </div>
</div>
</div>