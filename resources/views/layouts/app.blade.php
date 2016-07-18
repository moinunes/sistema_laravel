<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Laravel</title>

       <link href="/css/estilos.css"             rel="stylesheet">

    <!-- Styles -->
    <link href="bootstrap/css/bootstrap.css"     rel="stylesheet">
  
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

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
