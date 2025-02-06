# API de Gerenciamento de Médicos e Pacientes

#### Rotas Públicas

```http
  GET /medicos
```
```http
  GET /cidades/{id_cidade}/medicos
```

```http
  GET /cidades
```
---

## **Base URL**
http://localhost/api

---

## **Autenticação**
Todas as rotas marcadas como protegidas requerem autenticação do usuário. A autenticação é realizada utilizando tokens.

### **Cabeçalhos para autenticação**
```json
Authorization: Bearer {seu_token_de_acesso}
```

### **Médicos**

#### Listar Médicos

```http
  GET /medicos
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `nome` | `string` | **(Opcional)**. Busca por parte do nome do médico. |


Retorna uma lista de todos os médicos cadastrados, ordenada alfabeticamente.
Permite buscar por nome, ignorando prefixos como "Dr" ou "Dra".
Parâmetros de URL:

Parâmetro	Tipo	Descrição
nome	String	(Opcional) Busca por parte do nome do médico.

#### Exemplo de Requisição:
```http
  GET /medicos?nome=Joao
```
#### Resposta:
```json
[
    {
        "id": 1,
        "nome": "Dr. João",
        "especialidade": "Cardiologista",
        "cidade_id": 1,
        "created_at": "2025-02-04T20:48:38.000000Z",
        "updated_at": "2025-02-04T20:48:38.000000Z",
        "deleted_at": null,
        "cidade": {
            "id": 1,
            "nome": "São Paulo",
            "estado": "SP",
            "created_at": "2025-02-04T20:46:38.000000Z",
            "updated_at": "2025-02-04T20:46:38.000000Z",
            "deleted_at": null
        }
    }
]
```


#### Listar Médicos de uma Cidade

```http
  GET /cidades/{id_cidade}/medicos
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `id_cidade` | `Integer` | **(Obrigatorio)**. ID da cidade cujos médicos serão listados.nome do médico. |
| `nome` | `string` | **(Opcional)**. Busca por parte do nome do médico. |

#### Exemplo de Requisição:
```http
  GET /cidades/1/medicos?nome=Maria
```
```json
[
    {
        "id": 1,
        "nome": "Dr. João",
        "especialidade": "Cardiologista",
        "cidade_id": 1,
        "created_at": "2025-02-04T20:48:38.000000Z",
        "updated_at": "2025-02-04T20:48:38.000000Z",
        "deleted_at": null
    },
]
```

### **Pacientes**

#### Listar Pacientes
- Retorna uma lista de todos os pacientes cadastrados.

#### Exemplo de Requisição:
```http
  GET /pacientes
```
#### Resposta:
```json
[
    {
        "id": 1,
        "nome": "Carlos Silva",
        "cpf": "123.456.789-00",
        "celular": "11987654321",
        "created_at": "2025-02-04T20:50:27.000000Z",
        "updated_at": "2025-02-04T20:50:27.000000Z",
        "deleted_at": null,
    },
]
```

#### Listar Pacientes de um Médico
- Retorna todos os pacientes que possuem consultas agendadas ou realizadas com um médico específico.
- Apenas usuários autenticados podem acessar esta rota.
- Permite aplicar os seguintes filtros:
    Consultas que ainda não foram realizadas.
- Nome parcial do paciente.

```http
  GET /medicos/{id_medico}/pacientes
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `id_medico` | `Integer` | ID do médico cujos pacientes serão listados. |
| `apenas-agendadas` | `Boolean` | **(Opcional)**. Retorna apenas consultas que ainda não foram realizadas. |
| `nome` | `string` | **(Opcional)**. Busca por parte do nome do paciente. |

#### Exemplo de Requisição:
```http
  GET /medicos/1/pacientes?apenas-agendadas=true&nome=João
```

#### Resposta:

```Json
[
    {
        "id": 1,
        "nome": "Carlos Silva",
        "cpf": "123.456.789-00",
        "celular": "11987654321",
        "created_at": "2025-02-04T20:50:27.000000Z",
        "updated_at": "2025-02-04T20:50:27.000000Z",
        "deleted_at": null,
        "consultas": [
            {
                "id": 2,
                "medico_id": 1,
                "paciente_id": 1,
                "data": "2025-02-06 20:50:54",
                "created_at": "2025-02-04T20:50:54.000000Z",
                "updated_at": "2025-02-04T20:50:54.000000Z",
                "deleted_at": null
            }
        ]
    },
]
```

#### Cadsatrar Pacientes

- Permite criar um paciente.
```http
  POST /paciente
```
```Json
{
    "nome": "Joao MArcelo",
    "cpf": 123456789012,
    "celular": "98983535514"
}
```
#### Resposta:

```Json
{
    "nome": "João Marcelo",
    "cpf": "123456789012",
    "celular": "98983535514",
    "updated_at": "2025-02-06T13:33:13.000000Z",
    "created_at": "2025-02-06T13:33:13.000000Z",
    "id": 4
}
```

### **Consultas**


#### Cadastrar consulta

- Permite criar uma consulta entre um médico e um paciente.
```http
  POST /medico/consulta
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `medico_id` | `Integer` | ID do médico que realizará a consulta. |
| `paciente_id` | `Integer` | ID do paciente relacionado à consulta. |
| `data` | `Datetime	` | Data e hora da consulta. |

#### Exemplo de Requisição:

```Json
{
    "medico_id": 1,
    "paciente_id": 2,
    "data": "2025-02-10 10:00:00"
}
```
#### Resposta:

```Json
{
    "id": 1,
    "medico_id": 1,
    "paciente_id": 2,
    "data": "2025-02-10 10:00:00",
}

```

#### Listar consultas

```http
  POST /consultas
```
```Json
[
    {
        "id": 2,
        "medico_id": 1,
        "paciente_id": 1,
        "data": "2025-02-06 20:50:54",
        "created_at": "2025-02-04T20:50:54.000000Z",
        "updated_at": "2025-02-04T20:50:54.000000Z",
        "deleted_at": null,
        "medico": {
            "id": 1,
            "nome": "Dr. João",
            "especialidade": "Cardiologista",
            "cidade_id": 1,
            "created_at": "2025-02-04T20:48:38.000000Z",
            "updated_at": "2025-02-04T20:48:38.000000Z",
            "deleted_at": null
        },
        "paciente": {
            "id": 1,
            "nome": "Carlos Silva",
            "cpf": "123.456.789-00",
            "celular": "11987654321",
            "created_at": "2025-02-04T20:50:27.000000Z",
            "updated_at": "2025-02-04T20:50:27.000000Z",
            "deleted_at": null
        }
    },
]
```

### **Cidades**


#### Listar Cidades
```http
  POST /cidades
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `nome` | `string` | **(Opcional)**. Busca por parte da cidade. |


- Retorna uma lista de todas as cidades cadastrados
- Permite buscar por nome


#### Exemplo de Requisição:
```http
  GET /cidades?nome=São
```

```Json
[
    {
        "id": 1,
        "nome": "São Paulo",
        "estado": "SP",
        "created_at": "2025-02-04T20:46:38.000000Z",
        "updated_at": "2025-02-04T20:46:38.000000Z",
        "deleted_at": null
    }
]
```

#### Respostas de Erro Comuns
- 401 Unauthorized: O usuário não está autenticado.
- 404 Not Found: O recurso solicitado não foi encontrado.
