SALES TAXES
========================

This project is fully container-ized using **Docker**.<br>
However, even if it is not necessary, I strongly recommend to use the container-ized version<br>

### INSTALLING

#### IF YOU WANT TO USE THE DOCKERIZED VERSION


1. Clone this project with the `git clone` command in a directory of your choice
    * If you'll use HTTPS use `git clone https://github.com/TheFe91/sales-taxes.git` to clone the project
    * If you'll use SSH use `git clone git@github.com:TheFe91/sales-taxes.git` to clone the project
2. Open a terminal, navigate to this directory and run `docker-compose build`
3. Once finished run `docker-compose up -d` (***NOTE: your ports 80 and 6033 must be free***)
4. You'll need to connect to the container (you can do this by typing `docker exec -it sales-taxes_app_1 bash`) and then run this command to initialize some necessary data: `composer install && php bin/console doctrine:schema:create && php bin/console set:initial:data && php bin/console cache:clear --env=prod && apachectl restart`
    * Note that the command below will kick you out from the container after the last step will be completed, but this is perfectly fine, as you won't need the shell anymore
    * If prompted, answer `yes` to `The authenticity of host 'github.com' can't be established. Are you sure you want to continue connecting?`)
5. At the end of the installation, Composer will ask you some mandatory parameters. Answer in this way
    * database_host: `db`
    * database_port: `3306`
    * database_name: `SalesTaxes`
    * database_user: `dev_usr`
    * database_password: `dev_passwd`
    * Leave all the other parameters to their default value by hitting `Enter`
6. The application runs on your local machine on port 80, so you can access it by typing `http://localhost` in your browser

#### IF YOU WANT TO JUST USE THE APPLICATION

1. Clone this project with the `git clone` command in your Application Document Directory:
    * If you are on `Windows`, assuming you're using `XAMPP` with default settings it is `C:\XAMPP\htdocs`
    * If you are on `OS X`, assuming you're using `MAMP` with default settings it is `/Applications/MAMP/htdocs`
    * If you'll use HTTPS use `git clone https://github.com/TheFe91/sales-taxes.git SalesTaxes` to clone the project
    * If you'll use SSH use `git clone git@github.com:TheFe91/sales-taxes.git SalesTaxes` to clone the project
2. Open a `bash terminal` (you can use [Git Bash](https://git-scm.com/download/win) on Windows, no further action is required on `OS X`), navigate to the root of the project and then run `composer install && php bin/console doctrine:schema:create && php bin/console set:initial:data && php bin/console cache:clear --env=prod`
3. At the end of the installation, Composer will ask you some mandatory parameters. Answer in this way
    * database_host: `127.0.0.1`
    * database_port: `null`
    * database_name: `SalesTaxes`
    * database_user: `<your_db_username>`
    * database_password: `<your_db_password>`
    * Set all the other parameters to `null` 
4. You can access the application by typing `http://127.0.0.1/SalesTaxes/web/app.php` in your browser

#### HOW TO USE THE APPLICATION

1. You'll be presented a page where you can create products and associate them to a shopping list. Conventionally the categories are 2: *"Books, food and medical products"* and *"Other"*. There's no way to add new categories at this time
2. Fill in the fields and press the green button: you'll se your inserted products showing up in the page DataTable.
3. When you are ready, click *"Generate Receipt"*, choose a Shopping Basket and hit the green button to see the runtime-generated output.
