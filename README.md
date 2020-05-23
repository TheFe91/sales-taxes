SALES TAXES
========================

This project is fully container-ized using **Docker**.<br>
However, even if it is not necessary, I strongly recommend to use the container-ized version<br>
These are the steps you need to do

1. Clone this project in a directory of your choice
2. Open a terminal, navigate to this directory and run `docker-compose build`
3. Once finished run `docker-compose up -d` (***NOTE: your ports 80 and 6033 must be free***)
4. You'll need to connect to the container (you can do this by typing `docker exec -it sales-taxes_app_1 bash`) and then run this command to initialize some necessary data: `composer install && php bin/console doctrine:schema:create && php bin/console set:initial:data && php bin/console cache:clear --env=prod && apachectl restart`
    * Note that the command below will kick you out from the container after the last step will be completed, but this is perfectly fine, as you won't need the shell anymore
    * If prompted, answer `yes` to `The authenticity of host 'github.com' can't be established. Are you sure you want to continue connecting?`)
5. At the end of the installation, Composer will ask you some mandatory parameters. Answer in this way
    * database_host: db
    * database_port: 3306
    * database_name: SalesTaxes
    * database_user: dev_usr
    * database_password: dev_passwd
    * Set all the other parameters to `null` 
6. The application runs on your local machine on port 80, so you can access it by typing `http://localhost` in your browser
7. You'll be presented a page where you can create products and associate them to a shopping list. Conventionally the categories are 2: *"Books, food and medical products"* and *"Other"*. There's no way to add new categories at this time
8. Fill in the fields and press the green button: you'll se your inserted products showing up in the page DataTable.
9. When you are ready, click *"Generate Receipt"*, choose a Shopping Basket and hit the green button to see the runtime-generated output.
