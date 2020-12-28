# SONDA
Teste Back End - Credere

## Entrega

O teste foi desenvolvido na Linguagem de Programação PHP usando o Framework CodeIgniter 4.

## Executar

Para rodar o projeto basta clonar o repositório localmente. Nele contém o Docker compose de uma imagem com PHP instalado.

No diretório do projeto deve-se executar o seguinte comando:

    docker-compose up -d

O projeto será executado no endereço http://localhost:8080/

## Consumo da API

Para atender os requisitos do projeto, o mesmo possui 3 Endpoints:

### init

Endpoint com o objetivo de inicializar a posição da Sonda nas coordenadas X = 0 e Y = 0.

http://localhost:8080/api/init

### receivesCommand

Endpoint responsável por receber os comandos no formato JSON conforme exemplo do desafio.

http://localhost:8080/api/receivesCommand

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

http://localhost:8080/api/displaysCoordinates

Retorno esperado:

```json
  {
    "x": 2,
    "y": 3,
    "face": "D"
  }
```

# Teste Unitário

Para executar o teste, basta acessar o diretório do projeto em 'www/html/sonda' e digitar o comando:

    ./vendor/bin/phpunit

Se estiver rodando no OSX ou Linux, pode ser criado um link simbólico para facilitar a execução do teste, para isso basta usar o comando:

    ln -s ./vendor/bin/phpunit ./phpunit

E usar o comando para executar o teste:

    ./phpunit

# Teste usando o Insomnia

Ao utilizar o link do Insomnia um JSON será importado para a máquina local, possibilitando os testes dos Endpoints.

Foi gerado um arquivo para teste em diferentes locais:

## Local

Utilizando a imagem Docker local o teste pode ser acessado pelo endereço http://localhost:8080/. Optei por alterar a porta padrão 80 para 8080, evitando assim, possíveis conflitos.

[![Run in Insomnia}](https://insomnia.rest/images/run.svg)](https://insomnia.rest/run/?label=Credere%20Local&uri=https%3A%2F%2Fgithub.com%2Fmarcos-queiroz%2Fsonda%2Fblob%2Fmain%2FInsomniaLocal.json)

## Online

### Heroku

Para publicação no Heroku foi utilizado o repositório https://github.com/marcos-queiroz/sonda-heroku contendo somente a aplicação web do teste que pode ser acessado através do endereço https://sonda-credere.herokuapp.com/

[![Run in Insomnia}](https://insomnia.rest/images/run.svg)](https://insomnia.rest/run/?label=Credere%20Heroku&uri=https%3A%2F%2Fgithub.com%2Fmarcos-queiroz%2Fsonda%2Fblob%2Fmain%2FInsomniaHeroku.json)

### Hospedagem cPanel

Para demonstração o teste também foi publicado em uma hospedagem cPanel que pode ser acessada através do endereço https://sonda.marcosmqueiroz.com/ 

[![Run in Insomnia}](https://insomnia.rest/images/run.svg)](https://insomnia.rest/run/?label=Credere%20cPanel&uri=https%3A%2F%2Fgithub.com%2Fmarcos-queiroz%2Fsonda%2Fblob%2Fmain%2FInsomnia.json)


# Por fim é isso... 

:bowtie:
