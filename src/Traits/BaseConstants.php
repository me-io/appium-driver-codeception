<?php
namespace Appium\Traits;

class BaseConstants
{
                                    
	/** @var string */
	static public $POST = 'POST';
                                    
	/** @var string */
	static public $GET = 'GET';
                                    
	/** @var string */
	static public $DELETE = 'DELETE';
                                    
	/** @var string */
	public static $GETSTATUS = '/status';

	/** @var string */
	public static $CREATESESSION = '/session';

	/** @var string */
	public static $GETSESSIONS = '/sessions';

	/** @var string */
	public static $GETSESSION = '';

	/** @var string */
	public static $DELETESESSION = '';

	/** @var string */
	public static $TIMEOUTS = '/timeouts';

	/** @var string */
	public static $ASYNCSCRIPTTIMEOUT = '/timeouts/async_script';

	/** @var string */
	public static $IMPLICITWAIT = '/timeouts/implicit_wait';

	/** @var string */
	public static $GETWINDOWHANDLE = '/window_handle';

	/** @var string */
	public static $GETWINDOWHANDLES = '/window_handles';

	/** @var string */
	public static $GETURL = '/url';

	/** @var string */
	public static $SETURL = '/url';

	/** @var string */
	public static $FORWARD = '/forward';

	/** @var string */
	public static $BACK = '/back';

	/** @var string */
	public static $REFRESH = '/refresh';

	/** @var string */
	public static $EXECUTE = '/execute';

	/** @var string */
	public static $EXECUTEASYNC = '/execute_async';

	/** @var string */
	public static $GETSCREENSHOT = '/screenshot';

	/** @var string */
	public static $AVAILABLEIMEENGINES = '/ime/available_engines';

	/** @var string */
	public static $GETACTIVEIMEENGINE = '/ime/active_engine';

	/** @var string */
	public static $ISIMEACTIVATED = '/ime/activated';

	/** @var string */
	public static $DEACTIVATEIMEENGINE = '/ime/deactivate';

	/** @var string */
	public static $ACTIVATEIMEENGINE = '/ime/activate';

	/** @var string */
	public static $SETFRAME = '/frame';

	/** @var string */
	public static $SETWINDOW = '/window';

	/** @var string */
	public static $CLOSEWINDOW = '/window';

	/** @var string */
	public static $POSTWINDOWSIZE = '/window/:windowhandle/size';

	/** @var string */
	public static $GETWINDOWSIZE = '/window/:windowhandle/size';

	/** @var string */
	public static $POSTWINDOWPOSITION = '/window/:windowhandle/position';

	/** @var string */
	public static $GETWINDOWPOSITION = '/window/:windowhandle/position';

	/** @var string */
	public static $MAXIMIZEWINDOW = '/window/:windowhandle/maximize';

	/** @var string */
	public static $GETCOOKIES = '/cookie';

	/** @var string */
	public static $SETCOOKIE = '/cookie';

	/** @var string */
	public static $DELETECOOKIES = '/cookie';

	/** @var string */
	public static $DELETECOOKIE = '/cookie/:name';

	/** @var string */
	public static $GETPAGESOURCE = '/source';

	/** @var string */
	public static $TITLE = '/title';

	/** @var string */
	public static $FINDELEMENT = '/element';

	/** @var string */
	public static $FINDELEMENTS = '/elements';

	/** @var string */
	public static $ACTIVE = '/element/active';

	/** @var string */
	public static $KEYS = '/keys';

	/** @var string */
	public static $GETORIENTATION = '/orientation';

	/** @var string */
	public static $SETORIENTATION = '/orientation';

	/** @var string */
	public static $GETALERTTEXT = '/alert_text';

	/** @var string */
	public static $SETALERTTEXT = '/alert_text';

	/** @var string */
	public static $POSTACCEPTALERT = '/accept_alert';

	/** @var string */
	public static $POSTDISMISSALERT = '/dismiss_alert';

