# Server Setup

## Mac OS
### 1. Install Nginx

``` bash
brew update            
brew install nginx
```
The formula drops files under $HOMEBREW_PREFIX and sets up sensible defaults:

```brew --prefix``` will output $HOMEBREW_PREFIX
- <b>Doc-root:</b> ```$HOMEBREW_PREFIX/var/www```
- <b>Config:</b> ```$HOMEBREW_PREFIX/etc/nginx/nginx.conf``` (listens on 8080 so you don’t need sudo)
- Extra vhosts live in ```$HOMEBREW_PREFIX/etc/nginx/servers/```

### 2.  Start, stop, and auto-launch

```bash
# start and have it launch on login
brew services start nginx      

# stop
brew services stop nginx       

# restart after config edits
brew services restart nginx    

# check status
brew services list | grep nginx
```

Open http://localhost:8080 — you should see the “Welcome to nginx” page

### 3. Basic configuration

1. <b> Serve on port 80</b><br/>
Edit```nginx.conf``` → change the ```listen 8080;``` line to ```listen 80;``` then ```brew services restart nginx```

2. <b> Point to your project folder</b><br/>
    ```bash
    server {
        listen 80;
        server_name localhost;
        root /Users/<you>/Sites;
        index index.html index.htm;
    }
    ```
### 4. Managing logs & reloads
| Task | Command |
| --- | --- |
| Tail access log | ```tail -f $HOMEBREW_PREFIX/var/log/nginx/access.log``` |   
| Tail error log | ```tail -f $HOMEBREW_PREFIX/var/log/nginx/error.log``` |
| Hot-reload after config change | ```nginx -s reload``` |

### 5. Quick checklist
- ```brew services start nginx``` is green
- ```curl -I localhost:8080``` returns 200 OK
- Config test passes: ```nginx -t```


<!-- npm run dev
npx graphql-codegen --watch --config codegen.ts -->