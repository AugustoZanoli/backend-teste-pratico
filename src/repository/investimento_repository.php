<?php

class InvestimentoRepository
{
        private $conn;

        public function __construct(Connection $db)
        {
                $this->conn = $db->connect();
        }

        // Função para inserir novo investimento no banco
        public function inserir_investimento(Investimento $investimento): int
        {
                $sql = "INSERT INTO investimento (nome, tipo, valor, data) VALUES (:nome, :tipo, :valor, :data)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':nome', $investimento->get_nome());
                $stmt->bindValue(':tipo', $investimento->get_tipo());
                $stmt->bindValue(':valor', $investimento->get_valor());
                $stmt->bindValue(':data', $investimento->get_data()->format('Y-m-d'));
                $stmt->execute();

                return (int) $this->conn->lastInsertId();
        }

        // Função para atualizar um investimento do banco

        public function atualizar_investimento(Investimento $investimento): bool
        {
                $sql = "UPDATE investimento SET nome = :nome, tipo = :tipo, valor = :valor, data = :data WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':nome', $investimento->get_nome());
                $stmt->bindValue(':tipo', $investimento->get_tipo());
                $stmt->bindValue(':valor', $investimento->get_valor());
                $stmt->bindValue(':data', $investimento->get_data()->format('Y-m-d'));
                $stmt->bindValue(':id', $investimento->get_id());
                return $stmt->execute();
        }

        // Função para deletar um investimento do banco

        public function deletar_investimento(int $id): bool
        {
                $sql = "DELETE FROM investimento WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':id', $id);
                return $stmt->execute();
        }

        // Função para listar todos os investimentos no banco

        public function listar_investimentos(): array
        {
                $sql = "SELECT * FROM investimento";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $investimentos = [];

                foreach ($resultados as $row) {
                        $investimentos[] = new Investimento(
                                (int)$row['id'],
                                $row['nome'],
                                $row['tipo'],
                                (float)$row['valor'],
                                new DateTime($row['data'])
                        );
                }

                return $investimentos;
        }
}
