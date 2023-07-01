# Required SQL tables are located in /assets
- You can either set up the data manually through DBMs of your choice or you can include them in index.php and it should be set up automatically upon opening the index.php for the first time, uncomment the lines 9-14 in index.php.
- **Note:** database still needs to be set up manually, the code only creates the tables and inserts the data. You might run into some issues with inserting reservations. 
## How to run the project:
- Clone the repo
- Modify the databse connection in /assets/db.php
- Point your server to the root folder of the project, or copy the project to your server's root folder
- Open the index.php in your browser
- **Note:** was tested on XAMPP
  

  
---
# Web Development 2 library database project. 
Simple university project. Library system built with Server side tech and client side tech. This project is using PHP, SQL, HTML &amp; CSS.


# Library functionality- the users should be allowed to: 
- Search for a book 
- Reserve a book 
- View all the books that are reserved
- Login – The user must identify themselves to the system in order to use the system and 
throughout the whole site. If they have not previously used the system, they must register 
their details. 
- Registration - This allows a user to enter their details on the system.
- There is some amount of validation required on the data entered.
  
  
  
### Search for a book: The system should allow the user to search in a number of ways: 
- by book title and/or author (including partial search on both) 
- by book category description in a dropdown menu (book category should retrieved from database) 
-The results of the search should display as a list from which the user can then reserve a book if available. If the book is already reserved, the user should not be allowed to reserve the book.  
  
### Reserve a book – The system should allow a user to reserve a book provided that no-one else has reserved the book yet. The reservation functionality should capture the date on which the reservation was made. 
### View reserved books – the system should allow the user to see a list of the book(s) currently reserved by **that** user. User should be able to remove the reservation as well.
