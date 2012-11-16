CakePHP Google API Plugin sample
================================

1.  Install [CakePHP Google API Plugin sample](https://github.com/LubosRemplik/CakePHP-Google-API-Plugin-sample)

	```bash
	git clone --recursive https://github.com/LubosRemplik/CakePHP-Google-API-Plugin-sample.git google-sample-app
	```

2.  Create database & run bake, schema scripts

	```bash
	# basic cakephp installation
	cd google-sample-app/app
	chmod -R 777 tmp
	Console/cake bake db_config

	# schema
	Console/cake schema create -p Opauth
	```

3.  Configure - set google's credentials  
	Copy bootstrap.php.default to bootstrap.php and add your client_id, client_secret. 
	You can get these details at https://code.google.com/apis/console/

	```bash
	cp Config/bootstrap.php.default Config/bootstrap.php
	vim Config/bootstrap.php
	```

**Note** You have to configure [Opauth](https://github.com/LubosRemplik/cakephp-opauth) correctly
