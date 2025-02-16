<?php
class CMEB_Settings {

    const TYPE_BOOL = 'bool';
    const TYPE_INT = 'int';
    const TYPE_STRING = 'string';
    const TYPE_COLOR = 'color';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_RADIO = 'radio';
    const TYPE_SELECT = 'select';
    const TYPE_MULTISELECT = 'multiselect';
    const TYPE_CSV_LINE = 'csv_line';
    const TYPE_FILEUPLOAD = 'fileupload';
    const TYPE_CUSTOM = 'custom';

	// Settings
    const OPTION_WHITE_LIST = 'cmeb_whit_list';
    const OPTION_FREE_DOMAINS = 'cmeb_free_domains';
	const OPTION_EMAIL_BLACK_LIST = 'cmeb_email_white_list';
	const OPTION_IP_WHITE_LIST = 'cmeb_ip_white_list';
	
	// Labels
    const OPTION_LOGIN_ERROR = 'cmeb_login_error';
    const OPTION_BECAUSE_WHITE = 'cmeb_because_white';
    const OPTION_EMAIL_BECAUSE_BLACK = 'cmeb_email_because_black';
    const OPTION_IP_BECAUSE_BLACK = 'cmeb_ip_because_black';
	
    const ACCESS_EVERYONE = 0;
    const ACCESS_USERS = 1;
    const ACCESS_ROLE = 2;
    const EDIT_MODE_DISALLOWED = 0;
    const EDIT_MODE_WITHIN_HOUR = 1;
    const EDIT_MODE_WITHIN_DAY = 2;
    const EDIT_MODE_ANYTIME = 3;

    public static $categories = array(
        'cmeb_general' => 'General',
        'cmeb_labels' => 'Labels'
    );
	
    public static $subcategories = array(
        'cmeb_general' => array(
            'cmeb_domain' => 'Domain',
            'cmeb_email' => 'Email',
            'cmeb_ip' => 'IP',
            'cmeb_other' => 'Others',
            'cmeb_captcha' => 'Google ReCaptcha',
            'cmeb_restriction' => 'Restriction',
            'cmeb_integration' => 'Integration',
        ),
        'cmeb_labels' => array(
            'cmeb_labels_general' => 'General',
            'cmeb_labels_domain' => 'Domain',
            'cmeb_labels_email' => 'Email',
            'cmeb_labels_ip' => 'IP',
        )
    );

    public static function getOptionsConfig() {
        return apply_filters('cmeb_options_config', array(
			
			//cmeb_domain
			'_onlyinpro_a' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_domain',
				'title' => 'Domain Blacklist',
				'desc' => 'When enabled, domains on the blacklist will be marked as invalid.'
			),
			self::OPTION_WHITE_LIST => array(
				'type' => self::TYPE_BOOL,
				'default' => true,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_domain',
				'title' => 'Domain Whitelist',
				'desc' => 'When enabled, domains on the Whitelist will be automatically accepted. Domains not on the whitelist will undergo further checks.'
			),
			'_onlyinpro_b' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_domain',
				'title' => 'Accept domains only from Whitelist',
				'desc' => 'When enabled, only the domains on Whitelist will be accepted during registration. Domains not on the list will be marked as invalid.'
			),
			'_onlyinpro_c' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_domain',
				'title' => 'DNSBL Domain check',
				'desc' => 'Enable or disable DNSBL Domain service.'
			),
			self::OPTION_FREE_DOMAINS => array(
				'type' => self::TYPE_BOOL,
				'default' => true,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_domain',
				'title' => 'Free Domain list',
				'desc' => 'When enabled, domains on the Free Domain list will be marked as invalid.'
			),
				
