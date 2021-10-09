#Technical test for Andrei Manolache

##Quick notes for setting up this project:

- Please make sure you have php installed
- Please make sure you have composer installed
- please run composer install to obtain all the packages including PHPUnit
- I simply ran the project with this command : php -S localhost:8000

##Quick notes about the project itself

- One of the more interesting design patterns that were discussed in the interview with Mr. Nuno Costa was the Decorator pattern so I thought it would be a fun idea trying to implement that into this project. This is both as a learning experience to myself and to show my capacity of picking up new information and using it in a professional context


- No views were used since this was mainly a project design test but I did do a demo page in case any of the tests fail to work when importing the project for whatever reason. 
  To do that I used the FileParsing controller in
  App/Controller. If you guys want a visual representation of the code running
  just go to http://localhost:8000/ after launching the local web server

- I like loggers to just know what's going on and if anything breaks or if
  someone wants to access my page so I also added a logger in the Lib

- To save some time on most projects (coding tests/pure php projects etc)
  I do tend to reuse a project skeleton for the routing and the logging. 

Don't hesitate to contact me at andrei.r.manolache@gmail.com for
further details on this

