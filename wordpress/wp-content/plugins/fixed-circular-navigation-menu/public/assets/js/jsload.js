jQuery(document).ready(function($) {
	
        $('a.cn-anchor').on("click", function (e) {
            e.preventDefault();
            changeCnBtnContent('close');
            $('#cn-overlay').removeClass('on-overlay');
            $('#cn-wrapper').removeClass('opened-nav');
            var url = $(this).attr('href');
            var target = $(this).attr('target');
            window.open(url, target);
        });
        
});