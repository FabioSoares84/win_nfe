<div class="conteudo-fluido">
    <div class="rows">	
	<div class="col-12">
            <div class="caixa">
                <div class="caixa-titulo py-1 d-inline-block width-100">
                    <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Configuração Empresa</span>
                    <a href="<?php echo URL_BASE."configuracao" ?>" class="btn btn-amarelo float-right"><i class="fas fa-arrow-left mb-0"></i> Voltar</a>
                </div>
		<?php 
                    $this->verErro();
                    $this->verMsg();
                ?>
		<form action="<?php echo URL_BASE ."configuracao/salvar"?>" method="POST">
                    <div class="pt-2 px-5 pb-5 width-100 d-inline-block">
			<div class="border px-4">
                            <span class="d-block mt-4 h4 border-bottom">Configuração</span>
                            
                            <div class="rows">
                                <div class="col-6">
                                    <label class="text-label">Empresa</label>
                                    <input type="text" value="<?php echo isset($produto) ? $produto->produto: "" ?>" name="produto"  class="form-campo">
                                </div>
                                
                                <div class="col-2">
                                    <label class="text-label">Serie</label>
                                    <input type="text" value="<?php echo isset($produto) ? $produto->produto: "" ?>" name="produto"  class="form-campo">
                                </div>
                               
                                <div class="col-4">
                                    <label class="text-label">Ambiente</label>
                                    <select class="form-campo" name="id_unidade">
                                        <?php foreach($unidades as $unidade){
                                            $selecionado = (!isset($produto)) ? "" : ($produto->id_unidade==$unidade->id_unidade) ? "selected" : "";
                                            echo "<option value='$unidade->id_unidade' $selecionado > $unidade->unidade</option>";
                                        } ?>      
                                    </select>
                                </div>                              
                               
                                <div class="col-2">
                                    <label class="text-label">Versão</label>
                                    <input type="text" name="preco" value="<?php echo isset($produto) ? $produto->preco: "" ?>"  class="form-campo">
                                </div>												
                            </div>
                            
                            
				
                            <span class="d-block mt-4 h4 border-bottom">Dados Complementares</span>		
                            <div class="rows"> 
                                
                                <div class="col-4 ">
                                    <label class="text-label">Tributação</label>									
                                    <select class="form-campo" name="id_tributacao" id="cfop" >
                                        <?php foreach($tributacoes as $t) {
                                            $selecionado =  (!isset($produto)) ? "" : ($produto->id_tributacao==$t->id_tributacao) ? "selected" : "" ;
                                             echo "<option value='$t->id_tributacao' $selecionado >".$t->tributacao ."</option>";
                                        } ?>
                                    </select>  
				</div>
                                
                                <div class="UploadProgress simples">
                                    <form id="uploadForm" action="<?php echo URL_BASE ."configuracao/subir"?>" method="post" enctype="multipart/form-data">
                                            <div class="rows">
                                                    <div class="col-12">
                                                            <span>Selecione um Certificado:</span>
                                                            <div class="rows">
                                                                    <div class="col-9">
                                                                            <input type="file" name="arquivo" id="upload_arquivo">
                                                                    </div>
                                                                    <div class="col-3">
                                                                            <input type="submit" name="submit" value="Enviar" class="btn width-100"/>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                    </form>				
                                </div>

                                
                                
                                
                	        <div class="col-6 ">
                                    <label class="text-label">CFOP</label>									
                                    <select class="form-campo" name="cfop" id="cfop" >
                                        <option value="" >Escolha uma Opção</option>
                                        <?php foreach($cfops as $cfop) {
                                            $selecionado =  (!isset($produto)) ? "" : ($produto->cfop==$cfop->codigo_cfop) ? "selected" : "" ;
                                             echo "<option value='$cfop->codigo_cfop' $selecionado >".$cfop->codigo_cfop ." - ". $cfop->desc_cfop."</option>";
                                        } ?>
                                    </select>  
				</div>
					  				
				<div class="col-2">	
                                    <span class="text-label">Exceção tabela IPI</span>
					<select class="form-campo" name="extipi" >
                                            <option value="" >Escolha uma Opção</option>
                                            <?php for($i=1; $i<=8;$i++){
                                                $cod ="0".$i; 
                                                $selecionado =  (!isset($produto)) ? "" : ($produto->extipi==$cod) ? "selected" : "" ;
                                                echo "<option value='$cod' $selecionado>$cod</option>";
                                            }?> 
                                        </select>                            
				</div> 
					
				<div class="col-2">                        
                                    <small class="text-label">EAN/GTIN</small>
                                    <input type="text" name="gtin" value="<?php echo isset($produto) ? $produto->gtin: "" ?>" class="form-campo" >
				</div>
               
                                <div class="col-2">
                                    <label class="text-label">NCM</label>
                                    <input type="text" name="ncm" value="<?php echo isset($produto) ? $produto->ncm: "" ?>"  class="form-campo">
                                </div>
                                <div class="col-3">
                                    <label class="text-label">Código Benef. Fiscal na UF</label>
                                    <input type="text" name="cbenef" value="<?php echo isset($produto) ? $produto->cbenef: "" ?>"  class="form-campo">
                                </div>  
                                <div class="col-3">
                                    <label class="text-label">MVA</label>
                                    <input type="text" name="mva"  value="<?php echo isset($produto) ? $produto->mva : "" ?>"  class="form-campo">
                                </div>
                                <div class="col-2">
                                    <label class="text-label">NFCI</label>
                                    <input type="text" name="nfci" value="<?php echo isset($produto) ? $produto->mva : "" ?>"  class="form-campo">
                                </div>              
                                <div class="col-12 mt-4  pb-5">
                                    <input type="hidden" name="id_produto" value="<?php echo isset($produto) ? $produto->id_produto: null ?>">
                                    <input type="submit" value="Salvar alterações" class="btn btn-verde btn-medio d-block m-auto">
                                </div>         
                            </div>
			</div>
                    </div>
		</form>
            </div>
	</div>
    </div>
</div>