			//cmeb_email
			self::OPTION_EMAIL_BLACK_LIST => array(
				'type'			=> self::TYPE_BOOL,
				'default'		=> false,
				'category'		=> 'cmeb_general',
				'subcategory'	=> 'cmeb_email',
				'title'			=> 'Email Blacklist',
				'desc'			=> 'When enabled, the emails on the blacklist will be marked as invalid. Email validation is checked before domain validation.',
			),
			'_onlyinpro_d' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_email',
				'title' => 'Email Whitelist',
				'desc' => 'When enabled, emails on the whitelist will be automatically accepted. Emails not on the whitelist will undergo further checks. Email validation is checked before domain validation.'
			),
			'_onlyinpro_e' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_email',
				'title' => 'Accept emails only from Whitelist',
				'desc' => 'When enabled, only the emails on Whitelist will be accepted during registration. Emails not on the list will be marked as invalid.'
			),
			
			//cmeb_ip
			'_onlyinpro_f' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_ip',
				'title' => 'IP Blacklist',
				'desc' => 'When enabled, the IP on the blacklist will be marked as invalid.'
			),
			self::OPTION_IP_WHITE_LIST => array(
				'type'			=> self::TYPE_BOOL,
				'default'		=> false,
				'category'		=> 'cmeb_general',
				'subcategory'	=> 'cmeb_ip',
				'title'			=> 'IP Whitelist',
				'desc'			=> 'When enabled, IP on the whitelist will be automatically accepted.'
			),
			'_onlyinpro_h' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_ip',
				'title' => 'Accept IPs only from Whitelist',
				'desc' => 'When enabled, only the IPs on Whitelist will be accepted during registration. IPs not on the list will be marked as invalid.'
			),
			
			//cmeb_other
			'_onlyinpro_i' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_other',
				'title' => 'Enable for edit profile',
				'desc' => 'If enabled, then filters will work when user will update own email from edit profile section.'
			),
			'_onlyinpro_j' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_other',
				'title' => 'Remove HTML tags from error messages',
				'desc' => 'If enabled, then HTML tags automatic removed from error messages.'
			),
			'_onlyinpro_k' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_other',
				'title' => 'Show Powered by CreativeMinds',
				'desc' => 'Show or hide "Powered by CreativeMinds" in the registration screen.'
			),
			
			//cmeb_captcha
			'_onlyinpro_l' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_captcha',
				'title' => 'Google ReCaptcha v3',
				'desc' => 'When enabled, the google recaptcha will be added to the login area.'
			),
			'_onlyinpro_m' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_captcha',
				'title' => 'Google ReCaptcha Site Key',
				'desc' => 'Google ReCaptcha API Site Key.'
			),
			'_onlyinpro_n' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_captcha',
				'title' => 'Google ReCaptcha Secret Key',
				'desc' => 'Google ReCaptcha API Secret Key.'
			),
			
			//cmeb_restriction
			'_onlyinpro_o' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_restriction',
				'title' => 'Enable special characters restriction on email',
				'desc' => 'Enable if you want to prevent emails which have more than X amount special characters (.,#$%+-!^*) in the email.'
			),
			'_onlyinpro_p' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_restriction',
				'title' => 'Amount of special characters',
				'desc' => 'Here you can set X amount of special characters. This will work when you will enable above setting.'
			),
			
			//cmeb_integration
			'_onlyinpro_q' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_general',
				'subcategory' => 'cmeb_integration',
				'title' => 'Contact Form 7',
				'desc' => 'When enabled, then it will work with <a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a> plugin forms.'
			),
			
			//cmeb_labels_general
			self::OPTION_LOGIN_ERROR => array(
				'type' => self::TYPE_STRING,
				'default' => 'Register error:',
				'category' => 'cmeb_labels',
				'subcategory' => 'cmeb_labels_general',
				'title' => 'Register error',
				'desc' => 'Label for \'Register error:\' message',
			),
				
			//cmeb_labels_domain
			self::OPTION_BECAUSE_WHITE => array(
				'type' => self::TYPE_STRING,
				'default' => 'Domain is blacklisted',
				'category' => 'cmeb_labels',
				'subcategory' => 'cmeb_labels_domain',
				'title' => 'Domain is in the Blacklist',
				'desc' => 'Label for \'Domain is the blacklist\' message',
			),
			'_onlyinpro_l1' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_labels',
				'subcategory' => 'cmeb_labels_domain',
				'title' => 'Domain is in the Whitelist',
				'desc' => 'Label for \'Domain is in the whitelist\' message',
			),
			'_onlyinpro_l2' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_labels',
				'subcategory' => 'cmeb_labels_domain',
				'title' => 'Domain is not in whitelist',
				'desc' => 'Label for \'Domain is not in whitelist\' message. Displayed only when option \'Accept domains only from whitelist?\' is enabled',
			),
			'_onlyinpro_l3' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_labels',
				'subcategory' => 'cmeb_labels_domain',
				'title' => 'Not Blacklisted, not Whiteliested',
				'desc' => 'Label for \'Domain is neither blacklisted nor whitelisted\' message (only at backend when testing domain)',
			),
			'_onlyinpro_l4' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_labels',
				'subcategory' => 'cmeb_labels_domain',
				'title' => 'Domain is in the DNSBL list',
				'desc' => 'Label for \'Domain is in the DNSBL list\' message',
			),
			'_onlyinpro_l5' => array(
				'type' => self::TYPE_CUSTOM,
				'category' => 'cmeb_labels',
				'subcategory' => 'cmeb_labels_domain',
				'title' => 'Domain is in the Free domains list',
				'desc' => 'Label for \'Domain is in the Free domains list\' message',
			),
				
			//cmeb_labels_email
			self::OPTION_EMAIL_BECAUSE_BLACK			 => array(
				'type'			 => self::TYPE_STRING,
				'default'		 => 'Email is blacklisted',
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_email',
				'title'			 => 'Email is in the blacklist',
				'desc'			 => 'Label for \'Email is the blacklist\' message',
			),
			'_onlyinpro_l6'		 => array(
				'type'			 => self::TYPE_CUSTOM,
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_email',
				'title'			 => 'Email is in the whitelist',
				'desc'			 => 'Label for \'Email is in the whitelist\' message',
			),
			'_onlyinpro_l7'		 => array(
				'type'			 => self::TYPE_CUSTOM,
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_email',
				'title'			 => 'Email is not in whitelist',
				'desc'			 => 'Label for \'Email is neither in the whitelist\' message',
			),
			'_onlyinpro_l8'		 => array(
				'type'			 => self::TYPE_CUSTOM,
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_email',
				'title'			 => 'Not Blacklisted, not Whiteliested',
				'desc'			 => 'Label for \'Email is neither blacklisted nor whitelisted\' message (only at backend when testing domain)',
			),
			'_onlyinpro_l9'		 => array(
				'type'			 => self::TYPE_CUSTOM,
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_email',
				'title'			 => 'Email is invalid',
				'desc'			 => 'Label for \'Email is invalid\' message',
			),
			
			//cmeb_labels_ip
			self::OPTION_IP_BECAUSE_BLACK => array(
				'type' => self::TYPE_STRING,
				'default' => 'IP is blacklisted',
				'category' => 'cmeb_labels',
				'subcategory' => 'cmeb_labels_ip',
				'title' => 'IP is in the blacklist',
				'desc' => 'Label for \'IP is the blacklist\' message',
			),
			'_onlyinpro_l10'		 => array(
				'type'			 => self::TYPE_CUSTOM,
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_ip',
				'title'			 => 'IP is in the whitelist',
				'desc'			 => 'Label for \'IP is in the whitelist\' message',
			),
			'_onlyinpro_l11'		 => array(
				'type'			 => self::TYPE_CUSTOM,
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_ip',
				'title'			 => 'IP is not in whitelist',
				'desc'			 => 'Label for \'IP is neither in the whitelist\' message',
			),
			'_onlyinpro_l12'		 => array(
				'type'			 => self::TYPE_CUSTOM,
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_ip',
				'title'			 => 'Not Blacklisted, not Whiteliested',
				'desc'			 => 'Label for \'IP is neither blacklisted nor whitelisted\' message (only at backend when testing domain)',
			),
			'_onlyinpro_l13'		 => array(
				'type'			 => self::TYPE_CUSTOM,
				'category'		 => 'cmeb_labels',
				'subcategory'	 => 'cmeb_labels_ip',
				'title'			 => 'IP is invalid',
				'desc'			 => 'Label for \'IP is invalid\' message',
			),
				
        ));
    }

    public static function getOptionsConfigByCategory($category, $subcategory = null) {
        $options = self::getOptionsConfig();
        return array_filter($options, function($val) use ($category, $subcategory) {
            if ($val['category'] == $category) {
                return (is_null($subcategory) OR $val['subcategory'] == $subcategory);
            }
        });
    }

    public static function getOptionConfig($name) {
        $options = self::getOptionsConfig();
        if (isset($options[$name])) {
            return $options[$name];
        }
    }

    public static function setOption($name, $value) {
        $options = self::getOptionsConfig();
        if (isset($options[$name])) {
            $field = $options[$name];
            $old = get_option($name);
            if (is_array($old) OR is_object($old) OR strlen((string) $old) > 0) {
                update_option($name, self::cast($value, $field['type']));
            } else {
                $result = update_option($name, self::cast($value, $field['type']));
            }
        }
    }

    public static function deleteAllOptions() {
        $params = array();
        $options = self::getOptionsConfig();
        foreach ($options as $name => $optionConfig) {
            self::deleteOption($name);
        }
        return $params;
    }

    public static function deleteOption($name) {
        $options = self::getOptionsConfig();
        if (isset($options[$name])) {
            delete_option($name);
        }
    }

    public static function getOption($name) {
        $options = self::getOptionsConfig();
        if (isset($options[$name])) {
            $field = $options[$name];
            $defaultValue = (isset($field['default']) ? $field['default'] : null);
            return self::cast(get_option($name, $defaultValue), $field['type']);
        }
    }

    public static function getCategories() {
        $categories = array();
        $options = self::getOptionsConfig();
        foreach ($options as $option) {
            $categories[] = $option['category'];
        }
        return $categories;
    }

    public static function getSubcategories($category) {
        $subcategories = array();
        $options = self::getOptionsConfig();
        foreach ($options as $option) {
            if ($option['category'] == $category) {
                $subcategories[] = $option['subcategory'];
            }
        }
        return $subcategories;
    }

    protected static function boolval($val) {
        return (boolean) $val;
    }

    protected static function arrayval($val) {
        if (is_array($val))
            return $val;
        else if (is_object($val))
            return (array) $val;
        else
            return array();
    }

    protected static function cast($val, $type) {
        if ($type == self::TYPE_BOOL) {
            return (intval($val) ? 1 : 0);
        } else {
            $castFunction = $type . 'val';
            if (function_exists($castFunction)) {
                return call_user_func($castFunction, $val);
            } else if (method_exists(__CLASS__, $castFunction)) {
                return call_user_func(array(__CLASS__, $castFunction), $val);
            } else {
                return $val;
            }
        }
    }

    protected static function csv_lineval($value) {
        if (!is_array($value))
            $value = explode(',', $value);
        return $value;
    }

    public static function processPostRequest() {
        $params = array();
        $options = self::getOptionsConfig();
        foreach ($options as $name => $optionConfig) {
            if (isset($_POST[$name])) {
                $params[$name] = sanitize_text_field($_POST[$name]);
                self::setOption($name, sanitize_text_field($_POST[$name]));
            }
        }
        return $params;
    }

    public static function userId($userId = null) {
        if (empty($userId))
            $userId = get_current_user_id();
        return $userId;
    }

    public static function isLoggedIn($userId = null) {
        $userId = self::userId($userId);
        return !empty($userId);
    }

    public static function getRolesOptions() {
        global $wp_roles;
        $result = array();
        if (!empty($wp_roles) AND is_array($wp_roles->roles))
            foreach ($wp_roles->roles as $name => $role) {
                $result[$name] = $role['name'];
            }
        return $result;
    }

    public static function canReportSpam($userId = null) {
        return (self::getOption(self::OPTION_SPAM_REPORTING_ENABLED) AND ( self::getOption(self::OPTION_SPAM_REPORTING_GUESTS) OR self::isLoggedIn($userId)));
    }

    public static function getPagesOptions() {
        $pages = get_pages(array('number' => 100));
        $result = array(null => '--');
        foreach ($pages as $page) {
            $result[$page->ID] = $page->post_title;
        }
        return $result;
    }

    public static function areAttachmentsAllowed() {
        $ext = self::getOption(self::OPTION_ATTACHMENTS_FILE_EXTENSIONS);
        return (!empty($ext) AND ( self::getOption(self::OPTION_ATTACHMENTS_ANSWERS_ALLOW) OR self::getOption(self::OPTION_ATTACHMENTS_QUESTIONS_ALLOW)));
    }

    public static function getLoginPageURL($returnURL = null) {
        if (empty($returnURL)) {
            $returnURL = get_permalink();
        }
        if ($customURL = CMEB_Settings::getOption(CMEB_Settings::OPTION_LOGIN_PAGE_LINK_URL)) {
            return esc_url(add_query_arg(array('redirect_to' => urlencode($returnURL)), $customURL));
        } else {
            return wp_login_url($returnURL);
        }
    }

}