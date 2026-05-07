<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect to Login - Bakso Bunderan Ciomas</title>
    <script>
        // Redirect to universal login
        window.location.href = "{{ route('universal.login') }}";
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body>
    <div style="text-align: center; margin-top: 100px;">
        <h2>Redirecting to login page...</h2>
        <p>If you are not redirected automatically, <a href="{{ route('universal.login') }}">click here</a>.</p>
    </div>
</body>
</html>




