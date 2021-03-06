# Longevo

## Softwares necessários

* Apache 2
* PHP 5.4
* Composer
* Postgres 9.4 (com a extensão Postgis)

## Configurando o ambiente de desenvolvimento

Essa aplicação roda sobre framework Yii2.

Abaixo os passos para configurar o projeto.

### Host

Adicione um novo virtual host ao Apache. As configurações do apache geralmente
se encontram no arquivo `/etc/apache2/httpd.conf`.

```apache
<VirtualHost longevo.dev>
    ServerName longevo.dev
    DocumentRoot /var/www/longevo/web

    <Directory /var/www/longevo/web>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            allow from all
            Require all granted
    </Directory>
</VirtualHost>
```

Para que o host `longevo.dev` funcione, adicione a seguinte linha ao seu
arquivo `/etc/hosts`:

```
127.0.0.1 longevo.dev
```

**Importante**: para aplicar as configurações acima, reinicie o Apache:

```bash
sudo service apache2 reload # recarrega o Apache
```

### Aplicação

1. Copie o arquivo ".env.example", criando-o com o nome ".env". Configure as informações de banco de dados

2. Se você não tem o composer instalado, baixe-o [aqui|https://getcomposer.org/]

3. Vá até a pasta raiz do projeto (/var/www/longevo/) e execute composer install

4. Na pasta raiz do projeto rode as migrations, para gerar o banco de dados da aplicação

```
./yii migrate
```

### Dados

Conforme solicitação, os dados popularam as tabelas ao ter executado as migrations.
