# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # select box type and configure
  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"

  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", "512"]
  end

  # requires the vagrant-hostsupdater plugin
  config.hostsupdater.remove_on_suspend = true
  config.vm.network :private_network, ip: "10.10.1.2"
  config.vm.hostname = "localhost.polar-basin-6883.herokuapp.com"

  # sync the web folder
  config.vm.synced_folder "www/", "/var/www"

  # puppet
  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "puppet/manifests"
    puppet.manifest_file = "default.pp"
  end
end
