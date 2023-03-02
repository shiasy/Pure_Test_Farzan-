
<?php
$data=$_POST;
if ($data=='') {
    $data=$_GET;
}

Used::exportexcel($data);
?>