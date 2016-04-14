<?php
require('mysql_reportpublico.php');
$pdf = new PDF('P','pt','A3');
$pdf->SetFont('Arial','',14);
$pdf->connect('localhost','gamelhzo_baneos','Ss262601','gamelhzo_baneosfb');
$attr = array('titleFontSize'=>18, 'titleText'=>'Personas que acceden a la tabla p&ucuteblica');
$pdf->mysql_report("SELECT numero as Nro, ip, proxy, hora, fecha FROM publico order by numero",false,$attr);
$pdf->SetTitle($title);
$pdf->SetAuthor('Pablo Riquelme');
$pdf->Output('tabla publico.pdf','I');
?>