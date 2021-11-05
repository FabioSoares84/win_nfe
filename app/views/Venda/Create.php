<div class="rows">	
    <div class="col-12">
        <div class="caixa">
            <div class="caixa-titulo py-1 d-inline-block width-100">
                <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Adicionar Venda</span>
                <a href="<?php echo URL_BASE. "venda" ?>" class="btn btn-amarelo float-right"><i class="fas fa-arrow-left mb-0"></i> Voltar</a>
            </div>
					
            <div class="p-5 pb-0 pt-0 width-100 float-left">  								
                <div class="rows pb-4">	
                    <div class="col-12">
                    <span class="d-block mt-0 h4 pb-2 border-bottom">Venda </span>
                        <div class="caixa">
                            <form action="<?php echo URL_BASE."venda/salvar" ?>" method="POST">
                                <div class="rows p-4">
                                    <div class="col-6 mb-3 position-relative">
                                        <label class="text-label">Cliente</label>
                                            <select class="form-campo" name="id_cliente">
                                            <?php 
                                                foreach ($clientes as $cliente){
                                                    echo "<option value='$cliente->id_cliente'>$cliente->nome</opction>";
                                                }
                                            ?>
                                            </select>								  
                                    </div>

                                    <div class="col-2 mb-3">
                                        <label class="text-label">Data</label>
                                        <input type="date" name="data_venda" value="<?php echo hoje() ?>"   class="form-campo">
                                    </div>	
                                    <div class="col-2 mb-3">
                                        <label class="text-label">Hora</label>
                                        <input type="text" name="hora_venda" value="<?php echo agora() ?>"   class="form-campo">
                                    </div>						
                                    <div class="col-2 mt-4  mt-sm-4">
                                        <input type="hidden" id="id_venda" name="id_venda">                              
                                        <input type="submit" value="Inserir" id="btnInserirProduto" class="btn btn-azul width-100">
                                    </div>                                                                                                                    
                                </div>
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>

