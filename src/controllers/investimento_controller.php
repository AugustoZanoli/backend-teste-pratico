<?php

class InvestimentoController
{
        private $service;

        public function __construct(InvestimentoService $service)
        {
                $this->service = $service;
        }

        public function criar_investimento(array $dados)
        {
                try {
                        $investimento = new Investimento(
                                null,
                                $dados['nome'],
                                $dados['tipo'],
                                $dados['valor'],
                                new DateTime($dados['data'])
                        );
                        return $this->service->criarInvestimento($investimento);
                } catch (Exception $e) {
                        return [
                                "status" => 400,
                                "erro" => "Dados inválidos: " . $e->getMessage()
                        ];
                }
        }

        public function atualizar_investimento(array $dados)
        {
                try {
                        if (!isset($dados['id'])) {
                                throw new Exception("ID obrigatório para atualizar_investimento");
                        }
                        $investimento = new Investimento(
                                $dados['id'],
                                $dados['nome'],
                                $dados['tipo'],
                                $dados['valor'],
                                new DateTime($dados['data'])
                        );
                        return $this->service->atualizar_investimentoInvestimento($investimento);
                } catch (Exception $e) {
                        return [
                                "status" => 400,
                                "erro" => "Dados inválidos: " . $e->getMessage()
                        ];
                }
        }

        public function deletar_investimento(int $id)
        {
                return $this->service->deletar_investimentoInvestimento($id);
        }

        public function listar_investimentos()
        {
                return $this->service->listarInvestimentos();
        }
}
