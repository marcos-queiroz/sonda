<h1 align="center">
  🔭 SONDA
</h1>

<p align="center">
  <a href="#-projeto">Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-descrição">Descrição</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#%EF%B8%8F-executar-o-projeto">Executar</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-consumo-da-api">Consumo da API</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-teste-unitário">Testes</a>
</p>

## 📌 Projeto

Esse projeto é um sistema desenvolvido como teste técnico para o processo seletivo de Desenvolvedor Backend Credere.

## 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [PHP 7.4](https://php.net/)
- [Composer](https://getcomposer.org)
- [Codeigniter 4](https://codeigniter.com/)
- [Docker](https://docker.com)
### 📄 Descrição

Uma sonda exploradora da NASA pousou em marte. O pouso se deu em uma área retangular, na qual a sonda pode navegar usando uma interface web. A posição da sonda é representada pelo seu eixo x e y, e a direção que ele está apontado pela letra inicial, sendo as direções válidas:

- `E` - Esquerda
- `D` - Direita
- `C` - Cima
- `B` - Baixo

A sonda aceita três comandos:

- `GE` - girar 90 graus à esquerda
- `GD` - girar 90 graus à direta
- `M` - movimentar. Para cada comando `M` a sonda se move uma posição na direção à qual sua face está apontada.

A sonda inicia no quadrante (x = 0, y = 0), o que se traduz como a casa mais inferior da esquerda; também inicia com a face para a direita.

A intenção é controlar a sonda enviando a direção e quantidade de movimentos que ela deve executar. A resposta deve ser sua coordenada final caso o ponto se encontre dentro do quadrante, caso o ponto não possa ser alcançado a resposta deve ser um erro indicando que a posição é inválida. Para a execução do teste as dimensões de 5x5 pode ser usado.


## ⚙️ Executar o Projeto

Para rodar o projeto basta clonar o repositório localmente. Nele contém o Docker compose de uma imagem com PHP instalado.

```sh
    git clone https://github.com/marcos-queiroz/sonda.git
```

No diretório raiz do repositório deve-se executar o seguinte comando:

```sh
    docker-compose up -d
```

O projeto será executado no endereço http://localhost:8080/

### ❕ Observação

Se estiver rodando no Linux execute o comando para dar permissão de escrita no diretório 'writable'.
```sh
    sudo chgrp -R www-data www/html/sonda
```
```sh
    sudo chmod -R 775 www/html/sonda/writable
```

O projeto foi versionado com todas as dependências carregadas pelo Composer, com o objetivo de facilitar a execução do teste sem a necessidade de instalar todos os requisitos da aplicação.

Se a maquina possuir o PHP 7.4 e Composer instalados, basta acessar o diretório 'www/html/sonda' e executar o composer com o comando:

```sh
    composer install
```

## 💻 Consumo da API

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
    "y": 3,
    "sequence": "A sonda, girou para esquerda, se moveu 3 casas no eixo Y, girou para direita, se moveu 2 casas no eixo X"
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

# 📑 Teste Unitário

## Executar o teste no terminal do Docker.

Para isso basta localizar o container com o comando:

```sh
    docker container ps -a
```

Executar o comando para acessar o terminar da imagem:

```sh
    docker container exec -it sonda-credere /bin/sh/
```
```sh
    cd sonda/
```

No diretório do projeto execute o comando:

```sh
    ./vendor/bin/phpunit
```

Exemplo de retorno. 

![Execução no Windows](https://github.com/marcos-queiroz/sonda/blob/main/run-docker-windows.jpeg?raw=true)

## Executar o teste em maquina com PHP instalado

Basta acessar o diretório da aplicação em 'www/html/sonda/' e executar o comando:

```sh
    ./vendor/bin/phpunit
```

Exemplo de retorno

![Execução no terminal](https://github.com/marcos-queiroz/sonda/blob/main/run-terminal.jpg?raw=true)


# Deploy

## Heroku

No Heroku com uma conta administrativa clique em "New", escolher um nome para o App conforme a imagem.

![Criação de um novo APP no Heroku](https://github.com/marcos-queiroz/sonda/blob/main/deploy/01_create_new_app.jpg?raw=true)

Na maquina basta ter o Heroku CLI instalado, acesse o diretório 'www/html/sonda' e execute os comandos:

```sh
    heroku login
```
```sh
    git init
```
```sh
    heroku git:remote -a nome-app
```

Deploy da Aplicação
Envie todo o código para o repositório e realize o deploy.

```sh
    git add .
```
```sh
    git commit -am "Publicação do Novo APP"
```
```sh
    git push heroku master
```

Pronto a aplicação está publicada no Heroku, nesse exemplo no domínio: https://sonda-marte.herokuapp.com/

# 👾 Teste usando o Insomnia

No Windows ou MAC ao utilizar o link do Insomnia um JSON será importado para a máquina local, possibilitando os testes dos Endpoints.

Foi gerado um arquivo para teste em diferentes ambientes:

## 💻 Local

Utilizando a imagem Docker local o teste pode ser acessado pelo endereço http://localhost:8080/. Optei por alterar a porta padrão 80 para 8080, evitando assim, possíveis conflitos.

[![Run in Insomnia}](https://insomnia.rest/images/run.svg)](https://insomnia.rest/run/?label=Credere%20Local&uri=https%3A%2F%2Fgithub.com%2Fmarcos-queiroz%2Fsonda%2Fblob%2Fmain%2FInsomniaLocal.json)

## ☁️ Online

### Heroku

Para demonstração do funcionamento do teste, a aplicação foi publicada no endereço https://sonda-marte.herokuapp.com/

[![Run in Insomnia}](https://insomnia.rest/images/run.svg)](https://insomnia.rest/run/?label=Credere%20Heroku&uri=https%3A%2F%2Fgithub.com%2Fmarcos-queiroz%2Fsonda%2Fblob%2Fmain%2FInsomniaHeroku.json)

### Hospedagem cPanel

Para demonstração o teste também foi publicado em uma hospedagem cPanel que pode ser acessada através do endereço https://sonda.marcosmqueiroz.com/ 

[![Run in Insomnia}](https://insomnia.rest/images/run.svg)](https://insomnia.rest/run/?label=Credere%20cPanel&uri=https%3A%2F%2Fgithub.com%2Fmarcos-queiroz%2Fsonda%2Fblob%2Fmain%2FInsomnia.json)


# Por fim é isso... 

:bowtie:
