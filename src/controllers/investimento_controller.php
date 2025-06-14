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

                        $investimento->set_id($this->conn->lastInsertId());

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
        public function update_investimento(Investimento $investimento)
        {
                try {
                        $sql = "UPDATE investimento SET nome = :nome, tipo = :tipo, valor = :valor, data = :data WHERE id = :id";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bindValue(':nome', $investimento->get_nome());
                        $stmt->bindValue(':tipo', $investimento->get_tipo());
                        $stmt->bindValue(':valor', $investimento->get_valor());
                        $stmt->bindValue(':data', $investimento->get_data()->format('Y-m-d'));
                        $stmt->bindValue(':id', $investimento->get_id());

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

        // Função para deletar investimento no banco
        public function delete_investimento(Investimento $investimento)
        {
                try {
                        $sql = "DELETE FROM investimento WHERE id = :id";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bindValue(':id', $investimento->get_id());

                        $stmt->execute();

                        return [
                                "status" => 201,
                                "mensagem" => "Investimento removido com sucesso!"
                        ];
                } catch (PDOException $e) {
                        return [
                                "status" => 500,
                                "erro" => "Erro ao remover o investimento: " . $e->getMessage()
                        ];
                }
        }

        // Função para listar todos os investimentos no banco
        public function listar_todos()
        {
                try {
                        $sql = "SELECT * FROM investimento";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute();
                        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $investimentos = [];

                        foreach ($resultados as $row) {
                                $investimento = new Investimento(
                                        (int)$row['id'],
                                        $row['nome'],
                                        $row['tipo'],
                                        (float)$row['valor'],
                                        new DateTime($row['data'])

                                );

                                $investimentos[] = $investimento->to_array();
                        }

                        return [
                                "status" => 200,
                                "investimentos" => $investimentos
                        ];
                } catch (PDOException $e) {
                        return [
                                "status" => 500,
                                "erro" => "Erro ao listar investimentos: " . $e->getMessage()
                        ];
                }
        }
}
