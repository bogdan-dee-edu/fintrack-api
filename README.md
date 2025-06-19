#### Start docker compose:
```shell
docker composer up -d
```
---
#### Install Composer dependencies:
```shell
docker exec -it fintrack-php composer install
```
---
#### Create DB schema:
```shell
docker exec -it fintrack-php php bin/doctrine orm:schema-tool:create
```
---
#### Load fixtures:
```shell
docker exec -it fintrack-php php bin/fixtures
```
---
#### Map host `api.fintrack.local` to 127.0.0.1 in your hosts file

---
#### Start frontend:
Frontend documentation is [here](https://github.com/bogdan-dee-edu/fintrack-frontend).

---
#### Enjoy ;)