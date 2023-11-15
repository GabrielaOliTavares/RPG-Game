<?php
 class ClasseOpcao {
    private $nome = "";
    private $nome_classe = "";

    public function __construct($nome, $nome_classe) {
        $this->nome = $nome;
        $this->nome_classe = $nome_classe;
    }

    public function get_nome() {
        return $this->nome;
    }

    public function get_nome_classe() {
        return $this->nome_classe;
    }        
}
?>

