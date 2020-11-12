
DROP TABLE /*!32200 IF EXISTS*/ tmp_up_categories;
CREATE TABLE /*!32300 IF NOT EXISTS*/ tmp_up_categories (
  ID int(11) NOT NULL auto_increment,
  PID int(11) NOT NULL DEFAULT '0' ,
  name varchar(255) NOT NULL DEFAULT '' ,
  confirmed tinyint(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (ID),
  INDEX confirmed (confirmed)
);

DROP TABLE IF EXISTS tmp_up_comments;
CREATE TABLE IF NOT EXISTS tmp_up_comments (
  ID int(11) NOT NULL auto_increment,
  item int(11) NOT NULL default '0',
  user_id int(11) NOT NULL default '0',
  author varchar(255) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  hide_email enum('Y','N') NOT NULL default 'N',
  title varchar(255) NOT NULL default '',
  text text NOT NULL,
  created date NOT NULL default '0000-00-00',
  confirmed tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (ID),
  KEY category (item),
  KEY created (created)
) TYPE=MyISAM;

DROP TABLE /*!32200 IF EXISTS*/ tmp_up_sysvars;
CREATE TABLE /*!32300 IF NOT EXISTS*/ tmp_up_sysvars (
  id int(10) NOT NULL auto_increment,
  vname varchar(50) NOT NULL DEFAULT '' ,
  vvalue text NOT NULL DEFAULT '' ,
  PRIMARY KEY (id)
);


INSERT INTO tmp_up_sysvars VALUES("8","smtp_username","");
INSERT INTO tmp_up_sysvars VALUES("2","siteTheme","Default");
INSERT INTO tmp_up_sysvars VALUES("7","smtp_auth","N");
INSERT INTO tmp_up_sysvars VALUES("6","smtp_host","smtp");
INSERT INTO tmp_up_sysvars VALUES("9","smtp_password","");
INSERT INTO tmp_up_sysvars VALUES("10","site_title","Inspirations");
INSERT INTO tmp_up_sysvars VALUES("11","mailer_type","mail");
INSERT INTO tmp_up_sysvars VALUES("12","terms_of_service","Please remember that we are not responsible for any messages posted. We do not vouch for or warrant the accuracy, completeness or usefulness of any message, and are not responsible for the contents of any message. The messages express the views of the author of the message, not necessarily the views of system administrator(s). Any user who feels that a posted message is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable messages and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary. You agree, through your use of this service, that you will not use this service to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person\'s privacy, or otherwise violative of any law. You agree not to post any copyrighted material unless the copyright is owned by you or by this site, or you have the express written permission of the copyright owner to post the information on this site.");
INSERT INTO tmp_up_sysvars VALUES("13","category_display","DHTML Tree");
INSERT INTO tmp_up_sysvars VALUES("14","allow_picture_uploads","Y");
INSERT INTO tmp_up_sysvars VALUES("15","max_picture_size","200");
INSERT INTO tmp_up_sysvars VALUES("16","max_picture_width","200");
INSERT INTO tmp_up_sysvars VALUES("17","max_picture_height","400");
INSERT INTO tmp_up_sysvars VALUES("18","hide_user_emails","N");
INSERT INTO tmp_up_sysvars VALUES("19","allow_member_counter","Y");
INSERT INTO tmp_up_sysvars VALUES("20","enable_member_mail_notify","Y");
INSERT INTO tmp_up_sysvars VALUES("21","admin_notify","Y");
INSERT INTO tmp_up_sysvars VALUES("22","items_per_page","5");
INSERT INTO tmp_up_sysvars VALUES("23","site_footer","<br>This is a \"global site footer\" which can be set in the configuration file, which you receive upon script purchase. It\'s a good place to put contact information, or a link to another site or homepage. For example: <a href=http://www.tufat.com>Return to Home</a><br><br><br>");
INSERT INTO tmp_up_sysvars VALUES("24","date_format","M jS, Y");
INSERT INTO tmp_up_sysvars VALUES (25, 'auto_approve', 'N');
INSERT INTO tmp_up_sysvars VALUES (26, 'allow_edit', 'Y');
INSERT INTO tmp_up_sysvars VALUES (27, 'comments_per_page', '7');
INSERT INTO tmp_up_sysvars VALUES (28, 'allow_comments', 'Y');
