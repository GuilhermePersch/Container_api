# COMO USAR?

# API de Motos com PHP e Docker

Para o professor Hugo, atividade realizada em aula no dia 0

---

## Requisitos

- Docker
- Docker Compose

---

## Como rodar o projeto

1. Clone o repositório:

```bash
git clone https://github.com/GuilhermePersch/container_api.git
cd seu-repositorio

docker-compose up --build

http://localhost:8080

# EndPoints liberados:

🔹 Listar todas as motos
GET /motos
Retorna todas as motos cadastradas.

🔹 Cadastrar nova moto
POST /motos

JSON Exemplo:

json
Copiar
Editar
{
  "modelo": "CB 500F",
  "marca": "Honda",
  "ano": 2021,
  "preco": 35000
}
🔹 Buscar moto por ID
GET /motos/{id}
Exemplo: /motos/1

🔹 Atualizar moto existente
PUT /motos/{id}

JSON Exemplo:

json
Copiar
Editar
{
  "modelo": "MT-03",
  "marca": "Yamaha",
  "ano": 2022,
  "preco": 30000
}
