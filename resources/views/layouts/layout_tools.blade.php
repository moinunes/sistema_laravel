<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Sistema Laravel 5</title>

   <!-- css -->
   <link href="/css/app.css"     rel="stylesheet">
   <link href="/css/estilos.css" rel="stylesheet">
   <link href="/css/menu.css"    rel="stylesheet">
      
   <!-- jquery -->
   <script type="text/javascript" src="/jquery/jquery.js"></script>
   <script type="text/javascript" src="/jquery/jquery-ui.js"></script>   

   <!-- checkboxtree-->
   <link type="text/css" href="/checkboxtree/library/jquery-ui-1.8.12.custom/css/smoothness/jquery-ui-1.8.12.custom.css" rel="stylesheet"/>
   <link type="text/css" href="/checkboxtree/jquery.checkboxtree.css" rel="stylesheet" >
   <script type="text/javascript" src="/checkboxtree/jquery.checkboxtree.js"></script>

   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
   
</head>

<body>
   <?php $nome_sistema ='Ferramentas do Sistema' ?>
    
   <nav class="navbar navbar-default cor_verde">
      <div class="container-fluid">         
            <div class="row" >
               <table class="table-responsive" border="0" width="100%">
                  <tr>
                     <td width="10%"></td>
                     <td width="10%"><div class="div_logo"><a target="blank" href="http://laravel.com"><img src="/img/logo.png"></a></div></td>
                     <td width="30%"><div class="title"><?=$nome_sistema?></div></td>
                     <td width="25%"><div class="text-muted"><?= 'usuário: '.Auth::user()->name?></div></td>
                     <td width="25%"><div class="text-info"><?=date("d/m/Y")?></div></td>
                  </tr>
                  <tr>
                     <td colspan="5"><hr></td>                     
                  </tr>
                  
               </table>                 
            </div>
         
            <div class="row">               
               <div class="col-md-10 col-md-offset-1">
                  <nav id="menu-wrap">
                     <ul id="menu">
                        <li><a href="/">Home</a></li>
                        <li><a href="#">Ferramentas básicas</a>
                           <ul>
                              <li><a href='/tools/carregar_menu'>Carregar Menu</a></li>
                              <li><a href='/tools/teste'>teste</a></li>                              
                           </ul>                  
                        </li>
                        <li><a href="#">disponível</a>
                           <ul>
                              <li><a href='/tools/carregar_menu'>disponível</a></li>
                              <li><a href='/tools/carregar_menu'>disponível</a></li>
                           </ul>                  
                        </li>
                        <li><a href="/logout">Sair</a></li>
                     </ul>
                  </nav>

               </div>
            </div>
        
                     
      </div>  
   </nav>

    <div class="container-fluid">
   @yield('content')
    </div>

   
</body>
</html>
