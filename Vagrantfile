Vagrant.configure("2") do |config|

	class AnsibleVaultPassword
		def to_s
			begin
				system 'stty -echo'
				print "Enter ansible vault password: "
				pass = STDIN.gets.chomp
				ensure
				system 'stty echo'
			end
			pass
		end
	end

	config.vm.box = "codekandis/debian-buster64"
	config.vm.box_version = "~>1.0"
	config.vm.box_url = "https://vagrant.codekandis.net/codekandis/debian-buster64.json"
	config.vm.box_download_insecure = true
	config.vm.box_check_update = false

	config.vm.define "codekandis-session"
	config.vm.provider "virtualbox" do |provider|
		provider.name = "codekandis-session"
	end

	config.vm.network "private_network", ip: "192.168.42.44"

	config.vm.synced_folder ".", "/vagrant", type: "nfs"

	config.vm.provision "Requesting the ansible vault password", type: "shell" do |provisioner|
		provisioner.env = { "ansibleVaultPassword" => AnsibleVaultPassword.new }
		provisioner.inline = <<-END
			[[ ! -d "/mnt/ansible-tmp" ]] \
			&& mkdir "/mnt/ansible-tmp"
			mountpoint -q "/mnt/ansible-tmp" \
			|| mount -t tmpfs -o size=512 ansible-tmp "/mnt/ansible-tmp"
			/vagrant/env/ansible/scripts/vault-password.sh --save "${ansibleVaultPassword}"
		END
	end

	config.vm.provision "Provisioning the VM `codekandis-session` with the tasks `ansible`", type: "ansible_local" do |provisioner|
		provisioner.compatibility_mode = "2.0"
		provisioner.playbook = "/vagrant/env/ansible/ansible.yml"
		provisioner.raw_arguments = [ "--vault-id /vagrant/env/ansible/scripts/vault-password.sh" ]
		provisioner.inventory_path = "/vagrant/env/ansible/inv/integration/hosts"
		provisioner.limit = "localhost"
	end

	config.vm.provision "Provisioning the VM `codekandis-session` with the tasks `environment`", type: "ansible_local" do |provisioner|
		provisioner.compatibility_mode = "2.0"
		provisioner.playbook = "/vagrant/env/ansible/environment.yml"
		provisioner.raw_arguments = [ "--vault-id /vagrant/env/ansible/scripts/vault-password.sh" ]
		provisioner.inventory_path = "/vagrant/env/ansible/inv/integration/hosts"
		provisioner.limit = "localhost"
	end

	config.vm.provision "Deleting the ansible vault password", type: "shell" do |provisioner|
		provisioner.inline = <<-END
			/vagrant/env/ansible/scripts/vault-password.sh --delete
			mountpoint -q "/mnt/ansible-tmp" \
			&& umount "/mnt/ansible-tmp"
			[[ -d "/mnt/ansible-tmp" ]] \
			&& rm -r "/mnt/ansible-tmp"
		END
	end

end
