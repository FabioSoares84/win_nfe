<div class="conteudo-fluido">
    <div class="rows">	
        <div class="col-12">
            <div class="caixa">
                <div class="caixa-titulo py-1 d-inline-block width-100">
                    <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Inserir emitente</span>
                    <a href="<?php echo URL_BASE . "emitente" ?>" class="btn btn-amarelo float-right"><i class="fas fa-arrow-left mb-0"></i> Voltar</a>
                </div>
                   <?php 
                   $this->verErro();
                   $this->verMsg();
                   ?>
		<form action="<?php echo URL_BASE."emitente/salvar" ?>" method="POST">
                    <div class="p-5 pb-0 pt-4 width-100 float-left">
			<div class="tab-content current border-top p-3">
                            <span class="d-block mt-4 h4 border-bottom">Informações emitente</span>	
			    <div class="rows pb-4">					                                                
                                <div class="col-6 mb-3">
                                    <label class="text-label"><b class="text-vermelho">*</b> Razão Social</label>	
                                    <input type="text" name="razao_social" value="<?php echo isset($emitente->razao_social) ? $emitente->razao_social : null ?>" class="form-campo">
                                </div>
                                <div class="col-6 mb-3">
                                     <label class="text-label">Nome Fantasia</label>	
                                     <input type="text" name="nome_fantasia" value="<?php echo isset($emitente->nome_fantasia) ? $emitente->nome_fantasia : null ?>" class="form-campo">
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="text-label">CNPJ</label>	
                                    <input type="text" name="cnpj" id="cnpj" value="<?php echo isset($emitente->cnpj) ? $emitente->cnpj : null ?>"  class="form-campo mascara-cnpj">
                                </div> 

                                <div class="col-4 mb-3">
                                    <label class="text-label"><b class="text-vermelho">*</b> Insc. Estadual</label>	
                                    <input type="text" name="ie" value="<?php echo isset($emitente->ie) ? $emitente->ie : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="text-label">Insc. Municipal</label>	
                                    <input type="text" name="im" value="<?php echo isset($emitente->im) ? $emitente->im : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>

                                <div class="col-2 mb-3">
                                    <label class="text-label">Fone:</label>	
                                    <input type="text" name="fone" value="<?php echo isset($emitente->fone) ? $emitente->fone : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="text-label">Celular:</label>	
                                    <input type="text" name="celular" value="<?php echo isset($emitente->celular) ? $emitente->celular : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>                                               

                                <div class="col-4 mb-3">
                                    <label class="text-label">E-mail</label>	
                                    <input type="text" name="email" value="<?php echo isset($emitente->email) ? $emitente->email : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="text-label">E-mail Contabilidade</label>	
                                    <input type="text" name="email_contabilidade" value="<?php echo isset($emitente->email_contabilidade) ? $emitente->email_contabilidade : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>
                            </div>
                            <span class="d-block mt-4 h4 border-bottom">Informações básicas</span>	
                            <div class="rows pb-4">																					
                                <div class="col-2 mb-3">
                                    <label class="text-label">Cep</label>	
                                    <input type="text" name="cep"  value="<?php echo isset($emitente->cep) ? $emitente->cep : null ?>" placeholder="Digite aqui..." class="form-campo busca_cep">
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="text-label">Logradouro</label>	
                                    <input type="text" name="logradouro" value="<?php echo isset($emitente->logradouro) ? $emitente->logradouro : null ?>" placeholder="Digite aqui..." class="form-campo rua">
                                </div>
                                <div class="col-2 mb-4">
                                    <label class="text-label">Numero</label>	
                                    <input type="text" name="numero" value="<?php echo isset($emitente->numero) ? $emitente->numero : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="text-label">Bairro</label>	
                                    <input type="text" name="bairro" value="<?php echo isset($emitente->bairro) ? $emitente->bairro : null ?>" placeholder="Digite aqui..." class="form-campo bairro">
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="text-label">Complemento</label>	
                                    <input type="text" name="complemento" value="<?php echo isset($emitente->complemento) ? $emitente->complemento : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>	
                                <div class="col-2 mb-2">
                                    <label class="text-label">UF</label>	
                                    <input type="text" name="uf" value="<?php echo isset($emitente->uf) ? $emitente->uf : null ?>"   class="form-campo estado"> 
                                </div>                    
                                <div class="col-4 mb-3">
                                    <label class="text-label">Cidade</label>	
                                    <input type="text" name="cidade" value="<?php echo isset($emitente->cidade) ? $emitente->cidade : null ?>" placeholder="Digite aqui..." class="form-campo cidade">
                                </div>	
                                <div class="col-2 mb-3">
                                    <label class="text-label">Ibge</label>	
                                    <input type="text" name="ibge" value="<?php echo isset($emitente->ibge) ? $emitente->ibge : null ?>"  class="form-campo ibge mascara-cep">
                                </div>
                            </div>
                            <div class="rows pb-4">
                                <div class="col-12"><span class="d-block mt-4 h4 border-bottom">Dados Fiscais</span></div>			 
                            '   <div class="col-6 mb-3">
                                    <label class="text-label">CNAE</label>	
                                    <input type="text" name="cnae" value="<?php echo isset($emitente->cnae) ? $emitente->cnae : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="text-label">Regime Tributário</label>	
                                    <select class="form-campo" name="crt">
                                        <option value="1">Simples Nacional</option> 
                                        <option value="2">Lucro Presumido</option> 
                                        <option value="3">Lucro Real</option> 
                                    </select>
                                </div> 
                                <div class="col-12 mb-5 pt-4  text-center">
                                    <input type="hidden" name="id_emitente" value="<?php echo isset($emitente->id_emitente) ? $emitente->id_emitente : null ?>">
                                    <input type="submit" value="Salvar alterações" class="btn btn-verde btn-grande d-block m-auto">
                                </div>
                            </div>
                        </div>
                    </div>
		</form>
            </div>
	</div>
    </div>	
</div>