	/** @var string */
	public static $MOVETO = '/moveto';

	/** @var string */
	public static $CLICKCURRENT = '/click';

	/** @var string */
	public static $POSTBUTTONDOWN = '/buttondown';

	/** @var string */
	public static $POSTBUTTONUP = '/buttonup';

	/** @var string */
	public static $POSTDOUBLECLICK = '/doubleclick';

	/** @var string */
	public static $TOUCHCLICK = '/touch/click';

	/** @var string */
	public static $TOUCHDOWN = '/touch/down';

	/** @var string */
	public static $TOUCHUP = '/touch/up';

	/** @var string */
	public static $TOUCHMOVE = '/touch/move';

	/** @var string */
	public static $POSTTOUCHSCROLL = '/touch/scroll';

	/** @var string */
	public static $POSTTOUCHDOUBLECLICK = '/touch/doubleclick';

	/** @var string */
	public static $TOUCHLONGCLICK = '/touch/longclick';

	/** @var string */
	public static $FLICK = '/touch/flick';

	/** @var string */
	public static $GETGEOLOCATION = '/location';

	/** @var string */
	public static $SETGEOLOCATION = '/location';

	/** @var string */
	public static $GETLOCALSTORAGE = '/local_storage';

	/** @var string */
	public static $POSTLOCALSTORAGE = '/local_storage';

	/** @var string */
	public static $DELETELOCALSTORAGE = '/local_storage';

	/** @var string */
	public static $GETLOCALSTORAGEKEY = '/local_storage/key/:key';

	/** @var string */
	public static $DELETELOCALSTORAGEKEY = '/local_storage/key/:key';

	/** @var string */
	public static $GETLOCALSTORAGESIZE = '/local_storage/size';

	/** @var string */
	public static $GETSESSIONSTORAGE = '/session_storage';

	/** @var string */
	public static $POSTSESSIONSTORAGE = '/session_storage';

	/** @var string */
	public static $DELETESESSIONSTORAGE = '/session_storage';

	/** @var string */
	public static $GETSESSIONSTORAGEKEY = '/session_storage/key/:key';

	/** @var string */
	public static $DELETESESSIONSTORAGEKEY = '/session_storage/key/:key';

	/** @var string */
	public static $GETSESSIONSTORAGESIZE = '/session_storage/size';

	/** @var string */
	public static $GETLOG = '/log';

	/** @var string */
	public static $GETLOGTYPES = '/log/types';

	/** @var string */
	public static $GETAPPLICATIONCACHESTATUS = '/application_cache/status';

	/** @var string */
	public static $GETCURRENTCONTEXT = '/context';

	/** @var string */
	public static $SETCONTEXT = '/context';

	/** @var string */
	public static $GETCONTEXTS = '/contexts';

	/** @var string */
	public static $PERFORMTOUCH = '/touch/perform';

	/** @var string */
	public static $PERFORMMULTIACTION = '/touch/multi/perform';

	/** @var string */
	public static $MOBILESHAKE = '/appium/device/shake';

	/** @var string */
	public static $LOCK = '/appium/device/lock';

	/** @var string */
	public static $KEYEVENT = '/appium/device/keyevent';

	/** @var string */
	public static $PRESSKEYCODE = '/appium/device/press_keycode';

	/** @var string */
	public static $MOBILEROTATION = '/appium/device/rotate';

	/** @var string */
	public static $GETCURRENTACTIVITY = '/appium/device/current_activity';

	/** @var string */
	public static $GETCURRENTPACKAGE = '/appium/device/current_package';

	/** @var string */
	public static $INSTALLAPP = '/appium/device/install_app';

	/** @var string */
	public static $REMOVEAPP = '/appium/device/remove_app';

	/** @var string */
	public static $ISAPPINSTALLED = '/appium/device/app_installed';

	/** @var string */
	public static $PUSHFILE = '/appium/device/push_file';

