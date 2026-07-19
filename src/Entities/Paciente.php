<?php
declare(strict_types=1);
namespace App\Entities;

class Paciente
{
    public ?int $id = null;
    public string $nombres;
    public ?string $amaterno = null;
    public ?string $apaterno = null;
    public string $fechaNac;
    public string $created;
    public int $sexo = 1;
    public int $estadocivil = 1;
    public ?string $comentarios = null;
    public ?string $apodo = null;
    public ?string $calle = null;
    public int $estado = 14;
    public int $municipio = 73;
    public int $cp = 0;
    public ?string $telefonoCasa = null;
    public ?string $telefonoCelular = null;
    public int $escuela = 0;
    public int $grado = 0;
    public ?string $modified = null;
    public int $religion = 1;
    public ?string $email = null;
    public int $ocupacion = 0;
    public ?string $urgencia = null;
    public ?string $numext = null;
    public ?string $numint = null;
    public int $tiposangre = 1;
    public ?string $imss = null;
    public int $idpersona = 0;
    public bool $notificacion = false;
    public ?string $colonia = null;
    public int $consultorio = 0;
    public ?string $uniqueid = null;
    public int $estado_paciente = 0;

    // --- GETTERS ---

    public function getId(): ?int { return $this->id; }
    public function getNombres(): string { return $this->nombres; }
    public function getAmaterno(): ?string { return $this->amaterno; }
    public function getApaterno(): ?string { return $this->apaterno; }
    public function getFechaNac(): string { return $this->fechaNac; }
    public function getCreated(): string { return $this->created; }
    public function getSexo(): int { return $this->sexo; }
    public function getEstadocivil(): int { return $this->estadocivil; }
    public function getComentarios(): ?string { return $this->comentarios; }
    public function getApodo(): ?string { return $this->apodo; }
    public function getCalle(): ?string { return $this->calle; }
    public function getEstado(): int { return $this->estado; }
    public function getMunicipio(): int { return $this->municipio; }
    public function getCp(): int { return $this->cp; }
    public function getTelefonoCasa(): ?string { return $this->telefonoCasa; }
    public function getTelefonoCelular(): ?string { return $this->telefonoCelular; }
    public function getEscuela(): int { return $this->escuela; }
    public function getGrado(): int { return $this->grado; }
    public function getModified(): ?string { return $this->modified; }
    public function getReligion(): int { return $this->religion; }
    public function getEmail(): ?string { return $this->email; }
    public function getOcupacion(): int { return $this->ocupacion; }
    public function getUrgencia(): ?string { return $this->urgencia; }
    public function getNumext(): ?string { return $this->numext; }
    public function getNumint(): ?string { return $this->numint; }
    public function getTiposangre(): int { return $this->tiposangre; }
    public function getImss(): ?string { return $this->imss; }
    public function getIdpersona(): int { return $this->idpersona; }
    public function getNotificacion(): bool { return $this->notificacion; }
    public function getColonia(): ?string { return $this->colonia; }
    public function getConsultorio(): int { return $this->consultorio; }
    public function getUniqueid(): ?string { return $this->uniqueid; }
    public function getEstado_paciente(): int { return $this->estado_paciente; }

    // --- SETTERS ---

