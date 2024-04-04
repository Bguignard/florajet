<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Entity\Enum\LanguageEnum;
use App\Entity\Enum\SourceTypeEnum;
use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'article:item']),
        new GetCollection(normalizationContext: ['groups' => 'article:list']),
        new Put(),
        new Delete(),
        new Post(),
        ],
    order: ['publicationDate' => 'DESC'],
    paginationEnabled: true,
)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:list', 'article:item'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: true)]
    #[Groups(['article:list', 'article:item'])]
    private ?string $guid;

    #[ORM\Column(type: 'string', enumType: SourceTypeEnum::class)]
    #[Groups(['article:list', 'article:item'])]
    private SourceTypeEnum $sourceType;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['article:list', 'article:item'])]
    private string $sourceName;

    #[ORM\Column(length: 255)]
    #[Groups(['article:list', 'article:item'])]
    private string $sourceURL;

    #[ORM\Column(type: 'string', enumType: LanguageEnum::class)]
    #[Groups(['article:list', 'article:item'])]
    private LanguageEnum $language;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['article:list', 'article:item'])]
    private \DateTimeInterface $publicationDate;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['article:list', 'article:item'])]
    private ?string $permalink;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['article:list', 'article:item'])]
    private ?string $mediaUrl;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['article:list', 'article:item'])]
    private ?string $MediaDescription;

    #[ORM\Column(length: 255)]
    #[Groups(['article:list', 'article:item'])]
    private string $title;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['article:list', 'article:item'])]
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

    public function setGuid(?string $guid): Article
    {
        $this->guid = $guid;
        return $this;
    }

    public function setSourceType(SourceTypeEnum $sourceType): Article
    {
        $this->sourceType = $sourceType;
        return $this;
    }

    public function setSourceName(string $sourceName): Article
    {
        $this->sourceName = $sourceName;
        return $this;
    }

    public function setSourceURL(string $sourceURL): Article
    {
        $this->sourceURL = $sourceURL;
        return $this;
    }

    public function setLanguage(LanguageEnum $language): Article
    {
        $this->language = $language;
        return $this;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): Article
    {
        $this->publicationDate = $publicationDate;
        return $this;
    }

    public function setPermalink(?string $permalink): Article
    {
        $this->permalink = $permalink;
        return $this;
    }

    public function setMediaUrl(?string $mediaUrl): Article
    {
        $this->mediaUrl = $mediaUrl;
        return $this;
    }

    public function setMediaDescription(?string $MediaDescription): Article
    {
        $this->MediaDescription = $MediaDescription;
        return $this;
    }

    public function setTitle(string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    public function setContent(string $content): Article
    {
        $this->content = $content;
        return $this;
    }
}
