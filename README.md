# Number 1 A-F

### Installation
1. Clone repo: `https://github.com/rc4dayyan/backendphp.git`<br/>
2. Go to cloned folder, Run `cd backendphp`<br/>
3. Create new database on your mysql<br/>
4. Setup Environment variable file, Run `cp .env.example .env`<br/>
5. Update ".env" file to suit your needs "DB_DATABASE, DB_USERNAME, DB_PASSWORD"<br/>
6. Install Depedency, Run `composer install`<br/>
7. Set Jwt secret, Run `php artisan jwt:secret`<br/>
8. Migrate and Seed, Run `php artisan migrate`<br/>
9. Set APP_KEY, Run `php artisan key:generate`<br/>
10. Run on local dev server, Run `php artisan serve`<br/>
11. Open browser `http://localhost:8000`<br/>

### Usage
1. Login process, <br/>
    - Request URL = http://localhost:8000/api/login<br/>
    - Method = POST<br/>
    - body params = user_name:admin1 and password:admin1<br/>
    - Get "access_token" response<br/>

2. Get Mountly Omzet Per merchant and per day,<br/>
    A. Request URL = http://localhost:8000/api/monthly-omzet<br/>
        - you can add optional params example: `my=2021-11&page=1`<br/>
    B. Method = GET<br/>
    C. Header params: <br/>
        - name = authorization<br/>
        - value = Bearer $access_token<br/>

3. Get Mountly Omzet Per Outlet and per day,<br/>
    A. Request URL = http://localhost:8000/api/monthly-omzet<br/>
        - you can add optional params example: `my=2021-11&page=1`<br/>
    B. Method = GET<br/>
    C. Header params: <br/>
        - name = authorization<br/>
        - value = Bearer $access_token<br/>
