<?php

echo "<br>Please wait......... Formating database";


$db = new PDO('sqlite:chs/protected/data/chs.db');
	
//****** DROPPING UNUSED TABLES *********

$result = $db->query('DROP TABLE IF EXISTS ftp_settings');
$result = $db->query('DROP TABLE IF EXISTS livecall_setup');
$result = $db->query('DROP TABLE IF EXISTS preferences');
$result = $db->query('DROP TABLE IF EXISTS config');
$result = $db->query('DROP TABLE IF EXISTS spares_used_status');


//********** CREATE CONTRACT TABLE **********
/*
$contractSql = 'CREATE TABLE "contract" ("id" INTEGER PRIMARY KEY  NOT NULL ,"contract_type_id" INTEGER,"name" TEXT,"main_contact_details_id" INTEGER,"vat_reg_number" TEXT,"notes" TEXT,"active" INTEGER,"inactivated_by_user_id" INTEGER,"inactivated_on" DATETIME,"created_by_user_id" INTEGER,"created" DATETIME,"modified" DATETIME,"management_contact_details" TEXT,"spares_contact_details" TEXT,"accounts_contact_details" TEXT,"technical_contact_details" TEXT,"short_name" TEXT,"labour_warranty_months_duration" INTEGER,"parts_warranty_months_duration" INTEGER);';
$contractInsert = "INSERT INTO contract (id,contract_type_id,name,main_contact_details_id,vat_reg_number,notes,active,inactivated_by_user_id,inactivated_on,created_by_user_id,created,modified,management_contact_details,spares_contact_details,accounts_contact_details,technical_contact_details,short_name,labour_warranty_months_duration,parts_warranty_months_duration) VALUES ('1000000','1000000','Unknown Contract','1000000','','','1','','','1','1350473939','','Same as main contact','Same as main contact','Same as main contact','Same as main contact','UnknownContract','','');";
$result = $db->query('DROP TABLE IF EXISTS contract');
$result = $db->query($contractSql);
$result = $db->query($contractInsert);
*/

//********** CREATE CONTRACT TYPE TABLE **********
/*
$contractTypeSql = 'CREATE TABLE "contract_type" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , name TEXT , information TEXT, created_by_user_id INTEGER  , created DATETIME  , CONSTRAINT FK_contract_type_user FOREIGN KEY (created_by_user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE RESTRICT );';
$contractTypeInsert = "INSERT INTO contract_type (id,name,information,created_by_user_id,created) VALUES ('1000000','Unknown','N/A','1','1353405391');";
$result = $db->query('DROP TABLE IF EXISTS contract_type');
$result = $db->query($contractTypeSql);
$result = $db->query($contractTypeInsert);
*/

//********** CREATE CONTACT DETAILS TABLE **********

$contactSql = 'CREATE TABLE "contact_details" ( id INTEGER PRIMARY KEY NOT NULL , address_line_1 TEXT , address_line_2 TEXT, address_line_3 TEXT, town TEXT , postcode_s TEXT, postcode_e TEXT , postcode TEXT , county TEXT, state TEXT, country TEXT, latitudes TEXT, longitudes TEXT, mobile TEXT, telephone TEXT , fax TEXT, email TEXT , website TEXT, created DATETIME , lockcode INTEGER );';
$contactInsert = "INSERT INTO contact_details (id,address_line_1,address_line_2,address_line_3,town,postcode_s,postcode_e,postcode,county,state,country,latitudes,longitudes,mobile,telephone,fax,email,website,created,lockcode) VALUES ('1000000','N/A','N/A','','N/A','N/A','N/A','N/A N/A','','','','','','N/A','N/A','','N/A','','1366114663','0');";
$result = $db->query('DROP TABLE IF EXISTS contact_details');
$result = $db->query($contactSql);
$result = $db->query($contactInsert);

//************** CREATE ENGINEER TABLE **************

