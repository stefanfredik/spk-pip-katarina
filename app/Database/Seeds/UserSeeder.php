<?php

namespace App\Database\Seeds;

use App\Models\Users;
use CodeIgniter\Database\Seeder;
use Myth\Auth\Password;

class UserSeeder extends Seeder {
    public function run() {
        $this->userModel = new Users();


        $this->db->query("insert into auth_groups (name,description) values ('operator','Operator')");
        // $this->db->query("insert into auth_groups (name,description) values ('kepala-lurah','Kepala Lurah')");
        // $this->db->query("insert into auth_groups (name,description) values ('pendamping-pkh','Pendamping PKH')");

        $data = [
            'nama_user' => "Operator",
            'username' => "operator",
            'password_hash' => Password::hash("12345678"),
            'active'    => "1"
        ];

        $this->userModel->withGroup("operator")->save($data);
    }
}
