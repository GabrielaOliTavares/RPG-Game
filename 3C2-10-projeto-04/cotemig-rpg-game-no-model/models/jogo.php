<?php
    class Jogo {
        private $classes = array();
        private $jogador = null;
        private $npcs = array();

        public function adiciona_classe($classe) {
            array_push($this->classes, $classe);
        }

        public function get_classes_option() {
            $options = "";

            foreach($this->classes as $value) {
                $options .= 
                    "<option value=\"" . 
                    $value->get_nome_classe() . 
                    "\">" . 
                    $value->get_nome() . 
                    "</option>";
            }
            return $options;
        }

        public function set_jogador($personagem) {
            $this->jogador = $personagem;
        }

        public function get_jogador() {
            return $this->jogador;
        }

        public function adiciona_npc($npc) {
            array_push($this->npcs, $npc);
        }

        public function get_npcs() {
            return array_merge(array(), $this->npcs);
        }

        public function remover_npc($npc) {
            
            for ($i = 0; $i < sizeof($this->npcs); $i++) {
                if ($npc->get_nickname() === $this->npcs[$i]->get_nickname()) {
                    array_splice($this->npcs, $i, 1);
                    break;
                }
            }

        }
    }
?>