$engineerSql = 'CREATE TABLE "engineer" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , first_name TEXT, last_name TEXT , active INTEGER  , company TEXT, vat_reg_number TEXT, notes TEXT, inactivated_by_user_id INTEGER, inactivated_on DATETIME, contact_details_id INTEGER , delivery_contact_details_id INTEGER, created_by_user_id INTEGER  , created DATETIME  , modified DATETIME, fullname TEXT, CONSTRAINT FK_engineer_user FOREIGN KEY (inactivated_by_user_id ) REFERENCES user(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_engineer_user FOREIGN KEY (created_by_user_id ) REFERENCES user(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_engineer_contact_details FOREIGN KEY (contact_details_id ) REFERENCES contact_details(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_engineer_contact_details FOREIGN KEY (delivery_contact_details_id ) REFERENCES contact_details(id) ON DELETE CASCADE ON UPDATE RESTRICT );';
$engineerInsert = "INSERT INTO engineer (id,first_name,last_name,active,company,vat_reg_number,notes,inactivated_by_user_id,inactivated_on,contact_details_id,delivery_contact_details_id,created_by_user_id,created,modified,fullname) VALUES ('90000000','N/A','N/A','0','N/A','N/A','N/A','','','1000000','1000000','2','1366114663','','N/A');";
$result = $db->query('DROP TABLE IF EXISTS engineer');
$result = $db->query($engineerSql);
$result = $db->query($engineerInsert);



//************ CREATE CUSTOMER TABLE ********

$customerSql = 'CREATE TABLE IF NOT EXISTS "customer" ( "id" INTEGER PRIMARY KEY NOT NULL , "product_id" INTEGER , "title" TEXT , "first_name" TEXT  , "last_name" TEXT , "fullname" TEXT, "address_line_1" TEXT , "address_line_2" TEXT, "address_line_3" TEXT, "town" TEXT , "postcode_s" TEXT , "postcode_e" TEXT , "postcode" TEXT , "county" TEXT, "state" TEXT, "country" TEXT, "latitudes" TEXT, "longitudes" TEXT, "telephone" TEXT , "mobile" TEXT, "fax" TEXT, "email" TEXT , "notes" TEXT, "created_by_user_id" INTEGER , "created" DATETIME , "modified" DATETIME, "lockcode" INTEGER );';
$result = $db->query('DROP TABLE IF EXISTS customer');
$result = $db->query($customerSql);


//************ CREATE ENGGDIARY TABLE ********

$enggdiarySql = 'CREATE TABLE "enggdiary" ("id" INTEGER PRIMARY KEY NOT NULL ,"engineer_id" INTEGER ,"visit_start_date" DATETIME ,"visit_end_date" DATETIME,"slots" INTEGER,"servicecall_id" INTEGER,"user_id" INTEGER ,"created" DATETIME  ,"modified" DATETIME,"status" INTEGER, "notes" TEXT);';
$result = $db->query('DROP TABLE IF EXISTS enggdiary');
$result = $db->query($enggdiarySql);


//************ CREATE NOTIFICATION RULES TABLE ********

$rulesSql = 'CREATE TABLE "notification_rules" ("id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , "job_status_id" INTEGER, "active" BLOB, "customer_notification_code" INTEGER, "engineer_notification_code" INTEGER, "warranty_provider_notification_code" INTEGER, "notify_others" BLOB, "created" DATETIME, "modified" DATETIME, "delete" DATETIME, CONSTRAINT FK_notification_rules_notification_code FOREIGN KEY (customer_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_notification_rules_notification_code FOREIGN KEY (engineer_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_notification_rules_notification_code FOREIGN KEY (warranty_provider_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_notification_rules_job_status FOREIGN KEY (job_status_id) REFERENCES job_status (id) ON DELETE CASCADE ON UPDATE RESTRICT );';
$result = $db->query('DROP TABLE IF EXISTS notification_rules');
$result = $db->query($rulesSql);


//************ CREATE NOTIFICATION CONTACT TABLE ********

