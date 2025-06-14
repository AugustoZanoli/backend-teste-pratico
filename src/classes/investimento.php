<?php


class Investimento {

        private $nome;
        private $tipo;
        private $valor;
        private $data;

        public function __construct($nome, $tipo, $valor, $data){
                $this->nome = $nome;
                $this->tipo = $tipo;
                $this->valor = $valor;
                $this->data = $data;

        }

        public function get_dados(){
                
                return [
                        'nome' => $this->nome,
                        'tipo' => $this->tipo,
                        'valor' => $this->valor,
                        'data' => $this->data,
                ];
        }
}