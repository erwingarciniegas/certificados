<?php 
require('../librerias/fpdf/fpdf.php');
include_once("../configuraciones/bd.php");
$conexionBD=BD::crearInsttancia();
function agregartexto($pdf, $texto,$x,$y,$align='L',$fuente,$size=10,$r=0,$g=0,$b=0){
    $pdf->SetFont($fuente,"", $size);
    $pdf->setxy($x,$y);
    $pdf->setTextColor($r,$g,$b);
    $pdf->cell(0,10,$texto,0,0,$align);
}
function agregarImagen($pdf,$imagen,$x,$y){
    $pdf->Image($imagen,$x,$y,0);
}

$idcurso=isset($_GET['idcurso'])?$_GET['idcurso']:'';
$idalumno=isset($_GET['idalumno'])?$_GET['idalumno']:'';

$sql="SELECT alumnos.nombre, alumnos.apellidos,cursos.nombre_curso 
FROM alumnos, cursos WHERE alumnos.id=:idalumno AND cursos.id=:idcurso";
$resultado=$conexionBD->prepare($sql);
$resultado->bindParam(':idalumno',$idalumno);
$resultado->bindParam(':idcurso',$idcurso);
$resultado->execute();
$alumno=$resultado->fetch(PDO::FETCH_ASSOC);


$pdf = new FPDF("L","mm",array(254,194));
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
agregarImagen($pdf,"../src/certificado_.jpg",0,0);
agregartexto($pdf,ucwords(utf8_decode($alumno['nombre']."".$alumno['apellidos'])),60,70,'L',"Helvetica",30,0,84,115);
agregartexto($pdf,$alumno['nombre_curso'],-250,115,'C',"Helvetica",20,0,84,115);
agregartexto($pdf,date("d/m/Y"),-200,160 ,'c',"Helvetica",11,0,84,115);
$pdf->Output();





?>