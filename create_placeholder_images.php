<?php

// Danh sách các file ảnh cần tạo
$images = [
    'so-mi-nam-cong-so.jpg',
    'so-mi-ngan-tay-tre-trung.jpg',
    'so-mi-dai-tay-lich-lam.jpg',
    'quan-au-nam-han-quoc.jpg',
    'quan-short-nam-the-thao.jpg',
    'giay-cao-got.jpg',
    'giay-converse-nu.jpg',
    'giay-nu.jpg',
    'giay-da-tre-em.jpg',
    'giay-bup-be-tre-em.jpg',
    'san-pham-ban-chay.jpg',
    'ao-len-nu.jpg',
    'chan-vay-nu.jpg',
    'ao-khoac-nu.jpg'
];

$colors = [
    ['bg' => [255, 182, 193], 'text' => [139, 0, 0]],      // Pink
    ['bg' => [173, 216, 230], 'text' => [0, 0, 139]],      // Light Blue
    ['bg' => [255, 218, 185], 'text' => [139, 69, 19]],    // Peach
    ['bg' => [221, 160, 221], 'text' => [75, 0, 130]],     // Plum
    ['bg' => [152, 251, 152], 'text' => [0, 100, 0]],      // Pale Green
    ['bg' => [255, 228, 181], 'text' => [184, 134, 11]],   // Moccasin
    ['bg' => [176, 224, 230], 'text' => [0, 139, 139]],    // Powder Blue
    ['bg' => [255, 192, 203], 'text' => [199, 21, 133]],   // Pink
    ['bg' => [255, 239, 213], 'text' => [160, 82, 45]],    // Papaya Whip
    ['bg' => [230, 230, 250], 'text' => [72, 61, 139]],    // Lavender
    ['bg' => [255, 250, 205], 'text' => [184, 134, 11]],   // Lemon Chiffon
    ['bg' => [240, 128, 128], 'text' => [139, 0, 0]],      // Light Coral
    ['bg' => [175, 238, 238], 'text' => [0, 128, 128]],    // Pale Turquoise
    ['bg' => [255, 222, 173], 'text' => [139, 69, 19]]     // Navajo White
];

$outputDir = __DIR__ . '/public/images/';

if (!file_exists($outputDir)) {
    mkdir($outputDir, 0777, true);
}

foreach ($images as $index => $imageName) {
    $filePath = $outputDir . $imageName;
    
    // Kiểm tra nếu file đã tồn tại thì bỏ qua
    if (file_exists($filePath)) {
        echo "Bỏ qua: $imageName (đã tồn tại)\n";
        continue;
    }
    
    // Tạo ảnh 600x600
    $width = 600;
    $height = 600;
    $image = imagecreatetruecolor($width, $height);
    
    // Chọn màu
    $colorIndex = $index % count($colors);
    $bgColor = imagecolorallocate($image, $colors[$colorIndex]['bg'][0], $colors[$colorIndex]['bg'][1], $colors[$colorIndex]['bg'][2]);
    $textColor = imagecolorallocate($image, $colors[$colorIndex]['text'][0], $colors[$colorIndex]['text'][1], $colors[$colorIndex]['text'][2]);
    
    // Fill background
    imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);
    
    // Thêm text
    $productName = str_replace(['.jpg', '-'], [' ', ' '], $imageName);
    $productName = ucwords($productName);
    
    // Vẽ text ở giữa
    $fontSize = 5;
    $textWidth = imagefontwidth($fontSize) * strlen($productName);
    $textHeight = imagefontheight($fontSize);
    $x = ($width - $textWidth) / 2;
    $y = ($height - $textHeight) / 2;
    
    imagestring($image, $fontSize, $x, $y, $productName, $textColor);
    
    // Vẽ viền
    imagerectangle($image, 10, 10, $width - 10, $height - 10, $textColor);
    imagerectangle($image, 15, 15, $width - 15, $height - 15, $textColor);
    
    // Lưu ảnh
    imagejpeg($image, $filePath, 90);
    imagedestroy($image);
    
    echo "Đã tạo: $imageName\n";
}

echo "\nHoàn thành! Đã tạo " . count($images) . " ảnh placeholder.\n";
