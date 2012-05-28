@server        = "feynman.korovasoft.com"
@user          = "deploy"
@deploy_path   = "/var/www/"
@deploy_target = "tssaa"
@git_fork      = ENV["fork"] || "Korovasoft"
@git_branch    = ENV["branch"] || "dev"
@git_repo      = "git@github.com:#{@git_fork}/tssaa.git"

def ssh(message, command)
  sshified_command = "ssh -l #{@user} #{@server} cd #{@deploy_path}; #{command}"
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
