<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peserta extends Migration
{
    public function up()
    {
        $data = [
            'id' => [
                'type'  => 'INT',
                'auto_increment'    => TRUE
            ],
            'id_siswa' => [
                'type'  => 'INT',
            ],
            'tahun' => [
                'type'  => 'INT',
            ],
            'validasi' => [
                'type'  => 'ENUM',
                'constraint' => ['Valid', 'Tidak Valid', 'Belum Validasi'],
                'default' => 'Belum Validasi'
            ]
        ];

        $this->forge->addField($data);
        $this->forge->addKey('id', true);
        $this->forge->createTable('peserta');
    }

    public function down()
    {
        $this->forge->dropTable('peserta');
    }
}
