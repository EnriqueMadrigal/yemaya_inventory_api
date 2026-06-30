<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Entities\User;

class UserService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /*
    public function createTask($data) {
        if (empty($data['title']) || strtotime($data['due_date']) < time()) {
            throw new \Exception('Invalid task title or due date');
        }
        return $this->taskRepository->create($data);
    }
    */
    public function createUser($data) {

        $username = $data['username'];

        //Check if user exists

        $curUser = $this->userRepository->findByEmail($username);
        if ($curUser <> null) {
            return 0;
        }


        $newUser = new User();
        $newUser->setEmail($data['username']);
        $newUser->setFirstName($data['fname']);
        $newUser->setLastName($data['lastname']);
        $newUser->setPassword(password_hash($data['password'], PASSWORD_DEFAULT));

        $newUser->setPhoneNumber("");
        $newUser->setVerificationCode("");
        $newUser->setIsActive(1);
        $newUser->setIsBlocked(0);
        $newUser->setIsReported(0);
        $newUser->setLoginType(1);
        $newUser->setUserType(1);
        $newUser->setStatus(1);
        $newUser->setSuscriptionId(0);



    return $this->userRepository->insert($newUser);
    }


    public function getById($id) : User{

     $curUser = $this->userRepository->findById($id);
     $curUser->setPassword("");
     return $curUser;

    }

    

    
}