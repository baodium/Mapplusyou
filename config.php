<?php
/*
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
 /*
 Client ID:	
913969561812.apps.googleusercontent.com
Email address:	
913969561812@developer.gserviceaccount.com
Client secret:	
7SvqDf3rSPlM7Mofnu-zA388
Redirect URIs:	http://gcdc2013-mapplusyou.appspot.com
JavaScript origins:	http://gcdc2013-mapplusyou.appspot.com
 */
 
DEFINE('SERVER','localhost');
DEFINE('DATABASE','mapplusyou_db');
DEFINE('USERNAME','root');
DEFINE('PASSWORD','');
DEFINE('LIMIT','8');

/*


Client ID:	
123185527631-ll204ifgr6fv2p7830nqhnosak9p5di2.apps.googleusercontent.com
Email address:	
123185527631-ll204ifgr6fv2p7830nqhnosak9p5di2@developer.gserviceaccount.com
Client secret:	
k_U30l3mlc5TjHm2u8cGdRoZ
Redirect URIs:	http://localhost/xample
JavaScript origins:	http://localhost


Client ID:	
123185527631-s0lh5dr571mbo23hdjl79t7j3jf6uj3c.apps.googleusercontent.com
Email address:	
123185527631-s0lh5dr571mbo23hdjl79t7j3jf6uj3c@developer.gserviceaccount.com
Client secret:	
pET1MK9Aqny0oyPpqp_l2opG
Redirect URIs:	https://localhost/xample/
JavaScript origins:	https://localhost


Client ID:	
123185527631-1sjo0bbtl9ied6gvmk71uunju0dg5qnf.apps.googleusercontent.com
Email address:	
123185527631-1sjo0bbtl9ied6gvmk71uunju0dg5qnf@developer.gserviceaccount.com
Client secret:	
egg-1IXXHVccFPILPzlHyfZt
Redirect URIs:	http://mapplusyou.com/
JavaScript origins:	http://mapplusyou.com
*/
global $apiConfig;
$apiConfig = array(
    // True if objects should be returned by the service classes.
    // False if associative arrays should be returned (default behavior).
    'use_objects' =>false,
  
    // The application_name is included in the User-Agent HTTP header.
    'application_name' => 'mapplusyou',

    // OAuth2 Settings, you can get these keys at https://code.google.com/apis/console
    'oauth2_client_id' =>'123185527631-ll204ifgr6fv2p7830nqhnosak9p5di2.apps.googleusercontent.com',
    'oauth2_client_secret' =>'k_U30l3mlc5TjHm2u8cGdRoZ',
    'oauth2_redirect_uri' =>'http://localhost/xample',

    // The developer key, you get this at https://code.google.com/apis/console
    'developer_key' => 'AIzaSyDqqEjyaKwHduw_26LD6W8HBIEzBFhmZXg',
    // Site name to show in the Google's OAuth 1 authentication screen.
    'site_name' => 'mapplusyou',

    // Which Authentication, Storage and HTTP IO classes to use.
// Which Authentication, Storage and HTTP IO classes to use.
/*
'authClass'    => 'Google_OAuth2',
    'ioClass'      => 'Google_CurlIO',
    'cacheClass'   => 'Google_FileCache',
	
'authClass'    => 'Google_OAuth2',
'ioClass'      => 'Google_HttpStreamIO',
'cacheClass'   => 'Google_MemcacheCache',

*/
    'authClass'    => 'Google_OAuth2',
    'ioClass'      => 'Google_CurlIO',
    'cacheClass'   => 'Google_FileCache',

// We need to configure fake values for memcache to work
'ioMemCacheCache_host' => 'does_not_matter',
'ioMemCacheCache_port' => '37337',
    // Don't change these unless you're working against a special development or testing environment.
    'basePath' => 'https://www.googleapis.com',

    // IO Class dependent configuration, you only have to configure the values
    // for the class that was configured as the ioClass above
    'ioFileCache_directory'  =>
        (function_exists('sys_get_temp_dir') ?
            sys_get_temp_dir() . '/Google_Client' :
        '/tmp/Google_Client'),

    // Definition of service specific values like scopes, oauth token URLs, etc
    'services' => array(
      'analytics' => array('scope' => 'https://www.googleapis.com/auth/analytics.readonly'),
      'calendar' => array(
          'scope' => array(
              "https://www.googleapis.com/auth/calendar",
              "https://www.googleapis.com/auth/calendar.readonly",
          )
      ),
      'books' => array('scope' => 'https://www.googleapis.com/auth/books'),
      'latitude' => array(
          'scope' => array(
              'https://www.googleapis.com/auth/latitude.all.best',
              'https://www.googleapis.com/auth/latitude.all.city',
          )
      ),
      'moderator' => array('scope' => 'https://www.googleapis.com/auth/moderator'),
      'oauth2' => array(
          'scope' => array(
              'https://www.googleapis.com/auth/userinfo.profile',
              'https://www.googleapis.com/auth/userinfo.email',
          )
      ),
      'plus' => array('scope' => array('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/devstorage.full_control','https://www.googleapis.com/auth/youtube','https://www.googleapis.com/auth/youtube.upload','https://www.googleapis.com/auth/calendar')),
      'siteVerification' => array('scope' => 'https://www.googleapis.com/auth/siteverification'),
      'tasks' => array('scope' => 'https://www.googleapis.com/auth/tasks'),
      'urlshortener' => array('scope' => 'https://www.googleapis.com/auth/urlshortener')
    )
);
