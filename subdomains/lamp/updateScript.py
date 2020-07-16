import os
from ftplib import FTP

domain = "REDACTED"

user = "REDACTED"

password = "REDACTED"

print("Connecting to " + domain + " with user " + user)

ftp = FTP(domain, user, password)
ftp.login

print("Login successful, changing directory to working directory")
ftp.cwd("kodos.dev")
ftp.cwd("htdocs")


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

# Move to lamp

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


local_filename = "/home/kodos/kodos.dev/subdomains/lamp/login/main.css"
filename = "main.css"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END LOGIN CSS ####

#### START LOGIN VALIDATION ####

local_filename = "/home/kodos/kodos.dev/subdomains/lamp/login/validateLogin.php"
filename = "validateLogin.php"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END LOGIN VALIDATION
ftp.cwd("..")
ftp.cwd("signup")
#### START SIGNUP PAGE

local_filename = "/home/kodos/kodos.dev/subdomains/lamp/signup/index.html"
filename = "index.html"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END SIGNUP PAGE ####

#### START SIGNUP CSS ####

local_filename = "/home/kodos/kodos.dev/subdomains/lamp/signup/main.css"
filename = "main.css"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END SIGNUP CSS ####

#### START SUGNUP PHP ####

local_filename = "/home/kodos/kodos.dev/subdomains/lamp/signup/signup.php"
filename = "signup.php"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END SIGNUP PHP ####

ftp.cwd("..")
ftp.cwd("account")

#### START ACCOUNT ####

local_filename = "/home/kodos/kodos.dev/subdomains/lamp/account/index.php"
filename = "index.php"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END ACCOUNT ####

ftp.close()	

print("Done. Stay Classy, San Diego.")
