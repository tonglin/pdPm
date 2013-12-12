#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	tx_aoerealurlpath_overridepath tinytext NOT NULL,
	tx_aoerealurlpath_overridesegment tinytext NOT NULL,
	tx_aoerealurlpath_excludefrommiddle tinyint(3) DEFAULT '0' NOT NULL
);


#
# Table structure for table 'pages_language_overlay'
#
CREATE TABLE pages_language_overlay (
	tx_aoerealurlpath_overridepath tinytext NOT NULL,
	tx_aoerealurlpath_overridesegment tinytext NOT NULL,
	tx_aoerealurlpath_excludefrommiddle tinyint(3) DEFAULT '0' NOT NULL
);



#
# Table structure for table 'tx_aoerealurlpath_cache'
#
CREATE TABLE tx_aoerealurlpath_cache (
	tstamp int(11) DEFAULT '0' NOT NULL,	
	mpvar tinytext NOT NULL,	
	workspace int(11) DEFAULT '0' NOT NULL,
	rootpid int(11) DEFAULT '0' NOT NULL,
	languageid int(11) DEFAULT '0' NOT NULL,	
	pageid int(11) DEFAULT '0' NOT NULL,
	path varchar(255) DEFAULT '' NOT NULL,	
	dirty tinyint(3) DEFAULT '0' NOT NULL
	
	PRIMARY KEY (pageid,workspace,rootpid,languageid),
	KEY path (path)
);

#
# Table structure for table 'tx_aoerealurlpath_cachehistory'
#
CREATE TABLE tx_aoerealurlpath_cachehistory (
	uid int(11) NOT NULL auto_increment,	
	tstamp int(11) DEFAULT '0' NOT NULL,	
	mpvar tinytext NOT NULL,	
	workspace int(11) DEFAULT '0' NOT NULL,
	rootpid int(11) DEFAULT '0' NOT NULL,
	languageid int(11) DEFAULT '0' NOT NULL,	
	pageid int(11) DEFAULT '0' NOT NULL,
	path varchar(255) DEFAULT '' NOT NULL,	
	
	PRIMARY KEY (uid),
	KEY path (path)
);

