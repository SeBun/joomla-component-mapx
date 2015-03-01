ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `id` `id` INT(11) UNSIGNED NOT NULL;
ALTER TABLE `#__xmap_sitemap` ADD COLUMN `asset_id` INT(11) UNSIGNED NOT NULL
AFTER `id`;
ALTER TABLE `#__xmap_sitemap` DROP COLUMN `metadesc`;
ALTER TABLE `#__xmap_sitemap` DROP COLUMN `metakey`;
ALTER TABLE `#__xmap_sitemap` DROP COLUMN `is_default`;
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `attribs` `params` TEXT;
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `state` `published` TINYINT(1);
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `created` `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__xmap_sitemap` ADD COLUMN `created_by` INT(11) UNSIGNED NOT NULL DEFAULT '0'
AFTER `created`;
ALTER TABLE `#__xmap_sitemap` ADD COLUMN `modified` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
AFTER `created_by`;
ALTER TABLE `#__xmap_sitemap` ADD COLUMN `modified_by` INT(11) UNSIGNED NOT NULL DEFAULT '0'
AFTER `modified`;
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `count_xml` `count_xml` INT(11) UNSIGNED NOT NULL  DEFAULT '0';
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `count_html` `count_html` INT(11) UNSIGNED NOT NULL  DEFAULT '0';
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `views_xml` `views_xml` INT(11) UNSIGNED NOT NULL  DEFAULT '0';
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `views_html` `views_html` INT(11) UNSIGNED NOT NULL  DEFAULT '0';
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `lastvisit_xml` `lastvisit_xml` INT(11) UNSIGNED;
ALTER TABLE `#__xmap_sitemap` CHANGE COLUMN `lastvisit_html` `lastvisit_html` INT(11) UNSIGNED;
ALTER TABLE `#__xmap_sitemap` ADD INDEX `idx_access` (`access`);
ALTER TABLE `#__xmap_sitemap` ADD INDEX `idx_state` (`published`);