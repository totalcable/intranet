<?php
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');

//        $html = utf8_decode($html);
//        $dompdf = new DOMPDF();
//        
//        $papersize = "legal";
//        $orientation = 'landscape';
//        $dompdf->load_html($html);
//        ini_set("memory_limit", "32M");
//        $dompdf->render();
//        $dompdf->stream("name.pdf");
//        $this->dompdf->set_paper($papersize, $orientation);
//        $output = $this->dompdf->output();
//        file_put_contents('Brochure.pdf ', $output); 
ob_start();
?>

<html><p>Hello</p></html>

<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");
?>