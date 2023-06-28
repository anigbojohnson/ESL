# Abstract

This project is designed to develop a library system which is meant to replace mainly most of the 
manual activities being carried out by user in Library. The purpose of 
implementing such system is to meet the needs of patrons and librarian for such a system. The 
main objectives of this project are for patron to be able to check-in and checkout books and other 
material from the library on their own, the patron can use the search function to view catalog of 
other affiliated library in other for librarian to make request on their behalf. The patron can also 
make request for books to be reserved for them with this library system. And for librarian, they 
can manage catalog in the library. they can as well register patron with this system and accept 
payment in form of fines from patrons. When the system is being setup it will cause user’s data 
to be more security, it makes check-in and checkout of books to be less tedious and time 
consuming, it give patrons unlimited choices to a greater number of books and finally it reduces 
the need for more librarian thereby saving resources for government. To achieve this, research on 
similar project was carried-out and patrons of this system where given a questionnaire to 
understand their need. 



These outlines the functions which this project provides:
1. Book Check-in, checkout, reserve and renew 
2. Make payment: subscription, overdue book, and lost book
3. Add, update patron, librarian and book catalogue details
4. Update password
5. Patron to view borrowing history
6. Search book available in the system

 GUI for the system
The system is divided into two parts and they are:
1.	Librarian Area
2.	Patron Area

1.	Librarian Area


❖	Login

They are two kind of librarian, the main librarian and other librarian. The main librarian can add librarian but other librarian cannot. The librarian can login through this page by selecting either as main or other librarian. Then they can provide their login id and password number to login to their account. If these details are incorrect the user will be asked to furnish it with correct one.


![image](https://github.com/anigbojohnson/ESL/assets/64017426/824e7958-4a49-4bdf-b785-bddec3050fd9)


1.0 Librarian Login Page

 
❖	Librarian profile

This page as you can see display the details of librarian that just login to the system. when the librarian login he can click the button Due Date to send email to all patrons which have to return books due that day.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/1ea68808-5611-4550-b529-b8d34285f197)

1.1	Profile page for librarian

 
❖	Add patron

The librarian is the one in charge of registering patron, this he does by entering detail of patron in his international passport. But if it is a patron have been deleted from system, the librarian can enter the patron passport number on this page and it will be retrieved from archive to the system.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/60abcdd2-ca66-4894-a505-a8c33f4a7c43)
 
1.2	Add patrons page


❖	View patron

The patron available in the system will be displayed here. Through this page the librarian can search for any patron he/she wants according to the matching criteria. The criteria can be the patron name, passport number, gender, etc.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/1a83e576-be43-48cc-aa1d-feb304f16259)

1.3	view patrons page

 
❖	Update patron

When librarian select update button in the preceding view page figure 4-Error! No text of specified style in document.-1 will be displayed. The librarian can then update any patrons detail the want.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/3fb2657e-e3ca-473a-886d-82f879659bab)

 
1.4	Update Patron page

❖	Add librarian

This page can only be used by main librarian because he only has the privilege to do so. if other librarian tries to add librarian it will fail because he does not have such privileges.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/bfb42c4a-ee32-4b1c-aa38-6025e8a0896a)

1.5	Add librarian page
 

❖	view librarian

The main librarian can view details of every librarian in the system and he can search for them using the search function. He can delete librarian from the system.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/a7000c09-89a0-4696-8235-7eba4b0d8478)
 
1.6	View Librarian Page


❖	Update librarian

From this page the main librarian can update other librarian details.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/6896aff7-320e-4b2b-98cd-5276f667c81d)

 1.7	Update Librarian Page


❖	Add Manage Resources

This page allows librarian to enter book details to book catalogue. The details can be entered in two ways. One, it can be entered by librarian entering those details manually. Secondly, it can be added by entering the ISBN number of the book that have initially been deleted and clicking restore delete button.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/76e7a36d-8786-44ac-a1bf-f8d4d43d10d9)

1.8	Add books resources to catalogue

