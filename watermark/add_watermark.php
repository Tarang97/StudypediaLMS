<?php
session_start();
include("../functions/functions.php");
$filepath = null;
if(isset($_REQUEST['filepath']))    $filepath = "../".$_REQUEST['filepath'];
require('fpdf/fpdf.php');
require_once 'FPDI/fpdi.php';

try{
class PDF_Rotate extends FPDI {

    var $angle = 0;

    function Rotate($angle, $x = -1, $y = -1) {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle*=M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage() {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

}
$fullPathToFile = null;
if($filepath != null)
$fullPathToFile = $filepath;

class PDF extends PDF_Rotate {

    var $_tplIdx;
    
    function Header() {
        global $fullPathToFile;
        $this->SetFont('Arial', 'B', 50);
        $this->SetTextColor(255, 192, 203);
        $this->RotatedText(70, 170, 'Studypedia', 45);
        
        if (is_null($this->_tplIdx)) {
            // THIS IS WHERE YOU GET THE NUMBER OF PAGES
            $this->numPages = $this->setSourceFile($fullPathToFile);
            $this->_tplIdx = $this->importPage(1);
        }
        $this->useTemplate($this->_tplIdx, 0, 0, 200);
    }

    function RotatedText($x, $y, $txt, $angle) {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

}
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

if($pdf->numPages>1) {
    for($i=2;$i<=$pdf->numPages;$i++) {
        $pdf->_tplIdx = $pdf->importPage($i);
        $pdf->AddPage();
    }
}
$pdf->Output($filepath, 'F'); //save to a local file with the name given by filename (may include a path)
}
catch(Exception $e)
{
 //           unset($_SESSION['message']);
   // set_message("File is Uploaded but Watermark is not Added.");
            echo "<script type='text/javascript'>";
            echo "document.location.href = '../index.php' ";
            echo "</script>";
}

            echo "<script type='text/javascript'>";
            echo "document.location.href = '../index.php' ";
            echo "</script>";
?>
