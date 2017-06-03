# bookApi


Foi executado o PHP CS para padronizacao dos codigos segundo a PSR-2

-- Instalando o PHP CS

-- composer require "squizlabs/php_codesniffer" --dev

-- Verificando os erros nos codigos 

-- php vendor/bin/phpcs --standard=PSR2 --bootstrap=vendor/autoload.php src/

-- Instalando o PHP CS FIXER

-- composer require friendsofphp/php-cs-fixer 

-- Executando o PHP CS FIXER para correcao dos codigos do src

-- php vendor/bin/php-cs-fixer fix src/ --rules=@PSR2

-- Rodando de novo sem erros agora

-- php vendor/bin/phpcs --standard=PSR2 --bootstrap=vendor/autoload.php src/