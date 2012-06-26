require 'yaml'

@config_path   = ".ksdeploy.yaml"

if File.exist? @config_path
	@config = YAML.load_file @config_path
else
	puts "generating config skeleton at #{@config_path}"
	config = File.open @config_path, "w"
	config << "git_user:\n"  
	config << "private_key:"
	config.close
	puts "done"
	exit
end

@server        = "feynman.korovasoft.com"
@user          = "deploy"
@deploy_path   = "/var/www/"
@deploy_target = "tssaa"
@git_fork      = ENV["fork"] || @config["git_user"] || "Korovasoft"
@git_branch    = ENV["branch"] || "dev"
@git_repo      = "git@github.com:#{@git_fork}/tssaa.git"
@private_key   = @config["private_key"] || "~/.ssh/id_rsa"

def ssh(message, command)
  sshified_command = "ssh -i #{@private_key} -l #{@user} #{@server} 'cd #{@deploy_path} && #{command}'"
  puts "#{message}: #{command}"
  puts `#{sshified_command}`
end

desc "deploy the latest from GitHub"
task :deploy => [:wipe,:clone] do
end

task :clone do
  ssh("Cloning the git repo","git clone -b #{@git_branch} #{@git_repo}")
end

task :wipe do
  ssh("Wiping the old repo","rm -Rf #{@deploy_target}")
end

task :default => [:deploy] do 
end
