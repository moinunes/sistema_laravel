<?php
namespace App\Core\Repositories;

use App\Produto;

use App\Core\Infra\Infra_Tabela;
use App\Core\Infra\Infra_Filtro;
use App\Core\Infra\Infra_Relatorio;

use DB;
use Validator;
use Input;
 
 use Illuminate\Http\Request;

class ProdutoRepository extends Produto {
   
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
         $produto = new Produto();
         $this->igualar_objeto( $produto ) ;
         $this->tudo_ok = true;
         return $produto->save();
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
         $produto = Produto::findOrFail( $request['id_produto'] );
         $produto->codigo = $request['codigo'];
         $produto->descricao   = $request['descricao'];
         //$produto->quantidade     = $request['quantidade'];
         //$produto->preco          = $request['preco'];
         $produto->id_fornecedor  = $request['id_fornecedor'];
    
         $produto->update( $request );
         $this->tudo_ok = true;
      }
   } // alterar

   /** 
   * iguala o objeto
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_objeto( &$produto ) {
      $produto->codigo = $this->_request['codigo'];
      $produto->descricao   = $this->_request['descricao'];
      //$produto->quantidade     = $this->_request['quantidade'];
      //$produto->preco          = $this->_request['preco'];
      $produto->id_fornecedor  = $this->_request['id_fornecedor'];      
   } // igualar_objeto

   /** 
   * iguala o formulário
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_formulario( &$resultado, $id_produto ) {      
      $resultado = new \stdClass;

      $produto   = Produto::Find($id_produto);
      $achou     = ($produto) ? true : false;

      $resultado->acao     = $this->acao;
      $resultado->readonly = ( $this->acao == 'consultar' || $this->acao == 'excluir' ) ? 'readonly' : '';
      $resultado->achou    = $achou;
      if ($achou) {
         $fornecedor = $produto->fornecedor;
      }
      $resultado->id_produto     = $achou ? $produto->id_produto    : null;
      $resultado->codigo         = $achou ? $produto->codigo        : null;
      $resultado->descricao      = $achou ? $produto->descricao     : null;
      $resultado->quantidade     = $achou ? $produto->quantidade     : null;
      $resultado->preco          = $achou ? $produto->preco     : null;
      $resultado->id_fornecedor  = $achou ? $produto->id_fornecedor : null;
           
      $resultado->fornecedor_codigo = $achou ? $fornecedor->codigo : null;
      $resultado->fornecedor_nome   = $achou ? $fornecedor->nome   : null;
      
      // dd(Input::all());
      // dd($resultado);

   } // igualar_formulario

   /** 
   * exclui o registro
   *
   * @param int   id
   */
   public function Excluir( $id ) {
      $produto = Produto::find( $id );
      $produto->delete();
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
      $infra_filtro->nomes_filtros->filtro_codigo = '';
      $infra_filtro->nomes_filtros->filtro_descricao   = '';
      $infra_filtro->ordem_default = 'codigo';

      // prepara os filtros
      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_codigo != '' ) {         
         $filtro[] = "( codigo like '%{$infra_filtro->inputs->filtro_codigo}%' )";
      }
      if ( $infra_filtro->inputs->filtro_descricao != '' ) {
         $filtro[] = "descricao LIKE '%{$infra_filtro->inputs->filtro_descricao}%'";
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
      if ( $filtros->inputs->filtro_descricao != '' ) {
         $filtro[] = "descricao LIKE '%{$filtros->inputs->filtro_descricao}%'";
      }
      $where = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $ordem = $filtros->ordem;
      $rs = DB::select( " SELECT * FROM tbproduto WHERE ".$where ." ORDER BY ". $ordem ) ;
 
      $rel = new Infra_Relatorio();
      $rel->titulo = 'Produtos';
      $rel->AliasNbPages();
      $rel->AddPage();
     
      $rel->SetFont('Times', 'B', 12);
      $rel->Cell(20, 2,  utf8_decode('Código'     ), 0, 0, 'L');
      $rel->Cell(80, 2,  utf8_decode('Nome' ), 0, 0, 'L');
      $rel->Cell(35, 2,  utf8_decode('Quantidade' ), 0, 0, 'L');
      $rel->Line( 205, 27, 5, 27 );
      $rel->SetFont('Arial', '', 11);            
      foreach ( $rs as $index => $registro) {
         $descricao =  utf8_decode( substr($registro->descricao,0,40) );
         $rel->Ln( 7 );
         $rel->Cell(20, 8, $registro->codigo,     0, 0, 'L');
         $rel->Cell(80, 8, $descricao,  0, 0, 'L' );
         $rel->Cell(35, 8, $registro->quantidade,     0, 0, 'L');
      }
      $rel->Output();      
   } // imprimir

   private function _obter_regras( &$regras ) {      
      $id_produto = Input::get('id_produto');
      $regras = [ 'id_fornecedor'  => 'required', 
                  'descricao'   => 'required|min:2|max:60|' ,  
                  'codigo' => 'required|unique:tbproduto,codigo,'.$id_produto.',id_produto'
                ];
   } // obter_regras

}