❖	View Resources:

 Displays all book available in the system. the librarian can access this page through add catalogue page. This page provides search 
 function to search for books that they want.

 ![image](https://github.com/anigbojohnson/ESL/assets/64017426/4ba2eeed-dffb-43a5-a1f0-52b2aa2f20ee)

 1.9	View Catalogue page

 
❖	Update catalogue

![image](https://github.com/anigbojohnson/ESL/assets/64017426/bfd85599-aad2-410e-8be6-1def81a2e824)

1.10	Update Catalogue Page

 
❖	Check in book

For check in of books, librarian can enter patron passport number and ISBN number of the patron and book that want to be returned. This page will display details of book that librarian has just check in once it is successful.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/9cb713b8-37fd-4ab4-9073-c7637c84a052)

1.11	Check in page


❖	Search and login page

This page has search textbox that allow user to search for books of their choice according to books matching criteria. the criteria can be according to title, author, ISSN, ISBN etc. then they can enter book details according to the criteria they selected. This page can be accessed by any person without login. In order to login, the patron must first subscribe and then will enter their international number and password to login to their personal account through this page. For book reservation, the reserve link attached to each book help patron to make reservation.


 
2.	Patron Area

![image](https://github.com/anigbojohnson/ESL/assets/64017426/67271e11-e13b-4a00-9ac8-23ec8b110deb)

1.12	General search book area


❖	Reserve page

When reserve link is clicked (figure 4-Error! No text of specified style in document.-2 ) this page will be displayed (figure 4-Error! No text of specified style in document.-3 ). The patron will enter his password and passport number and the book will be reserved for him pending when he will pick it up.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/2bc8c458-8733-4436-b45a-52ec82cb9cd2)

1.13	Reserve book page


❖	Forgotten password

In this page any user that forgot his password can enter his email and a new password will be generated by the system and sent to his email. This password can be retrieved by patron from his registered email.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/0dc0c84c-c648-420a-aa43-6e6e3010ff44)

1.14	Forgotten password page


❖	Petron Profile

This page display details of the patrons that just login to his account.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/75e72983-e7eb-42f5-9e07-0280465c18e8)

1.15	Patrons profile page

 
❖	Checkout and renew

This page allow user to check out book for themselves and as well renew book that have been checked out. For renew checkout. patron only need to select renew checkbox in order to carry out this function.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/6d5c25c6-4e50-495a-b048-b543760af9a8)

1.16	Patron checkout and renew Checkout page


❖	Update password

The patron can change their password by entering the old password first in figure 4-18 and in figure 4-19 can then enter a new password for it to be updated.
 
![image](https://github.com/anigbojohnson/ESL/assets/64017426/07ae940e-95ca-4562-aa55-d08b3468ec44

1.17	update password page (enter current password)
 
![image](https://github.com/anigbojohnson/ESL/assets/64017426/b18bb758-2f58-443c-a5d0-279970b9142f)

1.18	Update password (New password)

 
❖	Borrowing History

Displays all books that patron have borrowed since he started using the library system.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/51b30ac0-3639-48e5-bffc-65470a43f5fb)

1.19	Borrowing history page

 
❖	Subscription page

When patron select link in his login page. he will be directed to this page where he will be required to pay some money with his credit card. when he selects pay with card button then a form will be displayed where he will pay according to the value of his subscription.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/ff939abc-944f-4fa7-b795-fe7a28eea3ba)

1.20	subscription page

For this project is using stripe company API for testing the credit card page. Therefore, this project will be using card number (4242 4242 4242 4242) , card expiration must be after today’s date and CVV number can be any three digits.
 
![image](https://github.com/anigbojohnson/ESL/assets/64017426/4a174ae7-c313-4108-ab74-22e94449c52f)

1.21	Credit card payment page


When the payment for subscription is successful, the page below will be displayed .

![image](https://github.com/anigbojohnson/ESL/assets/64017426/a1fb22e3-d68c-4307-b837-7a82ee5c9694)

1.22	Successful subscription.

 
❖	Lost Book

This page is where patron pay for lost book. Here patron is required to enter the lost book ISBN and it will display (figure 1.24) details of the lost book. When patron clicks pay with card, figure 1.25 will be displayed for him to enter his payment details.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/ab45a356-b6dc-4040-a59c-19499ee32160)

1.23	Lost book page.
 
 ![image](https://github.com/anigbojohnson/ESL/assets/64017426/6bb0ba07-3991-4534-9b82-bf0ffaa62d0d)

1.24	Lost book detail page

![image](https://github.com/anigbojohnson/ESL/assets/64017426/a5961191-3f21-4409-b5e2-26598c8923fe)

1.25	payment of lost book.

 
❖	Overdue book

Books that are due to be returned are charged on daily basis. the more days books stay patron the more charges it accumulates.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/374f4bf1-a0c6-4b86-a696-d7ecacfad7a4)

1.26	lost book details.

![image](https://github.com/anigbojohnson/ESL/assets/64017426/a27f81fa-9fcf-41e2-9495-9c2f9727ebdf)

1.27	payment details.
 
 
❖	About Us

![image](https://github.com/anigbojohnson/ESL/assets/64017426/65640c91-35fa-439f-98c0-ba161d2abd38)

1.28	About us: Describe history of Enugu state library

