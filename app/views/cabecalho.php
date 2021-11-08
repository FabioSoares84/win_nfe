<header class="bg-topo">
    <div class="conteudo">
	<div class="navbar">
            <input type="checkbox" id="chx">
            <label for="chx" class="mobmenu"><!--menu mobile--><i class="fas fa-bars"></i></label>
            <a href="<?php echo URL_BASE ?>" class="logo" alt="ERP completa"><img src="<?php echo URL_BASE ?>assets/img/logo.png" class="img-fluido"></a>	

            <ul class="menutopo">
                <li id="button"><img src="<?php echo URL_BASE ?>assets/img/foto.png" class="img"> <span>Fábio Soares  </span></li>					
                <ul id="effect" class="newClass">
                    <li><a href=""><i class="fas fa-sign-in-alt"></i> Sair</a></li>
                </ul>
            </ul>
				
            <nav class="menuprincipal" id="principal">					
                <ul class="menu-ul">
                    <li class="bg-menu"><a href=""><i class="icon fas fa-arrow-left"></i> Recolher menu</a></li>
                    <li><a href="configuracao_nota.html"><i class="icon fas fa-file-invoice-dollar"></i> Configurações de nota</a></li>
                    <li><a href="#menu_empresa"><span>+</span>  Empresa <i class="icon ihome fas fa-truck"></i></a></li>
                    <li><a href="#menu_contato"><span>+</span>  Contato <i class="icon ihome fas fa-user-tag"></i></a></li>
                    <li><a href="#menu_produto"><span>+</span>  Produto <i class="icon ihome fas fa-cube"></i></a></li>
                    <li><a href="<?php echo URL_BASE ."venda"?>"><i class="icon fas fa-file-invoice-dollar"></i> Venda</a></li>
                    <li><a href="#menu_tributacao" rel="ativo"><span>+</span>  Tributação <i class="icon ihome fas fa-book"></i></a></li>
                    <li><a href="#menu_notas" rel="ativo"><span>+</span>  Notas <i class="icon ihome fas fa-file-contract"></i></a></li>					
                </ul>
            </nav>

            <!-- MENU EMPRESA -->
            <nav class="menuprincipal" id="menu_empresa">
                    <ul class="menu-ul">
                            <li class="bg-menu"><a href=""><i class="icon fas fa-arrow-left"></i> Recolher menu</a></li>
                            <span class="h5 p-1 py-2 text-branco mb-0 d-block text-uppercase"><i class="icon fas fa-truck"></i> Emitente</span>
                            <li><a href="<?php echo URL_BASE ."emitente"?>"><i class="icon fas fa-list"></i> Lista</a></li>
                            <li><a href="<?php echo URL_BASE ."emitente/create"?>"><i class="icon fas fa-box"></i> cadastro</a></li>
                    </ul>
            </nav>

        <!-- MENU CONTATO -->
        <nav class="menuprincipal" id="menu_contato">
            <ul class="menu-ul">
                <li class="bg-menu"><a href=""><i class="icon fas fa-arrow-left"></i> Recolher menu</a></li>
                <span class="h5 p-1 py-2 text-branco mb-0 d-block text-uppercase"><i class="icon fas fa-user-tag"></i> Contato</span>
                <li><a href="<?php echo URL_BASE ."cliente"?>"><i class="icon fas fa-list"></i> Lista</a></li>
                <li><a href="<?php echo URL_BASE ."cliente/create"?>"><i class="icon fas fa-box"></i> cadastro</a></li>
            </ul>
        </nav>

        <!-- MENU PRODUTO -->
        <nav class="menuprincipal" id="menu_produto">
            <ul class="menu-ul">
                <li class="bg-menu"><a href=""><i class="icon fas fa-arrow-left"></i> Recolher menu</a></li>
                <span class="h5 p-1 py-2 text-branco mb-0 d-block text-uppercase"><i class="icon fas fa-cube"></i> Produto</span>
                <li><a href="<?php echo URL_BASE ."produto"?>"><i class="icon fas fa-list"></i> Lista</a></li>
                <li><a href="<?php echo URL_BASE ."produto/create"?>"><i class="icon fas fa-box"></i> cadastro</a></li>
            </ul>
        </nav>

        <!-- MENU TRIBUTAÇÃO -->
        <nav class="menuprincipal" id="menu_tributacao">
            <ul class="menu-ul">
                <li class="bg-menu"><a href=""><i class="icon fas fa-arrow-left"></i> Recolher menu</a></li>
                <span class="h5 p-1 py-2 text-branco mb-0 d-block text-uppercase"><i class="icon fas fa-book"></i> Tributação</span>
                <li><a href="lst_tributacao.html"><i class="icon fas fa-list"></i> Lista</a></li>
                <li><a href="frm_tributacao.html"><i class="icon fas fa-box"></i> cadastro</a></li>
            </ul>
        </nav>

    <!-- MENU NOTA -->
    <nav class="menuprincipal" id="menu_notas">
        <ul class="menu-ul">
            <li class="bg-menu"><a href=""><i class="icon fas fa-arrow-left"></i> Recolher menu</a></li>
            <span class="h5 p-1 py-2 text-branco mb-0 d-block text-uppercase"><i class="icon fas fa-file-contract"></i> Notas</span>
            <li><a href="<?php echo URL_BASE ."notafiscal"?>"><i class="icon fas fa-list"></i> Todas as notas</a></li>
            <li><a href="<?php echo URL_BASE ."notafiscal/create"?>"><i class="icon fas fa-box"></i> Nova nota</a></li>
            <li><a href="nfe_assinatura.html"><i class="icon fas fa-signature"></i> Assinada</a></li>
            <li><a href="nfe_validada.html"><i class="icon fas fa-stamp"></i> Validada</a></li>
            <li><a href="nfe_autorizada.html"><i class="icon fas fa-check-double"></i> Autorizada</a></li> 
            <li><a href="nfe_cancelada.html"><i class="icon far fa-window-close"></i> Cancelada</a></li>
        </ul>
    </nav>			
        </div>
    </div>
</header>