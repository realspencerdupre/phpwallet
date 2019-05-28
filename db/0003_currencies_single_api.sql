ALTER TABLE currencies DROP COLUMN balance_url;
ALTER TABLE currencies DROP COLUMN balance_jsonpath;
ALTER TABLE currencies ADD balance_api varchar(256);
