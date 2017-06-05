class utils{

  exec{'fixed':
    command => 'apt-get update --fix-missing -y',
    path    => ['/usr/bin', '/usr/sbin',]
  }

  $basic_packages = [
    'vim','git','gem','zip','build-essential','curl'
  ]

  package{$basic_packages:
    ensure => installed,
    require => Exec['fixed']
  }
}

class accounts {
  user { 'vagrant':
    ensure   => present,
    password => '$1$ImQjhUIS$oG7ejFp/tReDLujM2nkE80',
  }
}

class webserver{

  class {
    'apache':
      default_vhost => false,
      mpm_module => false,
  }

  class {
    'apache::mod::prefork':
      startservers    => "5",
      minspareservers => "3",
      maxspareservers => "3",
      serverlimit     => "64",
      maxclients      => "64",
  }

  include apache::mod::php
  include apache::mod::alias
  include apache::mod::rewrite
  include apache::mod::vhost_alias

  apache::vhost { 'book.com':         		  	  					#	Dominio definido para o site
    serveraliases => [
      'api.book.com',
      'dev.book.com',
    ],
    setenv          => [
      'APPLICATION_DEBUG true',
      'APPLICATION_DB_DRIVE pdo_mysql',
      'APPLICATION_DB_NAME bookApi',
      'APPLICATION_DB_HOST localhost',
      'APPLICATION_DB_PORT 3306',
      'APPLICATION_DB_USER application_user',
      'APPLICATION_DB_PASSWORD 123456789'
    ],
    priority		    => 15,										  							# Prioridade do Site no Apache
    port          	=> '80',								  								# Porta que o Site está ouvindo no Apache
    docroot       	=> '/var/www/web/',						  					# Diretório Raiz do Site
    directories => [{
      path 			=> '/var/www/web/',		  											# Diretório Raiz. Definido no Vagrantfile (server.vm.synced_folder)
      directoryindex => 'index.php index.html',								# Indice do Diretorio.
      options 	=> ['Indexes','FollowSymLinks','MultiViews'],	# Opções de Visualização de Conteúdo
#      order 		=> 'allow,deny',															# Aplicação das permissões de acesso.
#      allow 		=> 'from all'											  					# Disponivel para
      allow_override => [ 'None' ],                           # Permite override a partir de um .htaccess ( neste caso não )
      rewrites => [                                           # Aplica regras de rewrite de urls
        {
          rewrite_cond => [                                   # Link https://silex.sensiolabs.org/doc/2.0/web_servers.html#apache
            '%{REQUEST_FILENAME} !-d',
            '%{REQUEST_FILENAME} !-f'
          ],
          rewrite_rule => ['^ index.php [QSA,L]'],
        },
      ],
    }],
    docroot_owner 	=> 'www-data',														# Usuário Dono da Pasta ( Usuario de Serviço no Linux )
    docroot_group 	=> 'www-data',														# Grupo Dono da Pasta
    access_log_file => 'api.book.com_access.log',             # Logs de acesso
    error_log_file  => 'api.book.com_error.log',              # Logs de erros
  }
}

class language{

  class{'::php':
    ensure       => latest,
    manage_repos => true,
    fpm          => false,
    dev          => true,
    composer     => true,
    pear         => true,
    phpunit      => false,
    settings   => {
      'PHP/max_execution_time'  => '90',
      'PHP/display_errors'      => true,
      'PHP/log_errors'          => true,
      'PHP/track_errors'        => true,
      'PHP/html_errors'         => true,
      'PHP/max_input_time'      => '300',
      'PHP/memory_limit'        => '256M',
      'PHP/post_max_size'       => '32M',
      'PHP/upload_max_filesize' => '32M',
      'Date/date.timezone'      => 'America/Sao_Paulo',
    },
    extensions => {
      curl => {},
      gd => {},
      mcrypt => {},
      mysql => {},
      mongo => {},
      redis => {},
      oauth => {},
      curl => {},
      json => {},
      xsl => {},
      xmlrpc => {},
    },
  }
}

class database {

  class { '::mysql::server':
    root_password           => '123456789',
    remove_default_accounts => true,
    override_options        => {
      'mysqld' => {
        'connect_timeout'                 => '60',
        'bind_address'                    => '0.0.0.0',
        'max_connections'                 => '100',
        'max_allowed_packet'              => '128M',
        'thread_cache_size'               => '16',
        'query_cache_size'                => '128M',
      }
    },
  }

  mysql::db { 'bookapi':
    user      => 'application_user',
    password  => '123456789',
    host      => '%',
    grant     => ['all'],
    ensure    => present,
    charset   => 'utf8',
    collate   => 'utf8_general_ci',
    require   => Class['mysql::server'],
  }
}

node "apibook" {

  include utils
  include accounts
  include webserver
  include language
  include database

  Class['utils'] -> Class['accounts']
  Class['accounts'] -> Class['webserver']
  Class['webserver'] -> Class['language']
  Class['language'] -> Class['database']

}
