<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO kontak (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    $stmt->close();

    // Kirim ke Telegram
    $token = "7973622617:AAEnVPbdrzUr1hJ6niAtXWee_cIudAd4dtA";  // Ganti dengan Token Bot Telegram Anda
    $chat_id = "7704776010";  // Ganti dengan ID Telegram Anda

    $text = "📩 *Pesan Baru dari Formulir Kontak:*\n\n"
          . "👤 *Nama:* $name\n"
          . "📧 *Email:* $email\n"
          . "💬 *Pesan:* $message";

    $telegram_url = "https://api.telegram.org/bot$token/sendMessage";
    
    $data = [
        "chat_id" => $chat_id,
        "text" => $text,
        "parse_mode" => "Markdown"
    ];

    $options = [
        "http" => [
            "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    file_get_contents($telegram_url, false, $context);

    echo "Terima kasih, $name. Pesan Anda telah dikirim!";
    $conn->close();
} else {
    echo "Akses tidak diizinkan!";
}
?>