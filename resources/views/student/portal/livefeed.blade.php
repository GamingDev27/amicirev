@extends('layouts.student')

@section('content')
<div class="video-container">
    <iframe src="https://www.youtube.com/embed/KMYZqb88Wm0?si=6sWLURxCBOBYmXwu&amp;controls=0&enablejsapi=1"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen id="youtube-player"
        style="display:none;"></iframe>
    <div class="overlay" style="display:none;"></div>
    <button class="btn btn-primary " id="start-video"><i class="fas fa-video mx-2"></i>View Livestream</button>


    <div class="spinner-border text-primary" role="status" id="spinner" style="display: none;">
        <span class="sr-only">Loading...</span>
    </div>
</div>

@endsection


@push('styles')
<style>
    .video-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 1rem;
        margin: 2rem auto;
    }

    .video-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }


    .video-container {
        width: 90vw;
        height: 80vh;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        z-index: 5;
        pointer-events: all;

    }

    #start-button {
        margin-top: 10px
    }

    @media (min-width: 768px) {
        .video-container {
            width: 80vw;
            height: 80vh;
            margin: rem auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1rem;

        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            z-index: 10;
            pointer-events: all;

        }

        .hidden {
            display: none;
        }
         
        .fullscreen .video-container {
            width: 100%;
            height: 100%;
        }

        .fullscreen .overlay {
            display: block;
        }
    }
</style>
@endpush

@once
@push('scripts')
<script>
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player( 'youtube-player', {
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        $('#start-video').click(function(event) {
            videoContainer = $('#video-container'); 
            iframe = $('#youtube-player');

            $('.overlay').toggle();
            player.playVideo();  
            $(this).hide();
            $('#spinner').show();

            console.log(videoContainer);
            
            
            setTimeout(() => {
                $('#youtube-player').show();
                $('#spinner').hide();
                var iframe = player.getIframe();
                var requestFullScreen = iframe.requestFullscreen || iframe.mozRequestFullScreen || iframe.webkitRequestFullscreen || iframe.msRequestFullscreen;
                if (requestFullScreen) {
                    requestFullScreen.call(iframe);
                } else {
                    console.log("Fullscreen API is not supported");
                }
            }, 4000);

        });

        $('.overlay').click(function(event) {
            event.stopPropagation(); 
        });
    }

/*    
    
var player, iframe;

// init player
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '200',
    width: '300',
    videoId: 'KMYZqb88Wm0',
 
  });
}
function onPlayerReady(event) {
    
}
// when ready, wait for clicks
// function onPlayerReady(event) {
//   var player = event.target;
//   iframe = $('#player');
  
// }



jQuery(document).ready(function(){
    iframe = $('#player');
    $('#start-video').click(function(event) {
        //console.log(`mama mo`);
    });
    $('button').click(function(event) {
        player.playVideo();//won't work on mobile
        console.log(`mama mo`);
       
    });
    
});
*/    
  
</script>
@endpush
@endonce