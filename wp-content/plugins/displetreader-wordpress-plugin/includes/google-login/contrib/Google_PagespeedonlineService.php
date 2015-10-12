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
   * The "pagespeedapi" collection of methods.
   * Typical usage is:
   *  <code>
   *   $pagespeedonlineService = new displetretsidx_Google_PagespeedonlineService(...);
   *   $pagespeedapi = $pagespeedonlineService->pagespeedapi;
   *  </code>
   */
  class displetretsidx_Google_PagespeedapiServiceResource extends displetretsidx_Google_ServiceResource {


    /**
     * Runs Page Speed analysis on the page at the specified URL, and returns a Page Speed score, a list
     * of suggestions to make that page faster, and other information. (pagespeedapi.runpagespeed)
     *
     * @param string $url The URL to fetch and analyze
     * @param array $optParams Optional parameters.
     *
     * @opt_param string locale The locale used to localize formatted results
     * @opt_param string rule A Page Speed rule to run; if none are given, all rules are run
     * @opt_param string strategy The analysis strategy to use
     * @return displetretsidx_Google_Result
     */
    public function runpagespeed($url, $optParams = array()) {
      $params = array('url' => $url);
      $params = array_merge($params, $optParams);
      $data = $this->__call('runpagespeed', array($params));
      if ($this->useObjects()) {
        return new displetretsidx_Google_Result($data);
      } else {
        return $data;
      }
    }
  }

/**
 * Service definition for displetretsidx_Google_Pagespeedonline (v1).
 *
 * <p>
 * Lets you analyze the performance of a web page and get tailored suggestions to make that page faster.
 * </p>
 *
 * <p>
 * For more information about this service, see the
 * <a href="https://code.google.com/apis/pagespeedonline/v1/getting_started.html" target="_blank">API Documentation</a>
 * </p>
 *
 * @author Google, Inc.
 */
class displetretsidx_Google_PagespeedonlineService extends displetretsidx_Google_Service {
  public $pagespeedapi;
  /**
   * Constructs the internal representation of the Pagespeedonline service.
   *
   * @param displetretsidx_Google_Client $client
   */
  public function __construct(displetretsidx_Google_Client $client) {
    $this->servicePath = 'pagespeedonline/v1/';
    $this->version = 'v1';
    $this->serviceName = 'pagespeedonline';

    $client->addService($this->serviceName, $this->version);
    $this->pagespeedapi = new displetretsidx_Google_PagespeedapiServiceResource($this, $this->serviceName, 'pagespeedapi', json_decode('{"methods": {"runpagespeed": {"httpMethod": "GET", "response": {"$ref": "Result"}, "id": "pagespeedonline.pagespeedapi.runpagespeed", "parameters": {"locale": {"type": "string", "location": "query"}, "url": {"required": true, "type": "string", "location": "query"}, "rule": {"repeated": true, "type": "string", "location": "query"}, "strategy": {"enum": ["desktop", "mobile"], "type": "string", "location": "query"}}, "path": "runPagespeed"}}}', true));

  }
}

