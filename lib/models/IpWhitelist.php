<?php
class CMEB_IpWhitelist {

    const MENU_OPTION			= 'cmeb_ip_whitelist_option';
    const TABLE_NAME            = 'cmeb_ip_list';

    public static function isValid($ip) {
        global $wpdb;
        $sql = "SELECT COUNT(*) FROM " . $wpdb->prefix . self::TABLE_NAME . " WHERE whitelist=1 AND '" . esc_sql($ip) . "' LIKE REPLACE(ip, '*', '%')";
        $found = $wpdb->get_var($sql);
        return ($found > 0);
    }
	
	public static function install($network_wide = null) {
		global $wpdb;
		if ( is_multisite() && $network_wide ) {
			// Get all blogs in the network and activate plugin on each one
			$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				self::create_table();
				restore_current_blog();
			}
		} else {
			self::create_table();
		}
	}

    public static function uninstall() {
        //covered already by IpBlacklist
    }
	
	public static function create_table() {
		global $wpdb;
		$table_name 	 = $wpdb->prefix . self::TABLE_NAME;
		$charset_collate = $wpdb->get_charset_collate();
		if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name)  {
			$sql = "CREATE TABLE ".$table_name." (
			id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
			ip VARCHAR(100) NOT NULL,
			whitelist TINYINT(1) DEFAULT 0,
			UNIQUE KEY id (id) ) ".$charset_collate.";";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
	}
	
    public static function getIpsWhitelist() {
		self::create_table();
        global $wpdb;
        $sql = "SELECT * FROM " . $wpdb->prefix . self::TABLE_NAME . ' WHERE whitelist=1 ORDER BY ip ASC';
        return $wpdb->get_results($sql);
    }

    public static function _processAdminRequest() {
        isset($_POST['cmeb_ip_white'])?$var = $_POST['cmeb_ip_white']: $var = $_GET['cmeb_ip_white'];
        switch ($var) {
            case 'add':
				if ( wp_verify_nonce( $_POST['cmeb_ip_whitelist_form_nonce'], 'cmeb_ip_whitelist_form_nonce' ) ) {
					self::addIp($_POST['ip_white']);
				}
                break;
            case 'edit':
				if ( wp_verify_nonce( $_POST['cmeb_ip_whitelist_form_nonce'], 'cmeb_ip_whitelist_form_nonce' ) ) {
					$ids = $_POST['white_id'];
					$ips = $_POST['ip_white'];
					foreach ($ids as $key => $id) {
						self::editIp($id, $ips[$key]);
					}
				}
                break;
            case 'delete':
				if ( wp_verify_nonce( $_GET['nonce'], 'cmeb_ip_whitelist_form_nonce' ) ) {
					self::deleteIp($_GET['white_id']);
				}
                break;
			case 'clear':
                self::clearLog();
                break;
        }
    }

	public static function clearLog() {
		global $wpdb;
		$sql = "delete FROM " . $wpdb->prefix . self::TABLE_NAME . ' WHERE whitelist=1';
        $wpdb->query($sql);
    }

    public static function sanitizeIpName($name) {
        return trim(strtolower($name));
    }

	public static function isValidIpName($name) {
        $regex = "/[0-9*]{1,3}[.][0-9*]{1,3}[.][0-9*]{1,3}[.][0-9*]{1,3}/";
        return preg_match($regex, $name);
    }

    public static function ipExists($name, $id = null) {
        global $wpdb;
        $sql = $wpdb->prepare("SELECT COUNT(*) FROM " . $wpdb->prefix . self::TABLE_NAME . ' WHERE whitelist=1 AND ip=%s', $name);
        if (!empty($id) && is_numeric($id)) {
            $sql.=' AND id=' . $id;
        }
        return ($wpdb->get_var($sql) > 0);
    }

    public static function addIp($name) {
    	global $wpdb;
		$name = self::sanitizeIpName($name);
		if($name == '') {
			throw new Exception('Please enter valid IP address');
		} elseif (!self::isValidIpName($name)) {
			throw new Exception('IP address (' . $name . ') is not valid');
		} elseif (self::ipExists($name)) {
			throw new Exception('IP (' . $name . ') already exists in the system');
		} else {
			$wpdb->insert($wpdb->prefix . self::TABLE_NAME, array('ip' => $name, 'whitelist' => 1));
			$id = $wpdb->insert_id;
		}
    }

    public static function editIp($id, $name) {
        global $wpdb;
        $name = self::sanitizeIpName($name);
        if($name == '') {
			throw new Exception('Please enter valid IP address');
		} elseif (!self::isValidIpName($name)) {
            throw new Exception('IP address (' . $name . ') is not valid');
        } elseif (self::ipExists($name, $id)) {
            throw new Exception('IP address (' . $name . ') already exists in the system');
        } else {
            $wpdb->update($wpdb->prefix . self::TABLE_NAME, array('ip' => $name, 'whitelist' => 1), array('id' => $id));
        }
    }

    public static function deleteIp($id) {
        global $wpdb;
        $wpdb->delete($wpdb->prefix . self::TABLE_NAME, array('id' => $id));
    }

}