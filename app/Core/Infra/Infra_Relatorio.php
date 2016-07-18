<?php
namespace App\Core\Infra;

use App\Core\FPDF\fpdf;

/**************************************************************************
*
* Classe que auxilia nos relatórios
*
***************************************************************************/

class Infra_Relatorio extends FPDF {

   public $titulo;

   /**
   * Create a new controller instance.
   *   
   * $orientation = 'P' ou 'L'
   *
   * @return void
   */
   public function __construct( $orientation = 'P', $unit ='mm', $size ='A4' ) {
      parent::__construct( $orientation, $unit, $size );
      $this->orientation = $orientation;
      $this->unit        = $unit;
      $this->size        = $size;     
   }   

   /**
   * cabeçalho padrão dos relatórios
   *
   * @param  string   $titulo
   * @return string
   */
   function Header() {      
      $this->Image( 'img/logo1.png', 5, 3, 0, 0 );
      $this->SetFont( 'arial','B',16 );
      $this->SetY( 4 );      
      $this->Cell(80);
      $this->Cell( 20, 10, 'Nome da Empresa', 0, 0, 'C' );
      $this->SetFont('Arial','', 10 );
      $this->Cell( 155, 10, date('d/m/Y h:i:s'), 0, 0, 'C' );
      $this->Ln(7);
      $this->SetFont('Arial', 'B', 15 );      
      $this->Cell(80);
      $this->Cell( 20, 10, $this->titulo, 0, 0, 'C' );
      $this->Line( 205, 21, 5, 21 );
      $this->Ln(12);
   } // Header

   /**
   * Rodapé padrão dos relatórios
   *
   * @param  string   $titulo
   * @return string
   */
   function Footer() {
      $this->SetY(-15);
      $this->SetFont('Arial','I',8);
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   } // bcompiler_write_footer(filehandle)

}