	/** @var string */
	public static $PULLFILE = '/appium/device/pull_file';

	/** @var string */
	public static $PULLFOLDER = '/appium/device/pull_folder';

	/** @var string */
	public static $TOGGLEFLIGHTMODE = '/appium/device/toggle_airplane_mode';

	/** @var string */
	public static $TOGGLEWIFI = '/appium/device/toggle_wifi';

	/** @var string */
	public static $TOGGLELOCATIONSERVICES = '/appium/device/toggle_location_services';

	/** @var string */
	public static $TOGGLEDATA = '/appium/device/toggle_data';

	/** @var string */
	public static $STARTACTIVITY = '/appium/device/start_activity';

	/** @var string */
	public static $LAUNCHAPP = '/appium/app/launch';

	/** @var string */
	public static $CLOSEAPP = '/appium/app/close';

	/** @var string */
	public static $RESET = '/appium/app/reset';

	/** @var string */
	public static $BACKGROUND = '/appium/app/background';

	/** @var string */
	public static $ENDCOVERAGE = '/appium/app/end_test_coverage';

	/** @var string */
	public static $GETSTRINGS = '/appium/app/strings';

	/** @var string */
	public static $GETNETWORKCONNECTION = '/network_connection';

	/** @var string */
	public static $SETNETWORKCONNECTION = '/network_connection';

	/** @var string */
	public static $HIDEKEYBOARD = '/appium/device/hide_keyboard';

	/** @var string */
	public static $OPENNOTIFICATIONS = '/appium/device/open_notifications';

	/** @var string */
	public static $FINGERPRINT = '/appium/device/finger_print';

	/** @var string */
	public static $SENDSMS = '/appium/device/send_sms';

	/** @var string */
	public static $GSMCALL = '/appium/device/gsm_call';

	/** @var string */
	public static $GSMSIGNAL = '/appium/device/gsm_signal';

	/** @var string */
	public static $GSMVOICE = '/appium/device/gsm_voice';

	/** @var string */
	public static $POWERCAPACITY = '/appium/device/power_capacity';

	/** @var string */
	public static $POWERAC = '/appium/device/power_ac';

	/** @var string */
	public static $NETWORKSPEED = '/appium/device/network_speed';

	/** @var string */
	public static $TOUCHID = '/simulator/touch_id';

	/** @var string */
	public static $GETTIMEOUTS = '/timeouts';

	/** @var string */
	public static $POSTFRAMEPARENT = '/frame/parent';

	/** @var string */
	public static $GETCOOKIE = '/cookie/:name';

	/** @var string */
	public static $GETELEMENT = '/element/:elementid';

	/** @var string */
	public static $FINDELEMENTFROMELEMENT = '/element/:elementid/element';

	/** @var string */
	public static $FINDELEMENTSFROMELEMENT = '/element/:elementid/elements';

	/** @var string */
	public static $CLICK = '/element/:elementid/click';

	/** @var string */
	public static $SUBMIT = '/element/:elementid/submit';

	/** @var string */
	public static $GETTEXT = '/element/:elementid/text';

	/** @var string */
	public static $SETVALUE = '/element/:elementid/value';

	/** @var string */
	public static $GETNAME = '/element/:elementid/name';

	/** @var string */
	public static $CLEAR = '/element/:elementid/clear';

	/** @var string */
	public static $ELEMENTSELECTED = '/element/:elementid/selected';

	/** @var string */
	public static $ELEMENTENABLED = '/element/:elementid/enabled';

	/** @var string */
	public static $GETATTRIBUTE = '/element/:elementid/attribute/:name';

	/** @var string */
	public static $EQUALSELEMENT = '/element/:elementid/equals/:otherid';

	/** @var string */
	public static $ELEMENTDISPLAYED = '/element/:elementid/displayed';

	/** @var string */
	public static $GETLOCATION = '/element/:elementid/location';

	/** @var string */
	public static $GETLOCATIONINVIEW = '/element/:elementid/location_in_view';

