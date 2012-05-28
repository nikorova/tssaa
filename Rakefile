@server      = "feynman.korovasoft.com"
@user        = "deploy"
@deploy_path = "/var/www/tssaa"
@git_fork    = ENV["fork"] || "Korovasoft"
@git_branch  = ENV["branch"] || "master"
@git_repo    = "git@github.com:#{@git_fork}/tssaa.git"

def ssh(command)
  puts "ssh -l #{@user} #{@server} cd #{@deploy_path}; #{command}"
  puts `ssh -l #{@user} #{@server} cd #{@deploy_path}; #{command}`
end

desc "deploy the latest from GitHub"
task :deploy => [:pull] do
end

desc "setup #{@deploy_path} on #{@server}"
task :setup => [:clone] do
end

task :clone do
  ssh("git clone -b #{@git_branch} #{@git_repo}")
end

task :pull do
  ssh("git pull origin #{@git_branch}")
end
