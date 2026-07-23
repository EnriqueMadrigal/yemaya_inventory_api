<?php

// Adjust namespace as needed
namespace App\Entities;

class ComponentsText
{
    /**
     * @var int|null Primary key (auto-increment)
     */
    private ?int $id = null;

    /**
     * @var int Project id (tinyint in DB)
     */
    private int $idProject = 0;

    /**
     * @var int Value id (tinyint in DB)
     */
    private int $valueId = 0;

    /**
     * @var string|null Text value (varchar(60), nullable)
     */
    private ?string $textValue = null;

    /**
     * @var int Order id (tinyint in DB)
     */
    private int $orderId = 0;

    // --- Getters and Setters ---

    public function getId(): ?int
    {
        return $id = $this->id;
    }

    // id is auto-incremented by DB; provide a private/protected setter if your ORM needs hydration
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getIdProject(): int
    {
        return $this->idProject;
    }

    public function setIdProject(int $idProject): self
    {
        // MySQL TINYINT(4) range is -128..127 signed or 0..255 unsigned.
        // The table doesn't specify UNSIGNED; adjust validation if needed.
        $this->idProject = $idProject;
        return $this;
    }

    public function getValueId(): int
    {
        return $this->valueId;
    }

    public function setValueId(int $valueId): self
    {
        $this->valueId = $valueId;
        return $this;
    }

    public function getTextValue(): ?string
    {
        return $this->textValue;
    }

    public function setTextValue(?string $textValue): self
    {
        // varchar(60) limit in DB — you may wish to enforce length here
        $this->textValue = $textValue;
        return $this;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    // --- Optional helpers ---

    public static function fromArray(array $data): self
    {
        $e = new self();
        if (array_key_exists('id', $data)) $e->setId(self::toIntOrNull($data['id']));
        if (array_key_exists('idProject', $data)) $e->setIdProject((int)$data['idProject']);
        if (array_key_exists('valueId', $data)) $e->setValueId((int)$data['valueId']);
        if (array_key_exists('textValue', $data)) $e->setTextValue(self::toStringOrNull($data['textValue']));
        if (array_key_exists('orderId', $data)) $e->setOrderId((int)$data['orderId']);
        return $e;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'idProject' => $this->getIdProject(),
            'valueId' => $this->getValueId(),
            'textValue' => $this->getTextValue(),
            'orderId' => $this->getOrderId(),
        ];
    }

    private static function toIntOrNull($v): ?int
    {
        if ($v === null || $v === '') return null;
        return (int)$v;
    }

    private static function toStringOrNull($v): ?string
    {
        if ($v === null) return null;
        $s = (string)$v;
        return $s === '' ? null : $s;
    }
}
