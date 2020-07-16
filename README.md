# kodos.dev
## Important
This is a copy of the main kodos.dev repository, which is private. This version has all database and FTP passwords removed to ensure the security of the system.
The last update to this repository is from Thursday, July 16, 2020. Updates will not occur automatically.

## What this is
~~These are the files for kodos.dev. You shouldn't see this. Theres passwords in the php's. Don't look.~~
^ That doesn't apply here. Still, if you find some please let me know.

If you see this, you are likely reviewing this as part of a Job application by me and I shared this repository with you. Hello!

## Quick info about my education
I'm German and went to German schools from preschool all the way to 8th grade. I started my High School education in 9th grade in Pittsburgh, Pennsylvania, where I recieved excellent STEM education.
Notable STEM courses I enrolled in included
* Honors Introduction to Computer Programming (Visual Basic, 2 Semesters)
* Web Design (2 Semesters)
* AP Computer Science (College-Level Course, completed AP test with a score of 4, full year)
* Robotics (2 Semesters)

I have also completed several projects similar to this that I used to refine and expand my knowledge. As of now, they are a lot more poorly documented. Here are some links:
(WebcamFaceDetect)[https://github.com/kodosexe/WebcamFaceDetect]
(Raspi-Face-Aim)[https://github.com/kodosexe/raspi-face-aim]
(ArduinoVexRobotControl)[https://github.com/kodosexe/ArduinoVexRobotControl]

I am currently working on a website for a local Pittsburgh restaurant,  pabellonpgh.com. Completion of the website is dependant on the delivery date of new menus.
I am also in talks with the owner to develop a mobile app for the restaurant in the future.

## TODO
* Make PHP SQL Requests more secure (prepare statements) - note: this is not at production state yet and existing accounts are closely monitored to ensure no illegitimate accounts are created.
* Make Main Page Color selection more stylish and fix the alignment
* Add functionality for more than one device per account... we'll see how to do that
* Comment more sections

## Technical Notes
I use infinityfree.com for free webhosting of the website. SQL databases and hosting are included.
All files are written from scratch, no site like Squarespace or Wix has been used. As of now, the PHP is **insecure**. Please excuse this for now. This page is not yet ready for production and will be fixed before deployment.
This page is meant to be used in conjuncture with a kodos Smart Lamp. A history lesson of these lamps can be found below.

## How to Use
To make changes, simply update any files in the folders and execute update.sh to upload them to their respective places on the FTP server. Note that /subdomains currently lead to kodos.dev/[subdomain], as the free SSH protocol can't include subdomains. The end goal is to host the lamp application on lamp.kodos.dev.

Note: This won't work in the example repo.

## Sitemap
* kodos.dev / www.kodos.dev
  * blog
  * resume
  * projects
  * snake
  * lamp
    * login
    * account
    * getColor.php
    * setColor.php

The lamp files are where you want to look. This is where I have been spending most of my time to produce a website that's usable for testing purposes-

## History of kodos
Kodos is a fictional chracter from Star Trek - The original series. While being an interesting character, it's also a cool name so I went for it.
I built my first smart lamp in 2019 for my girlfriend. A wooden box housed a Raspberry Pi 3B and an Adafruit Trinket M0, and a bluetooth bulb that could be screwed on top. The bulb was manufactured by MagicLight and cost abou 35USD on Amazon. It screws into a regular socket and runs on 110-220V. A makeshift extension cable ran into the back and provided power to the Pi and the Bulb. The +5V of the Pi powered the Trinket. In the front, 3 potentiometers allowed a fine tuning of the red, green and blue values. Alternatively, the Pi ran a local webserver using Flask that privided an interface to change the color over WIFI. The Pi then updated the bulb via bluetooth.

Version 2.0 of the lamp had a 3D printed case with a Battery, charger and Arduino Nano 33 IOT. The initial plan was to have it get the color from the V1 Lamp's server to display the color. I designed the case using Autodesk Inventor to provide a base for a picture crystal to illuminate it from the bottom. I changed the Idea to make it more available for production, as it could be a potentially valuable business. I connected the V2 to the Internet and started kodos.dev. V1 works, but currently has an issue fitting all components in the case. V2.1 will fix that, as well as it will provide a PCB for a smaller footprint. I will design that as well.

## Contact
~~If you have illegitimate access to these files, please contact me immediately at info@kodos.dev. Thank you~~
