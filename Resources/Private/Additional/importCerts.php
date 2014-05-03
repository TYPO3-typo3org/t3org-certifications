<?php
/**
 * convert a CSV file of certified users into SQL statements
 */

$fp = fopen("certs.csv", "r");

$userId = 1;
$storagePid=774;

while( !feof($fp) ) {
    $zeile = fgetcsv( $fp  , NULL , ";"  );
	if(count($zeile) < 4) {
		continue;
	}

    $query = sprintf(
        'INSERT INTO tx_certifications_domain_model_user(uid,pid,first_name,last_name,email,public_email_address,country,certificates)'.
        'VALUES(%d, %d, "%s", "%s", "%s", %d, "%s", %d);',
        $userId, //uid
        $storagePid, //pid
	    addslashes(trim($zeile[2])), // last_name
	    addslashes(trim($zeile[1])), // first_name
	    addslashes(trim($zeile[0])), // email
        0, //public_email_address
	    addslashes(trim($zeile[3])), // country
        1 //certificates
    );
	echo $query."\n";


	$certificationDate = date("U",strtotime($zeile[4]));
    $expirationDate = strtotime('+3 years', $certificationDate);
    if ($zeile[6] == 'Version 4.x') {
        $version_four = TRUE;
    } else {
        $version_four = FALSE;
    }

    $query = sprintf(
        'INSERT INTO tx_certifications_domain_model_certificate (pid,user,certification_date,allow_listing,version_four,certificate_type,expiration_date) '.
        'VALUES(%d, %d, %d, %d, %d, %d, %d);',
        $storagePid,        //pid
        $userId,            //user
        $certificationDate, //certification_date
        1,                  //allow_listing
	    (int)$version_four,      // version_four
        1,                  // certificate_type
        $expirationDate     // expiration_date
    );

	echo $query."\n";

	$userId++;
}
echo 'INSERT INTO tx_certifications_domain_model_certificatetype (title) VALUES ("Integrator");';
fclose($fp);
