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
   
   public $_request;
   public $acao;

   public function __construct() {
   } // __construct   

   /** 
   * Altera as permissões do grupo selecionado
   *
   * @param object      atributos para persistir
   */
   public function Alterar() {      
      $this->preparar_array( $permissoes );     
      $id_grupo = $this->_request->id_grupo;
      DB::delete( "DELETE FROM tbpermissao WHERE id_grupo = '{$id_grupo}' " );
      foreach ( $permissoes as $indice => $valor ) {
         $permissao = new Permissao;
         $permissao->id_grupo = $id_grupo;
         $permissao->id_menu  = $valor;
         $permissao->save();
      }      
   } // alterar
  
   private function preparar_array( &$permissoes ) {
      $permissoes = array();
      $selecionados = str_replace( array('#'), ',', $this->_request->txt_selecionados );
      $selecionados = explode( ',', $selecionados );
      foreach ( $selecionados as $indice => $item ) {
         $item = explode( '_', $item );
         if( $item[0] != '' ) {
           $permissoes[$item[1]] = $item[1];
         }
      }
      sort($permissoes);
   }

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

  
}