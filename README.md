TheAirlineProject_Web
=====================

##The Airline Project web version##

<i>Licensing</i>: GPL V2

<i>Forum</i>: forum.theairlineproject.com
<i>Website</i>: theairlineproject.com (not the web game, yet)

<i>Contact</i>: mike@theairlineproject.com

###Basics###
This is still VERY early in development - it will be a couple months before anything playable is live

Mailing list, TODOS, and roadmap coming soon!

Looking for a project management web app of some sort possibly.

TODO list: docs/tap-web.TODO

Current dir structure:

pages/ - contains PHP helper pages for things like database imports and general use stuff that isn't part of the game (but could be)

scripts/ - contains bash scripts for handling various server tasks

tmp/ - contains any temporary files. these should be primarily info output and not required by any other files

xml/ - contains the xml data for airports, aircraft, and airlines that is imported to the database if you don't want to use the included DB

###Getting Started###

####Joining Us and Contacting Us####
If you want to work specifically on front- or back-end stuffs, the following comes in handy: 

* Knowledge of HTML/CSS, and basic graphic design (Front-End)
* Knowledge of PHP/MySQL and JavaScript (Back-End)
* Knowledge of associated frameworks (jQuery, Angular, CakePHP, etc)

You can reach us by email - mike@theairlineproject.com - and - christian@theairlineproject.com<br />
Skype: mike - md87415<br />
Facebook: http://facebook.com/TheAirline<br />
Twitter: http://twitter.com/pjank42 (The Airline Project) and http://twitter.com/_mikedugan (Mike)<br />
irc.freenode: #TheAirlineProject<br />

####Running the Stuffs####

git clone https://github.com/TheAirlineProject/TheAirlineProject_Web.git<br />
cd TheAirlineProject_Web/pages

mysql -u username -p <br />
CREATE DATABASE tap;<br />
exit;

mysql -p -u username tap < tap-data.sql

grep -rl "root" ./ | xargs sed -i 's/root/yourDBUser/g'<br />
grep -rl "asdf" ./ | xargs sed -i 's/asdf/yourDBPass/g'<br />

You *shouldn't* have to move around the xml stuffs, although you may wish to copy it to httpdocs methinks

cp -R xml ../httpdocs




