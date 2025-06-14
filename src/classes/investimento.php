<?php


class Investimento {

        private string $nome;
        private string $tipo;
        private float $valor;
        private DateTime $data;

        public function __construct(string $nome, string $tipo, float $valor, DateTime $data){
                $this->nome = $nome;
                $this->tipo = $tipo;
                $this->valor = $valor;
                $this->data = $data;

        }

        // Função só para testar o servidor
        public function get_dados(){
                
                return [
                        'nome' => $this->nome,
                        'tipo' => $this->tipo,
                        'valor' => $this->valor,
                        'data_investimento' => $this->data->format('Y-m-d'),
                ];
        }
}