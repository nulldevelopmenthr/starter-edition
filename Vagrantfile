# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.provider "virtualbox" do |v|
    v.memory = 2048
    v.cpus = 2
    v.name = "starteredition"
  end

  config.vm.box = "bento/ubuntu-16.04"
  config.vm.box_version = "<2.3.0"
  config.vm.hostname = "starteredition"

  config.vm.network "private_network", ip: "10.0.1.80"
  config.vm.synced_folder ".", "/vagrant", type: "nfs"

  config.vm.synced_folder './', '/vagrant', id: 'starteredition', type: "nfs"

  config.vm.provision :ansible do |ansible|
    ansible.playbook = "etc/provisioning/setup.yml"
    ansible.groups = {
      "vagrant" => ["default"],
      "servers:children" => ["vagrant"]
    }
    ansible.extra_vars = {
      "private_ip" => "127.0.0.1"
    }
    ansible.verbose = true
    ansible.limit = 'all'
  end
end
