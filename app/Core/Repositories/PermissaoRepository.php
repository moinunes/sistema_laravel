<?php
namespace App\Core\Repositories;

use App\Permissao;
use App\Grupo;

use App\Core\Infra\Infra_Tabela;
use App\Core\Infra\Infra_Filtro;
use App\Core\Infra\Infra_Relatorio;

use DB;
use Validator;
use Input;
 
use Illuminate\Http\Request;

class PermissaoRepository extends Permissao {
   
   private $_request;
   public $acao;

   public function __construct() {
      $this->tudo_ok = false;
   } // __construct
   

   /** 
   * altera o registro
   *
   * @param object      atributos para persistir
   */
   public function Alterar( $request ) {
      $this->_request = $request;
      $acao       = Input::get('acao');
      $id_grupo   = Input::get('id_grupo');
      $inputs = explode( ',', Input::get('txt_campos') );
      $permissoes = array();
      foreach ( $inputs as $key => $value) {        
         $key = explode( '_', $value );
         $permissoes[$key[1]] = $key[1];
      }
      DB::delete( "DELETE FROM tbpermissao WHERE id_grupo = '{$id_grupo}' " );
      foreach ( $permissoes as $key => $value ) {
         $permissao = new Permissao;
         $permissao->id_grupo = $id_grupo;
         $permissao->id_menu  = $key;
         $permissao->save();
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
      $grupo     = Grupo::Find($id);
      $achou     = ($grupo) ? true : false;

      $resultado->acao     = $this->acao;
      $resultado->readonly = ( $this->acao == 'consultar' || $this->acao == 'excluir' ) ? 'readonly' : '';
      $resultado->achou    = $achou;
      
      $resultado->id_grupo  = $achou ? $grupo->id_grupo  : null;
      $resultado->grupo     = $achou ? $grupo->grupo     : null;
      $resultado->descricao = $achou ? $grupo->descricao : null;
   } // igualar_formulario

   
  /**
   * obtém os filtros
   */
   public function obter_filtro( &$resultado ) {
      $filtro = array();      
      $resultado = new \stdClass();

      $infra_filtro = new Infra_Filtro();
      // define os nomes dos filtros
      $infra_filtro->nomes_filtros  = new \stdClass();
      $infra_filtro->nomes_filtros->filtro_grupo = '';
      $infra_filtro->nomes_filtros->filtro_descricao = '';
      
      $infra_filtro->ordem_default = 'grupo';
      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_grupo != '' ) {         
         $filtro[] = "( grupo like '%{$infra_filtro->inputs->filtro_grupo}%' )";
      }
      if ( $infra_filtro->inputs->filtro_descricao != '' ) {         
         $filtro[] = "( descricao like '%{$infra_filtro->inputs->filtro_descricao}%' )";
      }      
      $resultado->where  = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $resultado->ordem  = $infra_filtro->ordem;
      $resultado->inputs = $infra_filtro->inputs;
   } // obter_filtro


   /**
   *  Imprime os registros da grid
   */
   protected function imprimir() {
       $filtro = array();
      Infra_Filtro::obter_array_filtros( $filtros );   
      if ( $filtros->inputs->filtro_grupo != '' ) {         
         $filtro[] = "( grupo like '%{$filtros->inputs->filtro_grupo}%' )";
      }
     
      $where = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $ordem = $filtros->ordem;
      $rs = DB::select( " SELECT * FROM tbgrupo WHERE ".$where ." ORDER BY ". $ordem ) ;

      $rel = new Infra_Relatorio();
      $rel->titulo = 'Grupos';
      $rel->AliasNbPages();
      $rel->AddPage();
      $rel->SetFont('Times', 'B', 12);
      $rel->Cell(50, 2,  utf8_decode('Grupo'    ), 0, 0, 'L');
      $rel->Line( 205, 27, 5, 27 );
      $rel->SetFont('Arial', '', 11);
      foreach ($rs as $index => $registro) {
         $rel->Ln( 7 );
         $rel->Cell(50, 8, $registro->grupo,     0, 0, 'L');
      }
      $rel->Output();
   }


   
}