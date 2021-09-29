<?php 
    namespace App\Models\Attendance\Setting;

    use CodeIgniter\Model;
    
    class MasterTimeModel extends Model{
     
        protected $table  = 'master_time';
        protected $primaryKey = 'time_id';
        protected $useAutoIncrement = true;
        // protected $returnType     = 'array';
        protected $allowedFields = [     'time_name_th'
                                        ,'time_name_en'
                                        ,'time_nameshort_th'
                                        ,'time_nameshort_en'
                                        ,'employee_type'
                                        ,'time_holiday'
                                        ,'time_center'
                                        ,'time_day'
                                        ,'time_open'
                                        ,'time_late'
                                        ,'time_in'
                                        ,'time_out'
                                        ,'time_out'
                                        ,'time_lunch_in'
                                        ,'time_lunch_out'
                                        ,'time_work_day'
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