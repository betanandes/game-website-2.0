<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <main>
    <?php
        $cotação = 5.17;
        $real = $_REQUEST['din'] ?? 0;
        $dólar = $real/$cotação;

        $padrão = numfmt_create("pt-BR", NumberFormatter::CURRENCY);

        echo "seus " . numfmt_format_currency($padrão, $real, "BRL"). " equivalem a ". numfmt_format_currency($padrão, $dólar, "USD");
    ?> 
        <br><br>
        <button onclick="javascript:history.go(-1)">Voltar</button>
    </main>
    
</body>
</html>