<!--****************Codigo para corrigir acentuação utf-8***********************-->
<?php

    header("Content-Type: text/html; charset=utf-8",true); 
    ?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dara - Administrador</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="/administracao/apple-icon.png">
    <link rel="shortcut icon" href="/administracao/favicon.ico">
    <link rel="stylesheet" href="/administracao/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/administracao/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/administracao/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/administracao/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/administracao/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/administracao/vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="/administracao/assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!--anima��o da fun��o SHOW(( -->
    <script src="/meus_javascripts/sweetalert.min.js"></script>

    <!--estilo do avatar -->
    <style>
        .avatar {
  vertical-align: middle;
  width: 60px;
  height: 55px;
  border-radius: 50%;
}

.responsive {
  width: 100%;
  height: auto;
}

img.logo-navbar {
    width: 10rem !important;
    height: 5rem !important;
}

a {text-decoration:none;}

.profile-wrapper {
	width:200px;
	position:relative;
	margin:50px auto;
}
.profile-wrapper::after {
	content: '';
	position: absolute;
	top: 20px;
	right: 10px;
	border-color: #333 transparent transparent;
	border-width: 6px;
	border-style: solid;
}
.profile-wrapper::before {
	content: '';
	position: absolute;
	top: 20px;
	right: 10px;
	border-color: #eee transparent transparent;
	border-width: 6px;
	border-style: solid;
}

.profile .name {
	font-size:12px;
	color:#fff;
	line-height:26px;
	margin-left:10px;
}
.profile .name:hover {
	color:#0088cc;
}
.profile img {

	display:inline;
	box-shadow:0 0 3px rgba(0, 0, 0, 0.5) inset;
}

/* hover profile show menu */
.profile:hover .PassarCima {
	display:block;
}
    </style>
</head>
<body onload=display_ct();>
    <aside id="left-panel" class="left-panel bg-secondary">
        <nav class="navbar navbar-expand-sm navbar-default bg-secondary">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/administracao/index.php"><img src="/images/logo_copia.png" alt="Logo" class="img-responsive"></a>
                <a class="navbar-brand hidden" href="/administracao/index.php">
                    <span class="brand-name">D</span>
                </a>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu-icon">
                        <a href="/administracao/index.php"> <i class="menu-icon fa ti-home"></i>Página Inical </a>
                    </li>
                    <h3 class="menu-title">Área Produtos</h3><!-- /.menu-title -->
                    <li class="menu-icon">
                        <a href="/administracao/produtos/index.php"> <i class="menu-icon fa ti-panel"></i>Gerir Produtos</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa ti-eye"></i>Consultar Produtos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="/administracao/produtos/marcas_produtos/marca_padrao.php">Padrão</a></li>
                            <li><i class="fa fa-table"></i><a href="/administracao/produtos/marcas_produtos/marca_dara.php">My Dara</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Área Utilizadores</h3><!-- /.menu-title -->

                    <li class="menu-icon">
                        <a href="/administracao/utilizadores/index.php"> <i class="menu-icon fa ti-panel"></i>Gerir Utilizadores</a>
                    </li>
                    <h3 class="menu-title">Área Salários</h3><!-- /.menu-title -->
                    <li class="menu-icon">
                        <a href="/administracao/salarios/index.php"> <i class="menu-icon fa ti-clipboard"></i>Gerir Salários</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa ti-eye"></i>Consultar Salários</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="/administracao/salarios/salarios_marcas/padrao.php">Funcionários Padrão</a></li>
                            <li><i class="fa fa-table"></i><a href="/administracao/salarios/salarios_marcas/dara.php">Funcionários Dara</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Área Funcionário</h3><!-- /.menu-title -->
                    <li class="menu-icon">
                        <a href="/administracao/funcionarios/index.php"> <i class="menu-icon fa ti-panel"></i>Gerir Funcionários</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa ti-eye"></i>Consultar Funcionários</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="/administracao/funcionarios/empresa_funcionarios/padrao.php">Padrão</a></li>
                            <li><i class="fa fa-table"></i><a href="/administracao/funcionarios/empresa_funcionarios/dara.php">Dara</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Empresa</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-euro"></i>Gestão Monetária</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa ti-bar-chart"></i><a href="/administracao/empresa/gestao_dara.php">Dara</a></li>
                            <li><i class="menu-icon fa ti-bar-chart"></i><a href="/administracao/empresa/gestao_padrao.php">Padrão</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <marquee width="40%" direction="left" height="40%">
                        <!--   Dara - Collants e Meias de Senhora para Homem e Crianca -->
                        <p>
                            <?php
                    echo ' A administração da DARA deseja-lhe uma boa semana, '.$_SESSION['utilizador'].'';
                    ?>
                        </p>
                    </marquee>
                    <div align="right">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="user-area profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-area float-left" align="left">
                                <!--BEM VINDO UTILIZADOR X -->
                                <br>
                                <?php
							echo '<p style="color:#808080"> Bem-vindo(a), '.$_SESSION['utilizador'].' </p>';
                        ?>
                            </div>
                            <div class="user-area" align="right">
                                <?php if($_SESSION['fotografia'] != ''){ ?>
                                <p style="margin-left:0.7em"><img src="/images/imagens_utilizador/<?php echo $_SESSION['fotografia']?>" <?php echo $_SESSION['utilizador']?> alt="Avatar" class="avatar" /> </p>
                                <?php } else{ ?>
                                <p style="margin-left:0.7em"><img src="/images/desconhecido.png" alt="Avatar" class="avatar" <?php echo $_SESSION['utilizador']?> /></p>
                                <?php } ?>
                            </div>
                        </a>
                        <ul class="menu dropdown-menu" align="bottom">
                            <li><a class="nav-link" href="/administracao/pagina_perfil.php"><i class="fa fa-user"></i> Meu Perfil</a></li>
                            <li><a class="nav-link" href="/logout.php" onclick="return confirm('Tem a certeza que deseja sair?');"><i class="fa fa-power-off"></i> Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>