class displetretsidx_Google_Result extends displetretsidx_Google_Model {
  public $kind;
  protected $__formattedResultsType = 'displetretsidx_Google_ResultFormattedResults';
  protected $__formattedResultsDataType = '';
  public $formattedResults;
  public $title;
  protected $__versionType = 'displetretsidx_Google_ResultVersion';
  protected $__versionDataType = '';
  public $version;
  public $score;
  public $responseCode;
  public $invalidRules;
  protected $__pageStatsType = 'displetretsidx_Google_ResultPageStats';
  protected $__pageStatsDataType = '';
  public $pageStats;
  public $id;
  public function setKind($kind) {
    $this->kind = $kind;
  }
  public function getKind() {
    return $this->kind;
  }
  public function setFormattedResults(displetretsidx_Google_ResultFormattedResults $formattedResults) {
    $this->formattedResults = $formattedResults;
  }
  public function getFormattedResults() {
    return $this->formattedResults;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function getTitle() {
    return $this->title;
  }
  public function setVersion(displetretsidx_Google_ResultVersion $version) {
    $this->version = $version;
  }
  public function getVersion() {
    return $this->version;
  }
  public function setScore($score) {
    $this->score = $score;
  }
  public function getScore() {
    return $this->score;
  }
  public function setResponseCode($responseCode) {
    $this->responseCode = $responseCode;
  }
  public function getResponseCode() {
    return $this->responseCode;
  }
  public function setInvalidRules(/* array(displetretsidx_Google_string) */ $invalidRules) {
    $this->assertIsArray($invalidRules, 'displetretsidx_Google_string', __METHOD__);
    $this->invalidRules = $invalidRules;
  }
  public function getInvalidRules() {
    return $this->invalidRules;
  }
  public function setPageStats(displetretsidx_Google_ResultPageStats $pageStats) {
    $this->pageStats = $pageStats;
  }
  public function getPageStats() {
    return $this->pageStats;
  }
  public function setId($id) {
    $this->id = $id;
  }
  public function getId() {
    return $this->id;
  }
}

class displetretsidx_Google_ResultFormattedResults extends displetretsidx_Google_Model {
  public $locale;
  protected $__ruleResultsType = 'displetretsidx_Google_ResultFormattedResultsRuleResults';
  protected $__ruleResultsDataType = 'map';
  public $ruleResults;
  public function setLocale($locale) {
    $this->locale = $locale;
  }
  public function getLocale() {
    return $this->locale;
  }
  public function setRuleResults(displetretsidx_Google_ResultFormattedResultsRuleResults $ruleResults) {
    $this->ruleResults = $ruleResults;
  }
  public function getRuleResults() {
    return $this->ruleResults;
  }
}

class displetretsidx_Google_ResultFormattedResultsRuleResults extends displetretsidx_Google_Model {
  public $localizedRuleName;
  protected $__urlBlocksType = 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocks';
  protected $__urlBlocksDataType = 'array';
  public $urlBlocks;
  public $ruleScore;
  public $ruleImpact;
  public function setLocalizedRuleName($localizedRuleName) {
    $this->localizedRuleName = $localizedRuleName;
  }
  public function getLocalizedRuleName() {
    return $this->localizedRuleName;
  }
  public function setUrlBlocks(/* array(displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocks) */ $urlBlocks) {
    $this->assertIsArray($urlBlocks, 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocks', __METHOD__);
    $this->urlBlocks = $urlBlocks;
  }
  public function getUrlBlocks() {
    return $this->urlBlocks;
  }
  public function setRuleScore($ruleScore) {
    $this->ruleScore = $ruleScore;
  }
  public function getRuleScore() {
    return $this->ruleScore;
  }
  public function setRuleImpact($ruleImpact) {
    $this->ruleImpact = $ruleImpact;
  }
  public function getRuleImpact() {
    return $this->ruleImpact;
  }
}

class displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocks extends displetretsidx_Google_Model {
  protected $__headerType = 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksHeader';
  protected $__headerDataType = '';
  public $header;
  protected $__urlsType = 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrls';
  protected $__urlsDataType = 'array';
  public $urls;
  public function setHeader(displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksHeader $header) {
    $this->header = $header;
  }
  public function getHeader() {
    return $this->header;
  }
  public function setUrls(/* array(displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrls) */ $urls) {
    $this->assertIsArray($urls, 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrls', __METHOD__);
    $this->urls = $urls;
  }
  public function getUrls() {
    return $this->urls;
  }
}

class displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksHeader extends displetretsidx_Google_Model {
  protected $__argsType = 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksHeaderArgs';
  protected $__argsDataType = 'array';
  public $args;
  public $format;
  public function setArgs(/* array(displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksHeaderArgs) */ $args) {
    $this->assertIsArray($args, 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksHeaderArgs', __METHOD__);
    $this->args = $args;
  }
  public function getArgs() {
    return $this->args;
  }
  public function setFormat($format) {
    $this->format = $format;
  }
  public function getFormat() {
    return $this->format;
  }
}

class displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksHeaderArgs extends displetretsidx_Google_Model {
  public $type;
  public $value;
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

class displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrls extends displetretsidx_Google_Model {
  protected $__detailsType = 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsDetails';
  protected $__detailsDataType = 'array';
  public $details;
  protected $__resultType = 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsResult';
  protected $__resultDataType = '';
  public $result;
  public function setDetails(/* array(displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsDetails) */ $details) {
    $this->assertIsArray($details, 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsDetails', __METHOD__);
    $this->details = $details;
  }
  public function getDetails() {
    return $this->details;
  }
  public function setResult(displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsResult $result) {
    $this->result = $result;
  }
  public function getResult() {
    return $this->result;
  }
}

class displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsDetails extends displetretsidx_Google_Model {
  protected $__argsType = 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsDetailsArgs';
  protected $__argsDataType = 'array';
  public $args;
  public $format;
  public function setArgs(/* array(displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsDetailsArgs) */ $args) {
    $this->assertIsArray($args, 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsDetailsArgs', __METHOD__);
    $this->args = $args;
  }
  public function getArgs() {
    return $this->args;
  }
  public function setFormat($format) {
    $this->format = $format;
  }
  public function getFormat() {
    return $this->format;
  }
}

class displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsDetailsArgs extends displetretsidx_Google_Model {
  public $type;
  public $value;
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

class displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsResult extends displetretsidx_Google_Model {
  protected $__argsType = 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsResultArgs';
  protected $__argsDataType = 'array';
  public $args;
  public $format;
  public function setArgs(/* array(displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsResultArgs) */ $args) {
    $this->assertIsArray($args, 'displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsResultArgs', __METHOD__);
    $this->args = $args;
  }
  public function getArgs() {
    return $this->args;
  }
  public function setFormat($format) {
    $this->format = $format;
  }
  public function getFormat() {
    return $this->format;
  }
}

class displetretsidx_Google_ResultFormattedResultsRuleResultsUrlBlocksUrlsResultArgs extends displetretsidx_Google_Model {
  public $type;
  public $value;
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

class displetretsidx_Google_ResultPageStats extends displetretsidx_Google_Model {
  public $otherResponseBytes;
  public $flashResponseBytes;
  public $totalRequestBytes;
  public $numberCssResources;
  public $numberResources;
  public $cssResponseBytes;
  public $javascriptResponseBytes;
  public $imageResponseBytes;
  public $numberHosts;
  public $numberStaticResources;
  public $htmlResponseBytes;
  public $numberJsResources;
  public $textResponseBytes;
  public function setOtherResponseBytes($otherResponseBytes) {
    $this->otherResponseBytes = $otherResponseBytes;
  }
  public function getOtherResponseBytes() {
    return $this->otherResponseBytes;
  }
  public function setFlashResponseBytes($flashResponseBytes) {
    $this->flashResponseBytes = $flashResponseBytes;
  }
  public function getFlashResponseBytes() {
    return $this->flashResponseBytes;
  }
  public function setTotalRequestBytes($totalRequestBytes) {
    $this->totalRequestBytes = $totalRequestBytes;
  }
  public function getTotalRequestBytes() {
    return $this->totalRequestBytes;
  }
  public function setNumberCssResources($numberCssResources) {
    $this->numberCssResources = $numberCssResources;
  }
  public function getNumberCssResources() {
    return $this->numberCssResources;
  }
  public function setNumberResources($numberResources) {
    $this->numberResources = $numberResources;
  }
  public function getNumberResources() {
    return $this->numberResources;
  }
  public function setCssResponseBytes($cssResponseBytes) {
    $this->cssResponseBytes = $cssResponseBytes;
  }
  public function getCssResponseBytes() {
    return $this->cssResponseBytes;
  }
  public function setJavascriptResponseBytes($javascriptResponseBytes) {
    $this->javascriptResponseBytes = $javascriptResponseBytes;
  }
  public function getJavascriptResponseBytes() {
    return $this->javascriptResponseBytes;
  }
  public function setImageResponseBytes($imageResponseBytes) {
    $this->imageResponseBytes = $imageResponseBytes;
  }
  public function getImageResponseBytes() {
    return $this->imageResponseBytes;
  }
  public function setNumberHosts($numberHosts) {
    $this->numberHosts = $numberHosts;
  }
  public function getNumberHosts() {
    return $this->numberHosts;
  }
  public function setNumberStaticResources($numberStaticResources) {
    $this->numberStaticResources = $numberStaticResources;
  }
  public function getNumberStaticResources() {
    return $this->numberStaticResources;
  }
  public function setHtmlResponseBytes($htmlResponseBytes) {
    $this->htmlResponseBytes = $htmlResponseBytes;
  }
  public function getHtmlResponseBytes() {
    return $this->htmlResponseBytes;
  }
  public function setNumberJsResources($numberJsResources) {
    $this->numberJsResources = $numberJsResources;
  }
  public function getNumberJsResources() {
    return $this->numberJsResources;
  }
  public function setTextResponseBytes($textResponseBytes) {
    $this->textResponseBytes = $textResponseBytes;
  }
  public function getTextResponseBytes() {
    return $this->textResponseBytes;
  }
}

class displetretsidx_Google_ResultVersion extends displetretsidx_Google_Model {
  public $major;
  public $minor;
  public function setMajor($major) {
    $this->major = $major;
  }
  public function getMajor() {
    return $this->major;
  }
  public function setMinor($minor) {
    $this->minor = $minor;
  }
  public function getMinor() {
    return $this->minor;
  }
}
