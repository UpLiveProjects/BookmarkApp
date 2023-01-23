
CREATE TABLE bookmark_logs (
  id int(11) NOT NULL,
  time_stamp datetime NOT NULL,
  user_name text NOT NULL,
  task text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
