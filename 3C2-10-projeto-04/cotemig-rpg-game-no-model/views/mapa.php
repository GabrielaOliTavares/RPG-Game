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
    <link rel="stylesheet" href="../styles/footer-control.css">
</head>
<body>
    <main class="screen screen-mapa">
        <?php
            $jogador = $jogo->get_jogador();
            $npcs = $jogo->get_npcs();
            for ($y = 0; $y <= Personagem::MAX_Y; $y++) {
                for ($x = 0; $x <= Personagem::MAX_X; $x++) {
        ?>
            <div class="screen-mapa__celula">
                <?php
                    if (
                        $jogador->get_x() == $x &&
                        $jogador->get_y() == (Personagem::MAX_Y - $y)
                    ) {
                ?>
                    <div class="screen-mapa__celula__info">
                        <?php echo $jogador->get_nickname(); ?><br>
                        Level: <?php echo $jogador->get_level(); ?>
                    </div>
                    <img src="../images/<?php echo $jogador->get_imagem(); ?>" alt="jogador">
                <?php
                    }

                    foreach ($npcs as $npc) {
                        if (
                            $npc->get_x() == $x &&
                            $npc->get_y() == (Personagem::MAX_Y - $y)
                        ) {
                ?>
                        <div class="screen-mapa__celula__info screen-mapa__celula__info--npc">
                            <?php echo $npc->get_nickname(); ?><br>
                            Level: <?php echo $npc->get_level(); ?>
                        </div>
                        <img src="../images/<?php echo $npc->get_imagem(); ?>" alt="npc">
                <?php
                        }                        
                    }
                ?>
            </div>
        <?php
                }
            }
        ?> 
        <section class="backdrop-load backdrop-load--hidden">
            <img src="../images/loading-gif.gif" alt="loading...">
        </section>               
    </main>
    <footer class="footer-control">
        <a href="jogo.php?acao=novo-jogo">Novo Jogo</a>
    </footer>
    <script src="../scripts/mapa.js"></script>
</body>
</html>