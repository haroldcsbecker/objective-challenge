<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Sobre o projeto

O projeto está com overengineering no cálculo de taxas para **apresentação** de conhecimento sobre conceitos e padrões.<br>
Uma solução realista para este projeto seria apenas salvar as taxas em uma tabela e buscar ela para calcular o valor da transação.

- Data de entrega combinada: 07/04/2025 <br>
- [**Padrão de commits usados**](https://gist.github.com/qoomon/5dfcdf8eec66a051ecd85625518cfd13)    
- [**Link do desafio**](docs/Desafio_Tecnico_OBJ.pdf) 


| Descrição      | Ferramenta |
| :--:           | :--:       |
| Framework      | Laravel 12 |
| Banco de dados | SQlite     |
| Testes         | Pest       |



## Executar o projeto via composer
Para rodar o código localmente na máquina execute os comandos:

> composer install <br>
> php artisan migrate <br>
> composer run dev <br>

## Executar rotas pelo postman:
Para obter as rotas, baixe o arquivo de importação do [postman](/docs/Objective-challenge.postman_collection.json)

Caso necessário adicione um enviroment com o **base_url**:
> base_url: localhost:8000/api

Caso as consultas retornem html adicione o **header**:
> Accept: application/json

## Rodar os testes automatizados

Para rodar os testes utilize o comando:
> php artisan test
