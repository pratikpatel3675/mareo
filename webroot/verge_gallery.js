(function($) {
    $.fn.VergeGallery = function() {
        var images = $(this).find('img');
        $(this).find('img').on('click', function() {
            $('html body').append('<style type="text/css"> \
                    #gallery_preview { \
                        align-items:center; \
                        background:rgba(0,0,0,0.5); \
                        display:flex; \
                        font-family:monospace; \
                        font-size:30px; \
                        height:100%; \
                        justify-content:center; \
                        left:0; \
                        position:fixed; \
                        text-align:center; \
                        top:0; \
                        width:100%; \
                        z-index:1000; \
                    } \
                    #gallery_preview #picture { \
                        background:#fff; \
                        border-radius:15px; \
                        border:20px solid #fff; \
                        box-sizing:content-box; \
                        height:85vh; \
                        margin:auto; \
                        padding:0; \
                        position:relative; \
                    } \
                    #gallery_preview #prev_pic, \
                    #gallery_preview #next_pic { \
                        color:#fff; \
                        cursor:pointer; \
                        display:block; \
                        height:100%; \
                        position:absolute; \
                        top:0px;\
                        vertical-align: middle; \
                        width:25px; \
                        z-index:1001; \
                    } \
                    #prev_pic span, #next_pic span { \
                        left:5px; \
                        margin-top:-15px; \
                        position:absolute; \
                        top:50%; \
                    }\
                    #gallery_preview #prev_pic:hover, \
                    #gallery_preview #next_pic:hover { \
                        background:rgba(0, 0, 0, 0.3); \
                    } \
                    #gallery_preview #prev_pic { \
                        left:0px; \
                    } \
                    #gallery_preview #next_pic { \
                        right:0px;\
                    } \
                    #gallery_preview #close { \
                        color:#5a5a5a; \
                        cursor:pointer; \
                        display:block; \
                        font-weight:bold; \
                        height:10px; \
                        line-height:1px; \
                        margin:0; \
                        padding:0; \
                        position:absolute; \
                        right:-16px; \
                        top:-9px; \
                        z-index:1001; \
                    } \
                    #gallery_preview #close:hover { \
                        color:#777; \
                    } \
                    #gallery_preview img { \
                        height:85vh; \
                        width:auto; \
                    } \
                    #gallery_preview #verge_footer { \
                        bottom:-20px;\
                        position:absolute; \
                        right:20px;\
                    } \
                    #gallery_preview #verge_footer a{ \
                        color:#777;\
                        font-family:helvetica; \
                        font-size:11px; \
                        text-decoration:none; \
                    }\
                </style> \
                <div id="gallery_preview"> \
                    <div id="picture"> \
                        <div id="close" title="close">&#215;</div> \
                        <div id="prev_pic" href="#" role="button"><span>&lt;</span></div> \
                        <img src="' + $(this).attr('src') + '"> \
                        <div id="next_pic" href="#" role="button"><span>&gt;</span></div> \
                        <span id="verge_footer"><a href="https://github.com/enzo-bc/VergeGallery">VergeGallery</a></span> \
                    </div> \
                </div>');
        });
        $(document).on('click', '#prev_pic', function() {
            var current = $(this).next('img');
            for (var i = 0; i < images.length; ++i) {
                if ($(images[i]).attr('src') == current.attr('src')) {
                    if (i > 0) {
                        current.attr('src', $(images[i-1]).attr('src'));
                    } else {
                        current.attr('src', $(images[images.length - 1]).attr('src'));
                    }
                    break;
                }
            };
        });
        $(document).on('click', '#next_pic', function() {
            var current = $(this).prev('img');
            for (var i = 0; i < images.length; ++i) {
                if ($(images[i]).attr('src') == current.attr('src')) {
                    if (i < images.length - 1) {
                        current.attr('src', $(images[i+1]).attr('src'));
                    } else {
                        current.attr('src', $(images[0]).attr('src'));
                    }
                    break;
                }
            };
        });
        $(document).on('click', '#gallery_preview #close', function() {
            $('#gallery_preview').remove();
        });
    }
}(jQuery));
