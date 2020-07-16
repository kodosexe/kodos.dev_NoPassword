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

print("Directory found, updating files")

#### START MAIN INDEX ####

local_filename = "/home/kodos/kodos.dev/*"
filename = "*"
	
print("Updating file " + filename + " at " + local_filename)
	
lf = open(local_filename, "rb")
ftp.storbinary("STOR " + filename, lf)

lf.close

#### END MAIN INDEX ####



ftp.close()	

print("Done. Stay Classy, San Diego.")
