<?php
namespace ycd;

class Clock1Countdown extends Countdown {
	
	public function __construct() {
		parent::__construct();
		$this->setIsCountdown(false);
		add_filter('ycdGeneralMetaboxes', array($this, 'metaboxes'));
		add_action('add_meta_boxes', array($this, 'mainOptions'));
		add_filter('ycdCountdownDefaultOptions', array($this, 'defaultOptions'), 1, 1);
	}
	
	public function metaboxes($mtaboxes) {
        unset($mtaboxes['generalOptions']);
		
		return $mtaboxes;
	}
	
	public function defaultOptions($options) {
		
		return $options;
	}

    public function addToContent() {
        add_filter('the_content', array($this, 'getTheContentFilter'),99999999, 1);
    }
	
	public function includeStyles() {
		$this->includeGeneralScripts();
        wp_enqueue_script("jquery-ui-draggable");
		ScriptsIncluder::registerScript('canvas_clock.js', array('dirUrl' => YCD_COUNTDOWN_JS_URL.'clock/'));
        ScriptsIncluder::enqueueScript('canvas_clock.js');
        ScriptsIncluder::registerScript('Clock.js', array('dirUrl' => YCD_COUNTDOWN_JS_URL.'clock/'));
		ScriptsIncluder::enqueueScript('Clock.js');
	}
	
	public function mainOptions(){
		parent::mainOptions();
		add_meta_box('ycdMainOptions', __('Clock options', YCD_TEXT_DOMAIN), array($this, 'mainView'), YCD_COUNTDOWN_POST_TYPE, 'normal', 'high');
	}
	
	public function mainView() {
		$typeObj = $this;
		require_once YCD_VIEWS_MAIN_PATH.'clock1View.php';
	}
	
	public function renderLivePreview()
	{
		$typeObj = $this;
		require_once YCD_PREVIEW_VIEWS_PATH . 'circlePreview.php';
	}

    private function getClockArgs() {
    	$indicate = '#222';
    	$dial1Color = '#666600';
    	$dial2Color = '#81812e';
    	$dial3Color = '#9d9d5c';
    	$timeColor = '#333';
    	$dateColor = '#999';
	    $bgColor = '#ffffff';
    	
    	if(YCD_PKG_VERSION > YCD_FREE_VERSION) {
    		$indicate = $this->getOptionValue('ycd-clock1-indicate-color');
	    	$dial1Color = $this->getOptionValue('ycd-clock1-dial1-color');
	    	$dial2Color = $this->getOptionValue('ycd-clock1-dial2-color');
	    	$dial3Color = $this->getOptionValue('ycd-clock1-dial3-color');
	    	$timeColor = $this->getOptionValue('ycd-clock1-date-color');
	    	$dateColor = $this->getOptionValue('ycd-clock1-time-color');
	    	$bgColor = $this->getOptionValue('ycd-clock1-time-bg-color');
    	}
    	$mode = false;
    	if ($this->getOptionValue('ycd-clock-mode') == '24') {
            $mode = true;
        }

        $args = array(
            'indicate' => true,
            'indicate_color' => $indicate,
            'dial1_color' => $dial1Color,
            'dial2_color' => $dial2Color,
            'dial3_color' => $dial3Color,
            'time_add' => 1,
            'time_24h' => $mode,
            'date_add' => 3,
            'time_add_color' => $timeColor,
            'date_add_color' => $dateColor,
	        'bg_color' => $bgColor
        );

        return $args;
    }

    private function getCanvasOptions() {
    	$options = array();
    	$width = (int)$this->getOptionValue('ycd-clock1-width');
    	$timeZone = $this->getOptionValue('ycd-clock-time-zone');
        $mode = $this->getOptionValue('ycd-countdown-clock-mode');

        $options['mode'] = $mode;
    	$options['width'] = $width;
    	$options['timeZone'] = $timeZone;

        if($mode == 'timer') {
            $options['allSeconds'] = (int)$this->getOptionValue('ycd-clock-timer-hours')*3600 + (int)$this->getOptionValue('ycd-clock-timer-minutes')*60 + (int)$this->getOptionValue('ycd-clock-timer-seconds');
        }
    	
    	return $options;
    }

    private function getStylesStr() {
    	$align = $this->getOptionValue('ycd-clock1-alignment');
    	$id = $this->getId();

    	$style = '<style type="text/css">';
    	$style .= '.ycd-countdown-'.esc_attr($id).'-wrapper {';
    	$style .= 'text-align: '.esc_attr($align);
    	$style .= '}';
    	$style .= '</style>';
    	
    	return $style;
    }
	
	public function getViewContent() {
		$this->includeStyles();
		$id = $this->getId();

		$options = $this->getCanvasOptions();
		$allOptions = $this->getDataAllOptions();
		$options = $options + $allOptions;
		$options['id'] = $id;
		$width = @$options['width'];
		$args = $this->getClockArgs();

        $args = json_encode($args);
        $options = json_encode($options);

		$content = '<div class="ycd-countdown-wrapper ycd-countdown-'.esc_attr($id).'-wrapper">';
		$content .= '<canvas data-args="'.esc_attr($args).'" data-options="'.esc_attr($options).'" class="ycdClock1" width="'.esc_attr($width).'px" height="'.esc_attr($width).'px"></canvas>';
		$content .= $this->renderSubscriptionForm();
		$content .= '</div>';
		$content .= $this->getStylesStr();
	   
	   return $content;
	}
}