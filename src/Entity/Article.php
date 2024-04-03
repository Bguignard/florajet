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
    private ?string $guid;

    #[ORM\Column(type: 'string', enumType: SourceTypeEnum::class)]
    private SourceTypeEnum $sourceType;

    #[ORM\Column(type: 'string', length: 255)]
    private string $sourceName;

    #[ORM\Column(length: 255)]
    private string $sourceURL;

    #[ORM\Column(type: 'string', enumType: LanguageEnum::class)]
    private LanguageEnum $language;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $publicationDate;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $permalink;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mediaUrl;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MediaDescription;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(type: Types::TEXT)]
    private string $content;

    public function __construct(
        SourceTypeEnum $sourceType,
        string $sourceName,
        string $sourceURL,
        LanguageEnum $language,
        \DateTimeInterface $publicationDate,
        string $title,
        string $content,
        ?string $guid = null,
        ?string $permalink = null,
        ?string $mediaUrl = null,
        ?string $MediaDescription = null,

    ) {
        $this->sourceType = $sourceType;
        $this->sourceName = $sourceName;
        $this->sourceURL = $sourceURL;
        $this->language = $language;
        $this->publicationDate = $publicationDate;
        $this->title = $title;
        $this->content = $content;
        $this->guid = $guid;
        $this->permalink = $permalink;
        $this->mediaUrl = $mediaUrl;
        $this->MediaDescription = $MediaDescription;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSourceType(): SourceTypeEnum
    {
        return $this->sourceType;
    }

    public function getSourceURL(): string
    {
        return $this->sourceURL;
    }

    public function getLanguage(): LanguageEnum
    {
        return $this->language;
    }

    public function getPublicationDate(): \DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function getPermalink(): string
    {
        return $this->permalink;
    }

    public function getMediaDescription(): ?string
    {
        return $this->MediaDescription;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function getMediaUrl(): ?string
    {
        return $this->mediaUrl;
    }

    public function getSourceName(): string
    {
        return $this->sourceName;
    }

}
