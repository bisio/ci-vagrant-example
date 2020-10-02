# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "ubuntu/bionic64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "forwarded_port", guest: 3306, host: 3307

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"

   #Provider-specific configuration so you can fine-tune various
   #backing providers for Vagrant. These expose provider-specific options.
   #Example for VirtualBox:

   config.vm.provider "virtualbox" do |vb|
     # Display the VirtualBox GUI when booting the machine
     vb.gui = false

     # Customize the amount of memory on the VM:
     vb.memory = "2048"
   end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
  # documentation for more information about their specific syntax and use.
   config.vm.provision "shell", inline: <<-SHELL
    # Iptables
    echo iptables-persistent iptables-persistent/autosave_v4 boolean true | sudo debconf-set-selections
    echo iptables-persistent iptables-persistent/autosave_v6 boolean false | sudo debconf-set-selections
    # In Ubuntu 18.04 will instalt php7.2
    # php-apcu to cache dotenv file
    apt-get update
    apt-get install -y --force-yes php nginx git vim mysql-server-5.7 composer \
    php7.2-fpm php7.2-xml php-mysql php-apcu \
    iptables-persistent
    # Python to update iptables rules
    sudo apt-get install -y python2.7 python-cheetah ipython
    python update-rules.py
    # sudo cp /vagrant/rules.v4 /etc/iptables/rules.v4
    sudo iptables-restore <  /vagrant/rules.v4
    # Install codeigniter
    cd /vagrant/CodeIgniterProject
    composer install
    # Configure php-fpm
    sudo cp /vagrant/codeigniter.conf /etc/php/7.2/fpm/pool.d/
    sudo rm -f /etc/php/7.2/fpm/pool.d/www.conf
    # Configure Nginx
    sudo cp /vagrant/codeigniter  /etc/nginx/sites-available/
    sudo ln -s /etc/nginx/sites-available/codeigniter /etc/nginx/sites-enabled/
    sudo rm -f /etc/nginx/sites-enabled/default
    sudo systemctl enable php7.2-fpm
    sudo systemctl restart php7.2-fpm
    sudo systemctl restart nginx
    # Configure mysql
    sudo cp /vagrant/mysqld.cnf  /etc/mysql/mysql.conf.d/
    sudo systemctl restart mysql
    # Create database
    sudo mysql -u root < /vagrant/database.sql

   SHELL
end
