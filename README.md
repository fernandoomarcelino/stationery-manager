<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
<h3 align="center">
  Exercise
</h3>

<p align="center">Stationery system: Customers, products, orders</p>

<p align="center">
  <a href="#Objective">Objective</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#Installation">Installation</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
</p>


## Objective
the goal is to solve a challenge. Below original specification (pt-BR) 

#### Sobre o projeto

A API Restful deve contemplar os módulos **Cliente**, **Produtos** e **Pedido**, sendo que cada um devera conter  endpoints **CRUDL**.

As tabelas devem conter as seguintes informações:

* **Cliente** `nome, email, telefone, data de nascimento, endereço, complemento, bairro, cep, data de cadastro`;
* **Produto** `nome, preço, foto`;
* **Pedido** `código do cliente, código(s) do produto, data da criação`;

#### Requisitos

* Não devem existir dois clientes com o mesmo email.
* O produto deve possuir foto.
* Os dados devem ser validados.
* O sistema deve conter uma série de tipos de produtos já definidos.
* O pedido deve contemplar N produtos.
* O cliente pode contemplar N pedidos.
* Os registros devem conter a funcionalidade de soft deleting.
* Padronização PSR
* Nomenclatura de classes, métodos e rotas no padrão americano.
* Não é necessário utilizar padrão de autenticação (ex. OAuth) para consumir a API

#### Fonte
- [test](https://github.com/leonardorutz/teste/blob/main/README.md)

## Installation

#### Download the project
First step, download the project
``` bash
# Download
git clone https://github.com/fernandoomarcelino/stationery-manager.git

# Access the directory
cd stationery-manager
```

## configuration - Backend

``` bash
# Install dependencies
composer install

# Configure variables
cp .env.example .env

# now put your database credentials inside the .env file
php artisan key:generate

# create migrations (upload tables and initial data)
php artisan migrate --seed

# create symbolic link from uloadas folder (storage/app/public to public/storage/)
php artisan storage:link
```

## how to use
``` bash
# turn on the the server - it should go up on port 8000
php artisan serve

# you can configure vhost in apache/nginx or go up to another port
# Don't forget to update the variable APP_URL in the .env file.

# go to the documentation page to test the api
127.0.0.1:8000/api/documentation

```
you can now create, update, list one, list all or update features: customer, product and order.

All data is validated.

File upload was only configured for base64, so it should start with "data: image / png; base64,"
