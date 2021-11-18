<section class="conteudo">			
    <div class="conteudo-fluido">
    <div class="rows">	
        <div class="col-12">
            <div class="caixa">
                <div class="caixa-titulo py-1 d-inline-block width-100">
                        <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Inserir Tributação</span>
                        <a href="<?php echo URL_BASE?>tributacao/index" class="btn btn-amarelo float-right"><i class="fas fa-arrow-left mb-0"></i> Voltar</a>
                </div>
                <?php 
                    $this->verErro();
                    $this->verMsg();
                ?>
                <form action="<?php echo URL_BASE ."tributacao/salvar" ?>" method="POST">
                    <div class="p-5 pb-0 pt-4 mb-4 width-100 float-left">	                       	
                        <div class="tab-content current py-4 px-5">
                            <div class="rows p-5">
                                <div class="col-12 mb-3">
                                    <label class="text-label">Descrição da tributação</label>	
                                    <input type="text" name="tributacao" value="<?php echo isset($tributacao) ? $tributacao->tributacao : null ?>" placeholder="Digite aqui..." class="form-campo">
                                </div>  
                                <div class="col-12" style="clear:both">
                                    <input type="hidden" name="id_tributacao" value="<?php echo isset($tributacao) ? $tributacao->id_tributacao: null ?>">
                                    <input type="submit" value="Salvar Tributação" class="btn btn-verde m-auto px-4" >
                                </div>		 
                            </div>  					
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>