<?php session_start(); ?>
<?
require('fpdf.php');

class PDF extends FPDF
{
//Cabecera de página
function Header()
{
//Logo
$this->Image("http://i.imgur.com/TgijjxN.png" , 15 ,10, 33);
//Arial bold 15
$this->SetFont('Arial','B',15);
//Movernos a la derecha
$this->Cell(50);
//Título
$this->Cell(0,10,'Logs inicio sesion Gamer Chileno',1,0,'C');
//Salto de línea
$this->Ln(10);   
}
//Pie de página
function Footer()
{
//Posición: a 1,5 cm del final
$this->SetY(-15);
//Arial italic 8
$this->SetFont('Arial','I',8);
//Número de página
$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function TituloArchivo($num,$label)
{
   $this->SetY(28);
//Arial 12
$this->SetFont('Arial','',12);
//Color de fondo
$this->SetFillColor(200,220,255);
//Título
$this->Cell(0,6,"Archivo $num : $label",0,1,'L',true);
//Salto de línea
$this->Ln(2);
}

function CuerpoArchivo($file)
{
//Leemos el fichero
$f=fopen($file,'r');
$txt=fread($f,filesize($file));
fclose($f);
//Times 12
$this->SetFont('Times','',12);
//Imprimimos el texto justificado
$this->MultiCell(0,5,$txt,1,'C',false);
//Salto de línea
$this->Ln();

}

function ImprimirArchivo($num,$title,$file)
{
$this->AddPage();
$this->TituloArchivo($num,$title);
$this->CuerpoArchivo($file);
}
}

$pdf=new PDF();
$title='Logs inicio sesion baneos Gamer Chileno';
$pdf->SetTitle($title);
$pdf->SetAuthor('Pablo Riquelme');
$pdf->SetY(65);
$pdf->ImprimirArchivo(1,'Inicio sesiones 2015 ','archivos/sesiones/inicio-sesion2015.txt');
$pdf->Output('sesiones baneos GCL.pdf','I');
?> 