<?php 
    namespace App\Models;

    use CodeIgniter\Model;
    
    class UserModel extends Model{
        protected $table  = 'user_main';
        protected $primaryKey = 'user_id';
        protected $allowedFields = ['user_name','user_password','user_email'];
        
    }
?>