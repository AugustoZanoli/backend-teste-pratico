# Teste Prático: Controle de Investimentos (backend)

## Tecnologias utilizadas

---

- PHP (8.4.8)
- MySql (8.0.42)
- PDO

---

## Como rodar o projeto do zero

---

### 1. Clonar o repositório

```bash
git clone <URL_DO_SEU_REPOSITORIO>
cd <PASTA_DO_PROJETO>
```

### 2. Configurar váriaveis de ambiente

Crie um arquivo .env na raiz do projeto com as seguintes variáveis:

```bash
DB_HOST=localhost
DB_NAME=investimentos
DB_USERNAME=seu_username
DB_PASSWORD=sua_senha
```

Utilize os dados necessários para realizar a conexão com o seu banco local.

### 3. Criação do banco

- Faça login no MySQL
```bash
mysql -u root -p
```

- Crie o banco de dados investimentos
```sql
CREATE DATABASE investimentos;
USE investimentos;
```

- Crie a tabela investimento
```sql
CREATE TABLE investimento (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  tipo ENUM('Ação', 'Título', 'Fundo') NOT NULL,
  valor FLOAT NOT NULL,
  data DATE NOT NULL
);
```

### 4. Rodar o servidor backend

- O php já possui um servidor embutido. Para rodar basta executar:

```bash
php -S localhost:8080
```

---

### Observações

Caso o PHP esteja dando erro de drivers, pode ser necessário verificar se a instalação foi feita corretamente.

- Certifique-se que sua instalação do PHP tem a extensão pdo_mysql ativada.
```bash
php -m | findstr pdo
```

Caso ele liste pdo_mysql está tudo correto.