    public function setId(?int $id): void { $this->id = $id; }
    public function setNombres(string $nombres): void { $this->nombres = $nombres; }
    public function setAmaterno(?string $amaterno): void { $this->amaterno = $amaterno; }
    public function setApaterno(?string $apaterno): void { $this->apaterno = $apaterno; }
    public function setFechaNac(string $fechaNac): void { $this->fechaNac = $fechaNac; }
    public function setCreated(string $created): void { $this->created = $created; }
    public function setSexo(int $sexo): void { $this->sexo = $sexo; }
    public function setEstadocivil(int $estadocivil): void { $this->estadocivil = $estadocivil; }
    public function setComentarios(?string $comentarios): void { $this->comentarios = $comentarios; }
    public function setApodo(?string $apodo): void { $this->apodo = $apodo; }
    public function setCalle(?string $calle): void { $this->calle = $calle; }
    public function setEstado(int $estado): void { $this->estado = $estado; }
    public function setMunicipio(int $municipio): void { $this->municipio = $municipio; }
    public function setCp(int $cp): void { $this->cp = $cp; }
    public function setTelefonoCasa(?string $telefonoCasa): void { $this->telefonoCasa = $telefonoCasa; }
    public function setTelefonoCelular(?string $telefonoCelular): void { $this->telefonoCelular = $telefonoCelular; }
    public function setEscuela(int $escuela): void { $this->escuela = $escuela; }
    public function setGrado(int $grado): void { $this->grado = $grado; }
    public function setModified(?string $modified): void { $this->modified = $modified; }
    public function setReligion(int $religion): void { $this->religion = $religion; }
    public function setEmail(?string $email): void { $this->email = $email; }
    public function setOcupacion(int $ocupacion): void { $this->ocupacion = $ocupacion; }
    public function setUrgencia(?string $urgencia): void { $this->urgencia = $urgencia; }
    public function setNumext(?string $numext): void { $this->numext = $numext; }
    public function setNumint(?string $numint): void { $this->numint = $numint; }
    public function setTiposangre(int $tiposangre): void { $this->tiposangre = $tiposangre; }
    public function setImss(?string $imss): void { $this->imss = $imss; }
    public function setIdpersona(int $idpersona): void { $this->idpersona = $idpersona; }
    public function setNotificacion(bool $notificacion): void { $this->notificacion = $notificacion; }
    public function setColonia(?string $colonia): void { $this->colonia = $colonia; }
    public function setConsultorio(int $consultorio): void { $this->consultorio = $consultorio; }
    public function setUniqueid(?string $uniqueid): void { $this->uniqueid = $uniqueid; }
    public function setEstado_paciente(int $estado_paciente): void { $this->estado_paciente = $estado_paciente; }

public function toArray(): array
{
    return [
        'id'              => $this->id,
        'Nombres'         => $this->nombres,
        'Amaterno'        => $this->amaterno,
        'Apaterno'        => $this->apaterno,
        'FechaNac'        => $this->fechaNac,
        'created'         => $this->created,
        'sexo'            => $this->sexo,
        'estadocivil'     => $this->estadocivil,
        'comentarios'     => $this->comentarios,
        'apodo'           => $this->apodo,
        'calle'           => $this->calle,
        'estado'          => $this->estado,
        'municipio'       => $this->municipio,
        'cp'              => $this->cp,
        'telefonoCasa'    => $this->telefonoCasa,
        'telefonoCelular' => $this->telefonoCelular,
        'escuela'         => $this->escuela,
        'grado'           => $this->grado,
        'modified'        => $this->modified,
        'religion'        => $this->religion,
        'email'           => $this->email,
        'ocupacion'       => $this->ocupacion,
        'urgencia'        => $this->urgencia,
        'numext'          => $this->numext,
        'numint'          => $this->numint,
        'tiposangre'      => $this->tiposangre,
        'imss'            => $this->imss,
        'idpersona'       => $this->idpersona,
        'notificacion'    => $this->notificacion,
        'colonia'         => $this->colonia,
        'consultorio'     => $this->consultorio,
        'uniqueid'        => $this->uniqueid,
        'estado_paciente' => $this->estado_paciente,
    ];
}

public static function fromArray(array $row): self
    {
        $u = new self();
        // Map and cast defensively; ignore unknown keys
        if (array_key_exists('id', $row)) $u->setId(self::toNullableInt($row['id']));
        if (array_key_exists('Nombres', $row)) $u->setNombres((string)$row['Nombres']);
        if (array_key_exists('Amaterno', $row)) $u->setAmaterno((string)$row['Amaterno']);
        if (array_key_exists('Apaterno', $row)) $u->setApaterno((string)$row['Apaterno']);
        if (array_key_exists('sexo', $row)) $u->setSexo((int)$row['sexo']);
        if (array_key_exists('estadocivil', $row)) $u->setEstadocivil((int)$row['estadocivil']);
        if (array_key_exists('apodo', $row)) $u->setApodo((string)$row['apodo']);
        if (array_key_exists('calle', $row)) $u->setCalle((string)$row['calle']);
        if (array_key_exists('estado', $row)) $u->setEstado((int)$row['estado']);
        if (array_key_exists('municipio', $row)) $u->setMunicipio((int)$row['municipio']);
        if (array_key_exists('cp', $row)) $u->setCp((int)$row['cp']);
        if (array_key_exists('telefonoCelular', $row)) $u->setTelefonoCelular((string)$row['telefonoCelular']);
        if (array_key_exists('telefonoCasa', $row)) $u->setTelefonoCasa((string)$row['telefonoCasa']);
        if (array_key_exists('escuela', $row)) $u->setEscuela((int)$row['escuela']);
        if (array_key_exists('grado', $row)) $u->setGrado((int)$row['grado']);
        if (array_key_exists('religion', $row)) $u->setReligion((int)$row['religion']);
        if (array_key_exists('email', $row)) $u->setEmail((string)$row['email']);
        if (array_key_exists('ocupacion', $row)) $u->setOcupacion((int)$row['ocupacion']);
        if (array_key_exists('urgencia', $row)) $u->setUrgencia((string)$row['urgencia']);
        if (array_key_exists('numext', $row)) $u->setNumext((string)$row['numext']);
        if (array_key_exists('numint', $row)) $u->setNumint((string)$row['numint']);
        if (array_key_exists('tiposangre', $row)) $u->setTiposangre((int)$row['tiposangre']);
        if (array_key_exists('imss', $row)) $u->setImss((string)$row['imss']);
        if (array_key_exists('idpersona', $row)) $u->setIdpersona((int)$row['idpersona']);
        if (array_key_exists('colonia', $row)) $u->setColonia((string)$row['colonia']);
        if (array_key_exists('consultorio', $row)) $u->setConsultorio((int)$row['consultorio']);
        if (array_key_exists('uniqueid', $row)) $u->setUniqueid((string)$row['uniqueid']);
        if (array_key_exists('uniqueid', $row)) $u->setUniqueid((string)$row['uniqueid']);
        if (array_key_exists('notificacion', $row)) $u->setNotificacion((bool)$row['notificacion']);
        if (array_key_exists('estado_paciente', $row)) $u->setEstado_paciente((int)$row['estado_paciente']);
         
        return $u;
    }


