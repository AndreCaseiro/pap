<!--****************Codigo para corrigir acentuação utf-8***********************-->
<?php 
    header("Content-Type: text/html; charset=utf-8",true); 

    ?>
    
<html>
<head>
    <meta charset="utf-8"> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dara - Funcionário</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="/funcionario/apple-icon.png">
    <link rel="shortcut icon" href="/funcionario/favicon.ico">
    <link rel="stylesheet" href="/funcionario/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/funcionario/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/funcionario/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/funcionario/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/funcionario/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/funcionario/vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="/funcionario/assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    
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
    </style>
    
</head>

<aside id="left-panel" class="left-panel bg-secondary">
    <nav class="navbar navbar-expand-sm navbar-default bg-secondary">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
          
            <!-- <a class="navbar-brand" href="./index.php"><img src="images/logo1.png" alt="Logo"></a> -->
            <a class="navbar-brand" href="/funcionario/index.php"><img src="/images/logo_copia.png" alt="Logo"></a> 
            <a class="navbar-brand hidden" href="/funcionario/index.php">
                <span class="brand-name">D</span>
            </a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/funcionario/index.php"> <i class="menu-icon fa ti-home"></i>Página Inical </a>
                </li>
                <h3 class="menu-title">Área Produtos</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa ti-eye"></i>Consultar Produtos</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="/funcionario/consultar_produtos/marca_padrao.php">Padrão</a></li>
                        <li><i class="fa fa-table"></i><a href="/funcionario/consultar_produtos/marca_dara.php">My Dara</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Área Funcionário</h3><!-- /.menu-title -->
                <li class="menu-icon">
                    <a href="/funcionario/consultar_salarios/index.php"> <i class="menu-icon fa ti-clipboard"></i>Consultar Salário</a>
                </li>
                <li class="menu-icon">
                    <a href="/funcionario/consultar_premios/index.php"> <i class="menu-icon fa ti-eye"></i>Consultar Prémios</a>
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
            </div>

            

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        <!--Imagem utilizador---
                        
                        echo '<img class style= "user-avatar rounded" "padding-left:30px; padding-top:30px" src="/imagens/imagens_utilizador/'.$_SESSION['fotografia'].'" height="100" width="100" />';
                         -->

                       <!-- <img class="user-avatar rounded" src="/administracao/images/admin.jpg" alt="AvatarUtilizador" height="100%" width="100%"> -->
					   
					   
               <div class="user-area float-left" align="left" >
                            <!--BEM VINDO UTILIZADOR X -->
                            
  
                            <br>
                            <?php
							echo '<p style="color:#808080"> Bem-vindo(a), '.$_SESSION['utilizador'].' </p>';
                        ?>
                        </div>
                        <div class="user-area" align="right" >    
                            
                     
                            
                             <?php if($_SESSION['fotografia'] != ''){ ?>
                            <p style="margin-left:0.7em"><img src="/images/imagens_utilizador/<?php echo $_SESSION['fotografia']?>"  <?php echo $_SESSION['utilizador']?> alt="Avatar" class="avatar" /> </p>     
                <?php } else{ ?>  
                            <p style="margin-left:0.7em"><img src="/images/desconhecido.png" alt="Avatar" class="avatar" <?php echo $_SESSION['utilizador']?> /></p>       
                <?php } ?>
                            
                          
                        </div>
                    </a>

                    <ul class="menu dropdown-menu" align="bottom">

                            <li><a class="nav-link" href="/funcionario/pagina_perfil.php"><i class="fa fa-user"></i> Meu Perfil</a></li>

                            <li><a class="nav-link" href="/logout.php" onclick="return confirm('Tem a certeza que deseja sair?');"><i class="fa fa-power-off"></i> Sair</a></li>

                        </ul>
                </div>


            </div>
        </div>

    </header>
