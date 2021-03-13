<?php
session_start();
require './vendor/autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();

$emp_id = $_POST['emp_id'];
if ($_POST['round'] == null) {
    $round = 1;
} else {
    $round = $_POST['round'];
}

echo "<h3 style='text-align: center'>emp_id : " . $emp_id . "<h3>";

for ($i = 0; $i < $round; $i++) {
    for ($j = 0; $j < 5; $j++) {
        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($emp_id, $generator::TYPE_CODE_128)) . '">&emsp;&ensp;';
    }
    echo "<br>";
}
?>

<script>
    window.onload = function() {
        window.print();
    }
</script>