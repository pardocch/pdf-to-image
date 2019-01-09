<?php
include_once "../src/Pdf.php";

use Pardocch\Convert\Pdf as Pdf;

$pdf = new Pdf(__DIR__ . '/pdf/test.pdf');

var_dump($pdf->getPages());

var_dump($pdf->getFileName());

var_dump($pdf->getFileExt());

$pdf->setResolution(256)
    ->setImageFormat('png')
    ->save(__DIR__ . '/output/');