# config valid only for Capistrano 3.1
lock '3.2.1'
#lock '3.3.5'

set :application, 'alm'
set :repo_url, 'ssh://edward@45.55.238.212:8022/home/edward/alm.git'
#set :repo_url, 'ssh://edward@45.55.238.212/home/edward/alm.git'

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app
set :deploy_to, '/home/edward/alm'
set :keep_releases, 4

# Default value for :scm is :git
 set :scm, :git
 #set :user, "edward"

# Default value for :format is :pretty
 set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

# Default value for :pty is false
# set :pty, false

#set :use_sudo, false

#set :sudo, "sudo su -u edward -i"

# Default value for :linked_files is []
# set :linked_files, %w{config/database.yml}

# Default value for linked_dirs is []
# set :linked_dirs, %w{bin log tmp/pids tmp/cache tmp/sockets vendor/bundle public/system}

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5

task :query_interactive do
  on 'edward@45.55.238.212:8022' do
    info capture("[[ $- == *i* ]] && echo 'Interactive' || echo 'Not interactive'")
  end
end
task :query_login do
  on 'edward@45.55.238.212:8022' do
    info capture("shopt -q login_shell && echo 'Login shell' || echo 'Not login shell'")
  end
end

task :sudo_test do
  on 'edward@45.55.238.212:8022' do
    info capture("whoami; sudo su - edward")
  end
end

namespace :deploy do

=begin
  desc "Resymlink"
  task :resymlink do
    on roles(:app), in: :sequence, wait: 5 do
      run "rm -f #{current_path} && ln -s #{release_path} #{current_path}"
      run "rm /home/edward/alm/current/Common.php"
      run "ln -s /home/edward/alm/shared/Common.php /home/edward/alm/current/Common.php"
      run "ln -s /home/edward/alm/shared/licenses/ /home/edward/alm/current/assets/licenses"
      run "ln -s /home/edward/alm/shared/vendor/ /home/edward/alm/current/vendor"
    end
  end

=end
  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :touch, release_path.join('tmp/restart.txt')
      #After deployment deletes development db configuration file
      execute "rm /home/edward/alm/current/Common.php"
      #Symlink to the share db configuration files, this is needed because db params are different on dev and prod
      execute "ln -s /home/edward/alm/shared/Common.php /home/edward/alm/current/Common.php"
      #Symlink to the shared licenses folder outside of the capistrano deployment because it overwrites it and this dir holds production data
      execute "ln -s /home/edward/alm/shared/licenses/ /home/edward/alm/current/assets/licenses"
      #Symlink the vendor folder to the shared environment, if updated with composer, the folder must be regenerated and then moved to the shared folder
      execute "ln -s /home/edward/alm/shared/vendor/ /home/edward/alm/current/vendor"
    end
  end

  after :publishing, :restart

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end

end
