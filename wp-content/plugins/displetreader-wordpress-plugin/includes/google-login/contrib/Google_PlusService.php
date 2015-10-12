<?php
/*
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */


  /**
   * The "activities" collection of methods.
   * Typical usage is:
   *  <code>
   *   $plusService = new displetretsidx_Google_PlusService(...);
   *   $activities = $plusService->activities;
   *  </code>
   */
  class displetretsidx_Google_ActivitiesServiceResource extends displetretsidx_Google_ServiceResource {


    /**
     * Get an activity. (activities.get)
     *
     * @param string $activityId The ID of the activity to get.
     * @param array $optParams Optional parameters.
     * @return displetretsidx_Google_Activity
     */
    public function get($activityId, $optParams = array()) {
      $params = array('activityId' => $activityId);
      $params = array_merge($params, $optParams);
      $data = $this->__call('get', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_Activity($data);
      } else {
        return $data;
      }
    }
    /**
     * List all of the activities in the specified collection for a particular user. (activities.list)
     *
     * @param string $userId The ID of the user to get activities for. The special value "me" can be used to indicate the authenticated user.
     * @param string $collection The collection of activities to list.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string maxResults The maximum number of activities to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response.
     * @return displetretsidx_Google_ActivityFeed
     */
    public function listActivities($userId, $collection, $optParams = array()) {
      $params = array('userId' => $userId, 'collection' => $collection);
      $params = array_merge($params, $optParams);
      $data = $this->__call('list', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_ActivityFeed($data);
      } else {
        return $data;
      }
    }
    /**
     * Search public activities. (activities.search)
     *
     * @param string $query Full-text search query string.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string language Specify the preferred language to search with. See search language codes for available values.
     * @opt_param string maxResults The maximum number of activities to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string orderBy Specifies how to order search results.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response. This token can be of any length.
     * @return displetretsidx_Google_ActivityFeed
     */
    public function search($query, $optParams = array()) {
      $params = array('query' => $query);
      $params = array_merge($params, $optParams);
      $data = $this->__call('search', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_ActivityFeed($data);
      } else {
        return $data;
      }
    }
  }

  /**
   * The "comments" collection of methods.
   * Typical usage is:
   *  <code>
   *   $plusService = new displetretsidx_Google_PlusService(...);
   *   $comments = $plusService->comments;
   *  </code>
   */
  class displetretsidx_Google_CommentsServiceResource extends displetretsidx_Google_ServiceResource {


    /**
     * Get a comment. (comments.get)
     *
     * @param string $commentId The ID of the comment to get.
     * @param array $optParams Optional parameters.
     * @return displetretsidx_Google_Comment
     */
    public function get($commentId, $optParams = array()) {
      $params = array('commentId' => $commentId);
      $params = array_merge($params, $optParams);
      $data = $this->__call('get', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_Comment($data);
      } else {
        return $data;
      }
    }
    /**
     * List all of the comments for an activity. (comments.list)
     *
     * @param string $activityId The ID of the activity to get comments for.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string maxResults The maximum number of comments to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response.
     * @opt_param string sortOrder The order in which to sort the list of comments.
     * @return displetretsidx_Google_CommentFeed
     */
    public function listComments($activityId, $optParams = array()) {
      $params = array('activityId' => $activityId);
      $params = array_merge($params, $optParams);
      $data = $this->__call('list', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_CommentFeed($data);
      } else {
        return $data;
      }
    }
  }

  /**
   * The "moments" collection of methods.
   * Typical usage is:
   *  <code>
   *   $plusService = new displetretsidx_Google_PlusService(...);
   *   $moments = $plusService->moments;
   *  </code>
   */
  class displetretsidx_Google_MomentsServiceResource extends displetretsidx_Google_ServiceResource {


    /**
     * Record a moment representing a user's activity such as making a purchase or commenting on a blog.
     * (moments.insert)
     *
     * @param string $userId The ID of the user to record activities for. The only valid values are "me" and the ID of the authenticated user.
     * @param string $collection The collection to which to write moments.
     * @param displetretsidx_Google_Moment $postBody
     * @param array $optParams Optional parameters.
     *
     * @opt_param bool debug Return the moment as written. Should be used only for debugging.
     * @return displetretsidx_Google_Moment
     */
    public function insert($userId, $collection, displetretsidx_Google_Moment $postBody, $optParams = array()) {
      $params = array('userId' => $userId, 'collection' => $collection, 'postBody' => $postBody);
      $params = array_merge($params, $optParams);
      $data = $this->__call('insert', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_Moment($data);
      } else {
        return $data;
      }
    }
    /**
     * List all of the moments for a particular user. (moments.list)
     *
     * @param string $userId The ID of the user to get moments for. The special value "me" can be used to indicate the authenticated user.
     * @param string $collection The collection of moments to list.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string maxResults The maximum number of moments to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response.
     * @opt_param string targetUrl Only moments containing this targetUrl will be returned.
     * @opt_param string type Only moments of this type will be returned.
     * @return displetretsidx_Google_MomentsFeed
     */
    public function listMoments($userId, $collection, $optParams = array()) {
      $params = array('userId' => $userId, 'collection' => $collection);
      $params = array_merge($params, $optParams);
      $data = $this->__call('list', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_MomentsFeed($data);
      } else {
        return $data;
      }
    }
    /**
     * Delete a moment. (moments.remove)
     *
     * @param string $id The ID of the moment to delete.
     * @param array $optParams Optional parameters.
     */
    public function remove($id, $optParams = array()) {
      $params = array('id' => $id);
      $params = array_merge($params, $optParams);
      $data = $this->__call('remove', array($params));
      return $data;
    }
  }

  /**
   * The "people" collection of methods.
   * Typical usage is:
   *  <code>
   *   $plusService = new displetretsidx_Google_PlusService(...);
   *   $people = $plusService->people;
   *  </code>
   */
  class displetretsidx_Google_PeopleServiceResource extends displetretsidx_Google_ServiceResource {


    /**
     * Get a person's profile. If your app uses scope https://www.googleapis.com/auth/plus.login, this
     * method is guaranteed to return ageRange and language. (people.get)
     *
     * @param string $userId The ID of the person to get the profile for. The special value "me" can be used to indicate the authenticated user.
     * @param array $optParams Optional parameters.
     * @return displetretsidx_Google_Person
     */
    public function get($userId, $optParams = array()) {
      $params = array('userId' => $userId);
      $params = array_merge($params, $optParams);
      $data = $this->__call('get', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_Person($data);
      } else {
        return $data;
      }
    }
    /**
     * List all of the people in the specified collection. (people.list)
     *
     * @param string $userId Get the collection of people for the person identified. Use "me" to indiciated the authenticated user.
     * @param string $collection The collection of people to list.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string maxResults The maximum number of people to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string orderBy The order to return people in.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response.
     * @return displetretsidx_Google_PeopleFeed
     */
    public function listPeople($userId, $collection, $optParams = array()) {
      $params = array('userId' => $userId, 'collection' => $collection);
      $params = array_merge($params, $optParams);
      $data = $this->__call('list', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_PeopleFeed($data);
      } else {
        return $data;
      }
    }
    /**
     * List all of the people in the specified collection for a particular activity.
     * (people.listByActivity)
     *
     * @param string $activityId The ID of the activity to get the list of people for.
     * @param string $collection The collection of people to list.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string maxResults The maximum number of people to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response.
     * @return displetretsidx_Google_PeopleFeed
     */
    public function listByActivity($activityId, $collection, $optParams = array()) {
      $params = array('activityId' => $activityId, 'collection' => $collection);
      $params = array_merge($params, $optParams);
      $data = $this->__call('listByActivity', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_PeopleFeed($data);
      } else {
        return $data;
      }
    }
    /**
     * Search all public profiles. (people.search)
     *
     * @param string $query Specify a query string for full text search of public text in all profiles.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string language Specify the preferred language to search with. See search language codes for available values.
     * @opt_param string maxResults The maximum number of people to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response. This token can be of any length.
     * @return displetretsidx_Google_PeopleFeed
     */
    public function search($query, $optParams = array()) {
      $params = array('query' => $query);
      $params = array_merge($params, $optParams);
      $data = $this->__call('search', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_PeopleFeed($data);
      } else {
        return $data;
      }
    }
  }

