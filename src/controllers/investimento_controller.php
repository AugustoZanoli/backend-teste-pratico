<?php

class Investimento_controller
{
        private $conn;

        public function __construct(Connection $db)
        {
                $this->conn = $db->connect();
        }

        // Função para inserir investimento no banco
        public function inserir_investimento(Investimento $investimento)
        {
                try {

                        $sql = "INSERT INTO investimento (nome, tipo, valor, data) VALUES (:nome, :tipo, :valor, :data)";
                        $stmt = $this->conn->prepare($sql);

                        $stmt->bindValue(':nome', $investimento->get_nome());
                        $stmt->bindValue(':tipo', $investimento->get_tipo());
                        $stmt->bindValue(':valor', $investimento->get_valor());
                        $stmt->bindValue(':data', $investimento->get_data()->format('Y-m-d'));

                        $stmt->execute();

                        return [
                                "status" => 201,
                                "mensagem" => "Investimento cadastrado com sucesso!"
                        ];
                } catch (PDOException $e) {
                        return [
                                "status" => 500,
                                "erro" => "Erro ao cadastrar o investimento: " . $e->getMessage()
                        ];
                }
        }

        // Função para atualizar investimento no banco
        public function update_investimento(Investimento $investimento) {
                try{
                        $sql = "UPDATE investimentos.investimento i SET i.nome = :nome, i.tipo = :tipo, i.valor = :valor, i.data = :data WHERE i.id = ?"; // Preciso vincular esse id ao investimento
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bindValue(':nome', $investimento->get_nome());
                        $stmt->bindValue(':tipo', $investimento->get_tipo());
                        $stmt->bindValue(':valor', $investimento->get_valor());
                        $stmt->bindValue(':data', $investimento->get_data()->format('Y-m-d'));

                        $stmt->execute();

                        return [
                                "status" => 201,
                                "mensagem" => "Investimento atualizado com sucesso!"
                        ];
                } catch (PDOException $e) {
                        return [
                                "status" => 500,
                                "erro" => "Erro ao atualizar o investimento: " . $e->getMessage()
                        ];
                }
        }
}
