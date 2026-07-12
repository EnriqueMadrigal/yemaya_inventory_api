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


}