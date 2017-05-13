CREATE TABLE IF NOT EXISTS `10040908_kylastajad` (
   `id`       INT(11) NOT NULL auto_increment PRIMARY KEY,
   `username` VARCHAR(100) NOT NULL,
   `passw`    VARCHAR(40) NOT NULL,
   `visits`   INT(11) NOT NULL
   );

INSERT INTO `10040908_kylastajad` (
	`id`
	,`username`
	,`passw`
	,`visits`
	)
VALUES (
	NULL
	,'eliiv2'
	,Sha2('asd', 512)
	,'1'
	);

SELECT *
FROM 10040908_kylastajad;

Rows: 3
id 	username 	passw 	visits
1 	   eliiv 	   asd 	   0
2 	   eliiv 	   asd 	   1
3 	   eliiv2 	   e54ee7e285fbb0275279143abc4c554e5314e7b4... 	1
