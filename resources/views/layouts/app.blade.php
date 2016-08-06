<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Laravel</title>

    <link href="/css/estilos.css"             rel="stylesheet">

    <!-- jquery -->
   <script type="text/javascript" src="/jquery/jquery.js"></script>
   <script type="text/javascript" src="/jquery-ui/jquery-ui.js"></script>
   <link href="/jquery-ui/jquery-ui.css" rel="stylesheet">
   
   <!-- bootstrap -->
   <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>  
   <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
   <link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
   
  
</head>
<body>
   <?php $nome_sistema ='PROJETO - Laravel 5.2' ?>
    <nav class="navbar">
      <div class="container-fluid">

         <div class="row" >             
               <table class="table-responsive cor_verde" border="0" width="100%">                 
                  <td width="10%"></td>
                  <td width="10%"><div class="div_logo"><a target="blank" href="http://laravel.com"><img src="/img/logo.png"></a></div></td>
                  <td width="30%"><div class="title"><?=$nome_sistema?></div></td>
                  <td width="50%"></td>                  
               </table>            
         </div>
      </div>
   </nav>

  <div class="container-fluid">
       <div class="row row-centered"> 
         <div class="col-md-4 col-md-offset-4">
           @yield('content')
         </div>
      </div>
   </div>
   
</body>
</html>
