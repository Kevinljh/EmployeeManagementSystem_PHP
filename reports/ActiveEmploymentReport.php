<?php
//FILE			: ActiveEmployementReport.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: Active Employment Report. generates a report in pdf format using FPDF library 
//                and Mysql Query calls

if(basename(getcwd()) == "reports") chdir("../");
require("fpdf/fpdf.php");

// MySql setup
$db = mysqli_connect("localhost","root","root", "EMS");
if (!$db)
  {
  die('Could not connect: ' . mysqli_error($db));
  }

mysqli_query($db,"Use EMS" );

// fpdf Setup
$y_axis_initial = 10;
$pdf = new FPDF();
$pdf->Open();
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Courier', '', 11);
$pdf->SetFillColor(255,255,102);
$pdf->SetY($y_axis_initial);
$max = 25;
$i = 0;

$pdf->SetX(20);
$pdf->SetFont('Courier', '', 11);
$pdf->SetFont('','UB');
$pdf->Cell(56, 4, 'Active Employment Report', 0, 0, 'C', 1);
$pdf->SetFont('','');
$pdf->SetFont('Courier', '', 11);

/**************************************************************
***                                                         ***
***                      Full Time                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->SetX(36);
$pdf->MultiCell(111,5,'FullTime',1,'C', false);
$pdf->SetX(36);
$pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
$pdf->Cell(35, 5, 'Date of Hire', 1, 0, 'C', 0);
$pdf->Cell(38, 5, 'Avg. Hours', 1, 0, 'C', 0);
$y_axis = $y_axis + $row_height;

$row_height = 6;

 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, fulltimeemployee.dateOfHire,
                                (timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)
                                FROM person
                                LEFT JOIN fulltimeemployee
                                ON person.id=fulltimeemployee.id
                                LEFT JOIN timecard
                                ON person.id=timecard.id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(36);
        $pdf->MultiCell(111,5,'FullTime',1,'C', false);
        $pdf->SetX(36);
        $pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
        $pdf->Cell(35, 5, 'Date of Hire', 1, 0, 'C', 0);
        $pdf->Cell(38, 5, 'Avg. Hours', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $dateOfHire = $row['dateOfHire'];
    $hours = $row['(timecard.monday + timecard.tuesday 
                    + timecard.wednesday + timecard.thursday 
                    + timecard.friday + timecard.saturday 
                    + timecard.sunday)'];

    $pdf->Ln($lineBreak);                
    $pdf->SetX(36);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 5, " ".$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(38, 5, $hours, 1, 0, 'R', 0);
    $pdf->SetX(36);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Part Time                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->Ln($lineBreak);
$pdf->SetX(36);
$pdf->MultiCell(111,5,'PartTime',1,'C', false);
$pdf->SetX(36);
$pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
$pdf->Cell(35, 5, 'Date of Hire', 1, 0, 'C', 0);
$pdf->Cell(38, 5, 'Avg. Hours', 1, 0, 'C', 0);
$y_axis = $y_axis + $row_height;

$row_height = 6;

 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, parttimeemployee.dateOfHire,
                                (timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)
                                FROM person
                                LEFT JOIN parttimeemployee
                                ON person.id=parttimeemployee.id
                                LEFT JOIN timecard
                                ON person.id=timecard.id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    // if page is full
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(36);
        $pdf->MultiCell(111,5,'PartTime',1,'C', false);
        $pdf->SetX(36);
        $pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
        $pdf->Cell(35, 5, 'Date of Hire', 1, 0, 'C', 0);
        $pdf->Cell(38, 5, 'Avg. Hours', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $dateOfHire = $row['dateOfHire'];
    $hours = $row['(timecard.monday + timecard.tuesday 
                    + timecard.wednesday + timecard.thursday 
                    + timecard.friday + timecard.saturday 
                    + timecard.sunday)'];
    // draw table
    $pdf->Ln($lineBreak);                
    $pdf->SetX(36);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 5, " ".$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(38, 5, $hours, 1, 0, 'R', 0);
    $pdf->SetX(36);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Seasonal                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->Ln($lineBreak);
$pdf->SetX(36);
$pdf->MultiCell(111,5,'Seasonal',1,'C', false);
$pdf->SetX(36);
$pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
$pdf->Cell(35, 5, 'Date of Hire', 1, 0, 'C', 0);
$pdf->Cell(38, 5, 'Avg. Hours', 1, 0, 'C', 0);
$y_axis = $y_axis + $row_height;

$row_height = 6;

 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, seasonalemployee.seasonYear,
                                (timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)
                                FROM person
                                LEFT JOIN seasonalemployee
                                ON person.id=seasonalemployee.id
                                LEFT JOIN timecard
                                ON person.id=timecard.id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    // if page is full
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(36);
        $pdf->MultiCell(135,5,'Seasonal',1,'C', false);
        $pdf->SetX(36);
        $pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
        $pdf->Cell(35, 5, 'Date of Hire', 1, 0, 'C', 0);
        $pdf->Cell(38, 5, 'Avg. Hours', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $dateOfHire = $row['seasonYear'];
    $hours = $row['(timecard.monday + timecard.tuesday 
                    + timecard.wednesday + timecard.thursday 
                    + timecard.friday + timecard.saturday 
                    + timecard.sunday)'];
    // draw table
    $pdf->Ln($lineBreak);                
    $pdf->SetX(36);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 5, " ".$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(38, 5, $hours, 1, 0, 'R', 0);
    $pdf->SetX(36);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Contract                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->Ln($lineBreak);
$pdf->SetX(36);
$pdf->MultiCell(111,5,'Contract',1,'C', false);
$pdf->SetX(36);
$pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
$pdf->Cell(35, 5, 'Date of Hire', 1, 0, 'C', 0);
$pdf->Cell(38, 5, 'Avg. Hours', 1, 0, 'C', 0);
$y_axis = $y_axis + $row_height;

$row_height = 6;

 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, Contractor.ContractStartDate
                                FROM person
                                LEFT JOIN Contractor
                                ON person.id=Contractor.id
                                LEFT JOIN timecard
                                ON person.id=timecard.id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    // if page is full
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(36);
        $pdf->MultiCell(135,5,'Contract',1,'C', false);
        $pdf->SetX(36);
        $pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
        $pdf->Cell(35, 5, 'Date of Hire', 1, 0, 'C', 0);
        $pdf->Cell(38, 5, 'Avg. Hours', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $dateOfHire = $row['ContractStartDate'];
    
    // draw table
    $pdf->Ln($lineBreak);                
    $pdf->SetX(36);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 5, " ".$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(38, 5, "--", 1, 0, 'R', 0);
    $pdf->SetX(36);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}

/**************************************************************
***                                                         ***
***                      End                          
***                                                         ***
**************************************************************/
mysql_close($db);

$pdf->Ln($lineBreak);
$pdf->SetX(25);
$pdf->Cell(50, 5, 'Date Generated: ' . date("Y-m-d") , 0, 4, 'C', 0);
$pdf->Cell(50, 5, 'Run By : ' . $_SESSION["username"], 0, 4, 'C', 0);
$pdf->Output();

?>