<?php
namespace App\Core\Repositories;

use App\Grupo;
use App\Grupo_User;

use App\Core\Infra\Infra_Tabela;
use App\Core\Infra\Infra_Filtro;
use App\Core\Infra\Infra_Relatorio;

use DB;
use Validator;
use Input;
 
use Illuminate\Http\Request;

class GrupoRepository extends Grupo {
   
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
         $grupo = new Grupo();
         $this->igualar_objeto( $grupo ) ;
         $grupo->save();
         $this->incluir_grupo_user( $grupo->id_grupo );
         $this->tudo_ok = true;
         return;         
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
         $grupo = Grupo::findOrFail( $request['id_grupo'] );
         $grupo->grupo     = $request['grupo'];
         $grupo->descricao = $request['descricao'];    
         $grupo->update( $request );

         $this->excluir_grupo_user( $request['id_grupo'] );
         $this->incluir_grupo_user( $request['id_grupo'] );


         $this->tudo_ok = true;
      }
   } // alterar

   
     
   /** 
   * iguala o objeto
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_objeto( &$grupo ) {
      $grupo->id_grupo  = $this->_request['id_grupo'   ];  
      $grupo->grupo     = $this->_request['grupo'];
      $grupo->descricao = $this->_request['descricao' ];          
   } // igualar_objeto

   /** 
   * iguala o formulário
   *
   * @param object      atributos para persistir
   *
   */
   public function igualar_formulario( &$resultado, $id ) {
      $resultado = new \stdClass;
      $grupo        = Grupo::Find($id);
      $achou     = ($grupo) ? true : false;

      $resultado->acao     = $this->acao;
      $resultado->readonly = ( $this->acao == 'consultar' || $this->acao == 'excluir' ) ? 'readonly' : '';
      $resultado->achou    = $achou;
      
      $resultado->id_grupo   = $achou ? $grupo->id_grupo   : null;
      $resultado->grupo      = $achou ? $grupo->grupo     : null;
      $resultado->descricao  = $achou ? $grupo->descricao : null;


   } // igualar_formulario

   /** 
   * exclui o registro
   *
   * @param int   id
   */
   public function Excluir( $id ) {
      $grupo = Grupo::find( $id );
      $grupo->delete();

      $this->excluir_grupo_user( $id );

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
      $infra_filtro->nomes_filtros->filtro_grupo     = '';
      $infra_filtro->nomes_filtros->filtro_descricao = '';
      $infra_filtro->ordem_default = 'grupo';

      // prepara os filtros
      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_grupo != '' ) {         
         $filtro[] = "( grupo like '%{$infra_filtro->inputs->filtro_grupo}%' )";
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
      if ( $filtros->inputs->filtro_grupo != '' ) {         
         $filtro[] = "( grupo like '%{$filtros->inputs->filtro_grupo}%' )";
      }
      if ( $filtros->inputs->filtro_descricao != '' ) {
         $filtro[] = "descricao LIKE '%{$filtros->inputs->filtro_descricao}%'";
      }
      $where = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $ordem = $filtros->ordem;
      $rs = DB::select( " SELECT * FROM tbgrupo WHERE ".$where ." ORDER BY ". $ordem ) ;
 
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
         $rel->Cell(20, 8, $registro->grupo,     0, 0, 'L');
         $rel->Cell(80, 8, utf8_decode($registro->descricao),  0, 0, 'L');
      }
      $rel->Output();
      
   } // imprimir

   private function _obter_regras( &$regras ) {
      $id_grupo = Input::get('id_grupo');
      $regras = [ 'grupo'     => 'required|min:3|max:20|unique:tbgrupo,grupo,'.$id_grupo.',id_grupo',                        
                  'descricao' => 'required|min:3|max:60',
                ];
   } // obter_regras

 /**
   *  obtém os usuários disponíveis
   */   
   public function obter_usuarios_disponiveis( &$consulta, $id_grupo ) {
      $id_grupo = $id_grupo != '' ? $id_grupo : 0;
      $sql= " SELECT
                   id,
                   nome  
              FROM users     
              WHERE users.id NOT IN ( SELECT
                                          id_user
                                      FROM tbgrupo_user
                                      WHERE tbgrupo_user.id_grupo = {$id_grupo}
                                    ) ";
      $consulta = DB::select( $sql );
   } // obter_usuarios_disponiveis

  /**
   *  obtém os usuários selecionados
   */   
   public function obter_usuarios_selecionados( &$consulta, $id_grupo ) {
      $id_grupo = $id_grupo != '' ? $id_grupo : 0; 
      $sql = " SELECT
                       users.id,
                       users.nome
                  FROM users
                  JOIN  tbgrupo_user ON ( tbgrupo_user.id_user = users.id )
                  WHERE tbgrupo_user.id_grupo = $id_grupo
              ";
      $consulta = DB::select( $sql );
   } // obter_usuarios_selecionados

   /**
   *  obtém os usuários disponíveis
   */   
   public function obter_usuarios_disponiveis_selecionados( &$consulta, $usuarios ) {  
      $consulta = array();
      if ( $usuarios != '' ) {
         $ids = substr( $usuarios, 0, strlen($usuarios)-1 );
         $sql = " SELECT
                       id,
                       name
                  FROM users
                  WHERE users.id  IN ( {$ids} )
                ";
         $consulta = DB::select( $sql );      
      }
   } // obter_usuarios_disponiveis_selecionados

/**
   *  incluir grupo_user
   */   
   public function incluir_grupo_user( $id_grupo ) {
      $selecionados = Input::get('txt_usuarios_selecionados');
      if ( $selecionados != '' ) {
         $selecionados = explode( ',', $selecionados );
         foreach ( $selecionados as $indice => $id_user ) {
            if ( $id_user != '' ) {
               $grupo_user = new Grupo_User();         
               $grupo_user->id_grupo = $id_grupo;  
               $grupo_user->id_user  = $id_user;  
               $grupo_user->save();
            }
         }
      }
   } // incluir_grupo_user

  /**
   *  excluir grupo_user
   */   
   public function excluir_grupo_user( $id_grupo ) {
      $sql = " SELECT
                   id_grupo_user
               FROM tbgrupo_user     
               WHERE id_grupo = {$id_grupo}
             ";
      $consulta = DB::select( $sql );
      foreach ( $consulta as $item ) {
         Grupo_User::find( $item->id_grupo_user )->delete();          
      }
   } // excluir_grupo_user

}