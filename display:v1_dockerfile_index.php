root@kic:~/misc/display# cat Dockerfile 
#Base Image
FROM	centos:7
# Meta Data 
RUN	yum -y install --setopt='tsflags=nodocs' httpd epel-release yum-utils http://rpms.remirepo.net/enterprise/remi-release-7.rpm && \
	yum-config-manager --enable remi-php71 && \
	yum -y install --setopt='tsflags=nodocs' php php-mysqli php-mcrypt php-cli php-gd php-curl php-mysql php-fileinfo && \
    	yum clean all 
 
#Listen on below port
EXPOSE 80
COPY 	index.php /var/www/html/

# Always execute entry point
ENTRYPOINT	["/usr/sbin/httpd"]

# Run process in foregroud as a parameter
CMD		["-DFOREGROUND"] 
root@kic:~/misc/display# cat index.php 
<!DOCKTYPE html>
<html>
<body>
<h1>CONTAINER</h1>
<h2 style="color:blue;">
<?php
echo "HOSTNAME";
echo "</br>";
echo gethostname();
echo "</br>";  
echo "</br>";
echo "IP-ADDRESS";
echo "</br>";
echo $_SERVER["REMOTE_ADDR"];
?> 
</h2>
</body>
</html>


FOR IP ONLY use index.php with only below contents:
echo gethostname();
