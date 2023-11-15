<?php
    abstract class Personagem {
        private $tipo = "";
        private $imagem = "";
        private $nickname = "";
        private $x = 0;
        private $y = 0;
        private $level = 0;

        const MAX_X = 9;
        const MAX_Y = 3;

        public function __construct($tipo, $imagem, $nickname, $level, $x, $y) {
            $this->tipo = $tipo;
            $this->imagem = $imagem;
            $this->nickname = $nickname;
            $this->level = $level;
            $this->set_x($x);
            $this->set_y($y);
        }

        public function andar_direita() {
            if ($this->x < Personagem::MAX_X) {
                $this->x++;
            }
        }

        public function andar_esquerda() {
            if ($this->x > 0) {
                $this->x--;
            }
        }
        
        public function andar_cima() {
            if ($this->y < Personagem::MAX_Y) {
                $this->y++;
            }
        }

        public function andar_baixo() {
            if ($this->y > 0) {
                $this->y--;
            }
        } 
        
        public function aumenta_level() {
            $this->level++;
        }

        private function set_x($x) {
            if ($x > Personagem::MAX_X) {
                $x = Personagem::MAX_X;
            }
            $this->x = $x;
        }

        private function set_y($y) {
            if ($y > Personagem::MAX_Y) {
                $y = Personagem::MAX_Y;
            }
            $this->y = $y;
        }        

        public function get_tipo() {
            return $this->tipo;
        }

        public function get_imagem() {
            return $this->imagem;
        }
        
        public function get_nickname() {
            return $this->nickname;
        }        

        public function get_level() {
            return $this->level;
        }

        public function get_x() {
            return $this->x;
        } 
        
        public function get_y() {
            return $this->y;
        }        
    }
?>
