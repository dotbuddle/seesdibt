<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );

if( isset($_REQUEST['text']) ) {
	$ret = $c->update( $_REQUEST['text'] );	//����΢��
	if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
		echo "<p>����ʧ�ܣ�����{$ret['error_code']}:{$ret['error']}</p>";
	} else {
		echo "<p>���ͳɹ�</p>";
	}
}
?>