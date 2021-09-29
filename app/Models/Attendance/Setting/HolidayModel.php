<?php 
    namespace App\Models\Attendance\Setting;

    use CodeIgniter\Model;
    
    class HolidayModel extends Model{
     
        protected $table  = 'master_holiday';
        protected $primaryKey = 'holiday_id';
        protected $useAutoIncrement = true;
        protected $returnType     = 'array';
        protected $allowedFields = [    'holiday_date'
                                        ,'holiday_type'
                                        ,'holiday_name_th'
                                        ,'holiday_name_en'
                                        ,'remark'
                                        ,'active_status'
                                        ,'delete_flag'
                                        ,'create_by'
                                        ,'create_date'
                                        ,'update_by'
                                        ,'update_date'
                                    ];
        protected $useTimestamps = true;
        protected $createdField  = 'create_date';
        protected $updatedField  = 'update_date';

    }

?>