<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require ('assets/extensions/fpdf/fpdf.php');

class Reports_pdf extends CI_Controller {

  function __construct() {
      parent::__construct();
  }

  public function createReport(){

    $pdf=new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFillColor(178,23,18);
    $pdf->Rect(10, 10, 190, 15, 'F');
    $pdf->Rect(10, 75, 150, 25, 'F');
    $pdf->SetFillColor(30,127,204);
    $pdf->Rect(10, 110, 50, 10, 'F');
    $pdf->Rect(70, 110, 50, 10, 'F');
    $pdf->Rect(130, 110, 50, 10, 'F');
    $pdf->Rect(10, 130, 80, 10, 'F');
    $pdf->Rect(100, 130, 80, 10, 'F');
    $pdf->Rect(10, 150, 170, 10, 'F');
    $pdf->SetFillColor(178,23,18);
    $pdf->Rect(10, 180, 190, 10, 'F');
    $pdf->SetFillColor(220,220,220);
    $pdf->Rect(10, 190, 190, 40, 'F');
    $pdf->Image('https://botw-pd.s3.amazonaws.com/styles/logo-original-577x577/s3/092011/claro_2_1.jpg',18,30,40);
    $pdf->SetFillColor(220,220,220);


    $pdf->Ln(71);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial','B',20);
    $pdf->Cell(275,5,utf8_decode('     Incidente : '),0,1,'L');
    // Nombre Incidente
    $pdf->Ln(2);
    $pdf->SetFont('Arial','',17);
    $pdf->Cell(275,5,utf8_decode('      Lentitud NAP servicios corporativos '),0,1,'L');
    //Fecha Incidente
    $pdf->Ln(10);
    $pdf->SetTextColor(0,0,0);
    $this->negrilla($pdf);
    $pdf->Cell(30,5,utf8_decode('      Fecha: '),0,0,'L');
    $this->normal($pdf);
    $pdf->Cell(90,5,utf8_decode('10-10-2017'),0,1,'L');

    $pdf->Ln(7);    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,5,utf8_decode('Hora Inicio Falla : '),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,utf8_decode('07:40 AM'),0,0,'L');

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(27,5,utf8_decode('Hora Fin Falla : '),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(33,5,utf8_decode('10:40 AM'),0,0,'L');

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,5,utf8_decode('Indisponibilidad : '),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(15,5,utf8_decode('3 Horas'),0,0,'L');


    $pdf->Ln(20);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(12,5,utf8_decode('Ticket: '),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(78,5,utf8_decode('10531663 LAN Administrada'),0,0,'L');

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(32,5,utf8_decode('Codigo de enlace: '),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(90,5,utf8_decode('10531663 LAN Administrada'),0,1,'L');

    $pdf->Ln(15);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,5,utf8_decode('Reincidencia: '),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(78,5,utf8_decode('Si'),0,0,'L');

    $pdf->Ln(30);
    $pdf->SetTextColor(255,255,255);
    $this->negrilla($pdf);
    $pdf->Cell(190,5,utf8_decode('      1. Reporte de Falla'),0,0,'L');
    $pdf->Ln(10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(190,5,utf8_decode('      El usuario presentará una solicitud de servicio de soporte técnico con elformato (F (F-PL-ES-01) '),0,1,'L');
    $pdf->Cell(190,5,utf8_decode('      Reporte de Servicio” al Departamento de Estadística y Sistemas. ) '),0,1,'L');








    $pdf->AddPage();
    $pdf->SetFillColor(178,23,18);
    $pdf->Rect(10, 10, 190, 10, 'F');
    $pdf->SetFillColor(220,220,220);
    $pdf->Rect(10, 20, 190, 10, 'F');
    $pdf->Rect(10, 40, 190, 10, 'F');
    $pdf->SetFillColor(30,127,204);
    $pdf->Rect(10, 60, 190, 20, 'F');
    $pdf->SetFillColor(178,23,18);
    $pdf->Rect(10, 100, 190, 10, 'F');
    $pdf->SetFillColor(220,220,220);
    $pdf->Rect(10, 110, 190, 30, 'F');
    $pdf->SetFillColor(178,23,18);
    $pdf->Rect(10, 160, 190, 10, 'F');
    $pdf->SetFillColor(220,220,220);
    $pdf->Rect(10, 170, 190, 10, 'F');
    $pdf->Rect(10, 200, 190, 20, 'F');
    $pdf->Rect(10, 240, 190, 20, 'F');


    $pdf->Ln(3);
    $pdf->SetTextColor(255,255,255);
    $this->negrilla($pdf);
    $pdf->Cell(190,5,utf8_decode('      2. Servicios Afectados'),0,0,'L');

    $pdf->Ln(10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(50,5,utf8_decode('      Código de Enlace'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('      Descripción'),0,0,'L');
    $pdf->SetFont('Arial','',10);

    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      VDI0057'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('     Enlace L2L Corficolombiana – Casa de bolsa'),0,0,'L');
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      VDI0015'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('     Switch LAN '),0,0,'L');

    $pdf->Ln(20);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(35,5,utf8_decode('      Observaciones'),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,utf8_decode('Se presenta pérdida de conectividad sobre el L2L entre Casa de Bosa y Corficolombiana.'),0,0,'L');

    $pdf->Ln(40);
    $pdf->SetTextColor(255,255,255);
    $this->negrilla($pdf);
    $pdf->Cell(190,5,utf8_decode('      3. Causa Raiz'),0,0,'L');
    $pdf->Ln(10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(190,5,utf8_decode('      Puertos sobre los switch core de Casa de bolsa hacia Corficolombiana presentan bloqueo por UDLD.'),0,0,'L');


    $pdf->Ln(50);
    $pdf->SetTextColor(255,255,255);
    $this->negrilla($pdf);
    $pdf->Cell(190,5,utf8_decode('      4. Antecedentes'),0,0,'L');
    $pdf->Ln(10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(50,5,utf8_decode('      Fecha'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Descripción'),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      19/03/2018 09:08:44 a.m'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Se observa proactivamente  alarmas en el gestor de la plataforma Alcatel a las 9:08 '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AM del 19 de Marzo de 2018 de perdida de gestión para los equipos Alcatel '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AAC-BOG.CASABOLSA2 y ACL-BOG.CORPFINANCIERAKRA13. '),0,0,'L');
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      19/03/2018 09:08:44 a.m'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Se observa proactivamente  alarmas en el gestor de la plataforma Alcatel a las 9:08 '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AM del 19 de Marzo de 2018 de perdida de gestión para los equipos Alcatel '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AAC-BOG.CASABOLSA2 y ACL-BOG.CORPFINANCIERAKRA13. '),0,0,'L');
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      19/03/2018 09:08:44 a.m'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Se observa proactivamente  alarmas en el gestor de la plataforma Alcatel a las 9:08 '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AM del 19 de Marzo de 2018 de perdida de gestión para los equipos Alcatel '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AAC-BOG.CASABOLSA2 y ACL-BOG.CORPFINANCIERAKRA13. '),0,0,'L');
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      19/03/2018 09:08:44 a.m'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Se observa proactivamente  alarmas en el gestor de la plataforma Alcatel a las 9:08 '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AM del 19 de Marzo de 2018 de perdida de gestión para los equipos Alcatel '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AAC-BOG.CASABOLSA2 y ACL-BOG.CORPFINANCIERAKRA13. '),0,0,'L');

    $pdf->AddPage();
    $pdf->SetFillColor(178,23,18);
    $pdf->Rect(10, 10, 190, 10, 'F');
    $pdf->SetFillColor(220,220,220);
    $pdf->Rect(10, 20, 190, 10, 'F');
    $pdf->Rect(10, 50, 190, 20, 'F');
    $pdf->Rect(10, 90, 190, 20, 'F');
    $pdf->SetFillColor(178,23,18);
    $pdf->Rect(10, 130, 190, 10, 'F');
    $pdf->SetFillColor(30,127,204);
    $pdf->Rect(20, 150, 170, 10, 'F');
    $pdf->Rect(20, 170, 170, 10, 'F');
    $pdf->SetFillColor(178,23,18);
    $pdf->Rect(10, 200, 190, 10, 'F');
    $pdf->SetFillColor(220,220,220);
    $pdf->Rect(10, 210, 190, 20, 'F');
    $pdf->Rect(10, 250, 190, 20, 'F');


    $pdf->Ln(3);
    $pdf->SetTextColor(255,255,255);
    $this->negrilla($pdf);
    $pdf->Cell(190,5,utf8_decode('      5. Actividades Realizadas'),0,0,'L');
    $pdf->Ln(10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(50,5,utf8_decode('      Fecha'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Descripción'),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      19/03/2018 09:08:44 a.m'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Se observa proactivamente  alarmas en el gestor de la plataforma Alcatel a las 9:08 '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AM del 19 de Marzo de 2018 de perdida de gestión para los equipos Alcatel '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AAC-BOG.CASABOLSA2 y ACL-BOG.CORPFINANCIERAKRA13. '),0,0,'L');
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      19/03/2018 09:08:44 a.m'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Se observa proactivamente  alarmas en el gestor de la plataforma Alcatel a las 9:08 '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AM del 19 de Marzo de 2018 de perdida de gestión para los equipos Alcatel '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AAC-BOG.CASABOLSA2 y ACL-BOG.CORPFINANCIERAKRA13. '),0,0,'L');
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      19/03/2018 09:08:44 a.m'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Se observa proactivamente  alarmas en el gestor de la plataforma Alcatel a las 9:08 '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AM del 19 de Marzo de 2018 de perdida de gestión para los equipos Alcatel '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AAC-BOG.CASABOLSA2 y ACL-BOG.CORPFINANCIERAKRA13. '),0,0,'L');
    $pdf->Ln(10);
    $pdf->Cell(50,5,utf8_decode('      19/03/2018 09:08:44 a.m'),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('Se observa proactivamente  alarmas en el gestor de la plataforma Alcatel a las 9:08 '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AM del 19 de Marzo de 2018 de perdida de gestión para los equipos Alcatel '),0,1,'L');
    $pdf->Cell(50,5,utf8_decode('      '),0,0,'L');
    $pdf->Cell(140,5,utf8_decode('AAC-BOG.CASABOLSA2 y ACL-BOG.CORPFINANCIERAKRA13. '),0,0,'L');

    $pdf->Ln(30);
    $pdf->SetTextColor(255,255,255);
    $this->negrilla($pdf);
    $pdf->Cell(190,5,utf8_decode('      6. Involucrados en la solución de la falla'),0,0,'L');
    $pdf->Ln(20);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(50,5,utf8_decode('             Responsables Claro : '),0,0,'L');
    $pdf->Ln(20);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(50,5,utf8_decode('             Responsables Cliente :'),0,0,'L');

    $pdf->Ln(30);
    $pdf->SetTextColor(255,255,255);
    $this->negrilla($pdf);
    $pdf->Cell(190,5,utf8_decode('      7. Conclusiones'),0,0,'L');
    $pdf->Ln(10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(190,5,utf8_decode('    -	Según validaciones realizadas, el bloqueo de los puertos se produjo por UDLD, lo cual genero perdida de  '),0,1,'L');
    $pdf->Cell(190,5,utf8_decode('     conectividad en el canal. Esta activación es debido a  posibles manipulaciones '),0,0,'L');

    $pdf->Ln(15);
    $pdf->Cell(190,5,utf8_decode('    -	Según validaciones realizadas, el bloqueo de los puertos se produjo por UDLD, lo cual genero perdida de  '),0,1,'L');
    $pdf->Cell(190,5,utf8_decode('     conectividad en el canal. Esta activación es debido a  posibles manipulaciones '),0,0,'L');

    $pdf->Ln(15);
    $pdf->Cell(190,5,utf8_decode('    -	Según validaciones realizadas, el bloqueo de los puertos se produjo por UDLD, lo cual genero perdida de  '),0,1,'L');
    $pdf->Cell(190,5,utf8_decode('     conectividad en el canal. Esta activación es debido a  posibles manipulaciones '),0,0,'L');

     $pdf->Output();
  }

  public function negrilla($pdf){
    $pdf->SetFont('Arial','B',17);
  }

  public function normal($pdf){
    $pdf->SetFont('Arial','',17);
  }

  public function accionesMejora(){
    $pdf=new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);

    //HEADER
    $pdf->Image('https://i0.wp.com/www.digitalstreetsa.com/wp-content/uploads/2017/01/zte.jpg',15,6,28);

    $pdf->Cell(40,5,utf8_decode(''),'LRT',0,'L');
    $pdf->Cell(150,5,utf8_decode('ACCIONES DE MEJORA'),1,1,'C');
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(40,5,utf8_decode(''),'LR',0,'L');
    $pdf->Cell(50,5,utf8_decode('Código:'),'LRT',0,'C');
    $pdf->Cell(50,5,utf8_decode('Fecha de expedición:'),'LRT',0,'C');
    $pdf->Cell(50,5,utf8_decode('Versión:'),'LRT',1,'C');
    $pdf->Cell(40,5,utf8_decode(''),'LRB',0,'L');
    $pdf->Cell(50,5,utf8_decode('GCA-FT-06'),'LRB',0,'C');
    $pdf->Cell(50,5,utf8_decode('Octubre - 2017'),'LRB',0,'C');
    $pdf->Cell(50,5,utf8_decode('01'),'LRB',1,'C');

    //FECHAS
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(7);
    $pdf->Cell(30,5,utf8_decode('Fecha Solicitud'),'LRT',0,'L');
    $pdf->Cell(10,5,utf8_decode('Día'),1,0,'C');
    $pdf->Cell(10,5,utf8_decode('Mes'),1,0,'C');
    $pdf->Cell(10,5,utf8_decode('Año'),1,0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(25,5,utf8_decode('Tipo de acción:'),'LRT',0,'C');
    $pdf->Cell(15,5,utf8_decode('Acción'),'LRT',0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(20,5,utf8_decode('Sistema de'),'LRT',0,'C');
    $pdf->Cell(25,5,utf8_decode('Calidad (SGC)'),'LRT',0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(30,5,utf8_decode('Consecutivo Acción'),1,1,'C');

    $pdf->Cell(30,5,utf8_decode('Acción'),'LRB',0,'C');
    $pdf->Cell(10,5,utf8_decode('24'),1,0,'C');
    $pdf->Cell(10,5,utf8_decode('04'),1,0,'C');
    $pdf->Cell(10,5,utf8_decode('2018'),1,0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(25,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(15,5,utf8_decode('correctiva'),'LRB',0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(20,5,utf8_decode('gestión:'),'LRB',0,'C');
    $pdf->Cell(25,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(30,5,utf8_decode('ZTENOC005'),1,1,'C');

    $pdf->Ln(7);    $pdf->Cell(30,5,utf8_decode('Fecha elaboración'),'LRT',0,'C');
    $pdf->Cell(10,5,utf8_decode('Día'),1,0,'C');
    $pdf->Cell(10,5,utf8_decode('Mes'),1,0,'C');
    $pdf->Cell(10,5,utf8_decode('Año'),1,0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(25,5,utf8_decode('Estatus acción:'),'LRT',0,'C');
    $pdf->Cell(15,5,utf8_decode('Abierta'),'LRT',0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(30,5,utf8_decode('Fecha cierre'),'LRT',0,'L');
    $pdf->Cell(20,5,utf8_decode('Día'),1,0,'C');
    $pdf->Cell(15,5,utf8_decode('Mes'),1,0,'C');
    $pdf->Cell(15,5,utf8_decode('Año'),1,1,'C');

    $pdf->Cell(30,5,utf8_decode('Plan:'),'LRB',0,'C');
    $pdf->Cell(10,5,utf8_decode('24'),1,0,'C');
    $pdf->Cell(10,5,utf8_decode('04'),1,0,'C');
    $pdf->Cell(10,5,utf8_decode('2018'),1,0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(25,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(15,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(5,5,utf8_decode(''),'',0,'C');
    $pdf->Cell(30,5,utf8_decode('total acción'),'LRB',0,'L');
    $pdf->Cell(20,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(15,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(15,5,utf8_decode(''),1,1,'C');


    //REPORTANTES ACCION
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(7);
    $pdf->Cell(95,5,utf8_decode('REPORTANTE(S) DE LA ACCIÓN'),1,0,'C');
    $pdf->Cell(95,5,utf8_decode('RESPONSABLE(S) DE LA ACCIÓN'),1,1,'C');
    $pdf->Cell(30,5,utf8_decode('NOMBRE'),1,0,'C');
    $pdf->Cell(35,5,utf8_decode('CARGO'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('PROCESO'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('NOMBRE'),1,0,'C');
    $pdf->Cell(35,5,utf8_decode('CARGO'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('PROCESO'),1,1,'C');

    $pdf->Cell(30,5,utf8_decode('Alfredo Salcedo'),'LRT',0,'C');
    $pdf->Cell(35,5,utf8_decode('Gerente de la recepción'),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode('ZTR ON AIR'),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode('Luis Hidalgo'),'LRT',0,'C');
    $pdf->Cell(35,5,utf8_decode('Ingeniero II'),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode('ZTE ON AIR'),'LRT',1,'C');
    $pdf->Cell(30,5,utf8_decode('Camelo'),'LRB',0,'C');
    $pdf->Cell(35,5,utf8_decode('de infraestructura'),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(35,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',1,'C');

    $pdf->Cell(30,5,utf8_decode(''),'LRT',0,'C');
    $pdf->Cell(35,5,utf8_decode(''),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode('Raul Zúñiga'),'LRT',0,'C');
    $pdf->Cell(35,5,utf8_decode('Ingeniero II'),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode('ZTE ON AIR'),'LRT',1,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(35,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(35,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',1,'C');

    $pdf->Cell(30,5,utf8_decode(''),'LRT',0,'C');
    $pdf->Cell(35,5,utf8_decode(''),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode('Michael Franco'),'LRT',0,'C');
    $pdf->Cell(35,5,utf8_decode('Ingeniero II'),'LRT',0,'C');
    $pdf->Cell(30,5,utf8_decode('ZTE ON AIR'),'LRT',1,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(35,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(35,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',1,'C');

    //FUENTE DE LA ACCION
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(7);
    $pdf->Cell(40,5,utf8_decode('Fuente de la acción'),1,0,'C');
    $pdf->Cell(75,5,utf8_decode('Quejas, reclamos o sugerencias'),1,0,'C');
    $pdf->Cell(20,5,utf8_decode('Otra,¿cual?'),1,0,'C');
    $pdf->Cell(55,5,utf8_decode(''),1,1,'C');

    //FUENTE DE LA ACCION
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(7);
     $pdf->Cell(190,5,utf8_decode('DESCRIPCIÓN DEL HALLAZGO U OPORTUNIDA DE MEJORA'),1,1,'C');
    $pdf->Cell(60,5,utf8_decode('Requisito en caso que aplique'),1,0,'C');
    $pdf->Cell(130,5,utf8_decode('Descripción del hallazgo u oportunidad de mejora'),1,1,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(130,5,utf8_decode('Escalamientos Erróneos: Se evidencia que el análisis para los sitios: '),'LR',1,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(130,5,utf8_decode('NEI.Terminal-2-CUN.Madrid-4;MAG.Barbara Pinto, se realizó erróneamente '),'LR',1,'C');
    $pdf->Cell(60,5,utf8_decode('N/A'),'LR',0,'C');
    $pdf->Cell(130,5,utf8_decode('ya que se observa inconsistencias en su análisis, y fueron reportados '),'LR',1,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(130,5,utf8_decode('como seguimientos no exitosos cuando tenía que darse continuidad al proceso.'),'LRB',1,'C');

    //ANALSISI CAUSAS
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(7);
    $pdf->Cell(190,5,utf8_decode('ANÁLISIS DE CAUSA RAÍZ '),'LRT',1,'C');
    $pdf->Cell(190,5,utf8_decode('(Causa o causas por la que se presenta la no conformidad real o potencial u oportunidad de mejora'),'LRB',1,'C');
    $pdf->Cell(10,5,utf8_decode('No.'),1,0,'C');
    $pdf->Cell(60,5,utf8_decode('CAUSA'),1,0,'C');
    $pdf->Cell(60,5,utf8_decode('SUB CAUSA (¿POR QUE?)'),1,0,'C');
    $pdf->Cell(60,5,utf8_decode('ULTRA CAUSA (¿POR QUE?)'),1,1,'C');
    $pdf->SetFont('Arial','',7);

    $pdf->Cell(10,5,utf8_decode('1'),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode('Falla en la validacion de KPIS por parte'),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode('Error Humano'),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LR',1,'C');
    $pdf->Cell(10,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode(' de uno de los analista'),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LRB',1,'C');

    $pdf->Cell(10,5,utf8_decode('2'),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode('Error en la validacion de configuracion '),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode('Vacío de conocimiento por parte del ingeniero '),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LR',1,'C');
    $pdf->Cell(10,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode('de uno de los nodos'),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode('para la verificacion en el Nodo'),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LRB',1,'C');

    $pdf->Cell(10,5,utf8_decode('2'),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode('Error en la validacion de tickets en herramienta'),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode('Vacío de conocimiento por parte del ingeniero '),'LR',0,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LR',1,'C');
    $pdf->Cell(10,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode('para la verificacion en el Nodo'),'LRB',0,'C');
    $pdf->Cell(60,5,utf8_decode(''),'LRB',1,'C');

    $pdf->SetFont('Arial','',9);
    $pdf->Cell(140,5,utf8_decode('CONCLUSIÓN (Causa raíz real principal)'),1,0,'C');
    $pdf->Cell(50,5,utf8_decode('Categoría'),1,1,'C');
    $pdf->Cell(140,5,utf8_decode('Se evidencia un vacio en el concoimiento del proceso por parte de los ingenieros)'),'LR',0,'C');
    $pdf->Cell(50,5,utf8_decode('Metodología'),'LR',1,'C');
    $pdf->Cell(140,5,utf8_decode('encargados del analisis.)'),'LRB',0,'C');
    $pdf->Cell(50,5,utf8_decode(''),'LRB',1,'C');
    $pdf->AddPage();

    //HEADER
    $pdf->Image('https://i0.wp.com/www.digitalstreetsa.com/wp-content/uploads/2017/01/zte.jpg',15,6,28);

    $pdf->Cell(40,5,utf8_decode(''),'LRT',0,'L');
    $pdf->Cell(150,5,utf8_decode('ACCIONES DE MEJORA'),1,1,'C');
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(40,5,utf8_decode(''),'LR',0,'L');
    $pdf->Cell(50,5,utf8_decode('Código:'),'LRT',0,'C');
    $pdf->Cell(50,5,utf8_decode('Fecha de expedición:'),'LRT',0,'C');
    $pdf->Cell(50,5,utf8_decode('Versión:'),'LRT',1,'C');
    $pdf->Cell(40,5,utf8_decode(''),'LRB',0,'L');
    $pdf->Cell(50,5,utf8_decode('GCA-FT-06'),'LRB',0,'C');
    $pdf->Cell(50,5,utf8_decode('Octubre - 2017'),'LRB',0,'C');
    $pdf->Cell(50,5,utf8_decode('01'),'LRB',1,'C');

    //PLAN DE ACCION
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(7);
    $pdf->Cell(190,5,utf8_decode('PLAN DE ACCIÓN '),'LRT',1,'C');
    $pdf->Cell(190,5,utf8_decode('(Escribir las acciones que permitirán eliminar las causas reales o potenciales o desarrollar la oportunidad de mejora)'),'LRB',1,'C');
    $pdf->Cell(10,5,utf8_decode('No.'),1,0,'C');
    $pdf->Cell(80,5,utf8_decode('Acciones'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('RESPONSABLE(S)'),1,0,'C');
    $pdf->Cell(20,5,utf8_decode('FECHA INICIO'),1,0,'C');
    $pdf->Cell(20,5,utf8_decode('FECHA FIN'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('EVIDENCIAS'),1,1,'C');
    $pdf->SetFont('Arial','',7);

    $pdf->Cell(10,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(80,5,utf8_decode('Se realizara entrenamiento y seguimiento al siguiente'),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LR',1,'C');
    $pdf->Cell(10,5,utf8_decode('1'),'LR',0,'C');
    $pdf->Cell(80,5,utf8_decode('personal el cual presento falencia en la validacion de KPIs'),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode('Javier Torres'),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode('5/2/2018'),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode('5/2/2018'),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LR',1,'C');
    $pdf->Cell(10,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(80,5,utf8_decode('y Configuración: Luis Hidalgo, Raul Zuñiga, Michael Franco'),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',1,'C');

    $pdf->Cell(10,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(80,5,utf8_decode('Auditoria al 100% a los sitios realizados por las personas'),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LR',1,'C');
    $pdf->Cell(10,5,utf8_decode('2'),'LR',0,'C');
    $pdf->Cell(80,5,utf8_decode('que presentaron las falencias en la validacion de KPIs'),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode('Javier Torres'),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode('5/2/2018'),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode('12/2/2018'),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LR',1,'C');
    $pdf->Cell(10,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(80,5,utf8_decode('durante una semana'),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',1,'C');

    $pdf->Cell(10,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(80,5,utf8_decode('  Se realizara un retroalimentacion a todo el grupo de ON '),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(20,5,utf8_decode(''),'LR',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LR',1,'C');
    $pdf->Cell(10,5,utf8_decode('3'),'LRB',0,'C');
    $pdf->Cell(80,5,utf8_decode('AIR con las fallas reportadas'),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode('Javier Torres'),'LRB',0,'C');
    $pdf->Cell(20,5,utf8_decode('5/2/2018'),'LRB',0,'C');
    $pdf->Cell(20,5,utf8_decode('5/2/2018'),'LRB',0,'C');
    $pdf->Cell(30,5,utf8_decode(''),'LRB',1,'C');


    //SEGUIMIENTO PLAN DE ACCION
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(7);
    $pdf->Cell(190,5,utf8_decode('SEGUIMIENTO A LA EJECUCIÓN DEL PLAN DE ACCIÓN'),'LRT',1,'C');
    $pdf->Cell(190,5,utf8_decode('(Registrar el seguimiento y evidencias que permitan demostrar la ejecución del Plan de Acción)'),'LRB',1,'C');
    $pdf->Cell(10,5,utf8_decode('No.'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode('FECHA SEGUIMIENTO'),1,0,'C');
    $pdf->Cell(110,5,utf8_decode('RESULTADO DEL SEGUIMIENTO'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('REALIZADO POR'),1,1,'C');
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,5,utf8_decode('1'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(110,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(30,5,utf8_decode(''),1,1,'C');

    $pdf->Cell(10,5,utf8_decode('2'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(110,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(30,5,utf8_decode(''),1,1,'C');

    $pdf->Cell(10,5,utf8_decode('3'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(110,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(30,5,utf8_decode(''),1,1,'C');

    $pdf->Cell(10,5,utf8_decode('4'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(110,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(30,5,utf8_decode(''),1,1,'C');


    //VERIFICACIÓN DE LA EFICACIA DE LA ACCIÓN
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(7);
    $pdf->Cell(190,5,utf8_decode('VERIFICACIÓN DE LA EFICACIA DE LA ACCIÓN'),'LRT',1,'C');
    $pdf->Cell(150,5,utf8_decode('Descripción actividad verificación'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode('Concepto'),1,1,'C');
    $pdf->Cell(150,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,1,'C');
    $pdf->Cell(150,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,1,'C');
    $pdf->Cell(190,5,utf8_decode('CIERRE DE LA ACCIÓN DE MEJORA'),'LRT',1,'C');
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(20,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(50,5,utf8_decode('REPORTANTE'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode('RESPONSABLE'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode('EVALUADOR EFICACIA'),1,0,'C');
    $pdf->Cell(40,5,utf8_decode('COORDINADOR HSEQ'),1,1,'C');

    $pdf->Cell(20,5,utf8_decode('NOMBRE:'),1,0,'C');
    $pdf->Cell(50,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,1,'C');

    $pdf->Cell(20,5,utf8_decode('CARGO:'),1,0,'C');
    $pdf->Cell(50,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,1,'C');

    $pdf->Cell(20,5,utf8_decode('FIRMA:'),1,0,'C');
    $pdf->Cell(50,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(40,5,utf8_decode(''),1,1,'C');

    $pdf->Output();

  }

}
