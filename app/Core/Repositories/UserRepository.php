<?php
namespace App\Core\Repositories;

use App\User;

use App\Core\Infra\Infra_Tabela;
use App\Core\Infra\Infra_Filtro;
use App\Core\Infra\Infra_Relatorio;

use DB;
use Validator;
use Input;
use Crypt; 
use Illuminate\Http\Request;

class UserRepository extends User {
   
   private $_request;
   public $acao;

   public function __construct() {
      $this->tudo_ok = false;
   } // __construct
   
   /**
   * incluir
   *
   * @param do todos inputs
   */
   public function Incluir( $request ) {
      $this->_request = $request;      
      $this->_obter_regras( $regras );
      $this->validacao = Validator::make( $request , $regras );
      if ( $this->validacao->passes() ) {
         $user = new User();
         $this->igualar_objeto( $user ) ;
         $this->tudo_ok = true;
         return $user->save();
      }
   } // Incluir

   /** 
   * altera o registro
   *
   * @param object      atributos para persistir
   */
   public function Alterar( $request ) {
      $this->_request = $request;
      $this->_obter_regras( $regras );
      $this->validacao = Validator::make( $request , $regras );
      if ( $this->validacao->passes() ) {      
         $user = User::findOrFail( $request['id'] );
         $this->igualar_objeto( $user ) ;             
         $user->save();        
         $this->tudo_ok = true;
      }
   } // alterar

 
   /** 
   * iguala o formulário
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_formulario( &$resultado, $id ) {
      $resultado = new \stdClass;
      $user      = User::Find($id);
      $achou     = ($user) ? true : false;
 
      $resultado->acao     = $this->acao;
      $resultado->readonly = ( $this->acao == 'consultar' || $this->acao == 'excluir' ) ? 'readonly' : '';
      $resultado->achou    = $achou;
     
      $resultado->id              = $achou ? $user->id    : null;
      $resultado->nome            = $achou ? $user->nome  : null;
      $resultado->usuario         = $achou ? $user->usuario  : null;
      $resultado->email           = $achou ? $user->email : null;
//dd($this->acao);
      $resultado->password           = $this->acao == 'alterar' ? 'null' : '';
      $resultado->password_confirmar = $this->acao == 'alterar' ? 'null' : '';

//dd($resultado);
   } // igualar_formulario

  /** 
   * iguala o objeto
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_objeto( &$user ) {
      $user->id       = $this->_request['id'   ];  
      $user->nome     = $this->_request['nome' ];
      $user->usuario  = $this->_request['usuario' ];
      $user->email    = $this->_request['email'];      
      if ( ( $this->_request['acao'] == 'incluir' ) || 
           ( $this->_request['acao'] == 'alterar' && $this->_request['password'] != 'null' ) ) {
         $user->password = Crypt::encrypt($this->_request['password']);
      }
   } // igualar_objeto

   /** 
   * exclui o registro
   *
   * @param int   id
   */
   public function Excluir( $id ) {
      $user = User::find( $id );
      $user->delete();
      $this->tudo_ok = true;      
   } // Excluir

   /**
   * obtém os filtros
   */
   public function obter_filtro( &$resultado ) {
      $filtro = array();
      $resultado = new \stdClass();

      // define os nomes dos filtros
      $infra_filtro = new Infra_Filtro(); 
      $infra_filtro->nomes_filtros  = new \stdClass();
      $infra_filtro->nomes_filtros->filtro_nome    = '';
      $infra_filtro->nomes_filtros->filtro_usuario = '';
      $infra_filtro->nomes_filtros->filtro_email   = '';
      $infra_filtro->ordem_default = 'nome';

      // prepara os filtros
      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_nome != '' ) {         
         $filtro[] = "( nome like '%{$infra_filtro->inputs->filtro_nome}%' )";
      }
      if ( $infra_filtro->inputs->filtro_usuario != '' ) {         
         $filtro[] = "( usuario like '%{$infra_filtro->inputs->filtro_usuario}%' )";
      }
      
      if ( $infra_filtro->inputs->filtro_email != '' ) {
         $filtro[] = "email LIKE '%{$infra_filtro->inputs->filtro_email}%'";
      }  

      // retorna $resultado
      $resultado->where  = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $resultado->ordem  = $infra_filtro->ordem;
      $resultado->inputs = $infra_filtro->inputs;
   } // obter_filtro

    /**
   *  Imprime os registros da grid
   */   
   public function imprimir() {
         $filtro = array();
      Infra_Filtro::obter_array_filtros( $filtros );   
      if ( $filtros->inputs->filtro_nome != '' ) {         
         $filtro[] = "( nome like '%{$filtros->inputs->filtro_nome}%' )";
      }
      if ( $filtros->inputs->filtro_email != '' ) {
         $filtro[] = "email LIKE '%{$filtros->inputs->filtro_email}%'";
      }
      $where = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $ordem = $filtros->ordem;
      $rs = DB::select( " SELECT * FROM users WHERE ".$where ." ORDER BY ". $ordem ) ;
 
      $rel = new Infra_Relatorio();
      $rel->titulo = 'U.F.';
      $rel->AliasNbPages();
      $rel->AddPage();
     
      $rel->SetFont('Times', 'B', 12);
      $rel->Cell(20, 2,  utf8_decode('Sigla'     ), 0, 0, 'L');
      $rel->Cell(80, 2,  utf8_decode('Nome' ), 0, 0, 'L');
      $rel->Line( 205, 27, 5, 27 );
      $rel->SetFont('Arial', '', 11);            
      foreach ( $rs as $index => $registro) {
         $rel->Ln( 7 );
         $rel->Cell(20, 8, $registro->nome,     0, 0, 'L');
         $rel->Cell(80, 8, utf8_decode($registro->email),  0, 0, 'L');
      }
      $rel->Output();
      
   } // imprimir

   private function _obter_regras( &$regras ) {
      $id = Input::get('id');
      $regras = [ 'nome'     => 'required|min:2|max:40|unique:users,nome,'.$id.',id',
                  'email'    => 'required|min:2|max:40|unique:users,email,'.$id.',id',
                  'usuario'  => 'required|min:2|max:30|unique:users,usuario,'.$id.',id',                  
                  'password'           => 'required',                  
                  'password_confirmar' => 'required|same:password'   
                ];
   } // obter_regras

}