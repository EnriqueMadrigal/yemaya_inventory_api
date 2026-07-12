<?php
namespace App\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Repositories\UserRepository;

class AuthService {
      private $userRepository;

 public function __construct(UserRepository $userRepository) {
          $this->userRepository = $userRepository;
      }

      public function login(string $email, string $password): array {
          $user = $this->userRepository->findByEmail($email);
          if (!$user || !password_verify($password, $user->getPassword())) {
              throw new \RuntimeException('Invalid email or password');
          }


            $this->userRepository->updateLastLogin($user->getId());

          $payload = [
              'iat' => time(),
              'exp' => time() + (int)$_ENV['JWT_EXPIRY'],
              'user_id' => $user->getId(),
              'username' => $user->getUsername()
          ];



          $token = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
          return [
              'token' => $token,
              'user_id' => $user->getId(),
              'email' => $user->getEmail(),
              'user_type' => $user->getUserType()
          ];
      }

      public function validateToken(string $token): array {
          try {
              $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
              return (array)$decoded;
          } catch (\Exception $e) {
              throw new \RuntimeException('Invalid or expired token');
          }
      }

    public function getUuserId(string $token): int {
        $curUserId = 0;

         try {
              $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
              return (int)$decoded->user_id;
          } catch (\Exception $e) {
              throw new \RuntimeException('Invalid or expired token');
          }




        return $curUserId;
    }



}