$rulesContactSql = 'CREATE TABLE "notification_contact" ("id" INTEGER PRIMARY KEY  NOT NULL ,"notification_rule_id" INTEGER,"person_name" TEXT,"person_info" TEXT,"email" TEXT,"mobile" TEXT,"notification_code_id" INTEGER,"created" DATETIME,"modified" DATETIME,"deleted" DATETIME);';
$result = $db->query('DROP TABLE IF EXISTS notification_contact');
$result = $db->query($rulesContactSql);


//************ CREATE PRODUCT TABLE ********

$productSql = 'CREATE TABLE "product" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , contract_id INTEGER , brand_id INTEGER , product_type_id INTEGER , customer_id INTEGER , engineer_id INTEGER, purchased_from TEXT, purchase_date DATETIME, warranty_date DATETIME, model_number TEXT, serial_number TEXT, production_code TEXT, enr_number TEXT, fnr_number TEXT, discontinued INTEGER, warranty_for_months INTEGER, purchase_price FLOAT, notes TEXT, created_by_user_id INTEGER, created DATETIME , modified DATETIME, cancelled DATETIME, lockcode INTEGER, CONSTRAINT FK_product_user FOREIGN KEY (created_by_user_id ) REFERENCES user(id) ON DELETE CASCADE ON UPDATE RESTRICT , CONSTRAINT FK_product_contract FOREIGN KEY (contract_id ) REFERENCES contract(id) ON DELETE CASCADE ON UPDATE RESTRICT , CONSTRAINT FK_product_brand FOREIGN KEY (brand_id ) REFERENCES brand(id) ON DELETE CASCADE ON UPDATE RESTRICT , CONSTRAINT FK_product_product_type FOREIGN KEY (product_type_id ) REFERENCES product_type(id) ON DELETE CASCADE ON UPDATE RESTRICT , CONSTRAINT FK_product_customer FOREIGN KEY (customer_id ) REFERENCES customer(id) ON DELETE CASCADE ON UPDATE RESTRICT , CONSTRAINT FK_product_engineer FOREIGN KEY (engineer_id ) REFERENCES engineer(id) ON DELETE CASCADE ON UPDATE RESTRICT );';
$result = $db->query('DROP TABLE IF EXISTS product');
$result = $db->query($productSql);


//************* CREATE  SPARES USED TABLE *******************

$spresSql = 'CREATE TABLE "spares_used" ("id" INTEGER PRIMARY KEY NOT NULL ,"master_item_id" INTEGER ,"servicecall_id" INTEGER ,"item_name" TEXT,"part_number" TEXT,"unit_price" FLOAT,"quantity" INTEGER ,"total_price" FLOAT,"date_ordered" DATETIME,"created" DATETIME ,"modified" DATETIME,"created_by_user" INTEGER );';
$result = $db->query('DROP TABLE IF EXISTS spares_used');
$result = $db->query($spresSql);


//************ CREATE SERVICECALL TABLE ********

$serviceSql = 'CREATE TABLE "servicecall" ("id" INTEGER PRIMARY KEY  NOT NULL ,"service_reference_number" INTEGER,"customer_id" INTEGER,"product_id" INTEGER,"contract_id" INTEGER,"engineer_id" INTEGER,"insurer_reference_number" TEXT,"job_status_id" INTEGER,"fault_date" DATETIME,"fault_code" TEXT,"fault_description" TEXT,"engg_diary_id" INTEGER,"work_carried_out" TEXT,"spares_used_status_id" INTEGER DEFAULT (NULL) ,"total_cost" FLOAT,"vat_on_total" FLOAT,"net_cost" FLOAT,"job_payment_date" DATETIME,"job_finished_date" DATETIME,"notes" TEXT,"created_by_user_id" INTEGER,"created" DATETIME,"modified" DATETIME,"cancelled" DATETIME,"closed" DATETIME,"number_of_visits" INTEGER DEFAULT (0) ,"activity_log" TEXT,"comments" TEXT,"recalled_job" INTEGER);';
$result = $db->query('DROP TABLE IF EXISTS servicecall');
$result = $db->query($serviceSql);

























?>