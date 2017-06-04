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

class admins{
  user {'vagrant':
    ensure    => present,
    password  => '$1$ImQjhUIS$oG7ejFp/tReDLujM2nkE80',        # vagrant
  }
}

class webserver{

  class {
    'apache':
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

  apache::vhost { 'api.book.com':         		  	  					#	Dominio definido para o site
    priority		    => 15,										  							# Prioridade do Site no Apache
    port          	=> '80',								  								# Porta que o Site está ouvindo no Apache
    docroot       	=> '/var/www/web/',						  					# Diretório Raiz do Site
    directories => [{
      path 			=> '/var/www/web/',		  											# Diretório Raiz. Definido no Vagrantfile (server.vm.synced_folder)
      directoryindex => 'index.html',													# Indice do Diretorio.
      options 	=> ['Indexes','FollowSymLinks','MultiViews'],	# Opções de Visualização de Conteúdo
#      order 		=> 'allow,deny',															# Aplicação das permissões de acesso.
#      allow 		=> 'from all'											  					# Disponivel para
    }],
    docroot_owner 	=> 'www-data',														# Usuário Dono da Pasta ( Usuario de Serviço no Linux )
    docroot_group 	=> 'www-data'															# Grupo Dono da Pasta
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
      xdebug => {},
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
  include admins
  include webserver
  include language
  include database

  Class['utils'] -> Class['admins']
  Class['admins'] -> Class['webserver']
  Class['webserver'] -> Class['language']
  Class['language'] -> Class['database']

}
