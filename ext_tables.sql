#
# Table structure for table 'tx_certifications_domain_model_user'
#
CREATE TABLE tx_certifications_domain_model_user (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	disable tinyint(4) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,

	first_name varchar(50) DEFAULT '' NOT NULL,
	middle_name varchar(50) DEFAULT '' NOT NULL,
	last_name varchar(50) DEFAULT '' NOT NULL,
	country varchar(40) DEFAULT '' NOT NULL,
	email varchar(80) DEFAULT '' NOT NULL,

	cert_reason varchar(255) DEFAULT '' NOT NULL,
	public_email_address tinyint(1) unsigned DEFAULT '0' NOT NULL,
	certificates int(11) unsigned DEFAULT '0' NOT NULL,
	fe_user int(11) unsigned DEFAULT '0' NOT NULL,
	twitter varchar(255) DEFAULT '' NOT NULL,
	public_twitter tinyint(1) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),

);

#
# Table structure for table 'tx_certifications_domain_model_certificate'
#
CREATE TABLE tx_certifications_domain_model_certificate (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	feusers int(11) unsigned DEFAULT '0' NOT NULL,

	certification_date int(11) DEFAULT '0' NOT NULL,
	expiration_date int(11) DEFAULT '0' NOT NULL,
	allow_listing tinyint(1) unsigned DEFAULT '0' NOT NULL,
	version_four tinyint(1) unsigned DEFAULT '0' NOT NULL,
	certificate_type int(11) unsigned DEFAULT '0',
	user int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_certifications_domain_model_certificatetype'
#
CREATE TABLE tx_certifications_domain_model_certificatetype (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)
);
