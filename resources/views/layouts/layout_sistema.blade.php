<?php
use App\Core\Infra\Infra_Menu;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">   
   <title>Sistema Laravel 5.2</title>
 
   <!-- jquery -->
   <script type="text/javascript" src="/jquery/jquery.js"></script>
   <script type="text/javascript" src="/jquery-ui/jquery-ui.js"></script>
   <link href="/jquery-ui/jquery-ui.css" rel="stylesheet">
   
   <!-- bootstrap -->
   <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>  
   <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
   <link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

   <!-- jstree -->   
   <script src="/jstree/dist/jstree.min.js"></script>   
   <link rel="stylesheet" href="/jstree/dist/themes/default/style.min.css" />

   <!-- especifico da aplicação -->   
   <link href="/css/estilos.css" rel="stylesheet">
   <link href="/css/menu.css"    rel="stylesheet">
   <script type="text/javascript" src="/js/sistema.js"></script> 
   <script type="text/javascript" src="/js/buscar.js"></script> 
   
</head>

<body>
   <?php $nome_sistema ='PROJETO - Laravel 5.2' ?>
    
   <nav class="navbar">
      <div class="container-fluid">
         
         @if (Auth::guest())         
            <div class="col-md-10 col-md-offset-1">
               <table border="0" width="100%">
                  <tr>
                     <td width="10%"><div class="div_logo"><a target="blank" href="http://laravel.com"><img src="/img/logo.png"></a></div></td>
                     <td width="35%"><div class="title"><?= $nome_sistema?></div></td>
                     <td width="35%">
                        <ul class="nav navbar-nav navbar-right">
                           <li><a href="/auth/login">Entrar</a></li>
                        </ul>
                     </td>
                     <td width="35%">
                        <ul class="nav navbar-nav navbar-right">
                           <li><a href="/auth/register">Registrar</a></li>
                        </ul>
                     </td>
                  </tr>
               </table>
            </div>
         @else
            <div class="row">            
               <table class="table-responsive" border="0" width="100%">
                  <tr class="cor_verde">
                     <td width="10%"></td>
                     <td width="10%"><div class="div_logo"><a target="blank" href="http://laravel.com"><img src="/img/logo.png"></a></div></td>
                     <td width="20%"><div class="title"><?=$nome_sistema?></div></td>
                     <td width="10%"><div class="text-muted"><?= Auth::user()->usuario;?></div></td>
                     <td width="50%">
                        <button type="button" class="btn btn_menu" onclick="window.location.href='/produto'">PRODUTOS</button>
                        <button type="button" class="btn btn_menu" onclick="window.location.href='/produto'">CLIENTES</button>
                        <button type="button" class="btn btn_menu" onclick="window.location.href='/produto'">PEDIDOS</button>
                        <button type="button" class="btn btn_menu" onclick="window.location.href='/produto'">NFE</button>
                        <button type="button" class="btn btn_menu" onclick="window.location.href='/produto'">NFS</button>
                     </td>
                  </tr>
                  <tr class="cor_verde">
                     <td colspan="5"><hr class="hr1"></td>
                  </tr>
                  <tr class="cor_verde">
                     <td colspan="5">
                        <div class="col-md-10 col-md-offset-1">
                           <?php
                           $menu = new Infra_Menu();
                           $menu->montar_menu();
                           ?>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="5"><hr class="hr1"></td>
                  </tr>
                  <tr>
                     <td height="5"></td>
                  </tr>

                  <tr >
                     <td colspan="5" height="550"  VALIGN="top" ALIGN="CENTER">
                        <table width="100%">
                           <tr>
                              <td colspan="3"></td>
                           </tr>
                           <tr >
                              <td width="10%"></td>
                              <td width="80%">@yield('content')</td>
                              <td width="10%"></td>
                           </tr>
                        </table>
                     </td>
                  </tr>

               </table>
            </div>
         @endif                     
   
      </div>  
   </nav>
         
   <div class="div_rodape" >            
      <table  border="0" width="100%">
         <tr>
            <td width="10%"></td>
            <td width="20%"><div class="text-muted"><?= 'usuário: '.Auth::user()->nome?></div></td>
            <td width="70%"><div class="text-info"><?=date("d/m/Y")?></div></td>
         </tr>
         
      </table>
   </div>


</body>
</html>
