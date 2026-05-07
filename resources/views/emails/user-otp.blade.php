<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .otp { font-size: 32px; font-weight: bold; color: #8B0000; letter-spacing: 4px; text-align: center; margin: 20px 0; }
        .footer { color: #666; font-size: 12px; margin-top: 30px; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password Bakso Bunderan Ciomas</h2>
        <p>Halo,</p>
        <p>Kode verifikasi untuk reset password akun Anda:</p>
        
        <div class="otp">{{ $otp }}</div>
        
        <p>Kode ini berlaku selama {{ $expiresMinutes }} menit.</p>
        <p>Jika Anda tidak merasa meminta reset password, silakan abaikan email ini.</p>
        
        <div class="footer">
            <p>Bakso Bunderan Ciomas (BBC)</p>
        </div>
    </div>
</body>
</html>




