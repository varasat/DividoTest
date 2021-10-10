#Technical test for Andrei Manolache

##Quick notes for setting up this project:
- The project isn't dockerized, I work on windows and for some reason WSL2 was throwing a fit and shutting down sporadically. I'll troubleshoot it in my own time since I wanted to deliver this project in a timely manner.
- Please make sure you have php installed
- Please make sure you have composer installed
- please run composer install to obtain all the packages including PHPUnit
- I simply ran the project with this command : php -S localhost:8000
##Design choices 

- I assumed the required parameters for the config file are : environment, database, cache
- In certain environments like production it's very dangerous if during a config switch certain parameters aren't present(like the DB) so this test application has defaults set for each essential config section (environment/database/cache)
- For writing the config file we used the Decorator pattern. You can see this by observing the Configuration*.php set of classes in /App/Models
- I have broken down each functionality (Read, validate, log, etc) into separate units so they can be individually tested and also respect the Single Responsibility Principle

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

