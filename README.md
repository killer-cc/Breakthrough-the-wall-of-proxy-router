raspberry pi
==============

安裝 Apache PHP Mariadb Python3
------------------------------
	sudo apt install apache2 php php-mysql mariadb-server mariadb-client python3 -y

設定 MariaDB(自行設定)
------------------------------
	sudo mysql_secure_installation 

安裝 PHPMyAdmin
------------------------------
	sudo apt install phpmyadmin -y

	按下空格選擇 apache2 並 Enter，其他預設

安裝V2RAY
------------------------------
	sudo su -c "bash <(curl -L https://raw.githubusercontent.com/v2fly/fhs-install-v2ray/master/install-release.sh)"

設定 V2RAY
------------------------------
	sudo touch /usr/local/etc/v2ray/config.json.default

	sudo vim /usr/local/etc/v2ray/config.json.default

	(内容查看https://github.com/killer-cc/Breakthrough-the-limit-of-router/tree/main/v2ray-config config.json.default)
	(查看https://www.v2fly.org/config/overview.html設定Outbound)

設定開機啓動python
------------------------------
	sudo vim /etc/rc.local(把啟動命令放到/etc/rc.d/rc.local檔)

	(内容查看https://github.com/killer-cc/Breakthrough-the-limit-of-router/tree/main/v2ray-config 路徑.txt)

	sudo chmod 744 /etc/rc.local

設定自動寄送IP到Email的程式
------------------------------
	vim /home/pi/mail.py

	(内容查看https://github.com/killer-cc/Breakthrough-the-limit-of-router/tree/main/pi-home mail.py) 
	(記得將Google帳號密碼還有接收的Email改成自己的，並將低安全性應用程式存取權開啟(mail.py的8到13行))

設定自動更新Routing規則的程式
------------------------------
	vim /home/pi/updateV2RAY.py

	(内容查看https://github.com/killer-cc/Breakthrough-the-limit-of-router/tree/main/pi-home updateV2RAY.py)

設定資料庫
------------------------------
	sudo mysql

	#進入MariaDB後
		
		create database proxy;
		use proxy;

		#設定專用帳號
		grant all privileges on proxy.* to 'proxy'@'localhost' identified by '[密碼]' with grant option;
		flush privileges;

		#建立table
		create table domains( domain VARCHAR(100) NOT NULL,PRIMARY KEY (domain));
		create table ips( ip VARCHAR(100) NOT NULL,PRIMARY KEY (ip));
		
		#設定完成，退出
		exit

設定網頁
------------------------------
	cd /var/www/html

	#取得權限
	sudo chmod 777 . -R

	將html的內容使用任何SFTP軟體全部放到文件夾中

	#修改sql.php
	vim sql.php
	將$password = 後面改成設定資料庫時的密碼

使用方法
------------------------------
	瀏覽器打開http://[raspberry_pi_IP]
	選擇Domain/IP,輸入並保存
	電腦及手機使用Socks客戶端連接到	[raspberry_pi_IP]:1080
	完成
