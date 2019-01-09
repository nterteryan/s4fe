<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * If you have the error like 'Cannot load from mysql.proc. The table is probably corrupted'
         * go to your cmd and do ->  mysql_upgrade -u root -p 
         * http://relaksblog.ru/viewarticle.php?id=34
         */
        $sql = <<<SQL
            DROP PROCEDURE IF EXISTS search_items_procedure;
            CREATE PROCEDURE search_items_procedure(IN search_data VARCHAR(255), IN firlters VARCHAR(255))
                BEGIN
                        DROP TABLE IF EXISTS `itemsearchtableres`;
                        CREATE TABLE IF NOT EXISTS `itemsearchtableres` AS
                            SELECT 
                              `i`.`id`,
                              `i`.`title`,
                              `i`.`serial_number`,
                              `i`.`description`,
                              `i`.`reward`,
                              `i`.`created_date`,
                              `iph`.`file` AS `photo`,
                              `to`.`id` AS `transfer_ownership_id`,
                              `to`.`email` AS `transfer_ownership_email`,
                              CONCAT(
                                `to`.`first_name`,
                                ' ',
                                `to`.`last_name`
                              ) AS `transfer_ownership_full_name`,
                              `u`.`id` AS `user_id`,
                              `u`.`email` AS `user_email`,
                              CONCAT(
                                `u`.`first_name`,
                                ' ',
                                `u`.`last_name`
                              ) AS `user_full_name`,
                              `ua`.`address1` AS `user_address`,
                              `is`.`id` AS `status_id`,
                              `is`.`name` AS `status`,
                              `c`.`id` AS `category_id`,
                              `c`.`name` AS `category`,
                              `sc`.`id` AS `subcategory_id`,
                              `sc`.`name` AS `subcategory` 
                            FROM
                              `items` `i` 
                              INNER JOIN `users` `u` 
                                ON `i`.`user_id` = `u`.`id` 
                              LEFT OUTER JOIN `user_addresses` AS `ua` 
                                ON `u`.`id` = `ua`.`user_id` 
                              LEFT OUTER JOIN `users` AS `to` 
                                ON `to`.`id` = `i`.`transfer_ownership` 
                              INNER JOIN `item_statuses` `is` 
                                ON `i`.`status_id` = `is`.`id` 
                              INNER JOIN `categories` `sc` 
                                ON `i`.`category_id` = `sc`.`id` 
                              INNER JOIN `categories` `c` 
                                ON `c`.`id` = `sc`.`parent_id`
                            LEFT OUTER JOIN `item_photos` `iph` 
                              ON `iph`.`item_id` = `i`.`id`
                              GROUP BY `i`.`id`;

                        CREATE FULLTEXT INDEX ixItemFull ON `itemsearchtableres` (`title`, `serial_number`, `description`);
                        CREATE FULLTEXT INDEX ixItemFilterFull ON `itemsearchtableres` (`category`, `subcategory`, `status`);

                        SELECT *,MATCH(`title`, `serial_number`, `description`)
                                                  AGAINST (CONCAT('*',search_data,'*') IN NATURAL LANGUAGE MODE) AS coefficient
                                  FROM `itemsearchtableres`
                                                WHERE MATCH(`title`, `serial_number`, `description`)
                                                                AGAINST (CONCAT('*',search_data,'*') IN BOOLEAN MODE)
                                                      AND IF(firlters IS NOT NULL, 
                                                            MATCH(`category`, `subcategory`, `status`)
                                                                AGAINST (CONCAT('*',firlters,'*') IN BOOLEAN MODE)
                                                      , 1)
                                    ORDER BY coefficient DESC;
                        DROP TABLE IF EXISTS `itemsearchtableres`;
                END
SQL;
	DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   public function down()
    {
       $sql = "DROP PROCEDURE IF EXISTS search_items_procedure";
       DB::connection()->getPdo()->exec($sql);
    }
}
