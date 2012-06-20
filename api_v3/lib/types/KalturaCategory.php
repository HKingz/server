<?php
/**
 * @package api
 * @subpackage objects
 */
class KalturaCategory extends KalturaObject implements IFilterable 
{
	/**
	 * The id of the Category
	 * 
	 * @var int
	 * @readonly
	 * @filter eq,in
	 */
	public $id;
	
	/**
	 * 
	 * @var int
	 * @filter eq,in
	 */
	public $parentId;
	
	/**
	 * 
	 * @var int
	 * @readonly
	 * @filter order,eq
	 */
	public $depth;
	
	/**
	 * @var int
	 * @readonly
	 */
	public $partnerId;
	
	/**
	 * The name of the Category. 
	 * The following characters are not allowed: '<', '>', ','
	 * 
	 * @var string
	 * @filter order
	 */
	public $name;
	
	/**
	 * The full name of the Category
	 * 
	 * @var string
	 * @readonly
	 * @filter eq,likex,in
	 */
	public $fullName;
	
	/**
	 * The full ids of the Category
	 * 
	 * @var string
	 * @readonly
	 * @filter eq,likex, matchor
	 */
	public $fullIds;
	
	/**
	 * Number of entries in this Category (including child categories)
	 * 
	 * @var int
	 * @filter order
	 * @readonly
	 */
	public $entriesCount;
	
	/**
	 * Creation date as Unix timestamp (In seconds)
	 *  
	 * @var int
	 * @readonly
	 * @filter gte,lte,order
	 */
	public $createdAt;
	
	/**
	 * Update date as Unix timestamp (In seconds)
	 *  
	 * @var int
	 * @readonly
	 * @filter gte,lte,order
	 */
	public $updatedAt;
	
	/**
	 * Category description
	 * 
	 * @var string
	 */
	public $description;
	
	/**
	 * Category tags
	 * 
	 * @var string
	 * @filter like,mlikeor,mlikeand
	 */
	public $tags;
	
	/**
	 * If category will be returned for list action.
	 * 
	 * @var KalturaAppearInListType
	 * @filter eq
	 * @requiresPermission insert,update
	 */
	public $appearInList;
	
	/**
	 * defines the privacy of the entries that assigned to this category
	 * 
	 * @var KalturaPrivacyType
	 * @filter eq,in
	 * @requiresPermission insert,update
	 */
	public $privacy;
	
	/**
	 * If Category members are inherited from parent category or set manualy. 
	 * @var KalturaInheritanceType
	 * @filter eq,in
	 * @requiresPermission insert,update
	 */
	public $inheritanceType;
	
	//userJoinPolicy is readonly only since product asked - and not because anything else. server code is working, and readonly doccomment can be remove
	
	/**
	 * Who can ask to join this category
	 *  
	 * @var KalturaUserJoinPolicyType
	 * @requiresPermission insert,update
	 * @readonly
	 */
	public $userJoinPolicy;
	
	/**
	 * Default permissionLevel for new users
	 *  
	 * @var KalturaCategoryUserPermissionLevel
	 * @requiresPermission insert,update
	 */
	public $defaultPermissionLevel;
	
	/**
	 * Category Owner (User id)
	 *  
	 * @var string
	 * @requiresPermission insert,update
	 */
	public $owner;
	
	/**
	 * Number of entries that belong to this category directly
	 *  
	 * @var int
	 * @filter order
	 * @readonly
	 */
	public $directEntriesCount;
	
	
	/**
	 * Category external id, controlled and managed by the partner.
	 *  
	 * @var string
	 * @filter eq
	 */
	public $referenceId;
	
	/**
	 * who can assign entries to this category
	 *  
	 * @var KalturaContributionPolicyType
	 * @filter eq
	 * @requiresPermission insert,update
	 */
	public $contributionPolicy;
	
	/**
	 * Number of active members for this category
	 *  
	 * @var int
	 * @filter gte,lte,order
	 * @readonly
	 * 
	 */
	public $membersCount;
	
	/**
	 * Number of pending members for this category
	 *
	 * @var int
	 * @filter gte,lte
	 * @readonly
	 */
	public $pendingMembersCount;
	
	/**
	 * Set privacy context for search entries that assiged to private and public categories. the entries will be private if the search context is set with those categories.
	 *  
	 * @var string
	 * @filter eq
	 * @requiresPermission insert,update
	 */
	public $privacyContext;
	
	/**
	 * comma separated parents that defines a privacyContext for search
	 *
	 * @var string
	 * @readonly
	 */
	public $privacyContexts;
	
	/**
	 * Status
	 * 
	 * @var KalturaCategoryStatus
	 * @readonly
	 * @filter eq,in
	 */
	public $status;
	
	/**
	 * the category id that this category inherit its members and members permission (for contribution and join)
	 * 
	 * @var int
	 * @readonly
	 * @filter eq,in
	 */
	public $inheritedParentId;
	
