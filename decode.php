<?php
require 'path/to/QrReader.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    // Check if the uploaded file is an image (jpg or png)
    if (is_uploaded_file($file['tmp_name']) && in_array($file['type'], ['image/jpeg', 'image/png'])) {
        $filename = $file['tmp_name'];

        // Read QR Code content from the image
        try {
            $qrcode = new QrReader($filename);
            $qrContent = $qrcode->text();
            echo $qrContent;
        } catch (Exception $e) {
            echo 'Error: Unable to read QR Code.';
        }
    } else {
        echo 'Error: Invalid file format. Please upload a jpg or png image.';
    }
} else {
    echo 'Error: No file uploaded.';
}
