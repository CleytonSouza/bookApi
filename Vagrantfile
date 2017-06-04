# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
    config.vm.box = "puppetlabs/debian-8.2-64-puppet"
    config.vm.box_check_update = false
    config.vm.hostname = "apibook"

    unless Vagrant.has_plugin?("vagrant-librarian-puppet")
        raise "I need plugin vagrant-librarian-puppet !"
    else
        config.librarian_puppet.puppetfile_dir = "puppet"
        config.librarian_puppet.use_v1_api  = '3'
        config.librarian_puppet.destructive = true
    end

    if Vagrant.has_plugin?("vagrant-cachier")
        config.cache.scope = :machine
        config.cache.auto_detect = false
        config.cache.enable :apt
        config.cache.enable :gem
    end

    if Vagrant.has_plugin?("vagrant-hostmanager")
        config.hostmanager.enabled = true
        config.hostmanager.manage_host = true
        config.hostmanager.ignore_private_ip = false
        config.hostmanager.include_offline = true
        config.vm.network :private_network, ip: '192.168.56.101'
        config.hostmanager.aliases = %w(api.book.com book.com)
    else
        config.vm.network :private_network, ip: '192.168.56.101'
    end

    config.vm.provider :virtualbox do |v|
        v.customize [
         "modifyvm",:id,
         "--memory",1024,
         "--cpus",2
        ]
    end

    config.vm.synced_folder "./", "/var/www" , owner: "www-data", group: "www-data"

    config.vm.network :forwarded_port, guest: 80, host: 8080
    config.vm.network :forwarded_port, guest: 3306, host: 3306

    config.vm.provision :puppet do |puppet|
        puppet.environment_path = "puppet/environments"
        puppet.environment = "develop"
        puppet.module_path = "puppet/modules"
        puppet.options = "--disable_warnings=deprecations"
    end
end