	/**
	 * Can be used to store various partner related data as a numeric value
	 * 
	 * @var int
	 * @filter gte,lte,order
	 */
	public $partnerSortValue;
	
	/**
	 * Can be used to store various partner related data as a string 
	 * 
	 * @var string
	 */
	public $partnerData;
	
	/**
	 * Enable client side applications to define how to sort the category child categories 
	 * 
	 * @var KalturaCategoryOrderBy
	 */
	public $defaultOrderBy;
	
	/**
	 * 
	 * Number of direct children categories
	 * @filter order
	 * @var int
	 */
	public $directSubCategoriesCount;
	
	/**
	 * Entries moderation 
	 * @var KalturaNullableBoolean
	 */
	public $moderation;
	
	/**
	 * Nunber of pending moderation entries
	 * @var int
	 * @readonly
	 */
	public $pendingEntriesCount;
	
	private static $mapBetweenObjects = array
	(
		"id",
		"parentId",
		"depth",
		"name",
		"fullName",
		"fullIds",
		"partnerId",
		"entriesCount",
		"createdAt",
		"updatedAt",
		"description",
		"tags",
		"appearInList" => "displayInSearch",
		"privacy",
		"inheritanceType",
		"userJoinPolicy",
		"defaultPermissionLevel",
		"owner" => "puserId",
		"directEntriesCount",
		"referenceId",
		"contributionPolicy",
		"membersCount",
		"pendingMembersCount",
		"privacyContext",	
		"privacyContexts",
		"status",
		"inheritedParentId",
		"partnerSortValue",
		"partnerData",
		"defaultOrderBy",
		"directSubCategoriesCount",
		"moderation",
		"pendingEntriesCount",
	);
	
