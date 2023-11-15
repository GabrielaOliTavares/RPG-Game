<?php
    class Npc extends Personagem {

        public function __construct($nickname, $level, $x, $y) {
            parent::__construct("NPC", "personagem-01.png", $nickname, $level, $x, $y);
        }

    }
?>
