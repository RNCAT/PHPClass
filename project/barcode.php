<?php
session_start();
require './vendor/autoload.php';

use Dompdf\Dompdf;

$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
$dompdf = new Dompdf();


$emp_id = $_POST['emp_id'];
$emp_name = $_POST['emp_name'];
if ($_POST['row'] == null) {
    $row = 1;
} else {
    $row = $_POST['row'];
}

for ($i = 0; $i < $row; $i++) {
    $html .= $generator->getBarcode('081231723897', $generator::TYPE_CODE_128, 3, 40) . '<p style="text-align: center;">' . $emp_id . '&ensp;' . $emp_name . '</p>';
}


$dompdf->loadHtml(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
$dompdf->setPaper([0, 0, 300, 150], 'portrait');
$dompdf->render();
$dompdf->stream();

?>

<script>
    window.onload = function() {
        window.print();
    }
</script>