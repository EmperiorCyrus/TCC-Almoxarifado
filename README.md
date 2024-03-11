## Gerenciamento de almoxarifado

- Se puderem começar a escrever o README eu agradeceria. :D

## Como começar a usar projeto

Clone o repositório:

```bash
git clone https://github.com/EmperiorCyrus/TCC-Almoxarifado.git
```

Navegue até a pasta do projeto:

```bash
cd TCC-Almoxarifado
```

Instale as dependências necessárias:

```bash
composer install
```

Inicie um servidor localhost:

```bash
php -S localhost:3000
```

### Problemas na hora de iniciar o servidor

- Delete a pasta nikic/ dentro do vendor/
- Delete a pasta composer/ dentro do vendor/

Depois disso use novamente o comando `composer install`. Por fim inicie o servidor com o comando.

OBS: Lembrar de estar com o banco de dados configurado e rodando!
