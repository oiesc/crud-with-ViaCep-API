# Gestão de Clientes com API da ViaCEP

Sistema simples de cadastro do de clientes onde o endereço deve ser preenchido a partir do consumo da API dos correios.
Sistema feito em PHP (v 7.2), utilizando MySQL como banco de dados.
O Consumo da API é através de JavaScript.

Página inicial: index.php na pasta public_html.
(http://localhost/crud-with-ViaCep-API/public_html/index.php)

*Neste pequeno sistema, não foram implementadas todas as tratativas de erros 'não comuns' no mysql

**Construção do BD:**
Foram considerados que o cliente pode ter apenas um endereço, e um endereço pode pertencer a 1-n clientes; porém, no sistema de cadastro, não foi implementado a opção de aproveitar o endereço para outro cliente, ou seja: todo novo cliente vai ter seu novo endereço.
Comando para criar o BD: crudWithViaCEPApi.sql

**- MODELO LÓGICO -**

![](/modelo%20lógico.png)
