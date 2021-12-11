<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `users` ADD `created_by` BIGINT(11) NOT NULL AFTER `created_at`;");
        DB::statement("ALTER TABLE `users` ADD `updated_by` BIGINT(11) NOT NULL AFTER `updated_at`;");
        DB::statement("insert into Users values (1, 'Admin 1', 'admin1', 'admin1','', now(), 1, now(),1), (2, 'Admin 2', 'admin2', 'admin2','', now(), 2, now(),2);");

        DB::statement("
            CREATE TABLE `Merchants` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `user_id` int(40) NOT NULL,
            `merchant_name` varchar(40) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `created_by` bigint(20) NOT NULL,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_by` bigint(20) NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
        
          DB::statement("insert into Merchants values (1, 1, 'merchant 1', now(), 1, now(),1), (2, 2, 'Merchant 2', now(), 2, now(),2);");
        
        
          DB::statement("
          CREATE TABLE `Outlets` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `merchant_id` bigint(20) NOT NULL,
            `outlet_name` varchar(40) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `created_by` bigint(20) NOT NULL,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_by` bigint(20) NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
          DB::statement("insert into Outlets values (1, 1, 'Outlet 1', now(), 1, now(),1), (2, 2, 'Outlet 1', now(), 2, now(),2), (3, 1, 'Outlet 2', now(), 1, now(),1);");
        
        
          DB::statement("
          CREATE TABLE `Transactions` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `merchant_id` bigint(20) NOT NULL,
            `outlet_id` bigint(20) NOT NULL,
            `bill_total` double NOT NULL,
            `created_at` DATETIME NOT NULL,
            `created_by` bigint(20) NOT NULL,
            `updated_at` DATETIME NOT NULL,
            `updated_by` bigint(20) NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
          DB::statement("insert into Transactions values 
          (1, 1, 1, 2000, '2021-11-01 12:30:04', 1, '2021-11-01 12:30:04',1), 
          (2, 1, 1, 2500, '2021-11-01 17:20:14', 1, '2021-11-01 17:20:14',1),
          (3, 1, 1, 4000, '2021-11-02 12:30:04', 1, '2021-11-02 12:30:04',1),
          (4, 1, 1, 1000, '2021-11-04 12:30:04', 1, '2021-11-04 12:30:04',1),
          (5, 1, 1, 7000, '2021-11-05 16:59:30', 1, '2021-11-05 16:59:30',1),
          (6, 1, 3, 2000, '2021-11-02 18:30:04', 1, '2021-11-02 18:30:04',1), 
          (7, 1, 3, 2500, '2021-11-03 17:20:14', 1, '2021-11-03 17:20:14',1),
          (8, 1, 3, 4000, '2021-11-04 12:30:04', 1, '2021-11-04 12:30:04',1),
          (9, 1, 3, 1000, '2021-11-04 12:31:04', 1, '2021-11-04 12:31:04',1),
          (10, 1, 3, 7000, '2021-11-05 16:59:30', 1, '2021-11-05 16:59:30',1),
          (11, 2, 2, 2000, '2021-11-01 18:30:04', 2, '2021-11-01 18:30:04',2), 
          (12, 2, 2, 2500, '2021-11-02 17:20:14', 2, '2021-11-02 17:20:14',2),
          (13, 2, 2, 4000, '2021-11-03 12:30:04', 2, '2021-11-03 12:30:04',2),
          (14, 2, 2, 1000, '2021-11-04 12:31:04', 2, '2021-11-04 12:31:04',2),
          (15, 2, 2, 7000, '2021-11-05 16:59:30', 2, '2021-11-05 16:59:30',2),
          (16, 2, 2, 2000, '2021-11-05 18:30:04', 2, '2021-11-05 18:30:04',2), 
          (17, 2, 2, 2500, '2021-11-06 17:20:14', 2, '2021-11-06 17:20:14',2),
          (18, 2, 2, 4000, '2021-11-07 12:30:04', 2, '2021-11-07 12:30:04',2),
          (19, 2, 2, 1000, '2021-11-08 12:31:04', 2, '2021-11-08 12:31:04',2),
          (20, 2, 2, 7000, '2021-11-09 16:59:30', 2, '2021-11-09 16:59:30',2),
          (21, 2, 2, 1000, '2021-11-10 12:31:04', 2, '2021-11-10 12:31:04',2),
          (22, 2, 2, 7000, '2021-11-11 16:59:30', 2, '2021-11-11 16:59:30',2);");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