	/* (non-PHPdoc)
	 * @see KalturaObject::getMapBetweenObjects()
	 */
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$mapBetweenObjects);
	}
	
	/* (non-PHPdoc)
	 * @see IFilterable::getExtraFilters()
	 */
	public function getExtraFilters()
	{
		return array();
	}
	
	/* (non-PHPdoc)
	 * @see IFilterable::getFilterDocs()
	 */
	public function getFilterDocs()
	{
		return array();
	}
	
	/**
	 * validate parent id exists and if not - cannot set category to inherit from parent.
	 */
	public function validateParentId()
	{
		if ($this->parentId === null)
			$this->parentId = 0;
			
		if ($this->parentId !== 0)
		{
			$parentCategoryDb = categoryPeer::retrieveByPK($this->parentId);
			if (!$parentCategoryDb)
				throw new KalturaAPIException(KalturaErrors::PARENT_CATEGORY_NOT_FOUND, $this->parentId);
		}
	}
	
	/* (non-PHPdoc)
	 * @see KalturaObject::validateForInsert()
	 */
	public function validateForInsert($propertiesToSkip = array())
	{
		$this->validatePropertyMinLength("name", 1);
		$this->validatePropertyMaxLength("name", categoryPeer::MAX_CATEGORY_NAME);
		$this->validateCategory();
		
		if ($this->parentId !== null)
		{
			$this->validateParentId();
		}
		elseif ($this->inheritanceType == KalturaInheritanceType::INHERIT)
		{
			//cannot inherit member with no parant
			throw new KalturaAPIException(KalturaErrors::CANNOT_INHERIT_MEMBERS_WHEN_PARENT_CATEGORY_IS_NOT_SET);
		}
		
		return parent::validateForInsert($propertiesToSkip);
	}

	/* (non-PHPdoc)
	 * @see KalturaObject::validateForUpdate()
	 */
	public function validateForUpdate($sourceObject, $propertiesToSkip = array())
	{
		if ($this->name !== null)
		{
			$this->validatePropertyMinLength("name", 1);
			$this->validatePropertyMaxLength("name", categoryPeer::MAX_CATEGORY_NAME);
		}
		
		if ($this->parentId !== null)
		{
			$this->validateParentId();
		}
		elseif ($this->inheritanceType == KalturaInheritanceType::INHERIT && 
		($this->parentId instanceof KalturaNullField || $sourceObject->getParentId() == null))
		{
			//cannot inherit member with no parant
			throw new KalturaAPIException(KalturaErrors::CANNOT_INHERIT_MEMBERS_WHEN_PARENT_CATEGORY_IS_NOT_SET);
		}
			
		$this->validateCategory($sourceObject);
			
		return parent::validateForUpdate($sourceObject, $propertiesToSkip);
	}
	
	/**
	 * validate category fields
	 * 1. category that inherit memebers canno set values to inherited fields.
	 * 2. validate the owner id exists as kuser
	 * 
	 * @param category $sourceObject
	 */
	private function validateCategory(category $sourceObject = null)
	{
		if($this->privacyContext != null && kEntitlementUtils::getEntitlementEnforcement())
			throw new KalturaAPIException(KalturaErrors::CANNOT_UPDATE_CATEGORY_PRIVACY_CONTEXT);
			
		if($this->privacyContext === '' || 
		($this->privacyContext == null && !$sourceObject) || 
		($this->privacyContext == null && $sourceObject && $sourceObject->getPrivacyContexts() == ''))
		{
			if((($this->appearInList != KalturaAppearInListType::PARTNER_ONLY && $this->appearInList != null) || 
			   ($this->appearInList == null && $sourceObject && $sourceObject->getDisplayInSearch() != DisplayInSearchType::PARTNER_ONLY))|| 
			   (($this->moderation != KalturaNullableBoolean::FALSE_VALUE && $this->moderation != null) || 
			   ($this->moderation == null && $sourceObject && $sourceObject->getModeration() != false)) ||
			   (($this->inheritanceType != KalturaInheritanceType::MANUAL && $this->inheritanceType != null) || 
			   ($this->inheritanceType == null && $sourceObject && $sourceObject->getInheritanceType() != false)) ||
			   (($this->privacy != KalturaPrivacyType::ALL && $this->privacy != null) || 
			   ($this->privacy == null && $sourceObject && $sourceObject->getPrivacy() != KalturaPrivacyType::ALL)) ||
			   ($this->owner != null || 
			   ($this->owner == null && $sourceObject && $sourceObject->getKuserId() != null)) ||
			   (($this->userJoinPolicy != KalturaUserJoinPolicyType::NOT_ALLOWED && $this->userJoinPolicy != null) || 
			   ($this->userJoinPolicy == null && $sourceObject && $sourceObject->getUserJoinPolicy() != KalturaUserJoinPolicyType::NOT_ALLOWED)) ||
			   (($this->contributionPolicy != KalturaContributionPolicyType::ALL  && $this->contributionPolicy != null ) || 
			   ($this->contributionPolicy == null && $sourceObject && $sourceObject->getContributionPolicy() != KalturaContributionPolicyType::ALL)) ||
			   (($this->defaultPermissionLevel != KalturaCategoryUserPermissionLevel::MEMBER && $this->defaultPermissionLevel != null) || 
			   ($this->defaultPermissionLevel == null && $sourceObject && $sourceObject->getDefaultPermissionLevel() != KalturaCategoryUserPermissionLevel::MEMBER )))
			{
				if ($this->parentId != null)
				{
					$parentCategory = categoryPeer::retrieveByPK($this->parentId);
					if(!$parentCategory)
						throw new KalturaAPIException(KalturaErrors::CATEGORY_NOT_FOUND, $this->parentId);
					
					if($parentCategory->getPrivacyContexts() == '')
						throw new KalturaAPIException(KalturaErrors::CANNOT_UPDATE_CATEGORY_ENTITLEMENT_FIELDS_WITH_NO_PRIVACY_CONTEXT);
				}
				else
				{
					throw new KalturaAPIException(KalturaErrors::CANNOT_UPDATE_CATEGORY_ENTITLEMENT_FIELDS_WITH_NO_PRIVACY_CONTEXT);
				}
			}
		}
		
		if(($this->inheritanceType != KalturaInheritanceType::MANUAL && $this->inheritanceType != null) || 
			($this->inheritanceType == null && $sourceObject && $sourceObject->getInheritanceType() != false))
		{	
			if((!$sourceObject && $this->owner != null) || 
			   ($sourceObject && $this->owner != null && $this->owner != $sourceObject->getKuserId()) ||
			   (!$sourceObject && $this->userJoinPolicy != null) || 
			   ($sourceObject && $this->userJoinPolicy != null && $this->userJoinPolicy != $sourceObject->getUserJoinPolicy()) ||
			   (!$sourceObject && $this->defaultPermissionLevel != null) ||  
			   ($sourceObject && $this->defaultPermissionLevel != null && $this->defaultPermissionLevel != $sourceObject->getDefaultPermissionLevel()))
					throw new KalturaAPIException(KalturaErrors::CATEGORY_INHERIT_MEMBERS_CANNOT_UPDATE_INHERITED_ATTRIBUTES);
		}
		
		if (!is_null($sourceObject))
		{
			$partnerId = kCurrentContext::$partner_id ? kCurrentContext::$partner_id : kCurrentContext::$ks_partner_id;
			$partner = PartnerPeer::retrieveByPK($partnerId);
			if (!$partner || $partner->getFeaturesStatusByType(FeatureStatusType::LOCK_CATEGORY))
				throw new KalturaAPIException(KalturaErrors::CATEGORIES_LOCKED);		
		}

		if ($this->owner && $this->owner != '' && !($this->owner instanceof KalturaNullField) )
		{
			$partnerId = kCurrentContext::$partner_id ? kCurrentContext::$partner_id : kCurrentContext::$ks_partner_id;
			kuserPeer::createKuserForPartner($partnerId, $this->owner);
		}
		
	}
}