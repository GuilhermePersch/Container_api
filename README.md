# Exemplo Prático: API REST de Motos com Docker Compose (Para o Prof. Hugo Rafael)

Este projeto demonstra como criar uma API RESTful simples com **PHP (Apache)** e **MySQL** usando **Docker Compose**.

Você pode:
- Criar e acessar um banco de dados MySQL
- Usar rotas `GET`, `POST`, `PUT` e `DELETE` para gerenciar uma tabela de motos
- Subir e derrubar os containers facilmente com Docker

---

## Pré-requisitos

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- Uma ferramenta para testar APIs como [Postman](https://www.postman.com/) ou `curl`

---

## Estrutura do Projeto

meu-projeto/
│
├── Dockerfile # Imagem customizada com PHP + Apache
├── docker-compose.yml # Orquestração dos containers
└── src/
└── index.php # Código da API REST

---

## Como Rodar o Projeto

1. Acesse o diretório onde está o `docker-compose.yml`:

cd documents
cd container2
docker-compose up ou docker-compose up -d

Acesse navegador ou PostMan por:

http://localhost:8080/index.php/motos

Para parar os containers:

docker-compose down


## Como usar os ENDPOINTS

🧪 API REST: Como Usar
Todas as requisições devem ser feitas para:
http://localhost:8080/index.php/motos

▶️ GET /motos
Retorna todas as motos cadastradas.

bash
Copiar
Editar

curl http://localhost:8080/index.php/motos

▶️ GET /motos/{id}
Retorna uma moto específica.

bash
Copiar
Editar
curl http://localhost:8080/index.php/motos/1

▶️ POST /motos
Cria uma nova moto.

bash
Copiar
Editar
curl -X POST http://localhost:8080/index.php/motos
-H "Content-Type: application/json" \
-d '{
  "modelo": "XRE 300",
  "marca": "Honda",
  "ano": 2022,
  "preco": 21000.50
}'


▶️ PUT /motos/{id}
Atualiza os dados de uma moto.

bash
Copiar
Editar

curl -X PUT http://localhost:8080/index.php/motos/1 \
-H "Content-Type: application/json" \
-d '{
  "modelo": "XRE 300",
  "marca": "Honda",
  "ano": 2023,
  "preco": 22000.00
}'


▶️ DELETE /motos/{id}
Remove uma moto do banco de dados.

bash
Copiar
Editar

curl -X DELETE http://localhost:8080/index.php/motos/1

## Testar banco por Terminal:

Entrar no terminal e digitar os seguintes comandos:

docker ps -> Pegar o id do container MYSQL
docker exec -it (id do container) bash -> usar o id do container

Após isso, usar:

show databases;
use meu_banco;
show tables;
select * from motos;
