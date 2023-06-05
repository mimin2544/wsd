<?php                
require('connect.php'); 
include_once('tcpdf/tcpdf.php');
$db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_REQUEST['pdf_id']))
{
$pdf_id=$_REQUEST['pdf_id'];
$inv_mst_query = $db->prepare("SELECT * FROM `tbl_file`WHERE pdf_id='".$pdf_id."' ");  
$inv_mst_query->bindParam(":pdf_id", $pdf_id);         

$row = $inv_mst_query ->fetch(PDO::FETCH_ASSOC);
}

{

	//----- Code for generate pdf
	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);  
	//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	$pdf->SetDefaultMonospacedFont('helvetica');  
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
	$pdf->setPrintHeader(false);  
	$pdf->setPrintFooter(false);  
	$pdf->SetAutoPageBreak(TRUE, 10);  
	$pdf->SetFont('helvetica', '', 12);  
	$pdf->AddPage(); //default A4
	//$pdf->AddPage('P','A5'); //when you require custome page size 

	$content = ''; 

	$content .= '
	<style >
	body{
	font-size:10px;
	line-height:18px;
	font-family:"THSatabun z.ttf";
	color:#000;
	}
	</style>    
	<table cellpadding="0" cellspacing="0" style="border:1px solid #ddc;width:100%;">
	<table style="width:100%;" >
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2" align="center"><b>SHINERWEB TECHNOLOGIES</b></td></tr>
	<tr><td colspan="2" align="center"><b>CONTACT: +91 97979  97979</b></td></tr>
	<tr><td colspan="2" align="center"><b>WEBSITE: WWW.SHINERWEB.COM</b></td></tr>
	
	
	<tr class="heading" style="background:#eee;border-bottom:1px solid #ddd;font-weight:bold;">
		
		</td>
	</tr>';
		
$pdf->writeHTML($content);
$content2 ='
<style >
	body{
	font-size:10px;
	line-height:18px;
	font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
	color:#000;
	}
	</style>   
	<table cellpadding="0" cellspacing="0" style="border:0.5px solid #ddc;width:100;">
	<table style="width:100%;" >
	<tr><td colspan="1">&nbsp;</td></tr>
	<tr><td colspan="1" align="L"><b>Date:'.$row['name'].' </b></td></tr>
	<tr><td colspan="1" align="L"><b>Customer: </b></td></tr>
	
	<tr><td colspan="1" align="L"><b>INVOICE</b></td></tr>
	<tr><td colspan="2" align="center"><b>SHINERWEB TECHNOLOGIES</b></td></tr>
	<tr class="heading" style="background:#eee;border-bottom:1px solid #ddd;font-weight:bold;">
		
		</td>
	</tr>';
	$pdf->writeHTML($content2);

$file_location = "/home/fbi1glfa0j7p/public_html/examples/generate_pdf/uploads/"; //add your full path of your server
//$file_location = "/opt/lampp/htdocs/examples/generate_pdf/uploads/"; //for local xampp server

$datetime=date('dmY_hms');
$file_name = "cus_".$datetime.".pdf";
ob_end_clean();


$pdf->Output($file_name, 'I'); // I means Inline view
	
echo "Upload successfully!!";

}

//----- End Code for generate pdf
	


?>