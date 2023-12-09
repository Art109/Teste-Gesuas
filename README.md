Tenha Instalado 

Symfony Cli
Docker Desktop
Docker compose


Clone o repositorio do git
https://github.com/Art109/Teste-Gesuas

Acesse o a raiz do projeto

Abra o terminal e digite o comando abaixo para instalar a dependencias

symfony composer install

Ajuste o arquivo .env caso seja necessario configurar as variaveis de ambiente relacionadas ao BD


Digite o comando para iniciar o serviço do Docker e iniciar o servidor

symfony serve -d

Monte o container no docker
Todos comandos foram feitos pelo terminal do git , porém esse no meu computador só era utilizavel pelo cmd
docker-compose up -d --build

Após isso execute a migração do doctrine

symfony console doctrine:migrations:migrate

Abra o navegador e acesse http://localhost:8000 para visualizar a aplicação

Todos os testes foram feitos no windows
