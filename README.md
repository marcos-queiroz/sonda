# sonda
Teste Back End - Credere

## Entrega

O teste foi desenvolvido a Lingugem de Programação PHP e o Framework CodeIgniter4.

## Executar

Para rodar o projeto basta clonar o projeto localmente em uma maquina ou Docker que possua o PHP instalado.
No diretório do projeto executar o seguinte comando:

  php spark serve

O projeto será executado no endereço http://localhost:8080.

## Consumo da API

Para atender os requisitos do projeto o mesmo possui 3 Endpoints

### init

Endpoint com o objetivo de inicializar a posição da Sonda nas coordenadas X = 0 e Y = 0;

http://localhost:8080/api/init

Retorno esperado

```json
  {
    "x": 0,
    "y": 0,
    "face": "D"
  }
```

### receivesCommand

Endpoint responsável por receber os comandos no formato JSON conforme exemplo do desafio.

http://localhost:8080/api/receivesCommand

Exemplo de comando válido

```json
  {
     "movimentos": ["GE", "M", "M", "M", "GD", "M", "M"]
  }
```

Retorno esperado

```json
  {
    "x": 2,
    "y": 3
  }
```

### displaysCoordinates

Endpoint responsável pelo retorno da possição da sonta.

http://localhost:8080/api/displaysCoordinates

Retorno esperado

```json
  {
    "x": 0,
    "y": 0,
    "face": "D"
  }
```
