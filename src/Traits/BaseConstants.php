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
    static public $TIMEOUTS = 'timeouts';

    /** @var string */
    static public $ASYNC_SCRIPT = 'timeouts/async_script';

    /** @var string */
    static public $IMPLICIT_WAIT = 'timeouts/implicit_wait';

    /** @var string */
    static public $WINDOW_HANDLE = 'window_handle';

    /** @var string */
    static public $WINDOW_HANDLES = 'window_handles';

    /** @var string */
    static public $URL = 'url';

    /** @var string */
    static public $FORWARD = 'forward';

    /** @var string */
    static public $BACK = 'back';

    /** @var string */
    static public $REFRESH = 'refresh';

    /** @var string */
    static public $EXECUTE = 'execute';

    /** @var string */
    static public $EXECUTE_ASYNC = 'execute_async';

    /** @var string */
    static public $SCREENSHOT = 'screenshot';

    /** @var string */
    static public $AVAILABLE_ENGINES = 'ime/available_engines';

    /** @var string */
    static public $ACTIVE_ENGINE = 'ime/active_engine';

    /** @var string */
    static public $ACTIVATED = 'ime/activated';

    /** @var string */
    static public $DEACTIVATE = 'ime/deactivate';

    /** @var string */
    static public $ACTIVATE = 'ime/activate';

    /** @var string */
    static public $FRAME = 'frame';

    /** @var string */
    static public $PARENT = 'frame/parent';

    /** @var string */
    static public $WINDOW = 'window';

    /** @var string */
    static public $SIZE = 'window/:windowhandle/size';

    /** @var string */
    static public $POSITION = 'window/:windowhandle/position';

    /** @var string */
    static public $MAXIMIZE = 'window/:windowhandle/maximize';

    /** @var string */
    static public $COOKIE = 'cookie';

    /** @var string */
    static public $COOKIE_NAME = 'cookie/:name';

    /** @var string */
    static public $SOURCE = 'source';

    /** @var string */
    static public $TITLE = 'title';

    /** @var string */
    static public $ELEMENT = 'element';

    /** @var string */
    static public $ELEMENTS = 'elements';

    /** @var string */
    static public $ACTIVE = 'element/active';

    /** @var string */
    static public $ELEMENT_ELEMENTID = 'element/:elementId';

    /** @var string */
    static public $ELEMENT__ELEMENTID = 'element/:elementId/element';

    /** @var string */
    static public $ELEMENTS__ELEMENTID = 'element/:elementId/elements';

    /** @var string */
    static public $CLICK = 'element/:elementId/click';

    /** @var string */
    static public $SUBMIT = 'element/:elementId/submit';

    /** @var string */
    static public $TEXT = 'element/:elementId/text';

    /** @var string */
    static public $VALUE = 'element/:elementId/value';

    /** @var string */
    static public $KEYS = 'keys';

    /** @var string */
    static public $NAME = 'element/:elementId/name';

    /** @var string */
    static public $CLEAR = 'element/:elementId/clear';

    /** @var string */
    static public $SELECTED = 'element/:elementId/selected';

    /** @var string */
    static public $ENABLED = 'element/:elementId/enabled';

    /** @var string */
    static public $ATTRIBUTE_NAME = 'element/:elementId/attribute/:name';

    /** @var string */
    static public $EQUALS_OTHERID = 'element/:elementId/equals/:otherId';

    /** @var string */
    static public $DISPLAYED = 'element/:elementId/displayed';

    /** @var string */
    static public $LOCATION = 'element/:elementId/location';

    /** @var string */
    static public $LOCATION_IN_VIEW = 'element/:elementId/location_in_view';

    /** @var string */
    static public $SIZE__ELEMENTID = 'element/:elementId/size';

    /** @var string */
    static public $CSS_PROPERTYNAME = 'element/:elementId/css/:propertyName';

    /** @var string */
    static public $ORIENTATION = 'orientation';

    /** @var string */
    static public $ROTATION = 'rotation';

    /** @var string */
    static public $MOVETO = 'moveto';

    /** @var string */
    static public $CLICK_ = 'click';

    /** @var string */
    static public $BUTTONDOWN = 'buttondown';

    /** @var string */
    static public $BUTTONUP = 'buttonup';

    /** @var string */
    static public $DOUBLECLICK = 'doubleclick';

    /** @var string */
    static public $CLICK_TOUCH = 'touch/click';

    /** @var string */
    static public $DOWN = 'touch/down';

    /** @var string */
    static public $UP = 'touch/up';

    /** @var string */
    static public $MOVE = 'touch/move';

    /** @var string */
    static public $SCROLL = 'touch/scroll';

    /** @var string */
    static public $DOUBLECLICK_TOUCH = 'touch/doubleclick';

    /** @var string */
    static public $LONGCLICK = 'touch/longclick';

    /** @var string */
    static public $FLICK = 'touch/flick';

    /** @var string */
    static public $LOCATION_ = 'location';

    /** @var string */
    static public $LOCAL_STORAGE = 'local_storage';

    /** @var string */
    static public $KEY_KEY = 'local_storage/key/:key';

    /** @var string */
    static public $SIZE_LOCAL_STORAGE = 'local_storage/size';

    /** @var string */
    static public $SESSION_STORAGE = 'session_storage';

    /** @var string */
    static public $KEY_KEY_KEY = 'session_storage/key/:key';

    /** @var string */
    static public $SIZE_SESSION_STORAGE = 'session_storage/size';

    /** @var string */
    static public $LOG = 'log';

    /** @var string */
    static public $TYPES = 'log/types';

    /** @var string */
    static public $STATUS = 'application_cache/status';

    /** @var string */
    static public $CONTEXT = 'context';

    /** @var string */
    static public $CONTEXTS = 'contexts';

    /** @var string */
    static public $PAGEINDEX = 'element/:elementId/pageIndex';

    /** @var string */
    static public $NETWORK_CONNECTION = 'network_connection';

    /** @var string */
    static public $PERFORM = 'touch/perform';

    /** @var string */
    static public $PERFORM_MULTI = 'touch/multi/perform';

    /** @var string */
    static public $RECEIVE_ASYNC_RESPONSE = 'receive_async_response';

    /** @var string */
    static public $SHAKE = 'appium/device/shake';

    /** @var string */
    static public $SYSTEM_TIME = 'appium/device/system_time';

    /** @var string */
    static public $LOCK = 'appium/device/lock';

    /** @var string */
    static public $UNLOCK = 'appium/device/unlock';

    /** @var string */
    static public $IS_LOCKED = 'appium/device/is_locked';

    /** @var string */
    static public $START_RECORDING_SCREEN = 'appium/start_recording_screen';

    /** @var string */
    static public $STOP_RECORDING_SCREEN = 'appium/stop_recording_screen';

    /** @var string */
    static public $TYPES_PERFORMANCEDATA = 'appium/performanceData/types';

    /** @var string */
    static public $GETPERFORMANCEDATA = 'appium/getPerformanceData';

    /** @var string */
    static public $PRESS_KEYCODE = 'appium/device/press_keycode';

    /** @var string */
    static public $LONG_PRESS_KEYCODE = 'appium/device/long_press_keycode';

    /** @var string */
    static public $FINGER_PRINT = 'appium/device/finger_print';

    /** @var string */
    static public $SEND_SMS = 'appium/device/send_sms';

    /** @var string */
    static public $GSM_CALL = 'appium/device/gsm_call';

    /** @var string */
    static public $GSM_SIGNAL = 'appium/device/gsm_signal';

    /** @var string */
    static public $GSM_VOICE = 'appium/device/gsm_voice';

    /** @var string */
    static public $POWER_CAPACITY = 'appium/device/power_capacity';

    /** @var string */
    static public $POWER_AC = 'appium/device/power_ac';

    /** @var string */
    static public $NETWORK_SPEED = 'appium/device/network_speed';

    /** @var string */
    static public $KEYEVENT = 'appium/device/keyevent';

    /** @var string */
    static public $ROTATE = 'appium/device/rotate';

    /** @var string */
    static public $CURRENT_ACTIVITY = 'appium/device/current_activity';

    /** @var string */
    static public $CURRENT_PACKAGE = 'appium/device/current_package';

    /** @var string */
    static public $INSTALL_APP = 'appium/device/install_app';

    /** @var string */
    static public $REMOVE_APP = 'appium/device/remove_app';

    /** @var string */
    static public $APP_INSTALLED = 'appium/device/app_installed';

    /** @var string */
    static public $HIDE_KEYBOARD = 'appium/device/hide_keyboard';

    /** @var string */
    static public $IS_KEYBOARD_SHOWN = 'appium/device/is_keyboard_shown';

    /** @var string */
    static public $PUSH_FILE = 'appium/device/push_file';

    /** @var string */
    static public $PULL_FILE = 'appium/device/pull_file';

    /** @var string */
    static public $PULL_FOLDER = 'appium/device/pull_folder';

    /** @var string */
    static public $TOGGLE_AIRPLANE_MODE = 'appium/device/toggle_airplane_mode';

    /** @var string */
    static public $TOGGLE_DATA = 'appium/device/toggle_data';

    /** @var string */
    static public $TOGGLE_WIFI = 'appium/device/toggle_wifi';

    /** @var string */
    static public $TOGGLE_LOCATION_SERVICES = 'appium/device/toggle_location_services';

    /** @var string */
    static public $OPEN_NOTIFICATIONS = 'appium/device/open_notifications';

    /** @var string */
    static public $START_ACTIVITY = 'appium/device/start_activity';

    /** @var string */
    static public $SYSTEM_BARS = 'appium/device/system_bars';

    /** @var string */
    static public $DISPLAY_DENSITY = 'appium/device/display_density';

    /** @var string */
    static public $TOUCH_ID = 'appium/simulator/touch_id';

    /** @var string */
    static public $TOGGLE_TOUCH_ID_ENROLLMENT = 'appium/simulator/toggle_touch_id_enrollment';

    /** @var string */
    static public $LAUNCH = 'appium/app/launch';

    /** @var string */
    static public $CLOSE = 'appium/app/close';

    /** @var string */
    static public $RESET = 'appium/app/reset';

    /** @var string */
    static public $BACKGROUND = 'appium/app/background';

    /** @var string */
    static public $END_TEST_COVERAGE = 'appium/app/end_test_coverage';

    /** @var string */
    static public $STRINGS = 'appium/app/strings';

    /** @var string */
    static public $VALUE__ELEMENTID = 'appium/element/:elementId/value';

    /** @var string */
    static public $REPLACE_VALUE = 'appium/element/:elementId/replace_value';

    /** @var string */
    static public $SETTINGS = 'appium/settings';

    /** @var string */
    static public $RECEIVE_ASYNC_RESPONSE_APPIUM = 'appium/receive_async_response';

    /** @var string */
    static public $ALERT_TEXT = 'alert_text';

    /** @var string */
    static public $ACCEPT_ALERT = 'accept_alert';

    /** @var string */
    static public $DISMISS_ALERT = 'dismiss_alert';

    /** @var string */
    static public $TEXT_ALERT = 'alert/text';

    /** @var string */
    static public $ACCEPT = 'alert/accept';

    /** @var string */
    static public $DISMISS = 'alert/dismiss';

    /** @var string */
    static public $RECT = 'element/:elementId/rect';

}
