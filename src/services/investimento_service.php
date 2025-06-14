<?php

class InvestimentoService
{
        private $repository;

        public function __construct(InvestimentoRepository $repository)
        {
                $this->repository = $repository;
        }

        public function criarInvestimento(Investimento $investimento): array
        {
                try {
                        $id = $this->repository->inserir_investimento($investimento);
                        $investimento->set_id($id);

                        return [
                                "status" => 201,
                                "mensagem" => "Investimento cadastrado com sucesso!",
                                "investimento" => $investimento->to_array()
                        ];
                } catch (Exception $e) {
                        return [
                                "status" => 500,
                                "erro" => "Erro ao cadastrar investimento: " . $e->getMessage()
                        ];
                }
        }

        public function atualizar_investimentoInvestimento(Investimento $investimento): array
        {
                try {
                        $success = $this->repository->atualizar_investimento($investimento);

                        if ($success) {
                                return [
                                        "status" => 200,
                                        "mensagem" => "Investimento atualizado com sucesso!",
                                        "investimento" => $investimento->to_array()
                                ];
                        } else {
                                return [
                                        "status" => 404,
                                        "erro" => "Investimento não encontrado para atualização."
                                ];
                        }
                } catch (Exception $e) {
                        return [
                                "status" => 500,
                                "erro" => "Erro ao atualizar_investimento investimento: " . $e->getMessage()
                        ];
                }
        }

        public function deletar_investimentoInvestimento(int $id): array
        {
                try {
                        $success = $this->repository->deletar_investimento($id);
                        if ($success) {
                                return [
                                        "status" => 200,
                                        "mensagem" => "Investimento removido com sucesso!"
                                ];
                        } else {
                                return [
                                        "status" => 404,
                                        "erro" => "Investimento não encontrado para remoção."
                                ];
                        }
                } catch (Exception $e) {
                        return [
                                "status" => 500,
                                "erro" => "Erro ao remover investimento: " . $e->getMessage()
                        ];
                }
        }

        public function listarInvestimentos(): array
        {
                try {
                        $investimentos = $this->repository->listar_investimentos();
                        $arrayInvestimentos = array_map(fn($inv) => $inv->to_array(), $investimentos);

                        return [
                                "status" => 200,
                                "investimentos" => $arrayInvestimentos
                        ];
                } catch (Exception $e) {
                        return [
                                "status" => 500,
                                "erro" => "Erro ao listar investimentos: " . $e->getMessage()
                        ];
                }
        }
}
