SALES TAXES
========================

This project is fully container-ized using **Docker**.<br>
However, even if it is not necessary, I strongly recommend to use the container-ized version<br>
These are the steps you need to do

1. Clone this project in a directory of your choice
2. Open a terminal and run `docker-compose build`
3. Once finished run `docker-compose up -d` (***NOTE: your ports 80 and 6033 must be free***)
4. The application runs on your local machine on port 80, so you can access it by typing `http://localhost` in your browser
5. You'll be presented a page where you can create products and associate them to a shopping list. Conventionally the categories are 2: *"Books, food and medical products"* and *"Other"*. There's no way to add new categories at this time
6. Fill in the fields and press the green button: you'll se your inserted products showing up in the page DataTable.
7. When you are ready, click *"Generate Receipt"*, choose a Shopping Basket and hit the green button to see the runtime-generated output.

