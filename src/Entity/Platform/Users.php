<?php

namespace App\Entity\Platform;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="idx_24354_login", columns={"login"})}, indexes={@ORM\Index(name="idx_24354_rs_id", columns={"rs_id"}), @ORM\Index(name="idx_24354_routing_group_id", columns={"routing_group_id"}), @ORM\Index(name="idx_24354_smpp_user", columns={"smpp_user"}), @ORM\Index(name="IDX_1483A5E919EB6921", columns={"client_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="users_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rs_id", type="bigint", nullable=false)
     */
    private $rsId;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="text", nullable=false)
     */
    private $fullName = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="fio_gen", type="text", nullable=true)
     */
    private $fioGen = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="fio_manager", type="text", nullable=true)
     */
    private $fioManager;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone_manager", type="text", nullable=true)
     */
    private $phoneManager;

    /**
     * @var string
     *
     * @ORM\Column(name="inn", type="text", nullable=false)
     */
    private $inn = '';

    /**
     * @var string
     *
     * @ORM\Column(name="kpp", type="text", nullable=false)
     */
    private $kpp = '';

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="text", nullable=false)
     */
    private $city = '';

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="text", nullable=false)
     */
    private $phone = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bank_name", type="text", nullable=false)
     */
    private $bankName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="kor_schet", type="text", nullable=false)
     */
    private $korSchet = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bik", type="text", nullable=false)
     */
    private $bik = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="legal_ground", type="text", nullable=true)
     */
    private $legalGround;

    /**
     * @var string
     *
     * @ORM\Column(name="index_ur_adres", type="text", nullable=false)
     */
    private $indexUrAdres = '';

    /**
     * @var string
     *
     * @ORM\Column(name="index_post_adres", type="text", nullable=false)
     */
    private $indexPostAdres = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ras_schet", type="text", nullable=false)
     */
    private $rasSchet = '';

    /**
     * @var int
     *
     * @ORM\Column(name="is_ur", type="integer", nullable=false)
     */
    private $isUr = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ur_adres", type="text", nullable=false)
     */
    private $urAdres = '';

    /**
     * @var string
     *
     * @ORM\Column(name="post_adres", type="text", nullable=false)
     */
    private $postAdres = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", nullable=false)
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="passkey", type="text", nullable=false)
     */
    private $passkey = '';

    /**
     * @var int
     *
     * @ORM\Column(name="is_active", type="integer", nullable=false, options={"default"="1"})
     */
    private $isActive = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="is_delete", type="integer", nullable=false)
     */
    private $isDelete = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="full_access", type="integer", nullable=false)
     */
    private $fullAccess = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="text", nullable=false)
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text", nullable=false)
     */
    private $password = '';

    /**
     * @var int
     *
     * @ORM\Column(name="unlim_send", type="integer", nullable=false)
     */
    private $unlimSend = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="dynamic_names", type="integer", nullable=false)
     */
    private $dynamicNames = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer", nullable=false, options={"default"="8"})
     */
    private $priority = '8';

    /**
     * @var int
     *
     * @ORM\Column(name="smpp_user", type="integer", nullable=false)
     */
    private $smppUser = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="robox_use", type="integer", nullable=false)
     */
    private $roboxUse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sum", type="text", nullable=true)
     */
    private $sum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="new_registration", type="integer", nullable=false)
     */
    private $newRegistration = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="dinamic_templates", type="integer", nullable=false)
     */
    private $dinamicTemplates = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="can_set_validity_period", type="integer", nullable=false, options={"default"="1"})
     */
    private $canSetValidityPeriod = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="to_new_platform", type="integer", nullable=true)
     */
    private $toNewPlatform;

    /**
     * @var int
     *
     * @ORM\Column(name="phone_checked", type="integer", nullable=false, options={"default"="1"})
     */
    private $phoneChecked = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="can_download_stat", type="integer", nullable=false, options={"default"="1"})
     */
    private $canDownloadStat = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="can_download_bases", type="integer", nullable=false, options={"default"="1"})
     */
    private $canDownloadBases = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="can_see_detail_stat", type="integer", nullable=false, options={"default"="1"})
     */
    private $canSeeDetailStat = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="tarif_id", type="bigint", nullable=false)
     */
    private $tarifId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="show_info_field", type="integer", nullable=false)
     */
    private $showInfoField = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="info_field_name", type="text", nullable=false)
     */
    private $infoFieldName = '';

    /**
     * @var int
     *
     * @ORM\Column(name="routing_group_id", type="bigint", nullable=false)
     */
    private $routingGroupId;

    /**
     * @var int
     *
     * @ORM\Column(name="auto_moderate_sending", type="integer", nullable=false)
     */
    private $autoModerateSending = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="reg_name", type="integer", nullable=false)
     */
    private $regName = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="is_foreign_company", type="integer", nullable=false)
     */
    private $isForeignCompany = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="status_secret_key", type="text", nullable=true)
     */
    private $statusSecretKey;

    /**
     * @var int
     *
     * @ORM\Column(name="show_tarif", type="integer", nullable=false, options={"default"="1"})
     */
    private $showTarif = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_display_name", type="integer", nullable=true)
     */
    private $isDisplayName = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="sms_customer", type="integer", nullable=false)
     */
    private $smsCustomer = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="view_balance", type="integer", nullable=true)
     */
    private $viewBalance = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="originator_registration_notification_handler_url", type="text", nullable=true)
     */
    private $originatorRegistrationNotificationHandlerUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="low_balance_notification", type="integer", nullable=false, options={"default"="1"})
     */
    private $lowBalanceNotification = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="empty_balance_notification", type="integer", nullable=false, options={"default"="1"})
     */
    private $emptyBalanceNotification = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="low_balance", type="float", precision=10, scale=0, nullable=false, options={"default"="500"})
     */
    private $lowBalance = '500';

    /**
     * @var int
     *
     * @ORM\Column(name="balance_notification_mode_id", type="bigint", nullable=false, options={"default"="1"})
     */
    private $balanceNotificationModeId = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="http_originator_registration_notification", type="integer", nullable=false)
     */
    private $httpOriginatorRegistrationNotification = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="important", type="integer", nullable=true, options={"comment"="приоритет для перевода трафика (1 - приоритетный, 0 - обычный)"})
     */
    private $important = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="users_api_id", type="integer", nullable=true)
     */
    private $usersApiId;

    /**
     * @var int
     *
     * @ORM\Column(name="refuse_duplicate_messages", type="integer", nullable=false)
     */
    private $refuseDuplicateMessages = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ext_stat", type="boolean", nullable=true)
     */
    private $extStat;

    /**
     * @var int
     *
     * @ORM\Column(name="send_default_encoding", type="integer", nullable=false)
     */
    private $sendDefaultEncoding = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="partner_id", type="bigint", nullable=false)
     */
    private $partnerId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="disguise_digits_in_text", type="integer", nullable=false)
     */
    private $disguiseDigitsInText = '0';

    /**
     * @var \Clients
     *
     */
    private $client;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getRsId(): ?string
    {
        return $this->rsId;
    }

    public function setRsId(string $rsId): self
    {
        $this->rsId = $rsId;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getFioGen(): ?string
    {
        return $this->fioGen;
    }

    public function setFioGen(?string $fioGen): self
    {
        $this->fioGen = $fioGen;

        return $this;
    }

    public function getFioManager(): ?string
    {
        return $this->fioManager;
    }

    public function setFioManager(?string $fioManager): self
    {
        $this->fioManager = $fioManager;

        return $this;
    }

    public function getPhoneManager(): ?string
    {
        return $this->phoneManager;
    }

    public function setPhoneManager(?string $phoneManager): self
    {
        $this->phoneManager = $phoneManager;

        return $this;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(string $inn): self
    {
        $this->inn = $inn;

        return $this;
    }

    public function getKpp(): ?string
    {
        return $this->kpp;
    }

    public function setKpp(string $kpp): self
    {
        $this->kpp = $kpp;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName): self
    {
        $this->bankName = $bankName;

        return $this;
    }

    public function getKorSchet(): ?string
    {
        return $this->korSchet;
    }

    public function setKorSchet(string $korSchet): self
    {
        $this->korSchet = $korSchet;

        return $this;
    }

    public function getBik(): ?string
    {
        return $this->bik;
    }

    public function setBik(string $bik): self
    {
        $this->bik = $bik;

        return $this;
    }

    public function getLegalGround(): ?string
    {
        return $this->legalGround;
    }

    public function setLegalGround(?string $legalGround): self
    {
        $this->legalGround = $legalGround;

        return $this;
    }

    public function getIndexUrAdres(): ?string
    {
        return $this->indexUrAdres;
    }

    public function setIndexUrAdres(string $indexUrAdres): self
    {
        $this->indexUrAdres = $indexUrAdres;

        return $this;
    }

    public function getIndexPostAdres(): ?string
    {
        return $this->indexPostAdres;
    }

    public function setIndexPostAdres(string $indexPostAdres): self
    {
        $this->indexPostAdres = $indexPostAdres;

        return $this;
    }

    public function getRasSchet(): ?string
    {
        return $this->rasSchet;
    }

    public function setRasSchet(string $rasSchet): self
    {
        $this->rasSchet = $rasSchet;

        return $this;
    }

    public function getIsUr(): ?int
    {
        return $this->isUr;
    }

    public function setIsUr(int $isUr): self
    {
        $this->isUr = $isUr;

        return $this;
    }

    public function getUrAdres(): ?string
    {
        return $this->urAdres;
    }

    public function setUrAdres(string $urAdres): self
    {
        $this->urAdres = $urAdres;

        return $this;
    }

    public function getPostAdres(): ?string
    {
        return $this->postAdres;
    }

    public function setPostAdres(string $postAdres): self
    {
        $this->postAdres = $postAdres;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPasskey(): ?string
    {
        return $this->passkey;
    }

    public function setPasskey(string $passkey): self
    {
        $this->passkey = $passkey;

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsDelete(): ?int
    {
        return $this->isDelete;
    }

    public function setIsDelete(int $isDelete): self
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    public function getFullAccess(): ?int
    {
        return $this->fullAccess;
    }

    public function setFullAccess(int $fullAccess): self
    {
        $this->fullAccess = $fullAccess;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUnlimSend(): ?int
    {
        return $this->unlimSend;
    }

    public function setUnlimSend(int $unlimSend): self
    {
        $this->unlimSend = $unlimSend;

        return $this;
    }

    public function getDynamicNames(): ?int
    {
        return $this->dynamicNames;
    }

    public function setDynamicNames(int $dynamicNames): self
    {
        $this->dynamicNames = $dynamicNames;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getSmppUser(): ?int
    {
        return $this->smppUser;
    }

    public function setSmppUser(int $smppUser): self
    {
        $this->smppUser = $smppUser;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRoboxUse(): ?int
    {
        return $this->roboxUse;
    }

    public function setRoboxUse(int $roboxUse): self
    {
        $this->roboxUse = $roboxUse;

        return $this;
    }

    public function getSum(): ?string
    {
        return $this->sum;
    }

    public function setSum(?string $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNewRegistration(): ?int
    {
        return $this->newRegistration;
    }

    public function setNewRegistration(int $newRegistration): self
    {
        $this->newRegistration = $newRegistration;

        return $this;
    }

    public function getDinamicTemplates(): ?int
    {
        return $this->dinamicTemplates;
    }

    public function setDinamicTemplates(int $dinamicTemplates): self
    {
        $this->dinamicTemplates = $dinamicTemplates;

        return $this;
    }

    public function getCanSetValidityPeriod(): ?int
    {
        return $this->canSetValidityPeriod;
    }

    public function setCanSetValidityPeriod(int $canSetValidityPeriod): self
    {
        $this->canSetValidityPeriod = $canSetValidityPeriod;

        return $this;
    }

    public function getToNewPlatform(): ?int
    {
        return $this->toNewPlatform;
    }

    public function setToNewPlatform(?int $toNewPlatform): self
    {
        $this->toNewPlatform = $toNewPlatform;

        return $this;
    }

    public function getPhoneChecked(): ?int
    {
        return $this->phoneChecked;
    }

    public function setPhoneChecked(int $phoneChecked): self
    {
        $this->phoneChecked = $phoneChecked;

        return $this;
    }

    public function getCanDownloadStat(): ?int
    {
        return $this->canDownloadStat;
    }

    public function setCanDownloadStat(int $canDownloadStat): self
    {
        $this->canDownloadStat = $canDownloadStat;

        return $this;
    }

    public function getCanDownloadBases(): ?int
    {
        return $this->canDownloadBases;
    }

    public function setCanDownloadBases(int $canDownloadBases): self
    {
        $this->canDownloadBases = $canDownloadBases;

        return $this;
    }

    public function getCanSeeDetailStat(): ?int
    {
        return $this->canSeeDetailStat;
    }

    public function setCanSeeDetailStat(int $canSeeDetailStat): self
    {
        $this->canSeeDetailStat = $canSeeDetailStat;

        return $this;
    }

    public function getTarifId(): ?string
    {
        return $this->tarifId;
    }

    public function setTarifId(string $tarifId): self
    {
        $this->tarifId = $tarifId;

        return $this;
    }

    public function getShowInfoField(): ?int
    {
        return $this->showInfoField;
    }

    public function setShowInfoField(int $showInfoField): self
    {
        $this->showInfoField = $showInfoField;

        return $this;
    }

    public function getInfoFieldName(): ?string
    {
        return $this->infoFieldName;
    }

    public function setInfoFieldName(string $infoFieldName): self
    {
        $this->infoFieldName = $infoFieldName;

        return $this;
    }

    public function getRoutingGroupId(): ?string
    {
        return $this->routingGroupId;
    }

    public function setRoutingGroupId(string $routingGroupId): self
    {
        $this->routingGroupId = $routingGroupId;

        return $this;
    }

    public function getAutoModerateSending(): ?int
    {
        return $this->autoModerateSending;
    }

    public function setAutoModerateSending(int $autoModerateSending): self
    {
        $this->autoModerateSending = $autoModerateSending;

        return $this;
    }

    public function getRegName(): ?int
    {
        return $this->regName;
    }

    public function setRegName(int $regName): self
    {
        $this->regName = $regName;

        return $this;
    }

    public function getIsForeignCompany(): ?int
    {
        return $this->isForeignCompany;
    }

    public function setIsForeignCompany(int $isForeignCompany): self
    {
        $this->isForeignCompany = $isForeignCompany;

        return $this;
    }

    public function getStatusSecretKey(): ?string
    {
        return $this->statusSecretKey;
    }

    public function setStatusSecretKey(?string $statusSecretKey): self
    {
        $this->statusSecretKey = $statusSecretKey;

        return $this;
    }

    public function getShowTarif(): ?int
    {
        return $this->showTarif;
    }

    public function setShowTarif(int $showTarif): self
    {
        $this->showTarif = $showTarif;

        return $this;
    }

    public function getIsDisplayName(): ?int
    {
        return $this->isDisplayName;
    }

    public function setIsDisplayName(?int $isDisplayName): self
    {
        $this->isDisplayName = $isDisplayName;

        return $this;
    }

    public function getSmsCustomer(): ?int
    {
        return $this->smsCustomer;
    }

    public function setSmsCustomer(int $smsCustomer): self
    {
        $this->smsCustomer = $smsCustomer;

        return $this;
    }

    public function getViewBalance(): ?int
    {
        return $this->viewBalance;
    }

    public function setViewBalance(?int $viewBalance): self
    {
        $this->viewBalance = $viewBalance;

        return $this;
    }

    public function getOriginatorRegistrationNotificationHandlerUrl(): ?string
    {
        return $this->originatorRegistrationNotificationHandlerUrl;
    }

    public function setOriginatorRegistrationNotificationHandlerUrl(?string $originatorRegistrationNotificationHandlerUrl): self
    {
        $this->originatorRegistrationNotificationHandlerUrl = $originatorRegistrationNotificationHandlerUrl;

        return $this;
    }

    public function getLowBalanceNotification(): ?int
    {
        return $this->lowBalanceNotification;
    }

    public function setLowBalanceNotification(int $lowBalanceNotification): self
    {
        $this->lowBalanceNotification = $lowBalanceNotification;

        return $this;
    }

    public function getEmptyBalanceNotification(): ?int
    {
        return $this->emptyBalanceNotification;
    }

    public function setEmptyBalanceNotification(int $emptyBalanceNotification): self
    {
        $this->emptyBalanceNotification = $emptyBalanceNotification;

        return $this;
    }

    public function getLowBalance(): ?float
    {
        return $this->lowBalance;
    }

    public function setLowBalance(float $lowBalance): self
    {
        $this->lowBalance = $lowBalance;

        return $this;
    }

    public function getBalanceNotificationModeId(): ?string
    {
        return $this->balanceNotificationModeId;
    }

    public function setBalanceNotificationModeId(string $balanceNotificationModeId): self
    {
        $this->balanceNotificationModeId = $balanceNotificationModeId;

        return $this;
    }

    public function getHttpOriginatorRegistrationNotification(): ?int
    {
        return $this->httpOriginatorRegistrationNotification;
    }

    public function setHttpOriginatorRegistrationNotification(int $httpOriginatorRegistrationNotification): self
    {
        $this->httpOriginatorRegistrationNotification = $httpOriginatorRegistrationNotification;

        return $this;
    }

    public function getImportant(): ?int
    {
        return $this->important;
    }

    public function setImportant(?int $important): self
    {
        $this->important = $important;

        return $this;
    }

    public function getUsersApiId(): ?int
    {
        return $this->usersApiId;
    }

    public function setUsersApiId(?int $usersApiId): self
    {
        $this->usersApiId = $usersApiId;

        return $this;
    }

    public function getRefuseDuplicateMessages(): ?int
    {
        return $this->refuseDuplicateMessages;
    }

    public function setRefuseDuplicateMessages(int $refuseDuplicateMessages): self
    {
        $this->refuseDuplicateMessages = $refuseDuplicateMessages;

        return $this;
    }

    public function getExtStat(): ?bool
    {
        return $this->extStat;
    }

    public function setExtStat(?bool $extStat): self
    {
        $this->extStat = $extStat;

        return $this;
    }

    public function getSendDefaultEncoding(): ?int
    {
        return $this->sendDefaultEncoding;
    }

    public function setSendDefaultEncoding(int $sendDefaultEncoding): self
    {
        $this->sendDefaultEncoding = $sendDefaultEncoding;

        return $this;
    }

    public function getPartnerId(): ?string
    {
        return $this->partnerId;
    }

    public function setPartnerId(string $partnerId): self
    {
        $this->partnerId = $partnerId;

        return $this;
    }

    public function getDisguiseDigitsInText(): ?int
    {
        return $this->disguiseDigitsInText;
    }

    public function setDisguiseDigitsInText(int $disguiseDigitsInText): self
    {
        $this->disguiseDigitsInText = $disguiseDigitsInText;

        return $this;
    }

//    public function getClient(): ?Clients
//    {
//        return $this->client;
//    }
//
//    public function setClient(?Clients $client): self
//    {
//        $this->client = $client;
//
//        return $this;
//    }


}
