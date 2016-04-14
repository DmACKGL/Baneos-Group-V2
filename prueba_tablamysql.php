<?php
require('mysql_report.php');
$pdf = new PDF('L','pt','A3');
$pdf->SetFont('Arial','',14);
$pdf->connect('localhost','gamelhzo_baneos','Ss262601','gamelhzo_baneosfb');
$attr = array('titleFontSize'=>18, 'titleText'=>'Modificaciones baneo');
$pdf->mysql_report("SELECT numero as Nro, nombre, estado_nuevo as estado, hora, fecha, admin, ip, proxy, nota FROM modificacion order by numero",false,$attr);
$pdf->SetTitle($title);
$pdf->SetAuthor('Pablo Riquelme');
$pdf->Output('tabla modificaciones.pdf','I');
?>