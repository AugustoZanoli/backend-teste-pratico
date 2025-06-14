<?php


class Investimento
{

        private string $nome;
        private string $tipo;
        private float $valor;
        private DateTime $data;
        private ?int $id;

        public function __construct(?int $id, string $nome, string $tipo, float $valor, DateTime $data)
        {
                $this->id = $id;
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

        public function to_array()
        {
                return [
                        'id' => $this->get_id(),
                        'nome' => $this->get_nome(),
                        'tipo' => $this->get_tipo(),
                        'valor' => $this->get_valor(),
                        'data' => $this->get_data()->format('Y-m-d'),
                ];
        }



        // getters
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
        public function get_id(): ?int
        {
                return $this->id;
        }

        // setters
        public function set_id($id)
        {
                $this->id = $id;
        }
        public function set_nome($nome)
        {
                $this->nome = $nome;
        }
        public function set_tipo($tipo)
        {
                $this->tipo = $tipo;
        }
        public function set_valor($valor)
        {
                $this->valor = $valor;
        }
        public function set_data($data)
        {
                $this->data = $data;
        }
}
