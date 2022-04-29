<?php
const IMAGE_HANDLERS = [
    IMAGETYPE_JPEG => [
        'load' => 'imagecreatefromjpeg',
        'save' => 'imagejpeg',
        'quality' => 100
    ],
    IMAGETYPE_PNG => [
        'load' => 'imagecreatefrompng',
        'save' => 'imagepng',
        'quality' => 0
    ],
    IMAGETYPE_BMP => [
        'load' => 'imagecreatefrombmp',
        'save' => 'imagebmp',
        'quality' => 0
    ]
];
function compressimage($src, $dest, $targetWidth, $targetHeight = null) {
    $type = exif_imagetype($src);
    if (!$type || !IMAGE_HANDLERS[$type]) {
        return null;
    }
    $image = IMAGE_HANDLERS[$type]['load']($src);
    if (!$image) {
        return null;
    }
    $width = imagesx($image);
    $height = imagesy($image);
    if ($targetHeight == null) {
        $ratio = $width / $height;
        if ($width > $height) {
            $targetHeight = floor($targetWidth / $ratio);
        }
        else {
            $targetHeight = $targetWidth;
            $targetWidth = floor($targetWidth * $ratio);
        }
    }
    $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
    if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {
        imagecolortransparent(
            $thumbnail,
            imagecolorallocate($thumbnail, 0, 0, 0)
        );
        imagealphablending($thumbnail, false);
        imagesavealpha($thumbnail, true);
    }
    imagecopyresampled(
        $thumbnail,
        $image,
        0, 0, 0, 0,
        $targetWidth, $targetHeight,
        $width, $height
    );
    return IMAGE_HANDLERS[$type]['save']($thumbnail, $dest, IMAGE_HANDLERS[$type]['quality']);
}

?>

<!-- https://github.com/habibieamrullah/PHPUploadAndResizeImage/blob/master/compressimage.php -->