<?php
//FILE			: SeniorityReport.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: Seniority Report. generates a report in pdf format using FPDF library 
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
$pdf->SetFont('Courier', '', 10);
$pdf->SetFillColor(255,255,102);
$pdf->SetY($y_axis_initial);
$max = 25;
$i = 0;

$pdf->SetX(21);
$pdf->SetFont('Courier', '', 10);
$pdf->SetFont('','UB');
$pdf->Cell(34, 4, 'Seniority Report', 0, 0, 'C', 1);
$pdf->SetFont('','');
$pdf->SetFont('Courier', '', 10);

/**************************************************************
***                                                         ***
***                      Full Time                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->SetX(15);
$pdf->Cell(38, 4, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(35, 4, ' SIN', 1, 0, 'L', 0);
$pdf->Cell(26, 4, ' Type', 1, 0, 'L', 0);
$pdf->Cell(35, 4, ' Date of Hire', 1, 0, 'L', 0);
$pdf->Cell(55, 4, ' Years of Service', 1, 0, 'L', 0);
$y_axis = $y_axis + $row_height;

$row_height = 6;

 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, person.SIN, fulltimeemployee.dateOfHire
                                FROM person
                                LEFT JOIN fulltimeemployee
                                ON person.id=fulltimeemployee.id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(15);
        $pdf->Cell(38, 4, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' SIN', 1, 0, 'L', 0);
        $pdf->Cell(26, 4, ' Type', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' Date of Hire', 1, 0, 'L', 0);
        $pdf->Cell(55, 4, ' Years of Service', 1, 0, 'L', 0);
        
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $SIN = $row['SIN'];
    $dateOfHire = $row['dateOfHire'];
    

    $date1 = $dateOfHire;
    $date2 = date("Y-m-d");
    
    


    $diff = abs(strtotime($date2) - strtotime($date1));

    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    if ($years == 0)
    {
        if ($months == 0)
        {
            $YOS = $days." days";
        }
        
        else 
        {
            $YOS = $months." month," .$days." days";
        }
    }
    
    else
    {
        $YOS = $years." years," .$months." month," .$days." days";
    }
    
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(15);
    $pdf->Cell(38, 4, ' '.$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$SIN, 1, 0, 'L', 0);
    $pdf->Cell(26, 4, ' FullTime', 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(55, 4, ' '.$YOS, 1, 0, 'L', 0);
    $pdf->SetX(15);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Part Time                         
***                                                         ***
**************************************************************/


 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, person.SIN, partimeemployee.dateOfHire
                                FROM person
                                LEFT JOIN partimeemployee
                                ON person.id=partimeemployee.id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(15);
        $pdf->Cell(38, 4, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' SIN', 1, 0, 'L', 0);
        $pdf->Cell(26, 4, ' Type', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' Date of Hire', 1, 0, 'L', 0);
        $pdf->Cell(55, 4, ' Years of Service', 1, 0, 'L', 0);
        
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $SIN = $row['SIN'];
    $dateOfHire = $row['dateOfHire'];
    

    $date1 = $dateOfHire;
    $date2 = date("Y-m-d");
    
    


    $diff = abs(strtotime($date2) - strtotime($date1));

    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    if ($years == 0)
    {
        if ($months == 0)
        {
            $YOS = $days." days";
        }
        
        else 
        {
            $YOS = $months." month," .$days." days";
        }
    }
    
    else
    {
        $YOS = $years." years," .$months." month," .$days." days";
    }
    
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(15);
    $pdf->Cell(38, 4, ' '.$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$SIN, 1, 0, 'L', 0);
    $pdf->Cell(26, 4, ' PartTime', 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(55, 4, ' '.$YOS, 1, 0, 'L', 0);
    $pdf->SetX(15);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Seasonal                         
***                                                         ***
**************************************************************/


 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, person.SIN, seasonalemployee.seasonYear
                                FROM person
                                LEFT JOIN seasonaleemployee
                                ON person.id=seasonaleemployee.id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(15);
        $pdf->Cell(38, 4, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' SIN', 1, 0, 'L', 0);
        $pdf->Cell(26, 4, ' Type', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' Date of Hire', 1, 0, 'L', 0);
        $pdf->Cell(55, 4, ' Years of Service', 1, 0, 'L', 0);
        
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $SIN = $row['SIN'];
    $dateOfHire = $row['seasonYear'];
    

    $date1 = $dateOfHire;
    $date2 = date("Y-m-d");
    
    


    $diff = abs(strtotime($date2) - strtotime($date1));

    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    if ($years == 0)
    {
        if ($months == 0)
        {
            $YOS = $days." days";
        }
        
        else 
        {
            $YOS = $months." month," .$days." days";
        }
    }
    
    else
    {
        $YOS = $years." years," .$months." month," .$days." days";
    }
    
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(15);
    $pdf->Cell(38, 4, ' '.$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$SIN, 1, 0, 'L', 0);
    $pdf->Cell(26, 4, ' Seasonal', 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(55, 4, ' '.$YOS, 1, 0, 'L', 0);
    $pdf->SetX(15);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Contractor                         
***                                                         ***
**************************************************************/


 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, person.SIN, Contractor.ContractStartDate
                                FROM person
                                LEFT JOIN Contractor
                                ON person.id=Contractor.id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(15);
        $pdf->Cell(38, 4, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' SIN', 1, 0, 'L', 0);
        $pdf->Cell(26, 4, ' Type', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' Date of Hire', 1, 0, 'L', 0);
        $pdf->Cell(55, 4, ' Years of Service', 1, 0, 'L', 0);
        
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $SIN = $row['SIN'];
    $dateOfHire = $row['ContractStartDate'];
    

    $date1 = $dateOfHire;
    $date2 = date("Y-m-d");
    
    


    $diff = abs(strtotime($date2) - strtotime($date1));

    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    if ($years == 0)
    {
        if ($months == 0)
        {
            $YOS = $days." days";
        }
        
        else 
        {
            $YOS = $months." month," .$days." days";
        }
    }
    
    else
    {
        $YOS = $years." years," .$months." month," .$days." days";
    }
    
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(15);
    $pdf->Cell(38, 4, ' '.$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$SIN, 1, 0, 'L', 0);
    $pdf->Cell(26, 4, ' Contract', 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(55, 4, ' '.$YOS, 1, 0, 'L', 0);
    $pdf->SetX(15);
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