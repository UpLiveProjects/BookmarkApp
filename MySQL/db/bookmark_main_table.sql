
CREATE TABLE bookmark_main_table (
  id int(11) NOT NULL,
  user_name text NOT NULL,
  entry_time datetime NOT NULL,
  tab text NOT NULL,
  category text NOT NULL,
  category_display text NOT NULL DEFAULT 'on',
  category_style text DEFAULT NULL,
  bookmark_headline text DEFAULT NULL,
  bookmark_url text DEFAULT NULL,
  bookmark_meta text DEFAULT NULL,
  bookmark_notes text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
