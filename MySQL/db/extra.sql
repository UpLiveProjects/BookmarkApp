
ALTER TABLE bookmark_logs
  ADD PRIMARY KEY (id);

ALTER TABLE bookmark_main_table
  ADD PRIMARY KEY (id);

ALTER TABLE bookmark_users
  ADD PRIMARY KEY (id);

ALTER TABLE bookmark_logs
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE bookmark_main_table
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE bookmark_users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
