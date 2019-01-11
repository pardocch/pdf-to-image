pdf-to-image
========================================

It is a project that convert pdf files to images(supporting format *.jpg, *.jpeg, *.png)  

這是一個專案可以把PDF轉為圖片(JPG、JPEG、PNG)

## Requirements
* [Imagick](https://pecl.php.net/package/imagick)
* [Ghostscript](https://www.ghostscript.com/)

## Installation
```
composer require pardocch\pdf-to-image
```

## Usage

#### Save
```
$pdf = new Pardocch\Pdf\Pdf($PathOfPdf);
$pdf->save($Destination); 
```

#### Get Pdf Pages
```
$pdf->getPages(); // return int
```

#### Set Resolution
```
$pdf->setResolution($resolution);
```

#### Set Compression Quality
```
$pdf->setCompressionQuality($compressionQuality);
```
#### Set Output Image Format
```
$pdf->setImageFormat($format); // Supporting Format: jpg, jpeg, png 
``` 

#### Get Output Image Format
```
$pdf->getImageFormat();
```

#### Get File Name
```
$pdf->getFileName();
```

#### Get File Extension
```
$pdf->getFileExt();
```