 // Internal casting helpers
    private static function toNullableInt(mixed $v): ?int
    {
        if ($v === null || $v === '') return null;
        return (int)$v;
    }
    private static function toBool(mixed $v): bool
    {
        // Handle ints, strings from PDO for BIT(1) (can be "\x00"/"\x01"), and booleans
        if (is_bool($v)) return $v;
        if (is_int($v)) return $v === 1;
        if (is_string($v)) {
            // Normalize common representations
            if ($v === "\x00" || $v === "\0") return false;
            if ($v === "\x01") return true;
            $lv = strtolower(trim($v));
            if ($lv === '1' || $lv === 'true' || $lv === 't' || $lv === 'yes' || $lv === 'y') return true;
            if ($lv === '0' || $lv === 'false' || $lv === 'f' || $lv === 'no' || $lv === 'n' || $lv === '') return false;
        }
        return (bool)$v;
        }
    private static function toNullableDate(mixed $v): ?\DateTimeInterface
    {
        if ($v === null || $v === '') return null;
        // Accept DateTimeInterface or string
        if ($v instanceof \DateTimeInterface) return $v;
        try {
            // Expecting 'Y-m-d'
            return new \DateTimeImmutable((string)$v);
        } catch (\Exception) {
            return null;
        }
    }
    private static function toNullableDateTime(mixed $v): ?\DateTimeInterface
    {
        if ($v === null || $v === '') return null;
        if ($v instanceof \DateTimeInterface) return $v;
        try {
            // Expecting 'Y-m-d H:i:s'
            return new \DateTimeImmutable((string)$v);
        } catch (\Exception) {
            return null;
        }
    }
    private static function toDateTime(mixed $v): ?\DateTimeInterface
    {
        $dt = self::toNullableDateTime($v);
        return $dt;
    }


}

