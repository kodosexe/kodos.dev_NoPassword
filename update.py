import os
from ftplib import FTP

domain = "ftpupload.net"

user = "epiz_25908859"

password = "jTrri9ykubU"

print("Connecting to " + domain + " with user " + user)

ftp = FTP(domain, user, password)
ftp.login

print("Login successful, changing directory to working directory")
ftp.cwd("kodos.dev")
ftp.cwd("htdocs")
ftp.cwd("lamp")

print("Directory found, updating files")

#### START MAIN INDEX ####

local_filename = "/home/kodos/kodos.dev/index.html"
filename = "index.html"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END MAIN INDEX ####

#### START BLOG ####


local_filename = "/home/kodos/kodos.dev/blog.html"
filename = "blog.html"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END BLOG ####

#### START BLOG ####

local_filename = "/home/kodos/kodos.dev/projects.html"
filename = "projects.html"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END BLOG ####
# This only updates the main files at the moment. TODO: Update the rest of the files

# Move to subdomains/lamp

ftp.cwd("subdomains")
ftp.cwd("lamp")

#### START GET COLOR ####
local_filename = "/home/kodos/kodos.dev/subdomains/lamp/getColor.php"
filename = "getColor.php"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END GET COLOR ####

#### START LAMP INDEX ####

local_filename = "/home/kodos/kodos.dev/subdomains/lamp/index.php"
filename = "index.php"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END LAMP INDEX ####

#### START SET COLOR ####

local_filename = "/home/kodos/kodos.dev/subdomains/lamp/setColor.php"
filename = "setColor.php"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END SET COLOR ####

#### START LOGIN PAGE ####

ftp.cwd("login")
local_filename = "/home/kodos/kodos.dev/subdomains/lamp/login/index.html"
filename = "index.html"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END LOGIN PAGE ####

### START LOGIN CSS ####


local_filename = "/home/kodos/kodos.dev/subdomains/lamp/index.php"
filename = "index.php"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

ftp.close()	

print("Done. Stay Classy, San Diego.")
