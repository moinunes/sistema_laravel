<?php
namespace App\Http\Controllers;

use App\Core\Repositories\PermissaoRepository;
use App\Permissao;
use App\Grupo;

use App\Core\Infra\Infra_Filtro;

use Illuminate\Http\Request;
use Input;
use Auth;


class PermissaoController extends MeuController {

   protected $PermissaoRepository;

   /**
   * Create a new  instance.
   * @return void
   */
   public function __construct( PermissaoRepository $permissao_repository ) {
      $this->PermissaoRepository = $permissao_repository;
   } // __construct

   /**
   * Exibe o grid
   */
   public function exibir_grid() {
      $this->PermissaoRepository->obter_filtro( $resultado );     
      $data = Grupo::whereRaw( $resultado->where )->orderBy( $resultado->ordem )
                                                  ->paginate( $this->registros_por_pagina );        
      return view( 'permissao.permissao_grid' )->with( 'data', $data )
                                               ->with( 'filtros', $resultado->inputs );
   } // exibir_grid


   /**
   * Exibe o form
   */
   public function exibir_form( $acao, $id = null ) {
      Infra_Filtro::manter_filtros( 'S' );
      $this->PermissaoRepository->acao = $acao;      
      $this->PermissaoRepository->igualar_formulario( $data, $id );      
      return view( 'permissao.permissao_form' )->with( 'data',     $data  )
                                               ->with( 'acao',     $acao  );
   } // exibir_form   
    
   /**
   * Confirma a Inclusao, alteração e exclusão
   */
   public function confirmar() {      
      switch ( Input::get('acao') ) {
         case 'alterar':             
            $this->PermissaoRepository->_request = (object)Input::all();
            $this->PermissaoRepository->Alterar();
            break;         
              
         default:
            break;
      }      
      return redirect( 'permissao' );
   }

   /**
   *  Permissao negada
   */
   public function negadaxxxxxxxxxxxxxxxxxxxxxx() {     
      $rota = input::get('rota');
      $data = new \stdClass();     
      $data->usuario = Auth::user()->name;
      $data->rota    = $rota;

      return view( 'permissao.permissao_negada' )->with('data',$data );
   }


   public function cancelar() {      
      return redirect( 'permissao' );
   } // cancelar

}
