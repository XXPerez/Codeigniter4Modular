<?php
namespace App\Database\Migrations;

class UpdateUsers1 extends \CodeIgniter\Database\Migration {

    public function up() {
        $this->db->query("ALTER TABLE xusers ADD COLUMN `useralias` VARCHAR(50) NULL DEFAULT '' AFTER `email`");
    }

    public function down() {
    }

}
