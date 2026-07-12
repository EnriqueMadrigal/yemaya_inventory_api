<?php
declare(strict_types=1);
namespace App\Entities;

class Paciente
{
    private ?int $id = null;
    private string $nombres;
    private ?string $amaterno = null;
    private ?string $apaterno = null;
    private string $fechaNac;
    private string $created;
    private int $sexo = 1;
    private int $estadocivil = 1;
    private ?string $comentarios = null;
    private ?string $apodo = null;
    private ?string $calle = null;
    private int $estado = 14;
    private int $municipio = 73;
    private int $cp = 0;
    private ?string $telefonoCasa = null;
    private ?string $telefonoCelular = null;
    private int $escuela = 0;
    private int $grado = 0;
    private ?string $modified = null;
    private int $religion = 1;
    private ?string $email = null;
    private int $ocupacion = 0;
    private ?string $urgencia = null;
    private ?string $numext = null;
    private ?string $numint = null;
    private int $tiposangre = 1;
    private ?string $imss = null;
    private int $idpersona = 0;
    private bool $notificacion = false;
    private ?string $colonia = null;
    private int $consultorio = 0;
    private ?string $uniqueid = null;

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
    ];
}



}

