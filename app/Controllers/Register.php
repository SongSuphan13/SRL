<?php 
    namespace App\Controllers;

    use CodeIgniter\Controller;
    use App\Models\UserModel;
    
    class Register extends Controller{
     
        public function index(){
            helper(['form', 'url']);
            return view('/signup');
        }
        public function signup(){
            helper(['form', 'url']);
            $rules = [
                        'username' =>'required|min_length[5]|max_length[20]',
                        'useremail' =>'required|min_length[6]|max_length[50]|valid_email',
                        'userpassword' => 'required|min_length[5]|max_length[50]',
                        'confirmpassword' => 'matches[userpassword]',
                    ];
            $messages = [
                "username" => [
                    "required" => "กรุณาระบุ username",
                    "min_length" => "ต้องมีความยาวอย่างน้อย 5 อักขระ",
                    "max_length" => "ต้องมีความยาวไม่เกิน 20 อักขระ",
                ],
                "useremail" => [
                    "required" => "กรุณาระบุ Email",
                    "valid_email" => "กรุณาระบุ Email ให้ถูกต้อง",
                ],
                "userpassword" => [
                    "required" => "กรุณาระบุรหัสผ่าน",
                    "min_length" => "ต้องมีความยาวอย่างน้อย 5 อักขระ",
                    "max_length" => "ต้องมีความยาวไม่เกิน 50 อักขระ",
                ],
                "confirmpassword" => [
                    "matches" => "กรุณาระบุรหัสผ่านให้ตรงกัน"
                ],
            ];

            if($this->validate($rules, $messages)) {
                $user = new UserModel();
                $data = array(
                            'user_name' => $this->request->getVar('username'),
                            'user_password' => password_hash($this->request->getVar('userpassword'),PASSWORD_DEFAULT),
                            'user_email' => $this->request->getVar('useremail'),
                );
                $user->save($data);
                return redirect()->to('/signin');
            }else{
                
                $data['validation'] = $this->validator;
                return view('/signup', $data);
            }
        }
    }

?>