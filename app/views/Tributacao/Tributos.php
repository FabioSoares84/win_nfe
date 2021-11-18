<script src="<?php echo URL_BASE ."assets/js/tributacao_js.js" ?>"> </script>
<section class="conteudo">				
    <div class="conteudo-fluido">
        <div class="rows">
            <div class="col-12">
                <form action="" id="frmTributacao"  method="POST">
                    <div class="caixa">
                        <div class="caixa-titulo py-1 d-inline-block width-100">
                            <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Tributação</span>
                        </div>
                        <div class="p-3">
                            <div class="caixa p-3 px-4 pb-4">
                                <span class="h4 pt-1 mb-3 d-block">Descrição da Tribução:</span>
                                <div class="rows">
                                    <div class="col-2"><input type="text" name="id_tributacao" value="<?php echo $tributacao->id_tributacao ?>" placeholder="Digite aqui..." class="form-campo"></div>
                                    <div class="col-8"><input type="text" name="tributacao" value="<?php echo $tributacao->tributacao ?>" placeholder="Digite aqui..." class="form-campo"></div>
                                    <div class="col-2"> <button class="btn width-100">GRAVAR</button></div>
                                </div>
                            </div>
                            <div class="p-3 pt-1 width-100 float-left">	
                                <div class="p-1 mb-4 px-2" id="tab">							
                                   <ul class="tabs">
                                      <li><a href="#tab-1">IPI</a></li>
                                      <li><a href="#tab-2">PIS</a></li>
                                      <li><a href="#tab-3">CONFINS</a></li>
                                      <li><a href="#tab-4">ICMS</a></li>
                                   </ul>	
						   
                                    <div id="tab-1" class="cx-tab">
                                        <div class="rows py-4">
                                            <div class="col-12">	
                                                <span class="text-label">IPI</span>
                                                <select class="form-campo" name="cst_ipi" id="cst_ipi" onchange="selecionar_cst_ipi()" >
                                                    <option  value="">Selecione uma Opção</option>
                                                    <?php foreach ($lista_cst_ipi as $cst){
                                                         echo "<option value='$cst->cst_ipi>$cst->desc_ipi</option>";
                                                        
                                                    }?>
                                                    
                                                </select>  
                                                <div id="mostrar_ipi"></div>                          
                                            </div>
                                        </div>              
                                    </div> 
                                    
                                    <div id="tab-2" class="cx-tab">
                                        <div class="rows py-4">
                                            <div class="col-12">	
                                                <span class="text-label">PIS</span>
                                                <select class="form-campo" name="cst_pis" id="cst_pis" onchange="selecionar_cst_pis()" >
                                                    <option  value="">Selecione uma Opção</option>
                                                </select>       
                                                <div id="mostrar_pis"></div>                     
                                            </div>
                                        </div>              
                                    </div> 
                                    
                                    <div id="tab-3" class="tab-content">
                                        <div class="rows py-4">
                                            <div class="col-12">	
                                                <span class="text-label">COFINS</span>
                                                <select class="form-campo" name="cst_cofins" id="cst_cofins" onchange="selecionar_cst_cofins()" >
                                                    <option  value="">Selecione uma Opção</option>
                                                </select>     
                                                <div id="mostrar_cofins"></div>                       
                                            </div>
                                        </div>              
                                    </div>                     
							<div id="tab-4" class="tab-content">
							   <div class="rows py-4">
								   <div class="col-12">	
									   <span class="text-label">ICMS</span>
									   <select class="form-campo" name="cst_icms" id="cst_icms" onchange="selecionar_cst_icms()" >
										   <option  value="">Selecione uma Opção</option>
										  
									   </select>  
										
										<div id="mostrar_icms"></div>                          
								   </div>
							   </div>              

							</div> 
				</div>                    
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



