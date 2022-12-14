# Required SQL tables are located in /assets
- You can either set up the data manually through DBMs of your choice or you can include them in index.php and they should be set up automatically upon opening the index.php for the first time e.g. 
``        <?php
        require_once 'db.php';
        include '\assets\crete_books_table.php';
        include '\assets\create_category_table.php';
        include '\assets\create_users_table.php';
        include '\assets\reservations_table.php';
        include '\assets\sample_data.php';
        ?>
``





# Library_Project
Simple university project. Library system built with Server side tech and client side tech. This project is using PHP, SQL, HTML &amp; CSS.

## Web Development 2 library database project. 

# Library functionality- the users should be allowed to: 
· Search for a book 
· Reserve a book 
· View all the books that they have reserved 
# Login – The user must identify themselves to the system in order to use the system and 
throughout the whole site. If they have not previously used the system, they must register 
their details. 
# Registration - This allows a user to enter their details on the system. The registration 
process should validate that all details are entered. Mobile phone numbers should be 
numeric and 10 characters in length. Password should be six characters and have a 
password confirmation function. The system should ensure that each user can be 
identified using a unique username. 
# Search for a book: The system should allow the user to search in a number of ways: 
o by book title and/or author (including partial search on both) 
o by book category description in a dropdown menu (book category should 
retrieved from database) 
# The results of the search should display as a list from which the user can then reserve a 
book if available. If the book is already reserved, the user should not be allowed to 
reserve the book. 
# Reserve a book – The system should allow a user to reserve a book provided that no-one 
else has reserved the book yet. The reservation functionality should capture the date on 
which the reservation was made. 
# View reserved books – the system should allow the user to see a list of the book(s) 
currently reserved by that user. User should be able to remove the reservation as well. 
Notes: 
Apart from HTML, you should try to use other client side technologies like cascading style 
sheets to make pages neat and tidy. All validation should be server-side. 
Do not allow for more than 5 rows of data per page, where search results are being displayed. 
Include functionality to display lists across more than one page. 
The screens should be neat, simple design and usable.
