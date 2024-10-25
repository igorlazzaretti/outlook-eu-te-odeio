<?php
// 1. Define o caminho para a imagem PNG original
$imagePath = 'dieOutlookDie.png';

// 2. Define a nova largura desejada para a imagem
$newWidth = 220;

// 3. Carrega a imagem PNG usando a função `imagecreatefrompng()`
$image = imagecreatefrompng($imagePath);

// 4. Obtém as dimensões originais da imagem
$originalWidth = imagesx($image);
$originalHeight = imagesy($image);

// 5. Calcula a nova altura da imagem, mantendo a proporção original
$newHeight = ($originalHeight / $originalWidth) * $newWidth;

// 6. Redimensiona a imagem usando a função `imagescale()`
// Os parâmetros são: a imagem original, a nova largura, a nova altura
$resizedImage = imagescale($image, $newWidth, $newHeight);

// 7. Inicia um buffer de saída. Isso é necessário para capturar a saída da função `imagepng()`
ob_start();

// 8. Salva a imagem redimensionada no buffer de saída usando a função `imagepng()`
// Essa função gera a imagem PNG, mas em vez de salvá-la em um arquivo, ela a envia para o buffer de saída
imagepng($resizedImage);

// 9. Obtém o conteúdo do buffer de saída (que agora contém a imagem PNG redimensionada)
$imageData = ob_get_contents();

// 10. Limpa o buffer de saída e o fecha
ob_end_clean();

// 11. Libera a memória usada pelas imagens
imagedestroy($image);
imagedestroy($resizedImage);

// 12. Codifica os dados da imagem em Base64 usando a função `base64_encode()`
$base64 = base64_encode($imageData);

// 13. Cria o Data URI para a imagem
// O Data URI é uma string que contém os dados da imagem codificados em Base64
// Ele permite que você incorpore a imagem diretamente no código HTML
$src = 'data:image/png;base64,' . $base64;

// 14. Exibe a imagem em uma tag `<img>` no HTML
echo "<img src='$src' alt='Imagem Com Nova Resolução Finalmente! '>";

?>