/**
 * Service definition for displetretsidx_Google_Plus (v1).
 *
 * <p>
 * The Google+ API enables developers to build on top of the Google+ platform.
 * </p>
 *
 * <p>
 * For more information about this service, see the
 * <a href="https://developers.google.com/+/api/" target="_blank">API Documentation</a>
 * </p>
 *
 * @author Google, Inc.
 */
class displetretsidx_Google_PlusService extends displetretsidx_Google_Service {
  public $activities;
  public $comments;
  public $moments;
  public $people;
  /**
   * Constructs the internal representation of the Plus service.
   *
   * @param displetretsidx_Google_Client $client
   */
  public function __construct(displetretsidx_Google_Client $client) {
    $this->servicePath = 'plus/v1/';
    $this->version = 'v1';
    $this->serviceName = 'plus';

    $client->addService($this->serviceName, $this->version);
    $this->activities = new displetretsidx_Google_ActivitiesServiceResource($this, $this->serviceName, 'activities', json_decode('{"methods": {"get": {"id": "plus.activities.get", "path": "activities/{activityId}", "httpMethod": "GET", "parameters": {"activityId": {"type": "string", "required": true, "location": "path"}}, "response": {"$ref": "Activity"}, "scopes": ["https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/plus.me"]}, "list": {"id": "plus.activities.list", "path": "people/{userId}/activities/{collection}", "httpMethod": "GET", "parameters": {"collection": {"type": "string", "required": true, "enum": ["public"], "location": "path"}, "maxResults": {"type": "integer", "default": "20", "format": "uint32", "minimum": "1", "maximum": "100", "location": "query"}, "pageToken": {"type": "string", "location": "query"}, "userId": {"type": "string", "required": true, "location": "path"}}, "response": {"$ref": "ActivityFeed"}, "scopes": ["https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/plus.me"]}, "search": {"id": "plus.activities.search", "path": "activities", "httpMethod": "GET", "parameters": {"language": {"type": "string", "default": "en-US", "location": "query"}, "maxResults": {"type": "integer", "default": "10", "format": "uint32", "minimum": "1", "maximum": "20", "location": "query"}, "orderBy": {"type": "string", "default": "recent", "enum": ["best", "recent"], "location": "query"}, "pageToken": {"type": "string", "location": "query"}, "query": {"type": "string", "required": true, "location": "query"}}, "response": {"$ref": "ActivityFeed"}, "scopes": ["https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/plus.me"]}}}', true));
    $this->comments = new displetretsidx_Google_CommentsServiceResource($this, $this->serviceName, 'comments', json_decode('{"methods": {"get": {"id": "plus.comments.get", "path": "comments/{commentId}", "httpMethod": "GET", "parameters": {"commentId": {"type": "string", "required": true, "location": "path"}}, "response": {"$ref": "Comment"}, "scopes": ["https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/plus.me"]}, "list": {"id": "plus.comments.list", "path": "activities/{activityId}/comments", "httpMethod": "GET", "parameters": {"activityId": {"type": "string", "required": true, "location": "path"}, "maxResults": {"type": "integer", "default": "20", "format": "uint32", "minimum": "0", "maximum": "500", "location": "query"}, "pageToken": {"type": "string", "location": "query"}, "sortOrder": {"type": "string", "default": "ascending", "enum": ["ascending", "descending"], "location": "query"}}, "response": {"$ref": "CommentFeed"}, "scopes": ["https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/plus.me"]}}}', true));
    $this->moments = new displetretsidx_Google_MomentsServiceResource($this, $this->serviceName, 'moments', json_decode('{"methods": {"insert": {"id": "plus.moments.insert", "path": "people/{userId}/moments/{collection}", "httpMethod": "POST", "parameters": {"collection": {"type": "string", "required": true, "enum": ["vault"], "location": "path"}, "debug": {"type": "boolean", "location": "query"}, "userId": {"type": "string", "required": true, "location": "path"}}, "request": {"$ref": "Moment"}, "response": {"$ref": "Moment"}, "scopes": ["https://www.googleapis.com/auth/plus.login"]}, "list": {"id": "plus.moments.list", "path": "people/{userId}/moments/{collection}", "httpMethod": "GET", "parameters": {"collection": {"type": "string", "required": true, "enum": ["vault"], "location": "path"}, "maxResults": {"type": "integer", "default": "20", "format": "uint32", "minimum": "1", "maximum": "100", "location": "query"}, "pageToken": {"type": "string", "location": "query"}, "targetUrl": {"type": "string", "location": "query"}, "type": {"type": "string", "location": "query"}, "userId": {"type": "string", "required": true, "location": "path"}}, "response": {"$ref": "MomentsFeed"}, "scopes": ["https://www.googleapis.com/auth/plus.login"]}, "remove": {"id": "plus.moments.remove", "path": "moments/{id}", "httpMethod": "DELETE", "parameters": {"id": {"type": "string", "required": true, "location": "path"}}, "scopes": ["https://www.googleapis.com/auth/plus.login"]}}}', true));
    $this->people = new displetretsidx_Google_PeopleServiceResource($this, $this->serviceName, 'people', json_decode('{"methods": {"get": {"id": "plus.people.get", "path": "people/{userId}", "httpMethod": "GET", "parameters": {"userId": {"type": "string", "required": true, "location": "path"}}, "response": {"$ref": "Person"}, "scopes": ["https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/plus.me"]}, "list": {"id": "plus.people.list", "path": "people/{userId}/people/{collection}", "httpMethod": "GET", "parameters": {"collection": {"type": "string", "required": true, "enum": ["visible"], "location": "path"}, "maxResults": {"type": "integer", "default": "100", "format": "uint32", "minimum": "1", "maximum": "100", "location": "query"}, "orderBy": {"type": "string", "enum": ["alphabetical", "best"], "location": "query"}, "pageToken": {"type": "string", "location": "query"}, "userId": {"type": "string", "required": true, "location": "path"}}, "response": {"$ref": "PeopleFeed"}, "scopes": ["https://www.googleapis.com/auth/plus.login"]}, "listByActivity": {"id": "plus.people.listByActivity", "path": "activities/{activityId}/people/{collection}", "httpMethod": "GET", "parameters": {"activityId": {"type": "string", "required": true, "location": "path"}, "collection": {"type": "string", "required": true, "enum": ["plusoners", "resharers"], "location": "path"}, "maxResults": {"type": "integer", "default": "20", "format": "uint32", "minimum": "1", "maximum": "100", "location": "query"}, "pageToken": {"type": "string", "location": "query"}}, "response": {"$ref": "PeopleFeed"}, "scopes": ["https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/plus.me"]}, "search": {"id": "plus.people.search", "path": "people", "httpMethod": "GET", "parameters": {"language": {"type": "string", "default": "en-US", "location": "query"}, "maxResults": {"type": "integer", "default": "10", "format": "uint32", "minimum": "1", "maximum": "20", "location": "query"}, "pageToken": {"type": "string", "location": "query"}, "query": {"type": "string", "required": true, "location": "query"}}, "response": {"$ref": "PeopleFeed"}, "scopes": ["https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/plus.me"]}}}', true));

  }
}

