<?php
if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
    // Aquí, la imagen se ha subido correctamente y podemos procesarla
    $telegramBotToken = 'TU_TOKEN_DE_TELEGRAM';
    $chatId = 'TU_CHAT_ID';
    $caption = 'Esta es la imagen subida';
    
    $url = "https://api.telegram.org/bot" . $telegramBotToken . "/sendPhoto";
    
    $postFields = array(
        'chat_id' => $chatId,
        'caption' => $caption,
        'photo' => new CURLFILE($_FILES['fileToUpload']['tmp_name'])
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    
    echo $result;
} else {
    // Aquí, hubo un error al subir la imagen
    echo "Error al subir la imagen";
}
