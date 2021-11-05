<div class="rows">	
    <div class="col-12">
        <div class="caixa">
            <div class="caixa-titulo py-1 d-inline-block width-100">
                <span class="h5  pt-1 mb-0 d-inline-block"><i class="far fa-list-alt"></i> Adicionar Nota</span>
		<a href="#" class="btn btn-vermelho float-right"><i class="fas fa-arrow-left mb-0"></i> Voltar</a>
            </div>					
            <div class="p-5 pb-0 pt-0 width-100 float-left">								
                <div class="rows pb-4 mt-3">	
                    <div class="col-12">
		        <div class="caixa bg-padrao venda">
                            <div class="p-1 border-bottom width-100 d-inline-block">
                                <span class="text-branco text-uppercase float-left"> Cliente</span>
                                <a href="" class="btn btn-amarelo btn-pequeno float-right"> Editar cliente</a>
                            </div>
                            
                            <div class="rows">
                                <div class="col-6 position-relative border-right">
                                    <div class="p-1 pb-2">
                                        <label class="text-label"><i class="fas fa-user"></i> Cliente</label>
                                        <span class="d-block text-branco h5 mb-0">Manoel Jailton</span>								  
                                    </div>
                                </div>

                                <div class="col-2 border-right">
                                    <label class="text-label"><i class="fas fa-calendar-alt"></i> Data</label>
                                    <span class="d-block text-branco h5 mb-0">21/10/2021</span>
                                </div>
                                
                                <div class="col-2 border-right">
                                    <label class="text-label"><i class="fas fa-clock"></i> Hora</label>
                                    <span class="d-block text-branco h5 mb-0">10:00</span>
                                </div>
                                
                                <div class="col-2">
                                    <label class="text-label"><i class="fas fa-dollar-sign"></i> Total</label>
                                    <span class="d-block text-branco h5 mb-0">R$ 100</span>
                                </div>							
                            </div>
                        </div>
                        <form action="<?php echo URL_BASE ."itemvenda/salvar"?>" method="POST">		
                            <div class="caixa bg-cinza">
                                <div class="rows p-4">
                                    <div class="col-6 mb-3 position-relative">
                                        <label class="text-label">Nome do Produto</label>
                                        <select id="id_produto" name="id_produto" class="form-campo" onchange="buscarProduto()">
                                            <option>Selecione um produto</option>

                                            <?php foreach ($produtos as $produto){
                                               echo"<option value='$produto->id_produto'>$produto->produto</option>"; 
                                            }?>

                                        </select>
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
                                        <input type="hidden" id="id_venda" name="id_venda" value="<?php echo $venda->id_venda ?>">                              
                                        <input type="submit" value="Inserir" class="btn btn-verde width-100">
                                    </div>                                                                                                                    
                                </div>
                            </div>
                        </form>
                        <div class="tabela-responsiva border p-0">
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
                                    <tr>
                                        <td align="left">1</td>
                                        <td align="left">Produto 01</td>
                                        <td align="center">R$ 50</td>
                                        <td align="center">2</td>							
                                        <td align="center">R$ 100</td>
                                        <td align="center"><a href="javascript:;" onclick="return excluir(this)" data-entidade ="itemvenda" data-id="<?php echo $item->id_item_venda ?>" class="fas fa-trash-alt text-vermelho"> Excluir</a> </td>
                                    </tr>
                               </tbody>
                            </table>
                            <footer class="caixa-rodape text-right"> 
                                <a href="<?php echo URL_BASE."venda/excluirItens/".$item->id_venda ?>" onclick="" class="btn btn-amarelo d-inline-block"><i class="fas fa-broom"></i> Excluir Itens</a>
                                <a href="<?php echo URL_BASE."venda/excluir/".$item->id_venda ?>" onclick="" class="btn btn-vermelho d-inline-block"><i class="fas fa-trash"></i> Excluir Venda</a>
                                <a href="<?php echo URL_BASE."venda/finalizar/".$item->id_venda ?>" class="btn btn-verde d-inline-block"><i class="fas fa-check"></i> Finalizar Venda</a>
                            </footer>			
                        </div>
                    </div>   
                </div> 
            </div>
        </div>
    </div>
</div>

