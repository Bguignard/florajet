<?php

namespace App\Entity;

use App\Entity\Enum\LanguageEnum;
use App\Entity\Enum\SourceTypeEnum;
use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: true)]
    private ?string $guid = null;

    #[ORM\Column(type: 'string', enumType: SourceTypeEnum::class)]
    private ?string $sourceType = null;

    #[ORM\Column(length: 255)]
    private ?string $sourceURL = null;

    #[ORM\Column(type: 'string', enumType: LanguageEnum::class)]
    private ?string $language = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $publicationDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $permalink = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mediaUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MediaDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    public function __construct(
        string $sourceType,
        string $sourceURL,
        string $language,
        \DateTimeInterface $publicationDate,
        string $title,
        string $content,
        ?string $guid = null,
    ) {
        $this->sourceType = $sourceType;
        $this->sourceURL = $sourceURL;
        $this->language = $language;
        $this->publicationDate = $publicationDate;
        $this->title = $title;
        $this->content = $content;
        $this->guid = $guid;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSourceType(): ?string
    {
        return $this->sourceType;
    }

    public function getSourceURL(): ?string
    {
        return $this->sourceURL;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function getPermalink(): ?string
    {
        return $this->permalink;
    }

    public function getMediaDescription(): ?string
    {
        return $this->MediaDescription;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getGuid(): ?string
    {
        return $this->guid;
    }
}
