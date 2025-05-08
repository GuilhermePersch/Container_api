# COMO USAR?

# API de Motos com PHP e Docker

Para o professor Hugo, atividade realizada em aula no dia 08/05/2025

---

## Requisitos

- Docker
- Docker Compose

---

## Como rodar o projeto

Clonar o repositório: ->

bash
git clone https://github.com/GuilhermePersch/container_api.git


Encontrar na pasta:
cd container2

Buildar a imagem:
docker-compose up --build

Testar o localhost:
http://localhost:8080/index.php/motos

# EndPoints liberados:

🔹 Listar todas as motos
GET http://localhost:8080/index.php/motos
Retorna todas as motos cadastradas.

🔹 Cadastrar nova moto
POST http://localhost:8080/index.php/motos

JSON Exemplo:

json para copiar e editar


{
  "modelo": "CB 500F",
  "marca": "Honda",
  "ano": 2021,
  "preco": 35000
}


🔹 Buscar moto por ID
GET http://localhost:8080/index.php/motos

Exemplo: http://localhost:8080/index.php/motos/1

🔹 Atualizar moto existente
PUT http://localhost:8080/index.php/motos{id}

JSON Exemplo:

json para copiar e editar
{
  "modelo": "MT-03",
  "marca": "Yamaha",
  "ano": 2022,
  "preco": 30000
}


## Como rodar o banco:

docker ps  -> pegar o id do container MYSQL

docker exec -it container_id bash  -> entrar no container

show databases;

use meu_banco;

show tables;

select * from motos;
