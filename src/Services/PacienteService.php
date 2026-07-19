<?php
namespace App\Services;

use App\Entities\Paciente;
use App\Repositories\PacienteRepository;


class PacienteService {
    private $pacienteRepository;

    public function __construct(PacienteRepository $pacienteRepository) {
        $this->pacienteRepository = $pacienteRepository;
    }


public function createPaciente(Array $data) {

    $newPaciente = new Paciente();

    $newPaciente = $this->pacienteRepository->mapRowToEntity($data);
    $newPaciente->setUniqueid(uniqid());


         try {
              return $this->pacienteRepository->create($newPaciente);
              //return (int)$decoded->user_id;
          } catch (\Exception $e) {
            return $e->getMessage();
              //throw new \RuntimeException('Invalid or expired token');
          }




    return $this->pacienteRepository->create($newPaciente);

}

public function UpdatePaciente(Array $data) {

         try {
                $paciente = new Paciente();
                $paciente = $this->pacienteRepository->mapRowToEntity($data);

              return $this->pacienteRepository->update($paciente);
              //return (int)$decoded->user_id;
          } catch (\Exception $e) {
            return $e->getMessage();
              //throw new \RuntimeException('Invalid or expired token');
          }

}

public function ReadAllByIdPersona(int $id) {

        try {
            return $this->pacienteRepository->findAllByIdPersona($id);
              //return (int)$decoded->user_id;
          } catch (\Exception $e) {
            return $e->getMessage();
              //throw new \RuntimeException('Invalid or expired token');
          }

}

public function ReadIdPersona(int $id) {

        try {
            return $this->pacienteRepository->findById($id);
            
              //return (int)$decoded->user_id;
          } catch (\Exception $e) {
            return $e->getMessage();
              //throw new \RuntimeException('Invalid or expired token');
          }

}


public function DeletePaciente(int $data) {

         try {
                
              return $this->pacienteRepository->delete($data);
              //return (int)$decoded->user_id;
          } catch (\Exception $e) {
            return $e->getMessage();
              //throw new \RuntimeException('Invalid or expired token');
          }

}



}