class displetretsidx_Google_Acl extends displetretsidx_Google_Model {
  public $description;
  protected $__itemsType = 'displetretsidx_Google_PlusAclentryResource';
  protected $__itemsDataType = 'array';
  public $items;
  public $kind;
  public function setDescription($description) {
    $this->description = $description;
  }
  public function getDescription() {
    return $this->description;
  }
  public function setItems(/* array(displetretsidx_Google_PlusAclentryResource) */ $items) {
    $this->assertIsArray($items, 'displetretsidx_Google_PlusAclentryResource', __METHOD__);
    $this->items = $items;
  }
  public function getItems() {
    return $this->items;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
}

class displetretsidx_Google_Activity extends displetretsidx_Google_Model {
  protected $__accessType = 'displetretsidx_Google_Acl';
  protected $__accessDataType = '';
  public $access;
  protected $__actorType = 'displetretsidx_Google_ActivityActor';
  protected $__actorDataType = '';
  public $actor;
  public $address;
  public $annotation;
  public $crosspostSource;
  public $etag;
  public $geocode;
  public $id;
  public $kind;
  protected $__objectType = 'displetretsidx_Google_ActivityObject';
  protected $__objectDataType = '';
  public $object;
  public $placeId;
  public $placeName;
  protected $__providerType = 'displetretsidx_Google_ActivityProvider';
  protected $__providerDataType = '';
  public $provider;
  public $published;
  public $radius;
  public $title;
  public $updated;
  public $url;
  public $verb;
  public function setAccess(displetretsidx_Google_Acl $access) {
    $this->access = $access;
  }
  public function getAccess() {
    return $this->access;
  }
  public function setActor(displetretsidx_Google_ActivityActor $actor) {
    $this->actor = $actor;
  }
  public function getActor() {
    return $this->actor;
  }
  public function setAddress($address) {
    $this->address = $address;
  }
  public function getAddress() {
    return $this->address;
  }
  public function setAnnotation($annotation) {
    $this->annotation = $annotation;
  }
  public function getAnnotation() {
    return $this->annotation;
  }
  public function setCrosspostSource($crosspostSource) {
    $this->crosspostSource = $crosspostSource;
  }
  public function getCrosspostSource() {
    return $this->crosspostSource;
  }
  public function setEtag($etag) {
    $this->etag = $etag;
  }
  public function getEtag() {
    return $this->etag;
  }
  public function setGeocode($geocode) {
    $this->geocode = $geocode;
  }
  public function getGeocode() {
    return $this->geocode;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setObject(displetretsidx_Google_ActivityObject $object) {
    $this->object = $object;
  }
  public function getObject() {
    return $this->object;
  }
  public function setPlaceId($placeId) {
    $this->placeId = $placeId;
  }
  public function getPlaceId() {
    return $this->placeId;
  }
  public function setPlaceName($placeName) {
    $this->placeName = $placeName;
  }
  public function getPlaceName() {
    return $this->placeName;
  }
  public function setProvider(displetretsidx_Google_ActivityProvider $provider) {
    $this->provider = $provider;
  }
  public function getProvider() {
    return $this->provider;
  }
  public function setPublished($published) {
    $this->published = $published;
  }
  public function getPublished() {
    return $this->published;
  }
  public function setRadius($radius) {
    $this->radius = $radius;
  }
  public function getRadius() {
    return $this->radius;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function getTitle() {
    return $this->title;
  }
  public function setUpdated($updated) {
    $this->updated = $updated;
  }
  public function getUpdated() {
    return $this->updated;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
  public function setVerb($verb) {
    $this->verb = $verb;
  }
  public function getVerb() {
    return $this->verb;
  }
}

class displetretsidx_Google_ActivityActor extends displetretsidx_Google_Model {
  public $displayName;
  public $id;
  protected $__imageType = 'displetretsidx_Google_ActivityActorImage';
  protected $__imageDataType = '';
  public $image;
  protected $__nameType = 'displetretsidx_Google_ActivityActorName';
  protected $__nameDataType = '';
  public $name;
  public $url;
  public function setDisplayName($displayName) {
    $this->displayName = $displayName;
  }
  public function getDisplayName() {
    return $this->displayName;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setImage(displetretsidx_Google_ActivityActorImage $image) {
    $this->image = $image;
  }
  public function getImage() {
    return $this->image;
  }
  public function setName(displetretsidx_Google_ActivityActorName $name) {
    $this->name = $name;
  }
  public function getName() {
    return $this->name;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_ActivityActorImage extends displetretsidx_Google_Model {
  public $url;
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_ActivityActorName extends displetretsidx_Google_Model {
  public $familyName;
  public $givenName;
  public function setFamilyName($familyName) {
    $this->familyName = $familyName;
  }
  public function getFamilyName() {
    return $this->familyName;
  }
  public function setGivenName($givenName) {
    $this->givenName = $givenName;
  }
  public function getGivenName() {
    return $this->givenName;
  }
}

class displetretsidx_Google_ActivityFeed extends displetretsidx_Google_Model {
  public $etag;
  public $id;
  protected $__itemsType = 'displetretsidx_Google_Activity';
  protected $__itemsDataType = 'array';
  public $items;
  public $kind;
  public $nextLink;
  public $nextPageToken;
  public $selfLink;
  public $title;
  public $updated;
  public function setEtag($etag) {
    $this->etag = $etag;
  }
  public function getEtag() {
    return $this->etag;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setItems(/* array(displetretsidx_Google_Activity) */ $items) {
    $this->assertIsArray($items, 'displetretsidx_Google_Activity', __METHOD__);
    $this->items = $items;
  }
  public function getItems() {
    return $this->items;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setNextLink($nextLink) {
    $this->nextLink = $nextLink;
  }
  public function getNextLink() {
    return $this->nextLink;
  }
  public function setNextPageToken($nextPageToken) {
    $this->nextPageToken = $nextPageToken;
  }
  public function getNextPageToken() {
    return $this->nextPageToken;
  }
  public function setSelfLink($selfLink) {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink() {
    return $this->selfLink;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function getTitle() {
    return $this->title;
  }
  public function setUpdated($updated) {
    $this->updated = $updated;
  }
  public function getUpdated() {
    return $this->updated;
  }
}

class displetretsidx_Google_ActivityObject extends displetretsidx_Google_Model {
  protected $__actorType = 'displetretsidx_Google_ActivityObjectActor';
  protected $__actorDataType = '';
  public $actor;
  protected $__attachmentsType = 'displetretsidx_Google_ActivityObjectAttachments';
  protected $__attachmentsDataType = 'array';
  public $attachments;
  public $content;
  public $id;
  public $objectType;
  public $originalContent;
  protected $__plusonersType = 'displetretsidx_Google_ActivityObjectPlusoners';
  protected $__plusonersDataType = '';
  public $plusoners;
  protected $__repliesType = 'displetretsidx_Google_ActivityObjectReplies';
  protected $__repliesDataType = '';
  public $replies;
  protected $__resharersType = 'displetretsidx_Google_ActivityObjectResharers';
  protected $__resharersDataType = '';
  public $resharers;
  public $url;
  public function setActor(displetretsidx_Google_ActivityObjectActor $actor) {
    $this->actor = $actor;
  }
  public function getActor() {
    return $this->actor;
  }
  public function setAttachments(/* array(displetretsidx_Google_ActivityObjectAttachments) */ $attachments) {
    $this->assertIsArray($attachments, 'displetretsidx_Google_ActivityObjectAttachments', __METHOD__);
    $this->attachments = $attachments;
  }
  public function getAttachments() {
    return $this->attachments;
  }
  public function setContent($content) {
    $this->content = $content;
  }
  public function getContent() {
    return $this->content;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setObjectType($objectType) {
    $this->objectType = $objectType;
  }
  public function getObjectType() {
    return $this->objectType;
  }
  public function setOriginalContent($originalContent) {
    $this->originalContent = $originalContent;
  }
  public function getOriginalContent() {
    return $this->originalContent;
  }
  public function setPlusoners(displetretsidx_Google_ActivityObjectPlusoners $plusoners) {
    $this->plusoners = $plusoners;
  }
  public function getPlusoners() {
    return $this->plusoners;
  }
  public function setReplies(displetretsidx_Google_ActivityObjectReplies $replies) {
    $this->replies = $replies;
  }
  public function getReplies() {
    return $this->replies;
  }
  public function setResharers(displetretsidx_Google_ActivityObjectResharers $resharers) {
    $this->resharers = $resharers;
  }
  public function getResharers() {
    return $this->resharers;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_ActivityObjectActor extends displetretsidx_Google_Model {
  public $displayName;
  public $id;
  protected $__imageType = 'displetretsidx_Google_ActivityObjectActorImage';
  protected $__imageDataType = '';
  public $image;
  public $url;
  public function setDisplayName($displayName) {
    $this->displayName = $displayName;
  }
  public function getDisplayName() {
    return $this->displayName;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setImage(displetretsidx_Google_ActivityObjectActorImage $image) {
    $this->image = $image;
  }
  public function getImage() {
    return $this->image;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_ActivityObjectActorImage extends displetretsidx_Google_Model {
  public $url;
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_ActivityObjectAttachments extends displetretsidx_Google_Model {
  public $content;
  public $displayName;
  protected $__embedType = 'displetretsidx_Google_ActivityObjectAttachmentsEmbed';
  protected $__embedDataType = '';
  public $embed;
  protected $__fullImageType = 'displetretsidx_Google_ActivityObjectAttachmentsFullImage';
  protected $__fullImageDataType = '';
  public $fullImage;
  public $id;
  protected $__imageType = 'displetretsidx_Google_ActivityObjectAttachmentsImage';
  protected $__imageDataType = '';
  public $image;
  public $objectType;
  protected $__thumbnailsType = 'displetretsidx_Google_ActivityObjectAttachmentsThumbnails';
  protected $__thumbnailsDataType = 'array';
  public $thumbnails;
  public $url;
  public function setContent($content) {
    $this->content = $content;
  }
  public function getContent() {
    return $this->content;
  }
  public function setDisplayName($displayName) {
    $this->displayName = $displayName;
  }
  public function getDisplayName() {
    return $this->displayName;
  }
  public function setEmbed(displetretsidx_Google_ActivityObjectAttachmentsEmbed $embed) {
    $this->embed = $embed;
  }
  public function getEmbed() {
    return $this->embed;
  }
  public function setFullImage(displetretsidx_Google_ActivityObjectAttachmentsFullImage $fullImage) {
    $this->fullImage = $fullImage;
  }
  public function getFullImage() {
    return $this->fullImage;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setImage(displetretsidx_Google_ActivityObjectAttachmentsImage $image) {
    $this->image = $image;
  }
  public function getImage() {
    return $this->image;
  }
  public function setObjectType($objectType) {
    $this->objectType = $objectType;
  }
  public function getObjectType() {
    return $this->objectType;
  }
  public function setThumbnails(/* array(displetretsidx_Google_ActivityObjectAttachmentsThumbnails) */ $thumbnails) {
    $this->assertIsArray($thumbnails, 'displetretsidx_Google_ActivityObjectAttachmentsThumbnails', __METHOD__);
    $this->thumbnails = $thumbnails;
  }
  public function getThumbnails() {
    return $this->thumbnails;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_ActivityObjectAttachmentsEmbed extends displetretsidx_Google_Model {
  public $type;
  public $url;
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_ActivityObjectAttachmentsFullImage extends displetretsidx_Google_Model {
  public $height;
  public $type;
  public $url;
  public $width;
  public function setHeight($height) {
    $this->height = $height;
  }
  public function getHeight() {
    return $this->height;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
  public function setWidth($width) {
    $this->width = $width;
  }
  public function getWidth() {
    return $this->width;
  }
}

class displetretsidx_Google_ActivityObjectAttachmentsImage extends displetretsidx_Google_Model {
  public $height;
  public $type;
  public $url;
  public $width;
  public function setHeight($height) {
    $this->height = $height;
  }
  public function getHeight() {
    return $this->height;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
  public function setWidth($width) {
    $this->width = $width;
  }
  public function getWidth() {
    return $this->width;
  }
}

class displetretsidx_Google_ActivityObjectAttachmentsThumbnails extends displetretsidx_Google_Model {
  public $description;
  protected $__imageType = 'displetretsidx_Google_ActivityObjectAttachmentsThumbnailsImage';
  protected $__imageDataType = '';
  public $image;
  public $url;
  public function setDescription($description) {
    $this->description = $description;
  }
  public function getDescription() {
    return $this->description;
  }
  public function setImage(displetretsidx_Google_ActivityObjectAttachmentsThumbnailsImage $image) {
    $this->image = $image;
  }
  public function getImage() {
    return $this->image;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_ActivityObjectAttachmentsThumbnailsImage extends displetretsidx_Google_Model {
  public $height;
  public $type;
  public $url;
  public $width;
  public function setHeight($height) {
    $this->height = $height;
  }
  public function getHeight() {
    return $this->height;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
  public function setWidth($width) {
    $this->width = $width;
  }
  public function getWidth() {
    return $this->width;
  }
}

class displetretsidx_Google_ActivityObjectPlusoners extends displetretsidx_Google_Model {
  public $selfLink;
  public $totalItems;
  public function setSelfLink($selfLink) {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink() {
    return $this->selfLink;
  }
  public function setTotalItems($totalItems) {
    $this->totalItems = $totalItems;
  }
  public function getTotalItems() {
    return $this->totalItems;
  }
}

class displetretsidx_Google_ActivityObjectReplies extends displetretsidx_Google_Model {
  public $selfLink;
  public $totalItems;
  public function setSelfLink($selfLink) {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink() {
    return $this->selfLink;
  }
  public function setTotalItems($totalItems) {
    $this->totalItems = $totalItems;
  }
  public function getTotalItems() {
    return $this->totalItems;
  }
}

class displetretsidx_Google_ActivityObjectResharers extends displetretsidx_Google_Model {
  public $selfLink;
  public $totalItems;
  public function setSelfLink($selfLink) {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink() {
    return $this->selfLink;
  }
  public function setTotalItems($totalItems) {
    $this->totalItems = $totalItems;
  }
  public function getTotalItems() {
    return $this->totalItems;
  }
}

class displetretsidx_Google_ActivityProvider extends displetretsidx_Google_Model {
  public $title;
  public function setTitle($title) {
    $this->title = $title;
  }
  public function getTitle() {
    return $this->title;
  }
}

class displetretsidx_Google_Comment extends displetretsidx_Google_Model {
  protected $__actorType = 'displetretsidx_Google_CommentActor';
  protected $__actorDataType = '';
  public $actor;
  public $etag;
  public $id;
  protected $__inReplyToType = 'displetretsidx_Google_CommentInReplyTo';
  protected $__inReplyToDataType = 'array';
  public $inReplyTo;
  public $kind;
  protected $__objectType = 'displetretsidx_Google_CommentObject';
  protected $__objectDataType = '';
  public $object;
  protected $__plusonersType = 'displetretsidx_Google_CommentPlusoners';
  protected $__plusonersDataType = '';
  public $plusoners;
  public $published;
  public $selfLink;
  public $updated;
  public $verb;
  public function setActor(displetretsidx_Google_CommentActor $actor) {
    $this->actor = $actor;
  }
  public function getActor() {
    return $this->actor;
  }
  public function setEtag($etag) {
    $this->etag = $etag;
  }
  public function getEtag() {
    return $this->etag;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setInReplyTo(/* array(displetretsidx_Google_CommentInReplyTo) */ $inReplyTo) {
    $this->assertIsArray($inReplyTo, 'displetretsidx_Google_CommentInReplyTo', __METHOD__);
    $this->inReplyTo = $inReplyTo;
  }
  public function getInReplyTo() {
    return $this->inReplyTo;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setObject(displetretsidx_Google_CommentObject $object) {
    $this->object = $object;
  }
  public function getObject() {
    return $this->object;
  }
  public function setPlusoners(displetretsidx_Google_CommentPlusoners $plusoners) {
    $this->plusoners = $plusoners;
  }
  public function getPlusoners() {
    return $this->plusoners;
  }
  public function setPublished($published) {
    $this->published = $published;
  }
  public function getPublished() {
    return $this->published;
  }
  public function setSelfLink($selfLink) {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink() {
    return $this->selfLink;
  }
  public function setUpdated($updated) {
    $this->updated = $updated;
  }
  public function getUpdated() {
    return $this->updated;
  }
  public function setVerb($verb) {
    $this->verb = $verb;
  }
  public function getVerb() {
    return $this->verb;
  }
}

class displetretsidx_Google_CommentActor extends displetretsidx_Google_Model {
  public $displayName;
  public $id;
  protected $__imageType = 'displetretsidx_Google_CommentActorImage';
  protected $__imageDataType = '';
  public $image;
  public $url;
  public function setDisplayName($displayName) {
    $this->displayName = $displayName;
  }
  public function getDisplayName() {
    return $this->displayName;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setImage(displetretsidx_Google_CommentActorImage $image) {
    $this->image = $image;
  }
  public function getImage() {
    return $this->image;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_CommentActorImage extends displetretsidx_Google_Model {
  public $url;
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_CommentFeed extends displetretsidx_Google_Model {
  public $etag;
  public $id;
  protected $__itemsType = 'displetretsidx_Google_Comment';
  protected $__itemsDataType = 'array';
  public $items;
  public $kind;
  public $nextLink;
  public $nextPageToken;
  public $title;
  public $updated;
  public function setEtag($etag) {
    $this->etag = $etag;
  }
  public function getEtag() {
    return $this->etag;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setItems(/* array(displetretsidx_Google_Comment) */ $items) {
    $this->assertIsArray($items, 'displetretsidx_Google_Comment', __METHOD__);
    $this->items = $items;
  }
  public function getItems() {
    return $this->items;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setNextLink($nextLink) {
    $this->nextLink = $nextLink;
  }
  public function getNextLink() {
    return $this->nextLink;
  }
  public function setNextPageToken($nextPageToken) {
    $this->nextPageToken = $nextPageToken;
  }
  public function getNextPageToken() {
    return $this->nextPageToken;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function getTitle() {
    return $this->title;
  }
  public function setUpdated($updated) {
    $this->updated = $updated;
  }
  public function getUpdated() {
    return $this->updated;
  }
}

class displetretsidx_Google_CommentInReplyTo extends displetretsidx_Google_Model {
  public $id;
  public $url;
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_CommentObject extends displetretsidx_Google_Model {
  public $content;
  public $objectType;
  public $originalContent;
  public function setContent($content) {
    $this->content = $content;
  }
  public function getContent() {
    return $this->content;
  }
  public function setObjectType($objectType) {
    $this->objectType = $objectType;
  }
  public function getObjectType() {
    return $this->objectType;
  }
  public function setOriginalContent($originalContent) {
    $this->originalContent = $originalContent;
  }
  public function getOriginalContent() {
    return $this->originalContent;
  }
}

class displetretsidx_Google_CommentPlusoners extends displetretsidx_Google_Model {
  public $totalItems;
  public function setTotalItems($totalItems) {
    $this->totalItems = $totalItems;
  }
  public function getTotalItems() {
    return $this->totalItems;
  }
}

class displetretsidx_Google_ItemScope extends displetretsidx_Google_Model {
  protected $__aboutType = 'displetretsidx_Google_ItemScope';
  protected $__aboutDataType = '';
  public $about;
  public $additionalName;
  protected $__addressType = 'displetretsidx_Google_ItemScope';
  protected $__addressDataType = '';
  public $address;
  public $addressCountry;
  public $addressLocality;
  public $addressRegion;
  protected $__associated_mediaType = 'displetretsidx_Google_ItemScope';
  protected $__associated_mediaDataType = 'array';
  public $associated_media;
  public $attendeeCount;
  protected $__attendeesType = 'displetretsidx_Google_ItemScope';
  protected $__attendeesDataType = 'array';
  public $attendees;
  protected $__audioType = 'displetretsidx_Google_ItemScope';
  protected $__audioDataType = '';
  public $audio;
  protected $__authorType = 'displetretsidx_Google_ItemScope';
  protected $__authorDataType = 'array';
  public $author;
  public $bestRating;
  public $birthDate;
  protected $__byArtistType = 'displetretsidx_Google_ItemScope';
  protected $__byArtistDataType = '';
  public $byArtist;
  public $caption;
  public $contentSize;
  public $contentUrl;
  protected $__contributorType = 'displetretsidx_Google_ItemScope';
  protected $__contributorDataType = 'array';
  public $contributor;
  public $dateCreated;
  public $dateModified;
  public $datePublished;
  public $description;
  public $duration;
  public $embedUrl;
  public $endDate;
  public $familyName;
  public $gender;
  protected $__geoType = 'displetretsidx_Google_ItemScope';
  protected $__geoDataType = '';
  public $geo;
  public $givenName;
  public $height;
  public $id;
  public $image;
  protected $__inAlbumType = 'displetretsidx_Google_ItemScope';
  protected $__inAlbumDataType = '';
  public $inAlbum;
  public $kind;
  public $latitude;
  protected $__locationType = 'displetretsidx_Google_ItemScope';
  protected $__locationDataType = '';
  public $location;
  public $longitude;
  public $name;
  protected $__partOfTVSeriesType = 'displetretsidx_Google_ItemScope';
  protected $__partOfTVSeriesDataType = '';
  public $partOfTVSeries;
  protected $__performersType = 'displetretsidx_Google_ItemScope';
  protected $__performersDataType = 'array';
  public $performers;
  public $playerType;
  public $postOfficeBoxNumber;
  public $postalCode;
  public $ratingValue;
  protected $__reviewRatingType = 'displetretsidx_Google_ItemScope';
  protected $__reviewRatingDataType = '';
  public $reviewRating;
  public $startDate;
  public $streetAddress;
  public $text;
  protected $__thumbnailType = 'displetretsidx_Google_ItemScope';
  protected $__thumbnailDataType = '';
  public $thumbnail;
  public $thumbnailUrl;
  public $tickerSymbol;
  public $type;
  public $url;
  public $width;
  public $worstRating;
  public function setAbout(displetretsidx_Google_ItemScope $about) {
    $this->about = $about;
  }
  public function getAbout() {
    return $this->about;
  }
  public function setAdditionalName(/* array(displetretsidx_Google_string) */ $additionalName) {
    $this->assertIsArray($additionalName, 'displetretsidx_Google_string', __METHOD__);
    $this->additionalName = $additionalName;
  }
  public function getAdditionalName() {
    return $this->additionalName;
  }
  public function setAddress(displetretsidx_Google_ItemScope $address) {
    $this->address = $address;
  }
  public function getAddress() {
    return $this->address;
  }
  public function setAddressCountry($addressCountry) {
    $this->addressCountry = $addressCountry;
  }
  public function getAddressCountry() {
    return $this->addressCountry;
  }
  public function setAddressLocality($addressLocality) {
    $this->addressLocality = $addressLocality;
  }
  public function getAddressLocality() {
    return $this->addressLocality;
  }
  public function setAddressRegion($addressRegion) {
    $this->addressRegion = $addressRegion;
  }
  public function getAddressRegion() {
    return $this->addressRegion;
  }
  public function setAssociated_media(/* array(displetretsidx_Google_ItemScope) */ $associated_media) {
    $this->assertIsArray($associated_media, 'displetretsidx_Google_ItemScope', __METHOD__);
    $this->associated_media = $associated_media;
  }
  public function getAssociated_media() {
    return $this->associated_media;
  }
  public function setAttendeeCount($attendeeCount) {
    $this->attendeeCount = $attendeeCount;
  }
  public function getAttendeeCount() {
    return $this->attendeeCount;
  }
  public function setAttendees(/* array(displetretsidx_Google_ItemScope) */ $attendees) {
    $this->assertIsArray($attendees, 'displetretsidx_Google_ItemScope', __METHOD__);
    $this->attendees = $attendees;
  }
  public function getAttendees() {
    return $this->attendees;
  }
  public function setAudio(displetretsidx_Google_ItemScope $audio) {
    $this->audio = $audio;
  }
  public function getAudio() {
    return $this->audio;
  }
  public function setAuthor(/* array(displetretsidx_Google_ItemScope) */ $author) {
    $this->assertIsArray($author, 'displetretsidx_Google_ItemScope', __METHOD__);
    $this->author = $author;
  }
  public function getAuthor() {
    return $this->author;
  }
  public function setBestRating($bestRating) {
    $this->bestRating = $bestRating;
  }
  public function getBestRating() {
    return $this->bestRating;
  }
  public function setBirthDate($birthDate) {
    $this->birthDate = $birthDate;
  }
  public function getBirthDate() {
    return $this->birthDate;
  }
  public function setByArtist(displetretsidx_Google_ItemScope $byArtist) {
    $this->byArtist = $byArtist;
  }
  public function getByArtist() {
    return $this->byArtist;
  }
  public function setCaption($caption) {
    $this->caption = $caption;
  }
  public function getCaption() {
    return $this->caption;
  }
  public function setContentSize($contentSize) {
    $this->contentSize = $contentSize;
  }
  public function getContentSize() {
    return $this->contentSize;
  }
  public function setContentUrl($contentUrl) {
    $this->contentUrl = $contentUrl;
  }
  public function getContentUrl() {
    return $this->contentUrl;
  }
  public function setContributor(/* array(displetretsidx_Google_ItemScope) */ $contributor) {
    $this->assertIsArray($contributor, 'displetretsidx_Google_ItemScope', __METHOD__);
    $this->contributor = $contributor;
  }
  public function getContributor() {
    return $this->contributor;
  }
  public function setDateCreated($dateCreated) {
    $this->dateCreated = $dateCreated;
  }
  public function getDateCreated() {
    return $this->dateCreated;
  }
  public function setDateModified($dateModified) {
    $this->dateModified = $dateModified;
  }
  public function getDateModified() {
    return $this->dateModified;
  }
  public function setDatePublished($datePublished) {
    $this->datePublished = $datePublished;
  }
  public function getDatePublished() {
    return $this->datePublished;
  }
  public function setDescription($description) {
    $this->description = $description;
  }
  public function getDescription() {
    return $this->description;
  }
  public function setDuration($duration) {
    $this->duration = $duration;
  }
  public function getDuration() {
    return $this->duration;
  }
  public function setEmbedUrl($embedUrl) {
    $this->embedUrl = $embedUrl;
  }
  public function getEmbedUrl() {
    return $this->embedUrl;
  }
  public function setEndDate($endDate) {
    $this->endDate = $endDate;
  }
  public function getEndDate() {
    return $this->endDate;
  }
  public function setFamilyName($familyName) {
    $this->familyName = $familyName;
  }
  public function getFamilyName() {
    return $this->familyName;
  }
  public function setGender($gender) {
    $this->gender = $gender;
  }
  public function getGender() {
    return $this->gender;
  }
  public function setGeo(displetretsidx_Google_ItemScope $geo) {
    $this->geo = $geo;
  }
  public function getGeo() {
    return $this->geo;
  }
  public function setGivenName($givenName) {
    $this->givenName = $givenName;
  }
  public function getGivenName() {
    return $this->givenName;
  }
  public function setHeight($height) {
    $this->height = $height;
  }
  public function getHeight() {
    return $this->height;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setImage($image) {
    $this->image = $image;
  }
  public function getImage() {
    return $this->image;
  }
  public function setInAlbum(displetretsidx_Google_ItemScope $inAlbum) {
    $this->inAlbum = $inAlbum;
  }
  public function getInAlbum() {
    return $this->inAlbum;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setLatitude($latitude) {
    $this->latitude = $latitude;
  }
  public function getLatitude() {
    return $this->latitude;
  }
  public function setLocation(displetretsidx_Google_ItemScope $location) {
    $this->location = $location;
  }
  public function getLocation() {
    return $this->location;
  }
  public function setLongitude($longitude) {
    $this->longitude = $longitude;
  }
  public function getLongitude() {
    return $this->longitude;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function getName() {
    return $this->name;
  }
  public function setPartOfTVSeries(displetretsidx_Google_ItemScope $partOfTVSeries) {
    $this->partOfTVSeries = $partOfTVSeries;
  }
  public function getPartOfTVSeries() {
    return $this->partOfTVSeries;
  }
  public function setPerformers(/* array(displetretsidx_Google_ItemScope) */ $performers) {
    $this->assertIsArray($performers, 'displetretsidx_Google_ItemScope', __METHOD__);
    $this->performers = $performers;
  }
  public function getPerformers() {
    return $this->performers;
  }
  public function setPlayerType($playerType) {
    $this->playerType = $playerType;
  }
  public function getPlayerType() {
    return $this->playerType;
  }
  public function setPostOfficeBoxNumber($postOfficeBoxNumber) {
    $this->postOfficeBoxNumber = $postOfficeBoxNumber;
  }
  public function getPostOfficeBoxNumber() {
    return $this->postOfficeBoxNumber;
  }
  public function setPostalCode($postalCode) {
    $this->postalCode = $postalCode;
  }
  public function getPostalCode() {
    return $this->postalCode;
  }
  public function setRatingValue($ratingValue) {
    $this->ratingValue = $ratingValue;
  }
  public function getRatingValue() {
    return $this->ratingValue;
  }
  public function setReviewRating(displetretsidx_Google_ItemScope $reviewRating) {
    $this->reviewRating = $reviewRating;
  }
  public function getReviewRating() {
    return $this->reviewRating;
  }
  public function setStartDate($startDate) {
    $this->startDate = $startDate;
  }
  public function getStartDate() {
    return $this->startDate;
  }
  public function setStreetAddress($streetAddress) {
    $this->streetAddress = $streetAddress;
  }
  public function getStreetAddress() {
    return $this->streetAddress;
  }
  public function setText($text) {
    $this->text = $text;
  }
  public function getText() {
    return $this->text;
  }
  public function setThumbnail(displetretsidx_Google_ItemScope $thumbnail) {
    $this->thumbnail = $thumbnail;
  }
  public function getThumbnail() {
    return $this->thumbnail;
  }
  public function setThumbnailUrl($thumbnailUrl) {
    $this->thumbnailUrl = $thumbnailUrl;
  }
  public function getThumbnailUrl() {
    return $this->thumbnailUrl;
  }
  public function setTickerSymbol($tickerSymbol) {
    $this->tickerSymbol = $tickerSymbol;
  }
  public function getTickerSymbol() {
    return $this->tickerSymbol;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
  public function setWidth($width) {
    $this->width = $width;
  }
  public function getWidth() {
    return $this->width;
  }
  public function setWorstRating($worstRating) {
    $this->worstRating = $worstRating;
  }
  public function getWorstRating() {
    return $this->worstRating;
  }
}

class displetretsidx_Google_Moment extends displetretsidx_Google_Model {
  public $id;
  public $kind;
  protected $__resultType = 'displetretsidx_Google_ItemScope';
  protected $__resultDataType = '';
  public $result;
  public $startDate;
  protected $__targetType = 'displetretsidx_Google_ItemScope';
  protected $__targetDataType = '';
  public $target;
  public $type;
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setResult(displetretsidx_Google_ItemScope $result) {
    $this->result = $result;
  }
  public function getResult() {
    return $this->result;
  }
  public function setStartDate($startDate) {
    $this->startDate = $startDate;
  }
  public function getStartDate() {
    return $this->startDate;
  }
  public function setTarget(displetretsidx_Google_ItemScope $target) {
    $this->target = $target;
  }
  public function getTarget() {
    return $this->target;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
}

class displetretsidx_Google_MomentsFeed extends displetretsidx_Google_Model {
  public $etag;
  protected $__itemsType = 'displetretsidx_Google_Moment';
  protected $__itemsDataType = 'array';
  public $items;
  public $kind;
  public $nextLink;
  public $nextPageToken;
  public $selfLink;
  public $title;
  public $updated;
  public function setEtag($etag) {
    $this->etag = $etag;
  }
  public function getEtag() {
    return $this->etag;
  }
  public function setItems(/* array(displetretsidx_Google_Moment) */ $items) {
    $this->assertIsArray($items, 'displetretsidx_Google_Moment', __METHOD__);
    $this->items = $items;
  }
  public function getItems() {
    return $this->items;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setNextLink($nextLink) {
    $this->nextLink = $nextLink;
  }
  public function getNextLink() {
    return $this->nextLink;
  }
  public function setNextPageToken($nextPageToken) {
    $this->nextPageToken = $nextPageToken;
  }
  public function getNextPageToken() {
    return $this->nextPageToken;
  }
  public function setSelfLink($selfLink) {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink() {
    return $this->selfLink;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function getTitle() {
    return $this->title;
  }
  public function setUpdated($updated) {
    $this->updated = $updated;
  }
  public function getUpdated() {
    return $this->updated;
  }
}

class displetretsidx_Google_PeopleFeed extends displetretsidx_Google_Model {
  public $etag;
  protected $__itemsType = 'displetretsidx_Google_Person';
  protected $__itemsDataType = 'array';
  public $items;
  public $kind;
  public $nextPageToken;
  public $selfLink;
  public $title;
  public $totalItems;
  public function setEtag($etag) {
    $this->etag = $etag;
  }
  public function getEtag() {
    return $this->etag;
  }
  public function setItems(/* array(displetretsidx_Google_Person) */ $items) {
    $this->assertIsArray($items, 'displetretsidx_Google_Person', __METHOD__);
    $this->items = $items;
  }
  public function getItems() {
    return $this->items;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setNextPageToken($nextPageToken) {
    $this->nextPageToken = $nextPageToken;
  }
  public function getNextPageToken() {
    return $this->nextPageToken;
  }
  public function setSelfLink($selfLink) {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink() {
    return $this->selfLink;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function getTitle() {
    return $this->title;
  }
  public function setTotalItems($totalItems) {
    $this->totalItems = $totalItems;
  }
  public function getTotalItems() {
    return $this->totalItems;
  }
}

class displetretsidx_Google_Person extends displetretsidx_Google_Model {
  public $aboutMe;
  protected $__ageRangeType = 'displetretsidx_Google_PersonAgeRange';
  protected $__ageRangeDataType = '';
  public $ageRange;
  public $birthday;
  public $braggingRights;
  public $circledByCount;
  protected $__coverType = 'displetretsidx_Google_PersonCover';
  protected $__coverDataType = '';
  public $cover;
  public $currentLocation;
  public $displayName;
  protected $__emailsType = 'displetretsidx_Google_PersonEmails';
  protected $__emailsDataType = 'array';
  public $emails;
  public $etag;
  public $gender;
  public $hasApp;
  public $id;
  protected $__imageType = 'displetretsidx_Google_PersonImage';
  protected $__imageDataType = '';
  public $image;
  public $isPlusUser;
  public $kind;
  public $language;
  protected $__nameType = 'displetretsidx_Google_PersonName';
  protected $__nameDataType = '';
  public $name;
  public $nickname;
  public $objectType;
  protected $__organizationsType = 'displetretsidx_Google_PersonOrganizations';
  protected $__organizationsDataType = 'array';
  public $organizations;
  protected $__placesLivedType = 'displetretsidx_Google_PersonPlacesLived';
  protected $__placesLivedDataType = 'array';
  public $placesLived;
  public $plusOneCount;
  public $relationshipStatus;
  public $tagline;
  public $url;
  protected $__urlsType = 'displetretsidx_Google_PersonUrls';
  protected $__urlsDataType = 'array';
  public $urls;
  public $verified;
  public function setAboutMe($aboutMe) {
    $this->aboutMe = $aboutMe;
  }
  public function getAboutMe() {
    return $this->aboutMe;
  }
  public function setAgeRange(displetretsidx_Google_PersonAgeRange $ageRange) {
    $this->ageRange = $ageRange;
  }
  public function getAgeRange() {
    return $this->ageRange;
  }
  public function setBirthday($birthday) {
    $this->birthday = $birthday;
  }
  public function getBirthday() {
    return $this->birthday;
  }
  public function setBraggingRights($braggingRights) {
    $this->braggingRights = $braggingRights;
  }
  public function getBraggingRights() {
    return $this->braggingRights;
  }
  public function setCircledByCount($circledByCount) {
    $this->circledByCount = $circledByCount;
  }
  public function getCircledByCount() {
    return $this->circledByCount;
  }
  public function setCover(displetretsidx_Google_PersonCover $cover) {
    $this->cover = $cover;
  }
  public function getCover() {
    return $this->cover;
  }
  public function setCurrentLocation($currentLocation) {
    $this->currentLocation = $currentLocation;
  }
  public function getCurrentLocation() {
    return $this->currentLocation;
  }
  public function setDisplayName($displayName) {
    $this->displayName = $displayName;
  }
  public function getDisplayName() {
    return $this->displayName;
  }
  public function setEmails(/* array(displetretsidx_Google_PersonEmails) */ $emails) {
    $this->assertIsArray($emails, 'displetretsidx_Google_PersonEmails', __METHOD__);
    $this->emails = $emails;
  }
  public function getEmails() {
    return $this->emails;
  }
  public function setEtag($etag) {
    $this->etag = $etag;
  }
  public function getEtag() {
    return $this->etag;
  }
  public function setGender($gender) {
    $this->gender = $gender;
  }
  public function getGender() {
    return $this->gender;
  }
  public function setHasApp($hasApp) {
    $this->hasApp = $hasApp;
  }
  public function getHasApp() {
    return $this->hasApp;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setImage(displetretsidx_Google_PersonImage $image) {
    $this->image = $image;
  }
  public function getImage() {
    return $this->image;
  }
  public function setIsPlusUser($isPlusUser) {
    $this->isPlusUser = $isPlusUser;
  }
  public function getIsPlusUser() {
    return $this->isPlusUser;
  }
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setLanguage($language) {
    $this->language = $language;
  }
  public function getLanguage() {
    return $this->language;
  }
  public function setName(displetretsidx_Google_PersonName $name) {
    $this->name = $name;
  }
  public function getName() {
    return $this->name;
  }
  public function setNickname($nickname) {
    $this->nickname = $nickname;
  }
  public function getNickname() {
    return $this->nickname;
  }
  public function setObjectType($objectType) {
    $this->objectType = $objectType;
  }
  public function getObjectType() {
    return $this->objectType;
  }
  public function setOrganizations(/* array(displetretsidx_Google_PersonOrganizations) */ $organizations) {
    $this->assertIsArray($organizations, 'displetretsidx_Google_PersonOrganizations', __METHOD__);
    $this->organizations = $organizations;
  }
  public function getOrganizations() {
    return $this->organizations;
  }
  public function setPlacesLived(/* array(displetretsidx_Google_PersonPlacesLived) */ $placesLived) {
    $this->assertIsArray($placesLived, 'displetretsidx_Google_PersonPlacesLived', __METHOD__);
    $this->placesLived = $placesLived;
  }
  public function getPlacesLived() {
    return $this->placesLived;
  }
  public function setPlusOneCount($plusOneCount) {
    $this->plusOneCount = $plusOneCount;
  }
  public function getPlusOneCount() {
    return $this->plusOneCount;
  }
  public function setRelationshipStatus($relationshipStatus) {
    $this->relationshipStatus = $relationshipStatus;
  }
  public function getRelationshipStatus() {
    return $this->relationshipStatus;
  }
  public function setTagline($tagline) {
    $this->tagline = $tagline;
  }
  public function getTagline() {
    return $this->tagline;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
  public function setUrls(/* array(displetretsidx_Google_PersonUrls) */ $urls) {
    $this->assertIsArray($urls, 'displetretsidx_Google_PersonUrls', __METHOD__);
    $this->urls = $urls;
  }
  public function getUrls() {
    return $this->urls;
  }
  public function setVerified($verified) {
    $this->verified = $verified;
  }
  public function getVerified() {
    return $this->verified;
  }
}

class displetretsidx_Google_PersonAgeRange extends displetretsidx_Google_Model {
  public $max;
  public $min;
  public function setMax($max) {
    $this->max = $max;
  }
  public function getMax() {
    return $this->max;
  }
  public function setMin($min) {
    $this->min = $min;
  }
  public function getMin() {
    return $this->min;
  }
}

class displetretsidx_Google_PersonCover extends displetretsidx_Google_Model {
  protected $__coverInfoType = 'displetretsidx_Google_PersonCoverCoverInfo';
  protected $__coverInfoDataType = '';
  public $coverInfo;
  protected $__coverPhotoType = 'displetretsidx_Google_PersonCoverCoverPhoto';
  protected $__coverPhotoDataType = '';
  public $coverPhoto;
  public $layout;
  public function setCoverInfo(displetretsidx_Google_PersonCoverCoverInfo $coverInfo) {
    $this->coverInfo = $coverInfo;
  }
  public function getCoverInfo() {
    return $this->coverInfo;
  }
  public function setCoverPhoto(displetretsidx_Google_PersonCoverCoverPhoto $coverPhoto) {
    $this->coverPhoto = $coverPhoto;
  }
  public function getCoverPhoto() {
    return $this->coverPhoto;
  }
  public function setLayout($layout) {
    $this->layout = $layout;
  }
  public function getLayout() {
    return $this->layout;
  }
}

class displetretsidx_Google_PersonCoverCoverInfo extends displetretsidx_Google_Model {
  public $leftImageOffset;
  public $topImageOffset;
  public function setLeftImageOffset($leftImageOffset) {
    $this->leftImageOffset = $leftImageOffset;
  }
  public function getLeftImageOffset() {
    return $this->leftImageOffset;
  }
  public function setTopImageOffset($topImageOffset) {
    $this->topImageOffset = $topImageOffset;
  }
  public function getTopImageOffset() {
    return $this->topImageOffset;
  }
}

class displetretsidx_Google_PersonCoverCoverPhoto extends displetretsidx_Google_Model {
  public $height;
  public $url;
  public $width;
  public function setHeight($height) {
    $this->height = $height;
  }
  public function getHeight() {
    return $this->height;
  }
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
  public function setWidth($width) {
    $this->width = $width;
  }
  public function getWidth() {
    return $this->width;
  }
}

class displetretsidx_Google_PersonEmails extends displetretsidx_Google_Model {
  public $primary;
  public $type;
  public $value;
  public function setPrimary($primary) {
    $this->primary = $primary;
  }
  public function getPrimary() {
    return $this->primary;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
  public function setValue($value) {
    $this->value = $value;
  }
  public function getValue() {
    return $this->value;
  }
}

class displetretsidx_Google_PersonImage extends displetretsidx_Google_Model {
  public $url;
  public function setUrl($url) {
    $this->url = $url;
  }
  public function getUrl() {
    return $this->url;
  }
}

class displetretsidx_Google_PersonName extends displetretsidx_Google_Model {
  public $familyName;
  public $formatted;
  public $givenName;
  public $honorificPrefix;
  public $honorificSuffix;
  public $middleName;
  public function setFamilyName($familyName) {
    $this->familyName = $familyName;
  }
  public function getFamilyName() {
    return $this->familyName;
  }
  public function setFormatted($formatted) {
    $this->formatted = $formatted;
  }
  public function getFormatted() {
    return $this->formatted;
  }
  public function setGivenName($givenName) {
    $this->givenName = $givenName;
  }
  public function getGivenName() {
    return $this->givenName;
  }
  public function setHonorificPrefix($honorificPrefix) {
    $this->honorificPrefix = $honorificPrefix;
  }
  public function getHonorificPrefix() {
    return $this->honorificPrefix;
  }
  public function setHonorificSuffix($honorificSuffix) {
    $this->honorificSuffix = $honorificSuffix;
  }
  public function getHonorificSuffix() {
    return $this->honorificSuffix;
  }
  public function setMiddleName($middleName) {
    $this->middleName = $middleName;
  }
  public function getMiddleName() {
    return $this->middleName;
  }
}

class displetretsidx_Google_PersonOrganizations extends displetretsidx_Google_Model {
  public $department;
  public $description;
  public $endDate;
  public $location;
  public $name;
  public $primary;
  public $startDate;
  public $title;
  public $type;
  public function setDepartment($department) {
    $this->department = $department;
  }
  public function getDepartment() {
    return $this->department;
  }
  public function setDescription($description) {
    $this->description = $description;
  }
  public function getDescription() {
    return $this->description;
  }
  public function setEndDate($endDate) {
    $this->endDate = $endDate;
  }
  public function getEndDate() {
    return $this->endDate;
  }
  public function setLocation($location) {
    $this->location = $location;
  }
  public function getLocation() {
    return $this->location;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function getName() {
    return $this->name;
  }
  public function setPrimary($primary) {
    $this->primary = $primary;
  }
  public function getPrimary() {
    return $this->primary;
  }
  public function setStartDate($startDate) {
    $this->startDate = $startDate;
  }
  public function getStartDate() {
    return $this->startDate;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function getTitle() {
    return $this->title;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
}

class displetretsidx_Google_PersonPlacesLived extends displetretsidx_Google_Model {
  public $primary;
  public $value;
  public function setPrimary($primary) {
    $this->primary = $primary;
  }
  public function getPrimary() {
    return $this->primary;
  }
  public function setValue($value) {
    $this->value = $value;
  }
  public function getValue() {
    return $this->value;
  }
}

class displetretsidx_Google_PersonUrls extends displetretsidx_Google_Model {
  public $primary;
  public $type;
  public $value;
  public function setPrimary($primary) {
    $this->primary = $primary;
  }
  public function getPrimary() {
    return $this->primary;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
  public function setValue($value) {
    $this->value = $value;
  }
  public function getValue() {
    return $this->value;
  }
}

class displetretsidx_Google_PlusAclentryResource extends displetretsidx_Google_Model {
  public $displayName;
  public $id;
  public $type;
  public function setDisplayName($displayName) {
    $this->displayName = $displayName;
  }
  public function getDisplayName() {
    return $this->displayName;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function getType() {
    return $this->type;
  }
}
