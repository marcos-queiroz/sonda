# SONDA
Teste Back End - Credere

## Entrega

O teste foi desenvolvido na Linguagem de Programação PHP usando o Framework CodeIgniter 4.

## Executar

Para rodar o projeto basta clonar o repositório localmente. Nele contém o Docker compose de uma imagem com PHP instalado.

No diretório do projeto deve-se executar o seguinte comando:

    docker-compose up -d

O projeto será executado no endereço http://localhost.

## Consumo da API

Para atender os requisitos do projeto, o mesmo possui 3 Endpoints:

### init

Endpoint com o objetivo de inicializar a posição da Sonda nas coordenadas X = 0 e Y = 0.

http://localhost/api/init

Retorno esperado:

```json
  {
    "x": 0,
    "y": 0,
    "face": "D"
  }
```

### receivesCommand

Endpoint responsável por receber os comandos no formato JSON conforme exemplo do desafio.

http://localhost/api/receivesCommand

Exemplo de comando válido:

```json
  {
     "movimentos": ["GE", "M", "M", "M", "GD", "M", "M"]
  }
```

Retorno esperado:

```json
  {
    "x": 2,
    "y": 3
  }
```

### displaysCoordinates

Endpoint responsável pelo retorno da posição da sonda:

http://localhost/api/displaysCoordinates

Retorno esperado:

```json
  {
    "x": 2,
    "y": 3,
    "face": "D"
  }
```

# Teste usando o Insomnia

O teste foi publicado no domínio: https://sonda.marcosmqueiroz.com/ utilizando o link do Insomnia. O JSON será importado para a máquina local possibilitando os testes dos Endpoints. 

[![Run in Insomnia}](https://insomnia.rest/images/run.svg)](https://insomnia.rest/run/?label=Teste%20Credere&uri=https%3A%2F%2Fgithub.com%2Fmarcos-queiroz%2Fsonda%2Fblob%2Fmain%2FInsomnia.json)
