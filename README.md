
Go to folder
```bash
cd Einzelwerk
```
Create file "token" in the root of directory and put your DaData-token into it.

Rename .env  
```bash
make env
``` 

Build 
```bladehtml
make build
```

Start application:
```bash
make up
```


After 3-5 minutes. Migrating both DBs and seeding them.
```bash
make db
```

Testing (after previous about 3 min)
```bash
make test
```

Endpoints:
```bladehtml
REST API
GET
localhost:8001/api/contragents
POST
localhost:8001/api/contragents

Swagger
http://localhost:8001/api/documentation

Webpage to test-register and get token for Swagger auth-methods
http://localhost:8001/
```


