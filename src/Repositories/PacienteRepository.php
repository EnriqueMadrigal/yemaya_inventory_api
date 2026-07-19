<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Entities\Paciente;

class PacienteRepository extends BaseRepository
{
    private string $table = 'pacientes';

    //public function __construct(PDO $db)
    //{
    //    $this->db = $db;
    //}

    /**
     * Guarda un nuevo paciente en la base de datos
     */
    public function create(Paciente $paciente): int
    {
        $sql = "INSERT INTO pacientes (
                    Nombres, Amaterno, Apaterno, FechaNac, created, sexo, estadocivil, 
                    comentarios, apodo, calle, estado, municipio, cp, telefonoCasa, 
                    telefonoCelular, escuela, grado, modified, religion, email, 
                    ocupacion, urgencia, numext, numint, tiposangre, imss, 
                    idpersona, notificacion, colonia, consultorio, uniqueid,estado_paciente
                ) VALUES (
                    :nombres, :amaterno, :apaterno, :fechaNac, NOW(), :sexo, :estadocivil, 
                    :comentarios, :apodo, :calle, :estado, :municipio, :cp, :telefonoCasa, 
                    :telefonoCelular, :escuela, :grado, NULL, :religion, :email, 
                    :ocupacion, :urgencia, :numext, :numint, :tiposangre, :imss, 
                    :idpersona, :notificacion, :colonia, :consultorio, :uniqueid, :estado_paciente
                )";

        $stmt = $this->pdo->prepare($sql);
        
        $result = $stmt->execute([
            ':nombres'         => $paciente->getNombres(),
            ':amaterno'        => $paciente->getAmaterno(),
            ':apaterno'        => $paciente->getApaterno(),
            ':fechaNac'        => $paciente->getFechaNac(),
            ':sexo'            => $paciente->getSexo(),
            ':estadocivil'     => $paciente->getEstadocivil(),
            ':comentarios'     => $paciente->getComentarios(),
            ':apodo'           => $paciente->getApodo(),
            ':calle'           => $paciente->getCalle(),
            ':estado'          => $paciente->getEstado(),
            ':municipio'       => $paciente->getMunicipio(),
            ':cp'              => $paciente->getCp(),
            ':telefonoCasa'    => $paciente->getTelefonoCasa(),
            ':telefonoCelular' => $paciente->getTelefonoCelular(),
            ':escuela'         => $paciente->getEscuela(),
            ':grado'           => $paciente->getGrado(),
            ':religion'        => $paciente->getReligion(),
            ':email'           => $paciente->getEmail(),
            ':ocupacion'       => $paciente->getOcupacion(),
            ':urgencia'        => $paciente->getUrgencia(),
            ':numext'          => $paciente->getNumext(),
            ':numint'          => $paciente->getNumint(),
            ':tiposangre'      => $paciente->getTiposangre(),
            ':imss'            => $paciente->getImss(),
            ':idpersona'       => $paciente->getIdpersona(),
            ':notificacion'    => (int)$paciente->getNotificacion(),
            ':colonia'         => $paciente->getColonia(),
            ':consultorio'     => $paciente->getConsultorio(),
            ':uniqueid'        => $paciente->getUniqueid(),
            ':estado_paciente'     => $paciente->getEstado_paciente(),
            
        ]);

        if ($result) {
            $paciente->setId((int)$this->pdo->lastInsertId());
        }

