<?php
namespace App\Core\Repositories;

use App\Uf;

use App\Core\Infra\Infra_Tabela;
use App\Core\Infra\Infra_Filtro;
use App\Core\Infra\Infra_Relatorio;

use DB;
use Validator;
use Input;
 
use Illuminate\Http\Request;

class UfRepository extends Uf {
   
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
         $uf = new Uf();
         $this->igualar_objeto( $uf ) ;
         $this->tudo_ok = true;
         return $uf->save();
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
         //dd($request);
         $uf = Uf::findOrFail( $request['id_uf'] );
         $uf->sigla_uf = $request['sigla_uf'];
         $uf->nome_uf  = $request['nome_uf'];       
    
         $uf->update( $request );
         $this->tudo_ok = true;
      }
   } // alterar

   /** 
   * iguala o objeto
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_objeto( &$uf ) {
      $uf->id_uf    = $this->_request['id_uf'   ];  
      $uf->sigla_uf = $this->_request['sigla_uf'];
      $uf->nome_uf  = $this->_request['nome_uf' ];          
   } // igualar_objeto

   /** 
   * iguala o formulário
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_formulario( &$resultado, $id ) {
      $resultado = new \stdClass;
      $uf        = Uf::Find($id);
      $achou     = ($uf) ? true : false;

      $resultado->acao     = $this->acao;
      $resultado->readonly = ( $this->acao == 'consultar' || $this->acao == 'excluir' ) ? 'readonly' : '';
      $resultado->achou    = $achou;
      
      $resultado->id_uf    = $achou ? $uf->id_uf    : null;
      $resultado->sigla_uf = $achou ? $uf->sigla_uf : null;
      $resultado->nome_uf  = $achou ? $uf->nome_uf  : null;
   } // igualar_formulario

   /** 
   * exclui o registro
   *
   * @param int   id
   */
   public function Excluir( $id ) {
      $uf = Uf::find( $id );
      $uf->delete();
      $this->tudo_ok = true;      
   } // Excluirr

   /**
   * obtém os filtros
   */
   public function obter_filtro( &$resultado ) {
      $filtro = array();
      $resultado = new \stdClass();

      // define os nomes dos filtros
      $infra_filtro = new Infra_Filtro(); 
      $infra_filtro->nomes_filtros  = new \stdClass();
      $infra_filtro->nomes_filtros->filtro_sigla_uf     = '';
      $infra_filtro->nomes_filtros->filtro_nome_uf = '';
      $infra_filtro->ordem_default = 'sigla_uf';

      // prepara os filtros
      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_sigla_uf != '' ) {         
         $filtro[] = "( sigla_uf like '%{$infra_filtro->inputs->filtro_sigla_uf}%' )";
      }
      if ( $infra_filtro->inputs->filtro_nome_uf != '' ) {
         $filtro[] = "nome_uf LIKE '%{$infra_filtro->inputs->filtro_nome_uf}%'";
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
      if ( $filtros->inputs->filtro_sigla_uf != '' ) {         
         $filtro[] = "( sigla_uf like '%{$filtros->inputs->filtro_sigla_uf}%' )";
      }
      if ( $filtros->inputs->filtro_nome_uf != '' ) {
         $filtro[] = "nome_uf LIKE '%{$filtros->inputs->filtro_nome_uf}%'";
      }
      $where = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $ordem = $filtros->ordem;
      $rs = DB::select( " SELECT * FROM tbuf WHERE ".$where ." ORDER BY ". $ordem ) ;
 
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
         $rel->Cell(20, 8, $registro->sigla_uf,     0, 0, 'L');
         $rel->Cell(80, 8, utf8_decode($registro->nome_uf),  0, 0, 'L');
      }
      $rel->Output();
      
   } // imprimir

   private function _obter_regras( &$regras ) {
      $id_uf = Input::get('id_uf');
      $regras = [ 'sigla_uf' => 'required|min:2|max:2|unique:tbuf,sigla_uf,'.$id_uf.',id_uf',
                  'nome_uf'  => 'required',
                ];
   } // obter_regras

}