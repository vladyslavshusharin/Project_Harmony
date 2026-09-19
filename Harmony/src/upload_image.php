<?php
function uploadFile($file) {
    $target_dir = "Profile_Pictures/";

    try {
        // Ověření, že soubor byl nahrán
        if (!isset($file["tmp_name"]) || $file["tmp_name"] === "") {
            throw new Exception("No file was uploaded.");
        }

        // Ověření, že se jedná o obrázek
        $imageInfo = getimagesize($file["tmp_name"]);
        if ($imageInfo === false) {
            throw new Exception("File isn't a recognized image.");
        }

        // Validace MIME typu
        $allowed_mime = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($imageInfo['mime'], $allowed_mime)) {
            throw new Exception("Image has unsupported MIME type: " . $imageInfo['mime']);
        }

        // Validace přípony
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_extensions)) {
            throw new Exception("Wrong extension of file: " . $imageFileType . ". Allowed: JPG, JPEG, PNG a GIF.");
        }

        // Validace velikosti souboru (do 5 MB)
        if ($file["size"] > 5000000) {
            throw new Exception("File too big. Max size is 5MB");
        }

        // Validace rozměrů obrázku
        if ($imageInfo[0] > 3000 || $imageInfo[1] > 3000) {
            throw new Exception("Image too big: Max resolution is 3000x3000 px.");
        }

        // Kontrola složky pro nahrávání
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                throw new Exception("Couldn't create directory for image uploading");
            }
        }

        // Vygeneruj unikátní název souboru
        $unique_name = uniqid("img_", true) . "." . $imageFileType;
        $target_file = $target_dir . $unique_name;

        // Uložení souboru
        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Error during moving the file into target directory.");
        }

        // Hotovo
        return [
            'success' => true,
            'message' => "File uploaded.",
            'path' => $target_file
        ];

    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => $e->getMessage(),
            'path' => null
        ];
    }
}
?>