        //return $result;
        return $paciente->getId();
    }

    /**
     * Busca un paciente por su ID
     */
    public function findById(int $id): ?Paciente
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pacientes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (!$row) return null;
        return $this->mapRowToEntity($row);
    }

    /**
     * Obtiene todos los pacientes
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM pacientes");
        $pacientes = [];
        
        while ($row = $stmt->fetch()) {
            $pacientes[] = $this->mapRowToEntity($row);
        }

        return $pacientes;
    }

/**
     * Busca un paciente por su ID
     */
    public function findAllByIdPersona(int $id): array
    {
        //$stmt = $this->pdo->prepare("SELECT * FROM pacientes WHERE idPersona = ?");
        //$stmt->execute([$id]);
        $stmt = $this->pdo->query("SELECT * FROM pacientes where idPersona=".$id);
        $pacientes = [];
        
        while ($row = $stmt->fetch()) {
           
            $pacientes[] = Paciente::fromArray($row);
        }
       
        return $pacientes;
    }



    /**
     * Actualiza un paciente existente
     */
    public function update(Paciente $paciente): bool
    {
        $sql = "UPDATE pacientes SET 
                    Nombres = :nombres, Amaterno = :amaterno, Apaterno = :apaterno, 
                    FechaNac = :fechaNac, sexo = :sexo, estadocivil = :estadocivil, 
                    comentarios = :comentarios, apodo = :apodo, calle = :calle, 
                    estado = :estado, municipio = :municipio, cp = :cp, 
                    telefonoCasa = :telefonoCasa, telefonoCelular = :telefonoCelular, 
                    escuela = :escuela, grado = :grado, modified = NOW(), 
                    religion = :religion, email = :email, ocupacion = :ocupacion, 
                    urgencia = :urgencia, numext = :numext, numint = :numint, 
                    tiposangre = :tiposangre, imss = :imss, idpersona = :idpersona, 
                    notificacion = :notificacion, colonia = :colonia, 
                    consultorio = :consultorio, uniqueid = :uniqueid, estado_paciente = :estado_paciente
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            ':id'              => $paciente->getId(),
            ':nombres'         => $paciente->getNombres(),
            ':amaterno'        => $paciente->getAmaterno(),
            ':apaterno'        => $paciente->getApaterno(),
            ':fechaNac'        => $paciente->getFechaNac(),
            ':sexo'            => $paciente->getSexo(),
            ':estadocivil'     => $paciente->getEstadocivil(),
            ':comentarios'     => $paciente->getComentarios(),
            ':apodo'           => $paciente->getApodo(),
            ':calle'           => $paciente->getCalle(),
            ':estado'          => $paciente->getEstado(),
            ':municipio'       => $paciente->getMunicipio(),
            ':cp'              => $paciente->getCp(),
            ':telefonoCasa'    => $paciente->getTelefonoCasa(),
            ':telefonoCelular' => $paciente->getTelefonoCelular(),
            ':escuela'         => $paciente->getEscuela(),
            ':grado'           => $paciente->getGrado(),
            ':religion'        => $paciente->getReligion(),
            ':email'           => $paciente->getEmail(),
            ':ocupacion'       => $paciente->getOcupacion(),
            ':urgencia'        => $paciente->getUrgencia(),
            ':numext'          => $paciente->getNumext(),
            ':numint'          => $paciente->getNumint(),
            ':tiposangre'      => $paciente->getTiposangre(),
            ':imss'            => $paciente->getImss(),
            ':idpersona'       => $paciente->getIdpersona(),
            ':notificacion'    => (int)$paciente->getNotificacion(),
            ':colonia'         => $paciente->getColonia(),
            ':consultorio'     => $paciente->getConsultorio(),
            ':uniqueid'        => $paciente->getUniqueid(),
            ':estado_paciente' => $paciente->getEstado_paciente(),
        ]);
    }

    /**
     * Elimina un paciente por ID
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM pacientes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Mapea un array de la DB a la Entidad Paciente
     */
    public function mapRowToEntity(array $row): Paciente
    {
        $paciente = new Paciente();
        $paciente->setId((int)$row['id']);
        $paciente->setNombres($row['Nombres']);
        $paciente->setAmaterno($row['Amaterno']);
        $paciente->setApaterno($row['Apaterno']);
        $paciente->setFechaNac($row['FechaNac']);
        $paciente->setCreated($row['created']);
        $paciente->setSexo((int)$row['sexo']);
        $paciente->setEstadocivil((int)$row['estadocivil']);
        $paciente->setComentarios($row['comentarios']);
        $paciente->setApodo($row['apodo']);
        $paciente->setCalle($row['calle']);
        $paciente->setEstado((int)$row['estado']);
        $paciente->setMunicipio((int)$row['municipio']);
        $paciente->setCp((int)$row['cp']);
        $paciente->setTelefonoCasa($row['telefonoCasa']);
        $paciente->setTelefonoCelular($row['telefonoCelular']);
        $paciente->setEscuela((int)$row['escuela']);
        $paciente->setGrado((int)$row['grado']);
        $paciente->setModified($row['modified']);
        $paciente->setReligion((int)$row['religion']);
        $paciente->setEmail($row['email']);
        $paciente->setOcupacion((int)$row['ocupacion']);
        $paciente->setUrgencia($row['urgencia']);
        $paciente->setNumext($row['numext']);
        $paciente->setNumint($row['numint']);
        $paciente->setTiposangre((int)$row['tiposangre']);
        $paciente->setImss($row['imss']);
        $paciente->setIdpersona((int)$row['idpersona']);
        $paciente->setNotificacion((bool)$row['notificacion']);
        $paciente->setColonia($row['colonia']);
        $paciente->setConsultorio((int)$row['consultorio']);
        $paciente->setUniqueid($row['uniqueid']);
        $paciente->setEstado_paciente((int)$row['estado_paciente']);
  
        return $paciente;
    }
}
