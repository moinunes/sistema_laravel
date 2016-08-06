<?php
namespace App\Http\Controllers;

use App\Core\Repositories\UfRepository;

use App\Uf;

use App\Core\Infra\Infra_Filtro;

use Illuminate\Http\Request;
use Input;


/**************************************************************************************************
*
* Cadastro de UF
*
***************************************************************************************************/

class UfController extends MeuController {

   protected $UfRepository;

   /**
   * Create a new  instance.
   * @return void
   */
   public function __construct( UfRepository $uf_repository ) {
      parent::__construct();
      $this->UfRepository = $uf_repository;
   } // __construct

   /**
   * Exibe o grid
   */
   public function exibir_grid() {
      $this->UfRepository->obter_filtro( $resultado );      
      $data = Uf::whereRaw( $resultado->where )                     
                      ->orderBy( $resultado->ordem )
                      ->paginate( $this->registros_por_pagina );
   
      return view( 'uf.uf_grid' )->with( 'data', $data )
                                 ->with( 'filtros', $resultado->inputs );
   } // exibir_grid

   /**
   * Exibe o form
   */
   public function exibir_form( $acao, $id = null ) {
      Infra_Filtro::manter_filtros( 'S' );     
      $this->UfRepository->acao = $acao;
      $this->UfRepository->igualar_formulario( $data, $id );
      return view( 'uf.uf_form' )->with( 'data',     $data  )
                                 ->with( 'acao',     $acao  );
   } // exibir_form   

   /**
   * Confirma a Inclusao, alteração e exclusão
   */
   public function Confirmar() {      
 
      
      switch ( Input::get('acao') ) {
         case 'incluir':
            $this->UfRepository->Incluir( Input::all() );
            break;
         
         case 'alterar':         
            $this->UfRepository->Alterar( Input::all() );
            break;
         
         case 'excluir':
            $this->UfRepository->Excluir( Input::get('id_uf') );
            break;
               
         default:
            break;
      }

      if ( !$this->UfRepository->tudo_ok ) {
          $data = (object)Input::all();          
          return view( 'uf.uf_form' )->with( 'data',  $data )
                                     ->withErrors( $this->UfRepository->validacao   );
      }
      return redirect( 'uf' );
   } // Confirmar
   

   public function cancelar() {      
      return redirect( 'uf' );
   } // cancelar
 
  /**
   *  Imprime os registros da grid
   */   
   public function imprimir() {
      $this->UfRepository->imprimir();
   }

} // UfController
