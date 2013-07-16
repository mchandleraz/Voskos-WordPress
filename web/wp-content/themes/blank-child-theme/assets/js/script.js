$(function() {

	//set variables to determine if scripts for a particular environment need to be called.
	mobileEnvironment = 1;
	tabletEnvironment = 0;
	desktopEnvironment = 0;

	universalController();

	environmentChecker();
	$(window).resize(function(){
		environmentChecker();
	});
});


/**
 * environmentChecker()
 * Checks to see if Mobile, Tablet, or Desktop
 */
function environmentChecker() {
	console.log('environmentChecker fired');

	if ($(window).width() >= 960) {
		if (tabletEnvironment == 0){
			tabletEnvironment = 1;
			tabletController();
		}; //tabletcheck
		if (desktopEnvironment == 0){
			desktopEnvironment = 1;
			desktopController();
		}; //desktopcheck
		$('body').removeClass('mobile').removeClass('tablet').addClass('desktop');


	} else if ($(window).width() >= 600) {
		if (tabletEnvironment == 0){
			tabletEnvironment = 1;
			tabletController();
		}; //tabletcheck
		$('body').removeClass('mobile').removeClass('desktop').addClass('tablet');

	} else {
		$('body').removeClass('tablet').removeClass('desktop').addClass('mobile');
	}; //window.width

}; //environmentChecker


/**
 * universalController()
 * Run Universal Functions
 */
function universalController() {
	console.log('universalController Fired');

}; //universalController


/**
 * tabletController()
 * Run Tablet Functions
 */
function tabletController() {
	console.log('tabletController Fired');
	
}; //tabletController


/**
 * desktopController()
 * Run Desktop Functions
 */
function desktopController() {
	console.log('desktopController Fired');

}; //desktopController