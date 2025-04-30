## 🚀 Quick Start

1. Create new project using composer

    ```php
    composer create-project siubie/kaido-kit
    ```

2. Composer install

    ```php
    composer install
    ```

3. Npm Install

    ```php
    npm install
    ```

4. Copy .env

    ```php
    cp .env.example .env
    ```

5. Configure your database in .env

    ```php
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=kaido_kit
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Configure your google sign in cliend id and secret (optional)

    ```php
    #google auth
    GOOGLE_CLIENT_ID=
    GOOGLE_CLIENT_SECRET=
    GOOGLE_REDIRECT_URI=http://localhost:8000/admin/oauth/callback/google
    ```

7. Configure your resend for email sending (optional)

    ```php
    #resend
    MAIL_MAILER=resend
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    RESEND_API_KEY=
    MAIL_FROM_ADDRESS="admin@domain.com"
    MAIL_FROM_NAME="${APP_NAME}"
    ```

8. Migrate your database

    ```php
    php artisan migrate --seed
    ```

9. Serve the Application

    ```script
    composer run dev
    ```

11. If run successfully you will get this login interface

    ![image.png](.github/images/login-screen.png)

12. When signed in it will show this (not much yet but it getting there :) )

    ![image.png](.github/images/after-login-without-rbac.png)

13. Next step is to setup the RBAC, first generate the role and permission

    ```php
    php artisan shield:generate --all
    ```

14. It will ask which panel do you want to generate permission/policies for choose the admin panel.
15. Setup the super admin using this command

    ```php
    php artisan shield:super-admin
    ```

    ![image.png](.github/images/provide-superadmin.png)

16. Choose your super admin user and login again.

    ![image.png](.github/images/after-login-rbac.png)


## Security
Set your app Debug to false in .env file
```php
APP_NAME="Kaido-Kit"
APP_ENV=local
APP_KEY=base64:gWUd7RPrCZm6iu7qFddY3039BQLroNHJ0nqKcBr8eeA=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://localhost:8000
```

