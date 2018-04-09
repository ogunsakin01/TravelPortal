<script src="{{asset('assets/js/respond.js')}}"></script>
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/plugins/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/plugins/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/supersized.3.1.3.min.js')}}"></script>
<script src="{{asset('assets/js/js.js')}}"></script>
<script type="text/javascript">
    /* SLIDER SETTINGS */
    jQuery(function($){
        "use strict";
        $.supersized({

            //Functionality
            slideshow               :   1,		//Slideshow on/off
            autoplay				:	1,		//Slideshow starts playing automatically
            start_slide             :   1,		//Start slide (0 is random)
            random					: 	0,		//Randomize slide order (Ignores start slide)
            slide_interval          :   10000,	//Length between transitions
            transition              :   1, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
            transition_speed		:	500,	//Speed of transition
            new_window				:	1,		//Image links open in new window/tab
            pause_hover             :   0,		//Pause slideshow on hover
            keyboard_nav            :   0,		//Keyboard navigation on/off
            performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
            image_protect			:	1,		//Disables image dragging and right click with Javascript

            //Size & Position
            min_width		        :   0,		//Min width allowed (in pixels)
            min_height		        :   0,		//Min height allowed (in pixels)
            vertical_center         :   1,		//Vertically center background
            horizontal_center       :   1,		//Horizontally center background
            fit_portrait         	:   1,		//Portrait images will not exceed browser height
            fit_landscape			:   0,		//Landscape images will not exceed browser width

            //Components
            navigation              :   1,		//Slideshow controls on/off
            thumbnail_navigation    :   1,		//Thumbnail navigation
            slide_counter           :   1,		//Display slide numbers
            slide_captions          :   1,		//Slide caption (Pull from "title" in slides array)
            slides 					:  	[		//Slideshow Images
                {image : 'assets/images/slide.jpg', title : 'Slide 1'},
                {image : 'assets/images/slide2.jpg', title : 'Slide 2'},
                {image : 'assets/images/slide.jpg', title : 'Slide 3'},
            ]

        });
    });

</script>