# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.network "private_network", ip: "10.0.1.80"
  config.vm.synced_folder ".", "/vagrant", type: "nfs"

  config.vm.provider "virtualbox" do |v|
    v.name ="project_name"
    v.customize ["modifyvm", :id, "--memory", 2048]
    v.customize ["modifyvm", :id, "--ioapic", "on"]
    v.customize ["modifyvm", :id, "--cpus", "8"]
    v.customize ["modifyvm", :id, "--vram", "64"]
    v.customize ["modifyvm", :id, "--cpuexecutioncap", "100"]
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
    v.gui = false
  end

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