	/** @var string */
	public static $GETSIZE = '/element/:elementid/size';

	/** @var string */
	public static $GETCSSPROPERTY = '/element/:elementid/css/:propertyname';

	/** @var string */
	public static $GETROTATION = '/rotation';

	/** @var string */
	public static $SETROTATION = '/rotation';

	/** @var string */
	public static $PERFORMACTIONS = '/actions';

	/** @var string */
	public static $GETPAGEINDEX = '/element/:elementid/pageindex';

	/** @var string */
	public static $RECEIVEASYNCRESPONSE = '/receive_async_response';

	/** @var string */
	public static $GETDEVICETIME = '/appium/device/system_time';

	/** @var string */
	public static $UNLOCK = '/appium/device/unlock';

	/** @var string */
	public static $ISLOCKED = '/appium/device/is_locked';

	/** @var string */
	public static $STARTRECORDINGSCREEN = '/appium/start_recording_screen';

	/** @var string */
	public static $STOPRECORDINGSCREEN = '/appium/stop_recording_screen';

	/** @var string */
	public static $GETPERFORMANCEDATATYPES = '/appium/performancedata/types';

	/** @var string */
	public static $GETPERFORMANCEDATA = '/appium/performancedata';

	/** @var string */
	public static $LONGPRESSKEYCODE = '/appium/device/long_press_keycode';

	/** @var string */
	public static $ACTIVATEAPP = '/appium/device/activate_app';

	/** @var string */
	public static $TERMINATEAPP = '/appium/device/terminate_app';

	/** @var string */
	public static $QUERYAPPSTATE = '/appium/device/app_state';

	/** @var string */
	public static $ISKEYBOARDSHOWN = '/appium/device/is_keyboard_shown';

	/** @var string */
	public static $GETSYSTEMBARS = '/appium/device/system_bars';

	/** @var string */
	public static $GETDISPLAYDENSITY = '/appium/device/display_density';

	/** @var string */
	public static $SIMULATORTOUCHID = '/appium/simulator/touch_id';

	/** @var string */
	public static $TOGGLEENROLLTOUCHID = '/appium/simulator/toggle_touch_id_enrollment';

	/** @var string */
	public static $SETVALUEIMMEDIATE = '/appium/element/:elementid/value';

	/** @var string */
	public static $REPLACEVALUE = '/appium/element/:elementid/replace_value';

	/** @var string */
	public static $UPDATESETTINGS = '/appium/settings';

	/** @var string */
	public static $GETSETTINGS = '/appium/settings';

	/** @var string */
	public static $APPRECEIVEASYNCRESPONSE = '/appium/receive_async_response';

	/** @var string */
	public static $GETALERTTEXTEX = '/alert/text';

	/** @var string */
	public static $SETALERTTEXTEX = '/alert/text';

	/** @var string */
	public static $POSTACCEPTALERTEX = '/alert/accept';

	/** @var string */
	public static $POSTDISMISSALERTEX = '/alert/dismiss';

	/** @var string */
	public static $GETELEMENTRECT = '/element/:elementid/rect';

	/** @var string */
	public static $GETELEMENTSCREENSHOT = '/screenshot/:elementid';

	/** @var string */
	public static $GETWINDOWRECT = '/window/rect';

	/** @var string */
	public static $SETWINDOWRECT = '/window/rect';

	/** @var string */
	public static $MINIMIZEWINDOW = '/window/minimize';

	/** @var string */
	public static $FULLSCREENWINDOW = '/window/fullscreen';

	/** @var string */
	public static $GETPROPERTY = '/element/:elementid/property/:name';

	/** @var string */
	public static $SETCLIPBOARD = '/appium/device/set_clipboard';

	/** @var string */
	public static $GETCLIPBOARD = '/appium/device/_clipboard';

	/** @var string */
	public static $COMPAREIMAGES = '/appium/compare_images';

}
