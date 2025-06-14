<?php


class Investimento
{

        private string $nome;
        private string $tipo;
        private float $valor;
        private DateTime $data;

        public function __construct(string $nome, string $tipo, float $valor, DateTime $data)
        {
                $this->nome = $nome;
                $this->tipo = $tipo;
                $this->valor = $valor;
                $this->data = $data;

                $this->validar();
        }

        public function validar()
        {
                if (empty($this->nome)) {
                        throw new Exception("Nome não pode ser vazio");
                }
                if (empty($this->tipo)) {
                        throw new Exception("Tipo não pode ser vazio");
                }
                if ($this->valor <= 0) {
                        throw new Exception("Valor deve ser maior que zero");
                }
                if ($this->data > new DateTime()) {
                        throw new Exception("Data não pode ser no futuro");
                }
        }


        public function get_nome()
        {
                return $this->nome;
        }
        public function get_tipo()
        {
                return $this->tipo;
        }
        public function get_valor()
        {
                return $this->valor;
        }
        public function get_data()
        {
                return $this->data;
        }
}
