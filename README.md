# Simulador de Empréstimo

Este é um projeto para simulação de empréstimos com dados de instituições financeiras, convênios e taxas.

## Endpoints da API

- `GET /api/instituicoes`: Retorna uma lista de instituições.
- `GET /api/convenios`: Retorna uma lista de convênios.
- `POST /api/simular`: Realiza a simulação de empréstimo com os dados fornecidos no corpo da requisição.

## Como rodar o projeto

1. Clone este repositório:
   ```bash
   git clone https://github.com/gianlucasr23/simulador-api.git

2 . Acesse a pasta do projeto cd simulador-api

- cd simulador-api

3 . Instale as dependências do projeto com o Composes

composser install
4 . configure o arquivo .env com as variáveis do ambiente (caso necessário). 
5 . inicie o Servidor 
php artisan serve
6 . A6. Acesse a API através de `http://localhost:8000`.
   - **GET /api/instituicoes**: `http://localhost:8000/api/instituicoes`
   - **GET /api/convenios**: `http://localhost:8000/api/convenios`
   - **POST /api/simular**: Você pode testar o POST com um corpo JSON no Postman ou Insomnia.

