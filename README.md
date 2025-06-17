# Teste Prático: Controle de Investimentos (backend)

## Tecnologias utilizadas

---

- PHP (8.4.8)
- MySql (8.0.42)
- PDO

---

## Como rodar o projeto do zero

---

### Necessário
- PHP instalado (https://www.php.net/downloads)
- MySql instalado e rodando localmente (https://dev.mysql.com/downloads/)
- PDO configurado (Consulte "Configurando e ativando a extensão pdo_mysql" ao final do documento)

### 1. Clonar o repositório

```bash
git clone https://github.com/AugustoZanoli/backend-teste-pratico.git
ren backend-teste-pratico backend
cd backend
```

Caso esteja utilizando linux ou mac, substitua o comando ren por mv

```bash
mv backend-teste-pratico backend
```


### 2. Verificar pré-requisitos do PHP

Verifique a instalação do Php e da extensão pdo_mysql
```bash
php -v 
```

E

```bash
php -m | grep pdo
```

No Windows, substitua grep por findstr:

```bash
php -m | findstr pdo
```

Caso o pdo não tenha retorno, consulte o último tópico desse documento.

### 3. Configurar váriaveis de ambiente

Crie um arquivo .env na raiz do projeto com as seguintes variáveis:

```bash
DB_HOST=localhost
DB_NAME=investimentos
DB_USERNAME=seu_username
DB_PASSWORD=sua_senha
```

Utilize os dados necessários para realizar a conexão com o seu banco local.

### 4. Criação do banco

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

### 5. Rodar o servidor backend

- O php já possui um servidor embutido. Para rodar basta executar:

```bash
php -S localhost:8000
```

---

## Configurando e ativando a extensão pdo_mysql

Após instalar o PHP, pode ser necessário configurar algumas coisas manualmente, especialmente a extensão pdo_mysql usada para conexão com bancos MySQL via PDO.

### 1. Verifique se o PHP está instalado corretamente

No terminal, rode:

```bash
php -v
```

Se o PHP estiver instalado, ele mostrará a versão instalada.

### 2. Verifique se a extensão pdo_mysql está ativada

No terminal, execute:

```bash
php -m | grep pdo
```

No Windows, substitua grep por findstr:

```powershell
php -m | findstr pdo
```
Se aparecer pdo_mysql na lista, está tudo certo e você pode rodar seu backend normalmente.

### 3. Caso a extensão pdo_mysql não esteja ativada

Siga estes passos para ativá-la manualmente:

- Acesse o diretório onde o PHP foi instalado

Exemplo:

```bash
cd C:/php
```

- Verifique os arquivos de configuração

Liste os arquivos:

```bash
ls
```

Provavelmente, você verá arquivos chamados php.ini-production e php.ini-development, mas não verá o php.ini.

- Crie o arquivo de configuração

Copie ou renomeie o arquivo php.ini-development para php.ini:

No terminal:

```bash
copy php.ini-development php.ini
```

Ou faça manualmente no explorador de arquivos.

- Edite o arquivo php.ini

Abra o php.ini em um editor de texto e localize as seguintes linhas:

```ini
;extension_dir = "./"

;extension=mysqli

;extension=pdo_mysql
```

Remova o ponto-e-vírgula ; do início das linhas para ativá-las, e ajuste o caminho da extensão assim:

```ini
extension_dir = "ext"

extension=mysqli

extension=pdo_mysql
```

Salve o arquivo php.ini

Reinicie seu servidor PHP (se estiver usando um servidor embutido ou serviço)

Verifique novamente se a extensão está ativada

Execute no terminal:

```bash
php -m | findstr pdo
```
Agora deve listar:

```nginx
pdo_mysql
```

Se aparecer, significa que a extensão está funcionando.