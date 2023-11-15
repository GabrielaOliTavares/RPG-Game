<?php
    // Inicio a sessão da página
    session_start();

    // Carrego as classes modelos
    require_once(__DIR__ . "/../includes/carregar-models.php");
    
    // Recupero a ação a ser executada
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";

    // Vejo qual ação vou executar
    switch ($acao) {
        case "novo-jogo":

            // Inicio um novo jogo
            $jogo = new Jogo();

            // Adiciono as classes de personagens do jogo
            $jogo->adiciona_classe(new ClasseOpcao("Elfo Negro", "ElfoNegro"));   // personagem-02
            $jogo->adiciona_classe(new ClasseOpcao("Guerreiro", "Guerreiro"));    // personagem-03
            $jogo->adiciona_classe(new ClasseOpcao("Mago", "Mago"));              // personagem-04
            $jogo->adiciona_classe(new ClasseOpcao("Elfa Branca", "ElfaBranca")); // personagem-05
            $jogo->adiciona_classe(new ClasseOpcao("Guerreira", "Guerreira"));    // personagem-06
            $jogo->adiciona_classe(new ClasseOpcao("Gatuna", "Gatuna"));          // personagem-07

            // Gravo o jogo na sessão
            $_SESSION["jogo"] = serialize($jogo);

            // Gero o HTML da view
            include_once(__DIR__ . "/../views/novo-jogo.php");

            break;

        case "inicia-jogo":

            // Valido a sessão
            sessao_valida(false);

            // Carrego o jogo da sessão
            $jogo = unserialize($_SESSION["jogo"]);

            // Valido e recupero os valores dos inputs do formulário HTML
            if (!isset($_POST["nickname"]) || !$_POST["classe"]) {
                sessao_valida();
            }

            $nickname = $_POST["nickname"];
            $classe = $_POST["classe"];

            // Crio o jogador do usuário
            $jogador = new $classe($nickname);

            // Seto o jogador do usuário no jogo
            $jogo->set_jogador($jogador);

            // Crio os npcs do jogo
            $jogo->adiciona_npc(new Npc("Alice", 1, 2, 2)); // personagem-01
            $jogo->adiciona_npc(new Npc("Maria", 2, 6, 3)); // personagem-01
            $jogo->adiciona_npc(new Npc("Carla", 3, 5, 1)); // personagem-01
            $jogo->adiciona_npc(new Npc("Marta", 4, 7, 2)); // personagem-01
            $jogo->adiciona_npc(new Npc("Joana", 5, 9, 3)); // personagem-01

            // Gravo o jogo na sessão
            $_SESSION["jogo"] = serialize($jogo);

            // Redireciono para o mapa do jogo
            header("Location: jogo.php?acao=mapa");

            break;

        case "mapa":

            // Valido a sessão
            sessao_valida();

            // Carrego o jogo da sessão
            $jogo = unserialize($_SESSION["jogo"]);

            // Gero o HTML da view
            include_once(__DIR__ . "/../views/mapa.php");

            break;

        case "movimenta":

            // Valido a sessão
            sessao_valida();

            // Carrego o jogo da sessão
            $jogo = unserialize($_SESSION["jogo"]); 

            // Recupero o jogador
            $jogador = $jogo->get_jogador();

            // Recupero qual a direção a movimentar
            $direcao = $_GET["direcao"];

            // De acordo com a direção, movimento o jogador
            switch ($direcao) {
                case "cima";
                    $jogador->andar_cima();
                    break;
                case "baixo";
                    $jogador->andar_baixo();
                    break;
                case "esquerda";
                    $jogador->andar_esquerda();
                    break;
                case "direita";
                    $jogador->andar_direita();
                    break;                                                            
            }

            // Valido a posição dos jogadores em relação aos npcs
            $npcs = $jogo->get_npcs();
            foreach ($npcs as $npc) {
                if (
                    $jogador->get_x() == $npc->get_x() &&
                    $jogador->get_y() == $npc->get_y()
                ) {

                    // Venceu
                    if ($jogador->get_level() >= $npc->get_level()) {
                        
                        // Removo o NPC do jogo
                        $jogo->remover_npc($npc);

                        // Aumento o level do jogador
                        $jogador->aumenta_level();

                    } else { // Morreu
                        
                        // Tiro o jogo da sessão
                        unset($_SESSION["jogo"]);

                        // Redireciono para tela morreu
                        header("Location: jogo.php?acao=morreu");

                        exit();
                    }

                }
            }

            // Se não existe mais nenhum NPC, jogador venceu
            if (sizeof($jogo->get_npcs()) == 0) {

                // Tiro o jogo da sessão
                unset($_SESSION["jogo"]);

                // Redireciono para tela venceu
                header("Location: jogo.php?acao=venceu");

            } else { // Senão, continuo o jogo
            
                // Gravo o jogo na sessão
                $_SESSION["jogo"] = serialize($jogo);

                // Redireciono para o mapa do jogo
                header("Location: jogo.php?acao=mapa");

            }

            break;

        case "morreu":
            
            // Gero o HTML da view
            include_once(__DIR__ . "/../views/morreu.php");            

            break;

        case "venceu":
        
            // Gero o HTML da view
            include_once(__DIR__ . "/../views/venceu.php");

            break;

        default:
            // Se for enviada uma ação inválida, gero erro
            http_response_code(400);
    }

    /**
     * Verifica se na sessão existe um jogo ativo
     */
    function sessao_valida($valida_jogador = true) {
        $valido = true;

        if (!isset($_SESSION["jogo"]) || $_SESSION["jogo"] == null) {
            $valido = false;
        } else {
            $jogo = unserialize($_SESSION["jogo"]);
            if ($valida_jogador) {
                $valido = ($jogo->get_jogador() != null);
            }
        }

        if (!$valido) {
            header("Location: jogo.php?acao=novo-jogo");
            exit();            
        }
    }

?>