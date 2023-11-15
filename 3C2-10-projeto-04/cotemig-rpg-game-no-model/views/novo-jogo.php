<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotemig RPG Game</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shrikhand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/screen.css">
</head>
<body>
    <main class="screen screen-menu">

        <h1 class="screen-menu__title">Cotemig RPG Game</h1>

        <form action="jogo.php?acao=inicia-jogo" method="post">
            <ul class="screen-menu__itens">
                <li>
                    <fieldset>
                        <label for="nickname">Nickname</label>
                        <input type="text" id="nickname" name="nickname" value="" maxlength="10" required>
                    </fieldset>
                </li>
                <li>
                    <fieldset>
                        <label for="classe">Selecione uma classe</label>
                        <select id="classe" name="classe" required>
                            <?php echo $jogo->get_classes_option(); ?>
                        </select>
                    </fieldset>                    
                </li>
                <li>
                    <button>Iniciar</button>
                </li>
                <li>
                    <a href="../index.php">Página Inicial</a>
                </li>                
            </ul>
        </form>

    </main>
</body>
</html>