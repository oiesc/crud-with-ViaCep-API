# Gestão de Clientes com API da ViaCEP

Sistema simples de cadastro do de clientes onde o endereço deve ser preenchido a partir do consumo da API dos correios.
Sistema feito em PHP (v 7.2), utilizando MySQL como banco de dados.
O Consumo da API é feito através de JavaScript.

*1. Neste pequeno sistema, não foram implementadas todas as tratativas de erros 'não comuns' no mysql*

*2. O sistema é simples, portanto não conta com url amigáveis e outros detalhes avançados em PHP.*

**Construção do BD:**

Foram considerados que o cliente pode ter apenas um endereço, e um endereço pode pertencer a 1-n clientes; porém, no sistema de cadastro, não foi implementado a opção de aproveitar o endereço para outro cliente, ou seja: todo novo cliente vai ter seu novo endereço.

Arquivo com comando para criar o BD: **crudWithViaCEPApi.sql** ou **backup-crudWithViaCEPApi.sql**.


**- MODELO LÓGICO -**

![](/modelo%20lógico.png)

Necessário ter um servidor local (Apache) e MySQL instalados.

**Sequência de execução:**
1. Criar o BD no MySQL (utilizando os comandos disponíveis neste repositório), alterar o arquivo **config.php** e o arquivo **Apps/Services/Conexao.php)** para acessar o BD.
2. Acessar o sistema através da página inicial (**index.php** na pasta **public_html** - localhost/crud-with-ViaCep-API/public_html/index.php)

O objetivo desse sistema é estudar as operações de requisitar na API e fazer operações básicas (CRUD) no banco. 
Para mostrar essas operações, foram usados cards, onde cada card tem uma opção especifica, conforme imagem abaixo.

![](/prints/crud%20with%20viacep%20api%20-%20home.png)

Verifique a pasta prints para visualizar as páginas principais.
