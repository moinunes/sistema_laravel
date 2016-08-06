<?php
namespace App\Core\Repositories;

use App\Fornecedor;

use App\Core\Infra\Infra_Tabela;
use App\Core\Infra\Infra_Filtro;
use App\Core\Infra\Infra_Relatorio;

use DB;
use Validator;
use Input;
 
use Illuminate\Http\Request;

class FornecedorRepository extends Fornecedor {
   
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
         $fornecedor = new Fornecedor();
         $this->igualar_objeto( $fornecedor ) ;
         $this->tudo_ok = true;
         return $fornecedor->save();
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
         $fornecedor = Fornecedor::findOrFail( $request['id_fornecedor'] );
         $fornecedor->codigo = $request['codigo'];
         $fornecedor->nome   = $request['nome'];       
    
         $fornecedor->update( $request );
         $this->tudo_ok = true;
      }
   } // alterar

   /** 
   * exclui o registro
   *
   * @param int   id
   */
   public function Excluir( $id ) {
      $fornecedor = Fornecedor::find( $id );
      $fornecedor->delete();
      $this->tudo_ok = true;      
   } // Excluirr

 
   /** 
   * iguala o objeto
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_objeto( &$fornecedor ) {
      $fornecedor->id_fornecedor  = $this->_request['id_fornecedor' ];
      $fornecedor->codigo = $this->_request['codigo'];
      $fornecedor->nome   = $this->_request['nome'  ];      
   } // igualar_objeto

   /** 
   * iguala o formulário
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_formulario( &$resultado, $id ) {
      $resultado  = new \stdClass;
      $fornecedor = Fornecedor::Find($id);
      $achou      = ($fornecedor) ? true : false;

      $resultado->acao     = $this->acao;
      $resultado->readonly = ( $this->acao == 'consultar' || $this->acao == 'excluir' ) ? 'readonly' : '';
      $resultado->achou    = $achou;

      $resultado->id_fornecedor     = $achou ? $fornecedor->id_fornecedor     : null;
      $resultado->codigo = $achou ? $fornecedor->codigo : null;
      $resultado->nome  = $achou ? $fornecedor->nome   : null;
   } // igualar_formulario

   /**
   * obtém os filtros
   */
   public function obter_filtro( &$resultado ) {
      $filtro = array();
      $resultado = new \stdClass();

      // define os nomes dos filtros
      $infra_filtro = new Infra_Filtro(); 
      $infra_filtro->nomes_filtros  = new \stdClass();
      $infra_filtro->nomes_filtros->filtro_codigo    = '';
      $infra_filtro->nomes_filtros->filtro_nome= '';
      $infra_filtro->ordem_default = 'codigo';

      // prepara os filtros
      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_codigo != '' ) {    
         $filtro[] = "( codigo like '%{$infra_filtro->inputs->filtro_codigo}%' )";
      }
      if ( $infra_filtro->inputs->filtro_nome != '' ) {
         $filtro[] = "nome LIKE '%{$infra_filtro->inputs->filtro_nome}%'";
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
      if ( $filtros->inputs->filtro_codigo != '' ) {         
         $filtro[] = "( codigo like '%{$filtros->inputs->filtro_codigo}%' )";
      }
      if ( $filtros->inputs->filtro_nome != '' ) {
         $filtro[] = "nome LIKE '%{$filtros->inputs->filtro_nome}%'";
      }
      $where = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $ordem = $filtros->ordem;
      $rs = DB::select( " SELECT * FROM tbfornecedor WHERE ".$where ." ORDER BY ". $ordem ) ;
 
      $rel = new Infra_Relatorio();
      $rel->titulo = 'Fornecedor';
      $rel->AliasNbPages();
      $rel->AddPage();
     
      $rel->SetFont('Times', 'B', 12);
      $rel->Cell(20, 2,  utf8_decode('Código'     ), 0, 0, 'L');
      $rel->Cell(80, 2,  utf8_decode('Nome' ), 0, 0, 'L');
      $rel->Line( 205, 27, 5, 27 );
      $rel->SetFont('Arial', '', 11);            
      foreach ( $rs as $index => $registro) {
         $rel->Ln( 7 );
         $rel->Cell(20, 8, $registro->codigo,     0, 0, 'L');
         $rel->Cell(80, 8, utf8_decode($registro->nome),  0, 0, 'L');
      }
      $rel->Output();
      
   } // imprimir

   private function _obter_regras( &$regras ) {
      $id_fornecedor = Input::get('id_fornecedor');
      $regras = [ 'codigo' => 'required|min:2|max:20|unique:tbfornecedor,codigo,'.$id_fornecedor.',id_fornecedor',
                  'nome'   => 'required',
                ];
   } // obter_regras

}